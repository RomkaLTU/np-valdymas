<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
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
        'company_address',
        'company_name',
        'company_vat_code',
        'email',
        'phone',
        'company_code',
        'company_vat_code',
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
            Text::make(__('Telefonas'), 'phone'),
            Text::make(__('El. paštas'), 'email'),
            Select::make(__('Tipas'), 'type')->options([
                'personal' => 'Privatus',
                'company' => 'Įmonė',
            ]),
            Text::make(__('Įmonės pavadinimas'), 'company_name'),
            Text::make(__('Įmonės kodas'), 'company_code')->hideFromIndex(),
            Text::make(__('Įmonės PVM kodas'), 'company_vat_code')->hideFromIndex(),
            Text::make(__('Įmonės adresas'), 'company_address')->hideFromIndex(),
            Text::make(__('Atsakingo asmens pareigos'), 'responsible_person_role')->hideFromIndex(),
            Text::make(__('Atsakingo asmens vardas'), 'responsible_person_name')->hideFromIndex(),
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
