<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class HomePanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('home')
            ->path('home')
            ->login()
            ->colors([
                'primary' => Color::Rose,
            ])
            ->maxContentWidth(MaxWidth::Full)
            ->brandName('Tour Craft')
            ->brandLogo(function () {
                return Auth::check() ? '' : asset('storage/logo.png'); // Use Auth facade to check user authentication
            })
            ->brandLogoHeight(function () {
                return Auth::check() ? '2rem' : '14rem';
            })
            ->navigationItems([
                NavigationItem::make('Plan Trip')
                    ->url('/admin')
                    ->icon('heroicon-s-paper-airplane')
                    ->sort(6),
            ])
            ->navigationItems([
                NavigationItem::make('Design')
                    ->url('https://app.napkin.ai/')
                    ->icon('heroicon-s-newspaper')
                    ->openUrlInNewTab()
                    ->sort(5),
            ])
            ->userMenuItems([
                MenuItem::make()
                    ->label('Owner Dashboard')
                    ->icon('heroicon-s-cog-6-tooth')
                    ->url('/owner')
                    ->visible(fn(): bool => auth()->user()->isAdmin())
            ])
            ->sidebarCollapsibleOnDesktop()
            // ->sidebarWidth('6rem')
            ->discoverResources(in: app_path('Filament/Home/Resources'), for: 'App\\Filament\\Home\\Resources')
            ->discoverPages(in: app_path('Filament/Home/Pages'), for: 'App\\Filament\\Home\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Home/Widgets'), for: 'App\\Filament\\Home\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
