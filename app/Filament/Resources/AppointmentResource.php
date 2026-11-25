<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppointmentResource\Pages;
use App\Models\Appointment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationGroup = 'Operations';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('customer_id')->relationship('customer', 'name')->searchable()->required(),
            Forms\Components\Select::make('job_id')->relationship('job', 'job_number')->searchable(),
            Forms\Components\Select::make('assigned_to')->relationship('assignee', 'name')->searchable(),
            Forms\Components\TextInput::make('title')->required(),
            Forms\Components\Select::make('type')->options([
                'estimate' => 'Estimate',
                'site_measure' => 'Site measure',
                'install' => 'Install / frame',
                'punch' => 'Punch list',
                'follow_up' => 'Follow-up',
            ]),
            Forms\Components\Select::make('status')->options([
                'scheduled' => 'Scheduled',
                'completed' => 'Completed',
                'cancelled' => 'Cancelled',
                'no_show' => 'No show',
            ])->default('scheduled'),
            Forms\Components\DateTimePicker::make('starts_at')->required(),
            Forms\Components\DateTimePicker::make('ends_at'),
            Forms\Components\TextInput::make('location'),
            Forms\Components\Textarea::make('notes')->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('customer.name'),
                Tables\Columns\TextColumn::make('type')->badge(),
                Tables\Columns\TextColumn::make('status')->badge(),
                Tables\Columns\TextColumn::make('starts_at')->dateTime()->sortable(),
                Tables\Columns\TextColumn::make('assignee.name')->label('Tech'),
            ])
            ->defaultSort('starts_at')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ManageAppointments::route('/')];
    }
}
