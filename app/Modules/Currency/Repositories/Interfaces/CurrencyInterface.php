<?php

namespace App\Modules\Currency\Repositories\Interfaces;

use App\Modules\Currency\DTO\CurrencyData;

interface CurrencyInterface
{
    public function getAllCurrencies();
    public function getCurrencyById(int $id);
    public function getCurrencyByIsoCode(string $code);
    public function createCurrency(CurrencyData $data);
    public function deleteCurrency(int $id);
    public function updateCurrency(int $id, array $data);
}
