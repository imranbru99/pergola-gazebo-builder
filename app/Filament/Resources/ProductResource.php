<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?string $navigationGroup = 'Inventory';

    protected static ?string $navigationLabel = 'Products & Lumber';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required(),
            Forms\Components\TextInput::make('sku')->required()->unique(ignoreRecord: true),
            Forms\Components\Select::make('category')->options([
                'lumber' => 'Lumber',
                'hardware' => 'Hardware',
                'finish' => 'Stain / finish',
                'lighting' => 'Lighting',
                'supplies' => 'Supplies',
            ]),
            Forms\Components\Textarea::make('description')->columnSpanFull(),
            Forms\Components\TextInput::make('unit_cost')->numeric()->prefix('$'),
            Forms\Components\TextInput::make('unit_price')->numeric()->prefix('$'),
            Forms\Components\TextInput::make('stock_qty')->numeric()->default(0),
            Forms\Components\TextInput::make('unit')->default('each'),
            Forms\Components\Toggle::make('is_active')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sku')->searchable(),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('category')->badge(),
                Tables\Columns\TextColumn::make('stock_qty')->label('Qty'),
                Tables\Columns\TextColumn::make('unit_price')->money('USD'),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
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
            'index' => Pages\ManageProducts::route('/'),
        ];
    }
}
