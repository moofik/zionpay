<?php

namespace App\Service;

use App\Dto\ConvertedCurrencyDto;
use App\Dto\MoneyDto;
use GuzzleHttp\Client;
use \Cache;
use GuzzleHttp\Exception\GuzzleException;

class MoneyConverter
{
    public const API_KEY = 'cur_live_lJ1B3ROUfpJFH7fWpLP0f99YKXnlMpSB0sMXMhVN';

    /**
     * @param  string  $base
     * @param  array   $to
     * @throws GuzzleException
     * @return ConvertedCurrencyDto
     */
    public function getCurrencyRates(string $base, array $to): ConvertedCurrencyDto
    {
        $responseData = Cache::get('currency_rates');

        if ($responseData === null) {
            $client = new Client([
                'base_uri' => 'https://api.currencyapi.com/v3/',
            ]);

            $response = $client->get('latest?apikey=' . self::API_KEY . '&currencies='
                . implode('%2C', $to) . '&base_currency=' . $base);
            $response = json_decode($response->getBody(), true);

            if (!isset($response['data'])) {
                throw new \RuntimeException("Can't get currency exchange rates");
            }

            Cache::put('currency_rates', $response['data'], now()->addMinutes(60));

            $responseData = $response['data'];
        }

        $result = new ConvertedCurrencyDto();
        $result->apiResponseData = $responseData;
        $result->rubToUsdt = $responseData['USDT']['value'];

        return $result;
    }

    /**
     * @param  float  $amt
     * @throws GuzzleException
     * @return float
     */
    public function convert(float $amt): float
    {
        $rates = $this->getCurrencyRates('RUB', ['USDT']);
        $usdtAmt = $amt / $rates->rubToUsdt;

        return $usdtAmt * 1.056;
    }
}