<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data['menudata'] =Menu::all()->count();

        $data['orderdata'] = Transaction::all()->Count(); 
        
        $income = DB::table('transactions')
        ->select(DB::raw('sum(total_price) as income'))
        ->get();
        $data['income']=$income[0]->income;

        $user = DB::table('users')
        ->select(DB::raw('count(*) as user'))
        ->get();
        $data['user'] = $user[0]->user;

        $today = now()->format('Y-m-d');
        $userid = auth()->user()->id;
        $transtodayuser = DB::table('transactions')
            ->select(DB::raw('sum(total_price) as transtoday'))
            ->whereDate('created_at', $today)
            ->where('user_id',$userid)
            ->get();
        $data['transtodayuser'] = $transtodayuser[0]->transtoday;
        
        return view('layout.main-dashboard',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
