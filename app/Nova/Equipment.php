<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Whitecube\NovaFlexibleContent\Flexible;

class Equipment extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Equipment::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'title',
    ];

    public static function label()
    {
        return __('Įranga');
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
            Text::make(__('Pavadinimas'), 'title'),
            Number::make(__('Kiekis'), 'qty'),

            new Panel(__('Montažo važtaraščiai'), $this->assemblyWareFields()),
        ];
    }

    protected function assemblyWareFields(): array
    {
        return [
            Flexible::make(__('Važtaraščiai'), 'assembly_wares')->addLayout(__('Važtaraštis'), 'assembly_ware', [
                Text::make(__('Važtaraščio pavadinimas'), 'title'),
                Flexible::make(__('Važtaraščio eilutės'), 'assembly_ware_lines')->addLayout(__('Eilutė'), 'assembly_ware_line', [
                    Select::make(__('Aksesuaras'), 'accessory_id')->searchable()->nullable()->options(\App\Models\Accessories::all()->pluck('title', 'id')),
                    Number::make(__('Kiekis'), 'qty'),
                ])->button(__('Pridėti eilutę'))->fullWidth(),
            ])->button(__('Pridėti važtaraštį'))->fullWidth(),
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
