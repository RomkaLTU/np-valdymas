<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laraning\NovaTimeField\TimeField;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class Event extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Event::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    public static function label()
    {
        return __('Renginiai');
    }

    public static function singularLabel()
    {
        return __('Renginys');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request): array
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            Select::make(__('Uzsakymo tipas'), 'order_type')->options([
                'equipment_rent' => __('Įrangos nuoma'),
                'entertainment_and_equipment_rent' => __('Pramogų ir įrangos nuoma'),
                'equipment_rent_inplace' => __('Įrangos nuoma iš vietos'),
            ])->size('w-1/3'),

            Select::make(__('Regionas'), 'region')->options([
                'vilnius' => __('Vilniaus'),
                'klaipeda' => __('Klaipėdos'),
            ])->size('w-1/3'),

            BelongsTo::make(__('Pardavėjas'), 'seller', Seller::class)->size('w-1/3'),

            Date::make(__('Montavimo data'), 'install_date')->stacked(true),
            TimeField::make(__('Montavimo pradžios laikas'), 'install_time_start')->hideFromIndex()->stacked(true)->size('w-1/2')->nullable(),
            TimeField::make(__('Montavimo pabaigos laikas'), 'install_time_end')->hideFromIndex()->stacked(true)->size('w-1/2')->nullable(),
            Boolean::make('Suderinti', 'install_time_start_need_conf')->hideFromIndex()->size('w-1/2'),
            Boolean::make('Suderinti', 'install_time_end_need_conf')->hideFromIndex()->size('w-1/2'),

            Date::make(__('Pramogų data'), 'entertainment_date')->stacked(true)->if(['order_type'], fn($value) => $value['order_type'] === 'entertainment_and_equipment_rent'),
            TimeField::make(__('Pramogų pradžios laikas'), 'entertainment_time_start')->hideFromIndex()->stacked(true)->size('w-1/2')->nullable()->if(['order_type'], fn($value) => $value['order_type'] === 'entertainment_and_equipment_rent'),
            TimeField::make(__('Pramogų pabaigos laikas'), 'entertainment_time_end')->hideFromIndex()->stacked(true)->size('w-1/2')->nullable()->if(['order_type'], fn($value) => $value['order_type'] === 'entertainment_and_equipment_rent'),
            Boolean::make('Suderinti', 'entertainment_time_start_need_conf')->hideFromIndex()->size('w-1/2')->if(['order_type'], fn($value) => $value['order_type'] === 'entertainment_and_equipment_rent'),
            Boolean::make('Suderinti', 'entertainment_time_end_need_conf')->hideFromIndex()->size('w-1/2')->if(['order_type'], fn($value) => $value['order_type'] === 'entertainment_and_equipment_rent'),

            Date::make(__('Demontavimo data'), 'uninstall_date')->stacked(true),
            TimeField::make(__('Demontavimo pradžios laikas'), 'uninstall_time_start')->hideFromIndex()->stacked(true)->size('w-1/2')->nullable(),
            TimeField::make(__('Demontavimo pabaigos laikas'), 'uninstall_time_end')->hideFromIndex()->stacked(true)->size('w-1/2')->nullable(),
            Boolean::make('Suderinti', 'uninstall_time_start_need_conf')->hideFromIndex()->size('w-1/2'),
            Boolean::make('Suderinti', 'uninstall_time_end_need_conf')->hideFromIndex()->size('w-1/2'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
