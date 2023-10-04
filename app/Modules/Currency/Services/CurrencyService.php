<?php

namespace App\Modules\Currency\Services;

use App\Modules\Currency\DTO\CurrencyData;
use App\Modules\Currency\Entities\Currency;
use App\Modules\Currency\Repositories\Eloquent\CurrencyRepository;
use Illuminate\Database\Eloquent\Collection;

class CurrencyService
{
    public function __construct(
        private CurrencyRepository $currencyRepository
    ) {
    }

    /**
     * Retrieve all currencies.
     *
     * @return Collection A collection of all currencies.
     */
    public function getAll(): Collection
    {
        return $this->currencyRepository->getAllCurrencies();
    }

    /**
     * Retrieves a currency object from the database by its ID.
     *
     * @param  Currency  $currency The currency object representing the ID to fetch.
     *
     * @return Currency  The currency object fetched from the database.
     */
    public function getById(Currency $currency): Currency
    {
        return $this->currencyRepository->getCurrencyById($currency->id);
    }

    /**
     * Creates a new currency object in the database.
     *
     * @param  CurrencyData  $data The data for creating the currency object.
     *
     * @return Currency  The ID of the created currency object.
     */
    public function create(CurrencyData $data): Currency
    {
        return $this->currencyRepository->createCurrency($data->toArray());
    }

    /**
     * Updates a currency object in the database.
     *
     * @param  Currency  $currency The currency object to be updated.
     * @param  array  $date
     *
     * @return int
     */
    public function update(Currency $currency, array $date): int
    {
        return $this->currencyRepository->updateCurrency($currency->id, $date);
    }

    /**
     * Deletes a currency object from the database.
     *
     * @param  Currency  $currency The currency object to be deleted.
     *
     * @return int
     */
    public function delete(Currency $currency): int
    {
        return $this->currencyRepository->deleteCurrency($currency->id);
    }

    /**
     * Fetches currency data from a remote source and stores it in the database.
     *
     * @return void
     */
    public function fetchAndStoreCurrencies(): void
    {
        $response = file_get_contents(config('services.cbr.url'));
        $xmlData = simplexml_load_string($response);
        $jsonFormatData = json_encode($xmlData);
        $items = json_decode($jsonFormatData, true);

        foreach ($items['Item'] as $item) {
            $currencyData = CurrencyData::from([
                'external_id'   => (string) $item['@attributes']['ID'],
                'name'          => (string) $item['Name'],
                'eng_name'      => (string) $item['EngName'],
                'nominal'       => (int) $item['Nominal'],
                'parent_code'   => trim($item['ParentCode']) ?: null,
                'iso_num_code'  => (int) $item['ISO_Num_Code'] ?: '000',
                'iso_char_code' => is_string($item['ISO_Char_Code']) ? trim($item['ISO_Char_Code']) : 'no_data',
            ]);

            $this->currencyRepository->createCurrency($currencyData);
        }
    }
}
