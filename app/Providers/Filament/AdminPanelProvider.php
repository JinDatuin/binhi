<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Dashboard;
use App\Filament\Widgets\AchievementRanking;
use App\Filament\Widgets\AttendanceRanking;
use App\Filament\Widgets\MemberStats;
use App\Filament\Widgets\PersonalStats;
use Blade;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->widgets([
                MemberStats::class,
                AttendanceRanking::class,
                AchievementRanking::class,
                PersonalStats::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->brandName('')
            ->brandLogo(asset('images/logo.png'))
            ->brandLogoHeight('3rem')
            ->renderHook(
                PanelsRenderHook::BODY_START,
                fn (): string => Blade::render('
                    <style>
                        .fi-simple-layout {
                            background:
                                linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                                url("/images/login-bg.jpg");
                            background-size: cover;
                            background-position: center;
                        }
                        .fi-simple-main {
                            background: rgba(255, 255, 255, 0.08) !important;
                            backdrop-filter: blur(10px);
                            border: 1px solid rgba(255,255,255,0.2);
                            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
                        }
                    </style>
                ')
            );
    }
}
