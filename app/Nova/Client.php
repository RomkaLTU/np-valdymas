<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Client extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Client::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
        'address',
        'email',
        'phone',
        'contact_person',
        'company_code',
        'bank_account',
        'company_vat',
    ];

    public static function label()
    {
        return __('Klientai');
    }

    public static function singularLabel()
    {
        return __('Klientas');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make(__('Pavadinimas'), 'name'),
            Text::make(__('Adresas'), 'address'),
            Text::make(__('El. paštas'), 'email'),
            Text::make(__('Telefonas'), 'phone'),
            Text::make(__('Kontaktinis asmuo'), 'contact_person')->hideFromIndex(),
            Text::make(__('Įmonės kodas'), 'company_code')->hideFromIndex(),
            Text::make(__('Įmonės PVM kodas'), 'company_vat')->hideFromIndex(),
            Text::make(__('Banko sąsk. nr.'), 'bank_account')->hideFromIndex(),
            Text::make(__('Banko sąsk. nr.'), 'bank_account')->hideFromIndex(),
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
