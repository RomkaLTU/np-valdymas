<?php

namespace App\Nova;

use DigitalCreative\ConditionalContainer\ConditionalContainer;
use DigitalCreative\ConditionalContainer\HasConditionalContainer;
use Illuminate\Http\Request;
use Laraning\NovaTimeField\TimeField;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\BooleanGroup;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use NovaAttachMany\AttachMany;
use Whitecube\NovaFlexibleContent\Flexible;

class Event extends Resource
{
    use HasConditionalContainer;

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
            ])->size('w-1/3')->rules('required'),

            Select::make(__('Regionas'), 'region')->options([
                'vilnius' => __('Vilniaus'),
                'klaipeda' => __('Klaipėdos'),
            ])->size('w-1/3'),

            BelongsTo::make(__('Pardavėjas'), 'seller', Seller::class)->size('w-1/3'),

            Heading::make('<strong>Montavimas</strong>')->asHtml(),
            Date::make(__('Montavimo data'), 'install_date')->stacked(true),
            TimeField::make(__('Montavimo pradžios laikas'), 'install_time_start')->hideFromIndex()->stacked(true)->size('w-1/2')->nullable(),
            TimeField::make(__('Montavimo pabaigos laikas'), 'install_time_end')->hideFromIndex()->stacked(true)->size('w-1/2')->nullable(),
            Boolean::make('Suderinti', 'install_time_start_need_conf')->hideFromIndex()->size('w-1/2'),
            Boolean::make('Suderinti', 'install_time_end_need_conf')->hideFromIndex()->size('w-1/2'),

            ConditionalContainer::make([
                Heading::make('<strong>Pramogos</strong>')->asHtml(),
                Date::make(__('Pramogų data'), 'entertainment_date'),
                TimeField::make(__('Pramogų pradžios laikas'), 'entertainment_time_start')->hideFromIndex()->nullable(),
                TimeField::make(__('Pramogų pabaigos laikas'), 'entertainment_time_end')->hideFromIndex()->nullable(),
                Boolean::make('Suderinti', 'entertainment_time_start_need_conf')->hideFromIndex(),
                Boolean::make('Suderinti', 'entertainment_time_end_need_conf')->hideFromIndex(),
            ])->if('order_type = entertainment_and_equipment_rent'),

            Heading::make('<strong>Demontavimas</strong>')->asHtml(),
            Date::make(__('Demontavimo data'), 'uninstall_date')->stacked(true),
            TimeField::make(__('Demontavimo pradžios laikas'), 'uninstall_time_start')->hideFromIndex()->stacked(true)->size('w-1/2')->nullable(),
            TimeField::make(__('Demontavimo pabaigos laikas'), 'uninstall_time_end')->hideFromIndex()->stacked(true)->size('w-1/2')->nullable(),
            Boolean::make('Suderinti', 'uninstall_time_start_need_conf')->hideFromIndex()->size('w-1/2'),
            Boolean::make('Suderinti', 'uninstall_time_end_need_conf')->hideFromIndex()->size('w-1/2'),

            Heading::make('<strong>Klientas</strong>')->asHtml(),
            BelongsTo::make('Klientas', 'client', Client::class)->searchable()->nullable(),

            Heading::make('<strong>Kita informacija</strong>')->asHtml(),
            Currency::make('Kaina', 'price')->currency('EUR')->min(0)->step(100),
            Currency::make('Avansas', 'advance')->currency('EUR')->min(0)->step(100),
            Boolean::make('Reikalinga sutartis', 'need_contract')->default(1),

            ConditionalContainer::make([
                Heading::make('<strong>Informacija apie pramogas</strong>')->asHtml(),
                Text::make('Adresas', 'entertainment_address'),
                Text::make('Kontaktinis numeris atvykus', 'entertainment_contact_number_in_place')->help('Bus naudojama kliento kontaktai jei paliktas tuščias.'),
                Number::make('Darbuotojų poreikis', 'entertainment_workers'),
                Number::make('Elektros poreikis KW', 'entertainment_el_needs'),
                BooleanGroup::make('Elektra rūpinasi', 'entertainment_el_provider')->options([
                    'client' => 'Klientas',
                    'self' => 'Mes',
                    'generator' => 'Reikės generatoriaus',
                ]),
            ])->if('order_type = entertainment_and_equipment_rent'),

            ConditionalContainer::make([
                Heading::make('<strong>Informacija apie įrangą</strong>')->asHtml(),
                Text::make('Kontaktinis numeris atvykus', 'equipment_contact_number_in_place')->help('Bus naudojama kliento kontaktai jei paliktas tuščias.'),
                Text::make('Adresas', 'equipment_address'),
                Number::make('Darbuotojų poreikis montažui', 'equipment_workers_montage'),
                Number::make('Darbuotojų poreikis demontažui', 'equipment_workers_demontage'),
                BooleanGroup::make('Montavimo pagrindas', 'equipment_montage_ground')->options([
                    'hard' => 'Kietas',
                    'soft' => 'Minkštas',
                ]),
            ])->if('order_type = equipment_rent OR order_type = entertainment_and_equipment_rent'),

            Heading::make('<strong>Pasirinkite įrangą</strong>')->asHtml(),
            Flexible::make('Įranga', 'equipment')->addLayout('Įranga', 'equipment',[
                Select::make('Įranga', 'equipment')->options(\App\Models\Equipment::get()->pluck('title', 'id'))->searchable(),
                Number::make('Kiekis', 'qty'),
            ])->button('Pridėti įrangą'),

            Heading::make('<strong>Aksesuarai įrangai</strong>')->asHtml(),
            Flexible::make('Aksesuarai', 'accessories')->addLayout('Aksesuaras', 'accessory',[
                Select::make('Aksesuaras', 'accessory')->options(\App\Models\Accessories::get()->pluck('title', 'id'))->searchable(),
                Number::make('Kiekis', 'qty'),
            ])->button('Pridėti aksesuarą'),
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
