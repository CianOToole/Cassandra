<?php

namespace App\Services;

use App\Models\Balance;
use App\Models\Trade;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;


class TradeService
{
    public function calProfitLoss()
    {
        $totalGain = 0;
        $user = Auth::user()->id;
        $trades = Trade::where('user_id', '=', $user)->where('tradeClosed', '=', false)->get();
        $balance = Balance::where('user_id', '=', $user)->get();


        set_time_limit(0);
        foreach ($trades as $trade) {
            $url_info = "https://financialmodelingprep.com/api/v3/profile/{$trade->ticker}?apikey=937d579e58c5f65961d708c85782f993";

            $channel = curl_init();

            curl_setopt($channel, CURLOPT_AUTOREFERER, TRUE);
            curl_setopt($channel, CURLOPT_HEADER, 0);
            curl_setopt($channel, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($channel, CURLOPT_URL, $url_info);
            curl_setopt($channel, CURLOPT_FOLLOWLOCATION, TRUE);
            curl_setopt($channel, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
            curl_setopt($channel, CURLOPT_TIMEOUT, 0);
            curl_setopt($channel, CURLOPT_CONNECTTIMEOUT, 0);
            curl_setopt($channel, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($channel, CURLOPT_SSL_VERIFYPEER, FALSE);

            $output = curl_exec($channel);

            if (curl_error($channel)) {
                return 'error:' . curl_error($channel);
            } else {
                $outputJSON = json_decode($output);
                // array_push($totalGain, $outputJSON[0]->price - $trade->price_at_order);
                $totalGain = $outputJSON[0]->price - $trade->price_at_order;
            }
        }
        return $totalGain;
    }



    
}
