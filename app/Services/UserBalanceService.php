<?php

namespace App\Services;

use App\Models\Balance;
use App\Models\Trade;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class UserBalanceService
{

    public function createUserBalance()
    {
        $balance = Balance::where('user_id', Auth::id())->get();
       
        if (count($balance) > 0 || $balance == null) {
            return;
        } else {
            $balance = new Balance;
            $balance->type_of_currency = "Euro";
            $balance->amount = 100000.0;
            $balance->user_id = Auth::id();
            $balance->save();
        }
    }


    public function addProfit($trade)
    {

        set_time_limit(0);

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
        }

        $numOfShares = $trade->amount / $trade->price_at_order;
        $diffCal =  $outputJSON[0]->price - $trade->price_at_order;
        $profitOrLoss =  $numOfShares * $diffCal;

        $balance = Balance::where('user_id', Auth::id())->firstOrFail();
        $balance->amount += $profitOrLoss;
        $balance->save();
        $trade->tradeClosed = true;
        $trade->save();
    }

    public function minusProfit($request)
    {
        $balance = Balance::where('user_id', Auth::id())->firstOrFail();
        $balance->amount -= $request->amount;
        $balance->save();
    }
}
