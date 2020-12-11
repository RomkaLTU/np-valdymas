<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Vyuldashev\NovaPermission\RoleSelect;

class User extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\User::class;

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
        'id', 'name', 'email',
    ];

    public static function label()
    {
        return __('Vartotojai');
    }

    public static function singularLabel()
    {
        return __('Vartotojas');
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
            ID::make()->sortable(),

            RoleSelect::make('Rolė', 'roles')->required(),

            Gravatar::make()->maxWidth(50),

            Text::make(__('Vardas'), 'name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make(__('Pavardė'), 'surname')->hideFromIndex(),

            Text::make(__('Telefonas'), 'phone'),

            Text::make(__('Miestas'), 'city'),

            Date::make(__('Gimimo data'), 'birthdate')->hideFromIndex(),

            Boolean::make(__('Gali vairuoti'), 'can_drive'),

            Boolean::make(__('Turi automobilį'), 'has_car'),

            Trix::make(__('Komentaras'), 'comment'),

            Boolean::make(__('Patvirtintas'), 'approved'),

            Text::make(__('El. paštas'), 'email')
                ->sortable()
                ->required()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Password::make(__('Slaptažodis'))
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),


            MorphToMany::make(__('Leidimai'), 'permissions', \Vyuldashev\NovaPermission\Permission::class),
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
