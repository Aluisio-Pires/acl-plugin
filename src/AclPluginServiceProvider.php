<?php

namespace AluisioPires\AclPlugin;

use AluisioPires\AclPlugin\Pages\PermissionRolePage;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class AclPluginServiceProvider extends PackageServiceProvider
{
    protected array $pages = [
        PermissionRolePage::class,
    ];

    public function configurePackage(Package $package): void
    {
        $package
            ->name('acl-plugin')
            ->hasViews();

    }
}
