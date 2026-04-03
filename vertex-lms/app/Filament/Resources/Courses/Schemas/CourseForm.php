<?php

namespace App\Filament\Resources\Courses\Schemas;

use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Schema;

class CourseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informations générales')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->label('Titre')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Textarea::make('description')
                            ->label('Description')
                            ->columnSpanFull(),
                        Select::make('level')
                            ->label('Niveau')
                            ->options([
                                'beginner' => 'Débutant',
                                'intermediate' => 'Intermédiaire',
                                'advanced' => 'Avancé',
                            ])
                            ->required(),
                        TextInput::make('order')
                            ->label('Ordre')
                            ->numeric()
                            ->default(0),
                    ]),
                Section::make('Publication')
                    ->schema([
                        Toggle::make('is_published')
                            ->label('Publié')
                            ->default(false),
                    ]),
            ]);
    }
}
