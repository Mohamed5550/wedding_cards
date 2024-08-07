<?php

namespace App\Filament\Resources\EventResource\RelationManagers;

use App\Enums\InviteeNotificationStatus;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class InviteesRelationManager extends RelationManager
{
    protected static string $relationship = 'invitees';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__("Name"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label(__("Phone"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label(__("Notification status"))
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('attended_at')
                    ->label(__("Attended at"))
                    ->badge()
                    ->color(fn (string $state): string => $state ? 'success' : 'danger')
                    ->placeholder(__("Not attended"))
                    ->searchable(),
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
            ->headerActions([
            ])
            ->actions([
                
            ])
            ->bulkActions([
                
            ]);
    }
}
