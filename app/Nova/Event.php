<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Romkaltu\FieldsRow\FieldsRowClose;
use Romkaltu\FieldsRow\FieldsRowOpen;
use Romkaltu\OpenRow\OpenRow;
use Romkaltu\TestField\TestField;

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

            \R64\NovaFields\Select::make(__('Užsakymo tipas'), 'order_type')->options([
                'equipment_rent' => __('Įrangos nuoma'),
                'entertainment_and_equipment_rent' => __('Pramogų ir įrangos nuoma'),
                'equipment_rent_inplace' => __('Įrangos nuoma iš vietos'),
            ])
                ->labelClasses('w-full pt-4')
                ->wrapperClasses('flex flex-col w-1/3 float-left flex-1 px-4 pl-8')
                ->fieldClasses('w-full py-4'),

            \R64\NovaFields\Select::make(__('Regionas'), 'region')->options([
                'vilnius' => __('Vilniaus'),
                'klaipeda' => __('Klaipėdos'),
            ])
                ->labelClasses('w-full pt-4')
                ->wrapperClasses('flex flex-col w-1/3 float-left flex-1 px-4')
                ->fieldClasses('w-full py-4'),

            \R64\NovaFields\BelongsTo::make(__('Pardavėjas'), 'seller', Seller::class)
                ->labelClasses('w-full pt-4')
                ->wrapperClasses('flex flex-col w-1/3 flex-1 px-4 pr-8')
                ->fieldClasses('w-full py-4'),
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
