<?php

namespace App\Filament\Resources\Courses\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CoursesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('slug')
                    ->label('Slug'),
                TextColumn::make('level')
                    ->label('Niveau')
                    ->badge()
                    ->color(fn(string $state) => match($state) {
                        'beginner' => 'blue',
                        'intermediate' => 'yellow',
                        'advanced' => 'red',
                    }),
                IconColumn::make('is_published')
                    ->label('Publié')
                    ->boolean(),
                TextColumn::make('modules_count')
                    ->label('Modules')
                    ->counts('modules'),
            ])
            ->filters([
                SelectFilter::make('level')
                    ->options([
                        'beginner' => 'Débutant',
                        'intermediate' => 'Intermédiaire',
                        'advanced' => 'Avancé',
                    ]),
                SelectFilter::make('is_published')
                    ->options([
                        '0' => 'Non publié',
                        '1' => 'Publié',
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
