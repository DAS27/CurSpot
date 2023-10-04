<?php

namespace App\Modules\Currency\Repositories\Eloquent;

use App\Modules\Currency\DTO\CurrencyData;
use App\Modules\Currency\Entities\Currency;
use App\Modules\Currency\Repositories\Interfaces\CurrencyInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class CurrencyRepository implements CurrencyInterface
{
    /**
     * Retrieves all currencies.
     *
     * @return  Collection
     */
    public function getAllCurrencies(): Collection
    {
        return Currency::all();
    }

    /**
     * Retrieves a currency by its ID.
     *
     * @param  int  $id The ID of the currency.
     * @return Currency The retrieved currency object, or null if not found.
     */
    public function getCurrencyById(int $id): Currency
    {
        return Currency::where('id', $id)->first();
    }

    /**
     * Retrieves a currency using its ISO code.
     *
     * @param  string  $code The ISO code of the currency.
     * @return mixed          The currency model instance or null if not found.
     */
    public function getCurrencyByIsoCode(string $code)
    {
        return Currency::where('id', $code)->first();
    }

    /**
     * Creates a new currency.
     *
     * @param  CurrencyData  $data
     */
    public function createCurrency(CurrencyData $data): void
    {
        try {
            Currency::updateOrCreate(
                ['external_id' => $data->external_id],
                [
                    'name'          => $data->name,
                    'eng_name'      => $data->eng_name,
                    'nominal'       => $data->nominal,
                    'parent_code'   => $data->parent_code,
                    'iso_num_code'  => $data->iso_num_code,
                    'iso_char_code' => $data->iso_char_code,
                ]
            );
        } catch (\Exception $exception) {
            Log::debug($exception->getMessage());
        }
    }

    /**
     * Deletes a currency.
     *
     * @param  int  $id The ID of the currency to delete.
     * @return int  True if the currency was deleted successfully, false otherwise.
     */
    public function deleteCurrency(int $id): int
    {
        return Currency::destroy($id);
    }

    /**
     * Updates an existing currency.
     *
     * @param  int  $id   The ID of the currency to update.
     * @param  array  $data The updated properties of the currency.
     * @return int    The number of affected rows in the database.
     */
    public function updateCurrency(int $id, array $data): int
    {
        return Currency::whereId($id)->update($data);
    }
}
