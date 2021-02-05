<?php

namespace App\Providers;

use App\Nova\Accessories;
use App\Nova\Client;
use App\Nova\Equipment;
use App\Nova\Event;
use App\Nova\ExpenseType;
use App\Nova\Seller;
use App\Nova\User;
use App\Nova\Warehouse;
use CodencoDev\NovaGridSystem\NovaGridSystem;
use DigitalCreative\CollapsibleResourceManager\CollapsibleResourceManager;
use DigitalCreative\CollapsibleResourceManager\Resources\InternalLink;
use DigitalCreative\CollapsibleResourceManager\Resources\NovaResource;
use DigitalCreative\CollapsibleResourceManager\Resources\RawResource;
use DigitalCreative\CollapsibleResourceManager\Resources\TopLevelResource;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Vyuldashev\NovaPermission\NovaPermissionTool;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return true;
        });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
            new Help,
        ];
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            new CollapsibleResourceManager([
                'navigation' => [
                    TopLevelResource::make([
                        'label' => __('Renginiai'),
                        'resources' => [
                            Event::class,
                        ]
                    ]),
                    TopLevelResource::make([
                        'label' => __('Įranga'),
                        'resources' => [
                            Equipment::class,
                            Accessories::class,
                            Warehouse::class,
                        ]
                    ]),
                    TopLevelResource::make([
                        'label' => __('Kita'),
                        'resources' => [
                            Client::class,
                            Seller::class,
                            ExpenseType::class,
                        ]
                    ]),
                    TopLevelResource::make([
                        'label' => __('Sistema'),
                        'resources' => [
                            User::class,
                            InternalLink::make([
                                'label' => __('Leidimai'),
                                'badge' => null, // can be used to indicate the number of updates or notifications in this resource
                                'icon' => null, // HTML/SVG string or callback that produces one, see below
                                'target' => '_self',
                                'path' => '/resources/permissions',
                            ]),
                            InternalLink::make([
                                'label' => __('Rolės'),
                                'badge' => null, // can be used to indicate the number of updates or notifications in this resource
                                'icon' => null, // HTML/SVG string or callback that produces one, see below
                                'target' => '_self',
                                'path' => '/resources/roles',
                            ]),
                        ]
                    ]),
                ]
            ]),
            \Vyuldashev\NovaPermission\NovaPermissionTool::make(),
            new NovaGridSystem(),
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
