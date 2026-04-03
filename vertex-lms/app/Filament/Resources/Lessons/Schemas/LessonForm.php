<?php

namespace App\Filament\Resources\Lessons\Schemas;

use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class LessonForm
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
                        Select::make('type')
                            ->label('Type')
                            ->options([
                                'video' => 'Vidéo',
                                'text' => 'Texte',
                                'image' => 'Image',
                                'quiz' => 'Quiz',
                                'sim3d' => 'Simulateur 3D',
                            ])
                            ->required(),
                        Select::make('module_id')
                            ->label('Module')
                            ->relationship('module', 'title')
                            ->required(),
                        TextInput::make('order')
                            ->label('Ordre')
                            ->numeric()
                            ->default(0),
                    ]),
                Section::make('Contenu')
                    ->columnSpanFull()
                    ->schema([
                        Textarea::make('content')
                            ->label('Contenu (JSON)')
                            ->columnSpanFull()
                            ->helperText('Entrez le contenu en format JSON'),
                    ]),
                Section::make('Médias')
                    ->columnSpanFull()
                    ->schema([
                        FileUpload::make('media_images')
                            ->label('Images')
                            ->multiple()
                            ->directory('lesson-media')
                            ->acceptedFileTypes(['image/*'])
                            ->helperText('Téléchargez des images pour la leçon'),
                        FileUpload::make('media_videos')
                            ->label('Vidéos')
                            ->multiple()
                            ->directory('lesson-media')
                            ->acceptedFileTypes(['video/*'])
                            ->helperText('Téléchargez des vidéos pour la leçon'),
                    ]),
            ]);
    }
}
