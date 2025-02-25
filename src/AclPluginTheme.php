<?php

namespace AluisioPires\AclPlugin;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Assets\Theme;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentAsset;

class AclPlugin implements Plugin
{
    public function getId(): string
    {
        return 'acl-plugin';
    }

    public function register(Panel $panel): void
    {
        FilamentAsset::register([
            Theme::make('acl-plugin', __DIR__ . '/../resources/dist/acl-plugin.css'),
        ]);

        $panel
            ->font('DM Sans')
            ->primaryColor(Color::Amber)
            ->secondaryColor(Color::Gray)
            ->warningColor(Color::Amber)
            ->dangerColor(Color::Rose)
            ->successColor(Color::Green)
            ->grayColor(Color::Gray)
            ->theme('acl-plugin');
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
