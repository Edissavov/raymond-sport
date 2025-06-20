<?php

namespace App\Providers\Filament;

use Filament\Panel;
use Filament\PanelProvider;
use Filament\Navigation\NavigationItem;

class MembersPanelServiceProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('members')
            ->path('members')
            ->login()
            ->registration()
            ->passwordReset()
            ->emailVerification()
            ->profile()
            ->colors([
                'primary' => '#your-color', // Replace with your actual color
            ])
            ->discoverResources(in: app_path('Filament/Members/Resources'), for: 'App\\Filament\\Members\\Resources')
            ->discoverPages(in: app_path('Filament/Members/Pages'), for: 'App\\Filament\\Members\\Pages')
            ->discoverWidgets(in: app_path('Filament/Members/Widgets'), for: 'App\\Filament\\Members\\Widgets')
            ->navigationItems([
                NavigationItem::make('Back to Site')
                    ->url('/')
                    ->icon('heroicon-o-arrow-left')
                    ->sort(999),

                // For Members resource - if you want it in this panel
                NavigationItem::make('Members')
                    ->url(route('filament.members.resources.members.index')) // Changed from 'admin' to 'members'
                    ->icon('heroicon-o-users')
                    ->group('User Management')
            ]);
    }
}