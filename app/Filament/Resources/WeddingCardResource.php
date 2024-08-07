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
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WeddingCardResource extends Resource
{
    protected static ?string $model = WeddingCard::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return __("Wedding card");
    }

    public static function getPluralModelLabel(): string
    {
        return __("Wedding cards");
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                SpatieMediaLibraryFileUpload::make('image')
                    ->label(__("Image"))
                    ->collection('card_images')
                    ->columnSpanFull(),

                Forms\Components\Fieldset::make('families')
                    ->label(__("Families"))
                    ->schema([
                        Forms\Components\Toggle::make('has_families')
                            ->label(__("Has families"))
                            ->columnSpanFull()
                            ->required(),
                        Forms\Components\Select::make('families_font_id')
                            ->label(__("Families font"))
                            ->relationship('familiesFont', 'name')
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->label(__("Name"))
                                    ->maxLength(255)
                                    ->required(),
                                Forms\Components\SpatieMediaLibraryFileUpload::make('file')
                                    ->label(__("File"))
                                    ->collection('fonts')
                                    ->required(),
                            ]),
                        Forms\Components\TextInput::make('families_font_size')
                            ->label(__("Families font size"))
                            ->numeric(),
                        Forms\Components\TextInput::make('families_font_weight')
                            ->label(__("Families font weight"))
                            ->maxLength(255),
                        Forms\Components\ColorPicker::make('families_color')
                            ->label(__("Families color")),
                        Forms\Components\TextInput::make('groom_family_position_x')
                            ->label(__("Groom family position X"))
                            ->numeric(),
                        Forms\Components\TextInput::make('groom_family_position_y')
                            ->label(__("Groom family position Y"))
                            ->numeric(),
                        Forms\Components\TextInput::make('bride_family_position_x')
                            ->label(__("Bride family position X"))
                            ->numeric(),
                        Forms\Components\TextInput::make('bride_family_position_y')
                            ->label(__("Bride family position Y"))
                            ->numeric(),
                    ]),
        
                Forms\Components\Fieldset::make('names')
                    ->label(__("Names"))
                    ->schema([
        
                        Forms\Components\Select::make('names_font_id')
                            ->label(__("Names font"))
                            ->relationship('namesFont', 'name')
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->label(__("Name"))
                                    ->maxLength(255)
                                    ->required(),
                                Forms\Components\SpatieMediaLibraryFileUpload::make('file')
                                    ->label(__("File"))
                                    ->collection('fonts')
                                    ->required(),
                            ]),
                        Forms\Components\TextInput::make('names_font_size')
                            ->label(__("Names font size"))
                            ->numeric(),
                        Forms\Components\TextInput::make('names_font_weight')
                            ->label(__("Names font weight"))
                            ->maxLength(255),
                        Forms\Components\ColorPicker::make('names_color')
                            ->label(__("Names color")),
                        Forms\Components\TextInput::make('names_position_x')
                            ->label(__("Names position X"))
                            ->numeric(),
                        Forms\Components\TextInput::make('names_position_y')
                            ->label(__("Names position Y"))
                            ->numeric(),
                    ]),
        
                Forms\Components\Fieldset::make('time_location')
                    ->label(__("Time and Location"))
                    ->schema([
                        Forms\Components\Select::make('time_location_font_id')
                            ->label(__("Time and location font"))
                            ->relationship('timeLocationFont', 'name')
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->label(__("Name"))
                                    ->maxLength(255)
                                    ->required(),
                                Forms\Components\SpatieMediaLibraryFileUpload::make('file')
                                    ->label(__("File"))
                                    ->collection('fonts')
                                    ->required(),
                            ]),
                        Forms\Components\TextInput::make('time_location_font_size')
                            ->label(__("Time and location font size"))
                            ->numeric(),
                        Forms\Components\TextInput::make('time_location_font_weight')
                            ->label(__("Time and location font weight"))
                            ->maxLength(255),
                        Forms\Components\ColorPicker::make('time_location_color')
                            ->label(__("Time and location color")),
                        Forms\Components\TextInput::make('time_position_x')
                            ->label(__("Time position X"))
                            ->numeric(),
                        Forms\Components\TextInput::make('time_position_y')
                            ->label(__("Time position Y"))
                            ->numeric(),
                        Forms\Components\TextInput::make('location_position_x')
                            ->label(__("Location position X"))
                            ->numeric(),
                        Forms\Components\TextInput::make('location_position_y')
                            ->label(__("Location position Y"))
                            ->numeric(),
                        Forms\Components\TextInput::make('date_position_x')
                            ->label(__("Date position X"))
                            ->numeric(),
                        Forms\Components\TextInput::make('date_position_y')
                            ->label(__("Date position Y"))
                            ->numeric(),
                    ]),
        
                Forms\Components\Fieldset::make('invitee')
                    ->label(__("Invitee"))
                    ->schema([
                        Forms\Components\Toggle::make('has_invitee')
                            ->label(__("Has invitee"))
                            ->columnSpanFull()
                            ->required(),
                        Forms\Components\Select::make('invitee_font_id')
                            ->label(__("Invitee font"))
                            ->relationship('inviteeFont', 'name')
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->label(__("Name"))
                                    ->maxLength(255)
                                    ->required(),
                                Forms\Components\SpatieMediaLibraryFileUpload::make('file')
                                    ->label(__("File"))
                                    ->collection('fonts')
                                    ->required(),
                            ]),
                        Forms\Components\TextInput::make('invitee_font_size')
                            ->label(__("Invitee font size"))
                            ->numeric(),
                        Forms\Components\TextInput::make('invitee_font_weight')
                            ->label(__("Invitee font weight"))
                            ->maxLength(255),
                        Forms\Components\ColorPicker::make('invitee_color')
                            ->label(__("Invitee color")),
                        Forms\Components\TextInput::make('invitee_prefix')
                            ->label(__("Invitee prefix"))
                            ->maxLength(255),
                        Forms\Components\TextInput::make('invitee_x')
                            ->label(__("Invitee position X"))
                            ->numeric(),
                        Forms\Components\TextInput::make('invitee_y')
                            ->label(__("Invitee position Y"))
                            ->numeric(),
                    ]),
        
                Forms\Components\Fieldset::make('qr_code')
                    ->label(__("QR Code"))
                    ->schema([
                        Forms\Components\TextInput::make('qr_position_x')
                            ->label(__("QR position X"))
                            ->numeric(),
                        Forms\Components\TextInput::make('qr_position_y')
                            ->label(__("QR position Y"))
                            ->numeric(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('image')
                    ->label(__("Image"))
                    ->collection('card_images'),
                Tables\Columns\IconColumn::make('has_families')
                    ->label(__("Has families"))
                    ->boolean(),
                Tables\Columns\IconColumn::make('has_invitee')
                    ->label(__("Has invitee"))
                    ->boolean(),
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
