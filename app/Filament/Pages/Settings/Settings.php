<?php
namespace App\Filament\Pages\Settings;
 
use Closure;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Outerweb\FilamentSettings\Filament\Pages\Settings as BaseSettings;
 
class Settings extends BaseSettings
{
    public function schema(): array|Closure
    {
        return [
            Tabs::make('Settings')
                ->schema([
                    Tab::make('General')
                        ->schema([
                            TextInput::make('general.app_name')
                                ->required(),
                            Textarea::make('general.app_description')
                                ->required(),
                            FileUpload::make('general.app_logo')
                                ->required()
                                ->default(asset('storage/' . setting('general.app_logo')))
                                ->image(),
                            FileUpload::make('general.excel_template')
                                ->required(),
                            TextInput::make('general.invite_price')
                                ->numeric()
                                ->step(0.01)
                                ->required(),
                        ]),
                    
                    Tab::make('Homepage')
                        ->schema([
                            TextInput::make('home.title')
                                ->required(),
                            TextArea::make('home.subtitle')
                                ->required(),
                            FileUpload::make('home.background')
                                ->image()
                                ->required(),
                            TextArea::make('home.why_choose_us_text')
                                ->required(),
                        ]),
                    Tab::make('Contact')
                        ->schema([
                            TextInput::make('contact.address')
                                ->required(),
                            TextInput::make('contact.phone')
                                ->required(),
                            TextInput::make('contact.email')
                                ->required(),
                        ]),
                ]),
        ];
    }
}