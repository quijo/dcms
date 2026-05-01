<?php

// namespace App\Filament\Resources\Users\Schemas;

// use Filament\Forms\Components\TextInput;
// use Filament\Forms\Components\Select;

// class UserForm
// {
//     public static function make(): array
//     {
//         return [
//             TextInput::make('name')->required(),

//             TextInput::make('email')->required(),

//             Select::make('type')
//                 ->options([
//                     'pastor' => 'Pastor',
//                     'treasurer' => 'Treasurer',
//                     'secretary' => 'Secretary',
//                 ]),
//         ];
//     }
// }




namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms;
use Filament\Forms\Form;

class UserForm
{
    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required(),

            Forms\Components\TextInput::make('email')->email()->required(),

            Forms\Components\Select::make('role')
                ->options([
                    'super-admin' => 'Super Admin',
                    'district-superintendent' => 'District Superintendent',
                    'pastor' => 'Pastor',
                    'church-secretary' => 'Church Secretary',
                    'church-treasurer' => 'Church Treasurer',
                    'district-treasurer' => 'District Treasurer',
                    'district-secretary' => 'District Secretary',
                ])
                ->required(),

            Forms\Components\Select::make('church_id')
                ->relationship('church', 'name')
                ->searchable()
                ->preload()
                ->nullable(),

        ]);
    }
}
