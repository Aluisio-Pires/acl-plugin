<?php

namespace AluisioPires\AclPlugin\Pages;

use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionRolePage extends Page
{
    public Collection $roles;

    public Collection $permissions;

    public string $search = '';

    public array $selectedPermissions = [];

    public array $permissionsByRole = [];

    protected static ?string $navigationIcon = 'heroicon-o-key';

    protected static string $view = 'acl-plugin::filament.pages.permission-role-page';

    public static function getRoutePath(): string
    {
        return 'acl';
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Administration');
    }

    public static function getNavigationLabel(): string
    {
        return __('Access Control Panel');
    }

    public function getTitle(): string|Htmlable
    {
        return static::getNavigationLabel();
    }

    public function mount(): void
    {
        $this->roles = Role::all();
        $this->permissions = Permission::all();

        // Utiliza mapWithKeys para construir um array associativo com as permissões de cada role
        $this->permissionsByRole = $this->roles->mapWithKeys(function (Role $role) {
            return [$role->id => $role->permissions->pluck('id')->toArray()];
        })->toArray();

        $this->selectedPermissions = $this->permissionsByRole;
    }

    public function searchPermissions(string $value): void
    {
        $this->search = $value;
    }

    public function savePermissions(): void
    {
        foreach ($this->roles as $role) {
            $selected = $this->selectedPermissions[$role->id] ?? [];
            $permissions = Permission::whereIn('id', $selected)->get();
            $role->syncPermissions($permissions);
        }

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        Notification::make()
            ->title(__('Saved.'))
            ->success()
            ->send();

        session()->flash('success', __('Permissões atualizadas com sucesso!'));
    }
}
