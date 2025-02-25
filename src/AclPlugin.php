<?php

namespace AluisioPires\AclPlugin;

use Filament\Contracts\Plugin;
use Filament\Panel;

class AclPlugin implements Plugin
{
    public function getId(): string
    {
        return 'acl-plugin';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->pages([
                Pages\PermissionRolePage::class,
            ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public static function make(): self
    {
        return new self;
    }
}
