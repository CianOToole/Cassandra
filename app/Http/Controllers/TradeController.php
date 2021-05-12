<?php

namespace App\Http\Controllers;

use App\Models\Trade;
use App\Models\Balance;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Auth;
use App\Services\UserBalanceService;
use App\Services\TradeService;

class TradeController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user()->id;
        $trades = Trade::where('user_id', '=', $user)->where('tradeClosed', '=', false)->get();
        $gainLoss = (new TradeService())->calProfitLoss();
        $portfolioCash = 0;
        foreach ($trades as $trade) {
            $portfolioCash = $trade->amount;
        }
        $portfolioCash += $gainLoss;
        $balance = Balance::where('user_id', '=', $user)->get();
        // dd($balance[0]);
        return view('trades.index', [
            'trades' => $trades,
            'balance' => $balance,
            'gainLoss' => $gainLoss,
            'portfolioCash' => $portfolioCash
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *@param  int  $price
     *@param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $rules = [
            'ticket' => 'required|string|min:2|max:191'
        ];
        $request->validate($rules);
        set_time_limit(0);

        $url_info = "https://financialmodelingprep.com/api/v3/profile/{$request->ticket}?apikey=937d579e58c5f65961d708c85782f993";

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
        }
        return view('trades.create', [
            'price_at_order'  => $outputJSON[0]->price,
            'beta'  => $outputJSON[0]->beta,
            'volAvg'  => $outputJSON[0]->volAvg,
            'changes'  => $outputJSON[0]->changes,
            'range'  => $outputJSON[0]->range,
            'stock_ticker' => $request->ticket
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation rules
        $rules = [
            'price_at_order' => 'required|string|min:2|max:191',
            'amount'  => 'required|string|min:2|max:1000',
            'sellOrBuy' => 'required|in:1,0',
        ];
        //custom validation error messages
        $messages = [
            'amount.required' => 'Amount is requried', //syntax: field_name.rule
        ];
        //First Validate the form data
        $request->validate($rules, $messages);
        (new UserBalanceService())->createUserBalance();
        $trade = new Trade;
        $trade->price_at_order = $request->price_at_order;
        $trade->amount = $request->amount;
        $trade->sellOrBuy = $request->sellOrBuy;
        $trade->tradeClosed = false;
        $trade->user_id = Auth::id();
        $trade->ticker = $request->stock_ticker;

        $trade->beta = $request->beta;
        $trade->volAvg = $request->volAvg;
        $trade->changes = $request->changes;
        $trade->range = $request->range;
        $trade->save();
        (new UserBalanceService())->minusProfit($request);
        return redirect()
            ->route('trades.index')
            ->with('status', 'Created a new Trade!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $trades = Trade::findOrFail($id);
        return view('trades.show', [
            'trades' => $trades,
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
        $trades = Trade::findOrFail($id);
        return view('trades.edit', [
            'trades' => $trades,
        ]);
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
        $rules = [
            'first_name' => 'required|string|min:2|max:191',
            'middle_name'  => 'required|string|min:5|max:1000',
            'last_name' => 'required|string|min:2|max:191',
            'DOB'  => 'required|string|min:5|max:1000',
            'gender' => 'required|string|min:2|max:191',
            'address'  => 'required|string|min:5|max:1000',
            'postcode' => 'required|string|min:2|max:191',
            'country'  => 'required|string|min:5|max:1000',
            'email' => 'required|string|unique:users,email|min:2|max:191',
            'phone'  => 'required|string|min:5|max:1000',
            'password'  => 'required|string|min:5|max:1000',
        ];

        $messages = [
            'title.unique' => 'Todo title should be unique',
        ];

        $request->validate($rules, $messages);
        $trade = Trade::findOrFail($id);
        $trade->first_name = $request->first_name;
        $trade->middle_name = $request->middle_name;
        $trade->last_name = $request->last_name;
        $trade->DOB = $request->DOB;
        $trade->gender = $request->gender;
        $trade->address = $request->address;
        $trade->postcode = $request->postcode;
        $trade->country = $request->country;
        $trade->email = $request->email;
        $trade->phone = $request->phone;
        $trade->password = $request->password;
        $trade->save();

        return redirect()
            ->route('trades.show', $id)
            ->with('status', 'Updated the selected user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        $trades = Trade::findOrFail($id);
        (new UserBalanceService())->addProfit($trades);
        // $trades->delete();
        //Redirect to a specified route with flash message.
        return redirect()
            ->route('trades.index')
            ->with('status', 'closed the selected Trade');
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function history()
    {
        $user = Auth::user()->id;
        $trades = Trade::where('user_id', '=', $user)->where('tradeClosed', '=', true)->get();
        return view('trades.history', [
            'trades' => $trades
        ]);
    }
}
