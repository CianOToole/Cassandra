<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

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
    public function index()
    {
        // $user = Auth::user();
        // $stocks = $user->trades()->orderBy('created_at', 'desc')->paginate(8);
        // return view('stocks.index', [
        //     'stocks' => $stocks
        // ]);
         $stocks = Stock::orderBy('created_at', 'asc')->paginate(31);
        //  $test = Stock::groupBy('ticker')->get();
        //   $stocks = Stock::select("select DISTINCT ticker from stocks")->orderBy('created_at', 'desc');
        return view('stocks.index',[
            'stocks' => $stocks
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

    public function showAllTodos(){
        $stocks = Stock::orderBy('created_at', 'desc')->paginate(8);
        return view('stocks.index',[
            'stocks' => $stocks
        ]);
    }
}