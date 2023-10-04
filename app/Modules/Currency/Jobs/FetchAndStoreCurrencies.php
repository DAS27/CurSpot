<?php

namespace App\Modules\Currency\Jobs;

use App\Modules\Currency\Services\CurrencyService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Class FetchAndStoreCurrencies
 *
 * This class implements the ShouldQueue interface and is responsible for fetching and storing currencies.
 */
class FetchAndStoreCurrencies implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @param  CurrencyService  $currencyService
     * @return void
     */
    public function handle(CurrencyService $currencyService): void
    {
        $currencyService->fetchAndStoreCurrencies();
    }
}
