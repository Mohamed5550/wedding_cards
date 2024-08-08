<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Filament\Resources\EventResource\RelationManagers\InviteesRelationManager;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return __("Event");
    }

    public static function getPluralModelLabel(): string
    {
        return __("Events");
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('time')
                    ->required(),
                Forms\Components\TextInput::make('location')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('groom_family')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('groom_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('bride_family')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('bride_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(255)
                    ->default('not_started'),
                Forms\Components\Fieldset::make('wedding_card')
                    ->relationship('weddingCard')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('image')
                            ->collection('card_images')
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->columnSpan(1),
                Forms\Components\Select::make('user_id')
                    ->label(__("User"))
                    ->relationship('user', 'name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__("Name"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('time')
                    ->label(__("Time"))
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('groom_name')
                    ->label(__("Groom name"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('bride_name')
                    ->label(__("Bride name"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label(__("Status"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label(__("User"))
                    ->sortable(),
                Tables\Columns\TextColumn::make('invitees_count')
                    ->label(__("Invitees count"))
                    ->state(fn(Event $event) => $event->invitees()->sent()->count())
                    ->sortable(),
                Tables\Columns\TextColumn::make('attendees_count')
                    ->label(__("Attendees count"))
                    ->state(fn(Event $event) => $event->invitees()->attended()->count())
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__("Created at"))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__("Updated at"))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
            ])
            ->bulkActions([
                
            ]);
    }

    public static function getRelations(): array
    {
        return [
            InviteesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'view' => Pages\ViewEvent::route('/{record}'),
        ];
    }
}
