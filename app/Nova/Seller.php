<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Seller extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Seller::class;

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
        'type',
        'code',
        'vat_code',
        'address',
        'bank_account',
        'representative',
    ];

    public static function label()
    {
        return __('Pardavėjai');
    }

    public static function singularLabel()
    {
        return __('Pardavėjas');
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
            Text::make(__('Įmonės pavadinimas'), 'company_name'),
            Select::make(__('Tipas'))->options([
                'vat_payer' => __('PVM mokėtojas'),
                'non_vat_payer' => __('Ne PVM mokėtojas'),
            ]),
            Text::make(__('Įmonės kodas'), 'code'),
            Text::make(__('PVM mokėtojo kodas'), 'vat_code'),
            Text::make(__('Adresas'), 'address'),
            Text::make(__('Banko sąskaitos nr.'), 'bank_account'),
            Text::make(__('Atstovo vardas, pavardė'), 'representative'),
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
