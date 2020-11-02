<?php

namespace App\Http\Controllers;

use App\Models\Trade;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Auth;

class TradeController extends Controller
{


    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trades = Trade::orderBy('created_at', 'desc')->paginate(8);
        return view('trades.index', [
            'trades' => $trades
        ]);  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     return "bruh";
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
            'amount'  => 'required|string|min:5|max:1000',
            'sellOrBuy' => 'required|string|min:2|max:191',
            'stock_id'  => 'required|string|min:5|max:1000',
        ];
        //custom validation error messages
        $messages = [
            'email.unique' => 'User title should be unique', //syntax: field_name.rule
        ];
        //First Validate the form data
        $request->validate($rules, $messages);
        $trade = new Trade;
        $trade->price_at_order = $request->price_at_order;
        $trade->amount = $request->amount;
        $trade->sellOrBuy = $request->sellOrBuy;
        $trade->user_id = Auth::id();
        $trade->stock_id = $request->stock_id;
        $trade->save();
        return redirect()
            ->route('stocks.index')
            ->with('status', 'Created a new Todo!');
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

        $request->validate($rules,$messages);
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
            -> with('status','Updated the selected user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trades = Trade::findOrFail($id);
        $trades->delete();
        //Redirect to a specified route with flash message.
        return redirect()
            ->route('trades.index')
            -> with('status','Deleted the selected user');
    }
}
