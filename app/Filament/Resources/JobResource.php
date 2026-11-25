<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobResource\Pages;
use App\Models\Job;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class JobResource extends Resource
{
    protected static ?string $model = Job::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

    protected static ?string $navigationGroup = 'Operations';

    protected static ?string $navigationLabel = 'Jobs / Projects';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('job_number')->required()->unique(ignoreRecord: true),
            Forms\Components\Select::make('customer_id')->relationship('customer', 'name')->searchable()->required(),
            Forms\Components\Select::make('assigned_to')->relationship('assignee', 'name')->searchable(),
            Forms\Components\TextInput::make('title')->required(),
            Forms\Components\Select::make('service_type')->options([
                'pergola' => 'Freestanding pergola',
                'gazebo' => 'Gazebo pavilion',
                'attached' => 'Attached patio cover',
                'repair' => 'Repair / reinforcement',
                'stain' => 'Stain / reseal',
            ]),
            Forms\Components\Select::make('status')->options([
                'lead' => 'Lead',
                'estimate' => 'Estimate',
                'scheduled' => 'Scheduled',
                'in_progress' => 'In progress',
                'completed' => 'Completed',
                'cancelled' => 'Cancelled',
            ])->required(),
            Forms\Components\Select::make('priority')->options([
                'low' => 'Low',
                'normal' => 'Normal',
                'high' => 'High',
            ])->default('normal'),
            Forms\Components\TextInput::make('address'),
            Forms\Components\DatePicker::make('start_date'),
            Forms\Components\DatePicker::make('due_date'),
            Forms\Components\TextInput::make('estimated_value')->numeric()->prefix('$'),
            Forms\Components\TextInput::make('actual_value')->numeric()->prefix('$'),
            Forms\Components\Textarea::make('description')->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('job_number')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('title')->searchable()->limit(30),
                Tables\Columns\TextColumn::make('customer.name'),
                Tables\Columns\TextColumn::make('status')->badge(),
                Tables\Columns\TextColumn::make('priority')->badge(),
                Tables\Columns\TextColumn::make('estimated_value')->money('USD'),
                Tables\Columns\TextColumn::make('due_date')->date(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')->options([
                    'lead' => 'Lead',
                    'estimate' => 'Estimate',
                    'scheduled' => 'Scheduled',
                    'in_progress' => 'In progress',
                    'completed' => 'Completed',
                ]),
            ])
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
        return [
            'index' => Pages\ManageJobs::route('/'),
        ];
    }
}
