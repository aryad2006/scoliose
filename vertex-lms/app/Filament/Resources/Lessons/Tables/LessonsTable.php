<?php

namespace App\Filament\Resources\Lessons\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class LessonsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->color(fn(string $state) => match($state) {
                        'video' => 'blue',
                        'text' => 'green',
                        'image' => 'purple',
                        'quiz' => 'yellow',
                        'sim3d' => 'red',
                    }),
                TextColumn::make('module.title')
                    ->label('Module')
                    ->searchable(),
                TextColumn::make('order')
                    ->label('Ordre'),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options([
                        'video' => 'Vidéo',
                        'text' => 'Texte',
                        'image' => 'Image',
                        'quiz' => 'Quiz',
                        'sim3d' => 'Simulateur 3D',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
