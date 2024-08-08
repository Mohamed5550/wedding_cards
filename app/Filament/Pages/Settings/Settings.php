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
    public static function getNavigationLabel() : string
    {
        return __("Settings");
    }

    public function getTitle() : string
    {
        return __("Settings");
    }

    public function schema(): array|Closure
    {
        return [
            Tabs::make('Settings')
                ->schema([
                    Tab::make(__("General"))
                        ->schema([
                            TextInput::make('general.app_name')
                                ->label(__("App name"))
                                ->required(),
                            Textarea::make('general.app_description')
                                ->label(__("App description"))
                                ->required(),
                            FileUpload::make('general.app_logo')
                                ->label(__("App logo"))
                                ->directory('settings')
                                ->required()
                                ->default(asset('storage/' . setting('general.app_logo')))
                                ->image(),
                            FileUpload::make('general.excel_template')
                                ->label(__("Excel template"))
                                ->directory('settings')
                                ->required(),
                        ]),
                    
                    Tab::make(__('Homepage'))
                        ->schema([
                            TextInput::make('home.title')
                                ->label(__("Home title"))
                                ->required(),
                            TextArea::make('home.subtitle')
                                ->label(__("Home subtitle"))
                                ->required(),
                            FileUpload::make('home.background')
                                ->label(__("Home background"))
                                ->directory('settings')
                                ->image()
                                ->required(),
                            TextArea::make('home.why_choose_us_text')
                                ->label(__("Why choose us text"))
                                ->required(),
                        ]),
                    Tab::make(__("Contact information"))
                        ->schema([
                            TextInput::make('contact.address')
                                ->label(__("Address"))
                                ->required(),
                            TextInput::make('contact.phone')
                                ->label(__("Phone"))
                                ->required(),
                            TextInput::make('contact.email')
                                ->label(__("Email"))
                                ->required(),
                        ]),
                ]),
        ];
    }
}