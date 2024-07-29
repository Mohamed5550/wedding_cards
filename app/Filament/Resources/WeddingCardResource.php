<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WeddingCardResource\Pages;
use App\Filament\Resources\WeddingCardResource\RelationManagers;
use App\Models\WeddingCard;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WeddingCardResource extends Resource
{
    protected static ?string $model = WeddingCard::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                SpatieMediaLibraryFileUpload::make('image')
                    ->collection('card_images')
                    ->columnSpanFull(),

                Forms\Components\Fieldset::make('families')
                    ->schema([
                        // add new font or select from current fonts


                        Forms\Components\Toggle::make('has_families')
                            ->columnSpanFull()
                            ->required(),
                        Forms\Components\Select::make('families_font_id')
                            ->relationship('familiesFont', 'name')
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->maxLength(255)
                                    ->required(),
                                Forms\Components\SpatieMediaLibraryFileUpload::make('file')
                                    ->collection('fonts')
                                    ->required(),
                            ]),
                        Forms\Components\TextInput::make('families_font_size')
                            ->numeric(),
                        Forms\Components\TextInput::make('families_font_weight')
                            ->maxLength(255),
                        Forms\Components\ColorPicker::make('families_color'),
                        Forms\Components\TextInput::make('groom_family_position_x')
                            ->numeric(),
                        Forms\Components\TextInput::make('groom_family_position_y')
                            ->numeric(),
                        Forms\Components\TextInput::make('bride_family_position_x')
                            ->numeric(),
                        Forms\Components\TextInput::make('bride_family_position_y')
                            ->numeric(),
                    ]),
                
                Forms\Components\Fieldset::make('names')
                    ->schema([

                        Forms\Components\Select::make('names_font_id')
                            ->relationship('namesFont', 'name')
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->maxLength(255)
                                    ->required(),
                                Forms\Components\SpatieMediaLibraryFileUpload::make('file')
                                    ->collection('fonts')
                                    ->required(),
                            ]),
                        Forms\Components\TextInput::make('names_font_size')
                            ->numeric(),
                        Forms\Components\TextInput::make('names_font_weight')
                            ->maxLength(255),
                        Forms\Components\ColorPicker::make('names_color'),
                        Forms\Components\TextInput::make('names_position_x')
                            ->numeric(),
                        Forms\Components\TextInput::make('names_position_y')
                            ->numeric(),
                    ]),

                Forms\Components\Fieldset::make('Time and Location')
                    ->schema([
                        Forms\Components\Select::make('time_location_font_id')
                            ->relationship('timeLocationFont', 'name')
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->maxLength(255)
                                    ->required(),
                                Forms\Components\SpatieMediaLibraryFileUpload::make('file')
                                    ->collection('fonts')
                                    ->required(),
                            ]),
                        Forms\Components\TextInput::make('time_location_font_size')
                            ->numeric(),
                        Forms\Components\TextInput::make('time_location_font_weight')
                            ->maxLength(255),
                        Forms\Components\ColorPicker::make('time_location_color'),
                        Forms\Components\TextInput::make('time_position_x')
                            ->numeric(),
                        Forms\Components\TextInput::make('time_position_y')
                            ->numeric(),
                        Forms\Components\TextInput::make('location_position_x')
                            ->numeric(),
                        Forms\Components\TextInput::make('location_position_y')
                            ->numeric(),
                        Forms\Components\TextInput::make('date_position_x')
                            ->numeric(),
                        Forms\Components\TextInput::make('date_position_y')
                            ->numeric(),
                    ]),
                
                Forms\Components\Fieldset::make('Time and Location')
                    ->schema([
                        Forms\Components\Toggle::make('has_invitee')
                            ->columnSpanFull()
                            ->required(),
                        Forms\Components\Select::make('invitee_font_id')
                            ->relationship('inviteeFont', 'name')
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->maxLength(255)
                                    ->required(),
                                Forms\Components\SpatieMediaLibraryFileUpload::make('file')
                                    ->collection('fonts')
                                    ->required(),
                            ]),
                        Forms\Components\TextInput::make('invitee_font_size')
                            ->numeric(),
                        Forms\Components\TextInput::make('invitee_font_weight')
                            ->maxLength(255),
                        Forms\Components\ColorPicker::make('invitee_color'),
                        Forms\Components\TextInput::make('invitee_prefix')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('invitee_x')
                            ->numeric(),
                        Forms\Components\TextInput::make('invitee_y')
                            ->numeric(),
                    ]),

                Forms\Components\Fieldset::make('QR Code')
                    ->schema([
                        Forms\Components\TextInput::make('qr_position_x')
                            ->numeric(),
                        Forms\Components\TextInput::make('qr_position_y')
                            ->numeric(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('has_families')
                    ->boolean(),
                Tables\Columns\TextColumn::make('families_font')
                    ->searchable(),
                Tables\Columns\TextColumn::make('families_font_size')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('families_font_weight')
                    ->searchable(),
                Tables\Columns\TextColumn::make('families_color')
                    ->searchable(),
                Tables\Columns\TextColumn::make('groom_family_position_x')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('groom_family_position_y')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bride_family_position_x')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bride_family_position_y')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\SelectColumn::make('names_font')
                    ->searchable(),
                Tables\Columns\TextColumn::make('names_font_size')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('names_font_weight')
                    ->searchable(),
                Tables\Columns\TextColumn::make('names_color')
                    ->searchable(),
                Tables\Columns\TextColumn::make('time_location_font')
                    ->searchable(),
                Tables\Columns\TextColumn::make('time_location_font_size')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('time_location_font_weight')
                    ->searchable(),
                Tables\Columns\TextColumn::make('time_location_color')
                    ->searchable(),
                Tables\Columns\TextColumn::make('time_position_x')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('time_position_y')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('location_position_x')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('location_position_y')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_position_x')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_position_y')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('invitee_font')
                    ->searchable(),
                Tables\Columns\TextColumn::make('invitee_font_size')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('invitee_font_weight')
                    ->searchable(),
                Tables\Columns\TextColumn::make('invitee_color')
                    ->searchable(),
                Tables\Columns\IconColumn::make('has_invitee')
                    ->boolean(),
                Tables\Columns\TextColumn::make('invitee_prefix')
                    ->searchable(),
                Tables\Columns\TextColumn::make('qr_position_x')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('qr_position_y')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWeddingCards::route('/'),
            'create' => Pages\CreateWeddingCard::route('/create'),
            'edit' => Pages\EditWeddingCard::route('/{record}/edit'),
        ];
    }
}
