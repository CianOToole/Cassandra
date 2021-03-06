<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use App\Models\Trade;
use App\Models\Balance;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Services\UserBalanceService;
use App\Services\TradeService;

class StockController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    //  gives the user the stock blade file and returns data for the balance box
    public function index()
    {
        $user = Auth::user()->id;
        $balances = Balance::where('user_id', Auth::id())->get();
        $trades = Trade::where('user_id', '=', $user)->where('tradeClosed', '=', false)->get();
        $gainLoss = (new TradeService())->calProfitLoss();
        $portfolioCash = 0;
        foreach ($trades as $trade) {
            $portfolioCash = $trade->amount;
        }
        $portfolioCash += $gainLoss;
        $balance = Balance::where('user_id', Auth::id())->get();
        
        if ($balances[0]->amount >  0) {
            return view('stock',[
                'trades' => $trades,
                'balances' => $balances,
                'gainLoss' => $gainLoss,
                'portfolioCash' => $portfolioCash
            ]);
        } else {
            $balance = new Balance;
            $balance->type_of_currency = "Euro";
            $balance->amount = 100000.0;
            $balance->user_id = Auth::id();
            $balance->save();
        }

        return view('stock', [
            'trades' => $trades,
            'balances' => $balances,
            'gainLoss' => $gainLoss,
            'portfolioCash' => $portfolioCash
        ]);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stock = Stock::findOrFail($id);
        return view('stocks.show', [
            'stock' => $stock,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
