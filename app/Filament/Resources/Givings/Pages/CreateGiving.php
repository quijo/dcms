<?php

namespace App\Filament\Resources\Givings\Pages;

use App\Filament\Resources\GivingResource;
use App\Models\Giving;
use App\Models\GivingType;
use Filament\Resources\Pages\CreateRecord;
use App\Models\FiscalYear;

class CreateGiving extends CreateRecord
{
    protected static string $resource = \App\Filament\Resources\Givings\GivingResource::class;



    protected function mutateFormDataBeforeCreate(array $data): array
    {


        $data['fiscal_year_id'] =
            FiscalYear::findByDate($data['date'])?->id;

        return $data;
    }









    protected function handleRecordCreation(array $data): Giving
    {
        $fiscalYearId =
            \App\Models\FiscalYear::findByDate($data['date'])?->id;

        $givingType = GivingType::find($data['giving_type_id']);

        if (! $givingType) {
            throw new \Exception('Giving type not found.');
        }

        if ($givingType->name === 'District Budget') {

            $amount = $data['amount'];

            $districtAmount = $amount * 0.12;
            $educationAmount = $amount * 0.02;
            $wefAmount = $amount * 0.055;

            $districtType = GivingType::where('name', 'District Budget')->first();
            $educationType = GivingType::where('name', 'Educational Budget')->first();
            $wefType = GivingType::where('name', 'World Evangelism Fund')->first();

            Giving::create([
                ...$data,
                'fiscal_year_id' => $fiscalYearId,
                'giving_type_id' => $districtType->id,
                'amount' => $districtAmount,
            ]);

            Giving::create([
                ...$data,
                'fiscal_year_id' => $fiscalYearId,
                'giving_type_id' => $educationType->id,
                'amount' => $educationAmount,
            ]);

            return Giving::create([
                ...$data,
                'fiscal_year_id' => $fiscalYearId,
                'giving_type_id' => $wefType->id,
                'amount' => $wefAmount,
            ]);
        }

        return Giving::create([
            ...$data,
            'fiscal_year_id' => $fiscalYearId,
        ]);
    }
}
