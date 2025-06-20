<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;


class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->relationship('product', 'name')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->reactive()
                    ->afterStateUpdated(function ($state, Forms\Set $set) {
                        $product = \App\Models\Product::find($state);
                        if ($product) {
                            $set('price', $product->price);
                        }
                    }),

                Forms\Components\Select::make('size_id')
                    ->relationship('size', 'name')
                    ->searchable()
                    ->preload(),

                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(100)
                    ->reactive(),

                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$')
                    ->minValue(0.01)
                    ->reactive(),

                Forms\Components\Textarea::make('notes')
                    ->maxLength(255)
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('product.name')
            ->columns([
                Tables\Columns\TextColumn::make('product.name')
                    ->label('Product')
                    ->searchable(),

                Tables\Columns\TextColumn::make('size.name')
                    ->label('Size'),

                Tables\Columns\TextColumn::make('quantity')
                    ->label('Qty'),

                Tables\Columns\TextColumn::make('price')
                    ->label('Price')
                    ->money('usd'),

                Tables\Columns\TextColumn::make('subtotal')
                    ->label('Subtotal')
                    ->money('usd')
                    ->state(function (OrderItem $record): float {
                        return $record->quantity * $record->price;
                    }),

                Tables\Columns\TextColumn::make('notes')
                    ->label('Notes')
                    ->limit(30),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->after(function ($record) {
                        $this->updateOrderTotal();
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->after(function ($record) {
                        $this->updateOrderTotal();
                    }),
                Tables\Actions\DeleteAction::make()
                    ->after(function ($record) {
                        $this->updateOrderTotal();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->after(function () {
                            $this->updateOrderTotal();
                        }),
                ]),
            ]);
    }

    protected function updateOrderTotal(): void
    {
        $order = $this->getOwnerRecord();
        $total = $order->items()->sum(DB::raw('quantity * price'));
        $order->update(['total_price' => $total]);
    }
}
