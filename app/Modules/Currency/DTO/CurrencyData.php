<?php

namespace App\Modules\Currency\DTO;

use Spatie\LaravelData\Data;

/**
 * Class CurrencyData
 *
 * CurrencyData represents the data of a currency.
 *
 */
class CurrencyData extends Data
{
    public string $external_id;
    public string $name;
    public string $eng_name;
    public int $nominal;
    public ?string $parent_code;
    public int $iso_num_code;
    public string $iso_char_code;
}
