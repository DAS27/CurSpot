<?php

namespace App\Modules\Currency\Entities;

use App\Models\CurrencyRate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * Class Article
 * @package App\Models
 *
 * @property int $id
 * @property string $external_id
 * @property string $name
 * @property string $eng_name
 * @property integer $nominal
 * @property string $parent_code
 * @property integer $iso_num_code
 * @property string $iso_char_code
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Currency extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'external_id',
        'name',
        'eng_name',
        'nominal',
        'parent_code',
        'iso_num_code',
        'iso_char_code',
    ];

    /**
     * Get the currency rates associated with this model.
     *
     * @return HasMany
     */
    public function rates(): HasMany
    {
        return $this->hasMany(CurrencyRate::class);
    }

    /**
     * Returns the latest rate for the current object.
     *
     * @return CurrencyRate|HasMany The latest rate for the current object. Returns null if no rates are found.
     */
    public function getCurrentRate(): CurrencyRate|HasMany
    {
        return $this->rates()->latest('date')->first();
    }

}
