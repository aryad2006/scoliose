<?php

namespace App\Filament\Resources\Modules\Schemas;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class ModuleForm
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
                        Select::make('course_id')
                            ->label('Cours')
                            ->relationship('course', 'title')
                            ->required(),
                        TextInput::make('order')
                            ->label('Ordre')
                            ->numeric()
                            ->default(0),
                    ]),
            ]);
    }
}
