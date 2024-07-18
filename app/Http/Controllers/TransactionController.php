<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\DetailTransaction;
use App\Models\Menu;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $jumlahdatatampil = 5;
        $page = $request->query('page', 1);
        $nourut = ($jumlahdatatampil * ($page - 1)) + 1;
        
        $data['nourut'] = $nourut;
        
        $data['cart'] = Cart::with('menu')->get();
        $data['menu'] = Menu::paginate($jumlahdatatampil);
        return view('transaction',$data);
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
        $request->validate([
            'menu_id' => 'required',
            'price' => 'required',
            'qty' => 'required',
            'subtotal' => 'required',
            'total_price' => 'required',
            'pay' => 'required',
            'return' => 'required',
        ]);
        $input = $request->all();

        $headtrans = Transaction::create([
            'user_id' => auth()->user()->id,
            'total_price' =>$request->total_price,
            'pay' => $request->pay,
            'return' =>$request->return,
        ]);
        foreach ($input['menu_id'] as $item => $value) {
           

            $data2 = array(
                'transaction_id' => $headtrans->id,
                'menu_id' => $input['menu_id'][$item],
                'price' => $input['price'][$item],
                'qty' => $input['qty'][$item],
                'subtotal' => $input['subtotal'][$item]
            );

            DetailTransaction::create($data2);
        }
        Cart::truncate();
        return redirect('/order')->with('cetak_struk', $headtrans->id);

    }

    public function cetakstruk($id){
        $data['cetakstruk'] = DetailTransaction::with('menu')->join('transactions', 'detail_transactions.transaction_id', '=', 'transactions.id')->where('transactions.id','=',$id)->get();
        return view('struk-order', $data);
    }

    public function cart(Request $request, $id)
    {
        
        $menu = Menu::findOrFail($id);

        $price = $menu->price;
        $subtotal = $price * 1;
        Cart::create([
            'menu_id' => $id,
            'price' => $menu->price,
            'qty' => 1,
            'subtotal' => $subtotal,
        ]);
        session()->flash('success','menu data has been add to cart');
        return redirect()->back();

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
    public function historyOrder(){
        $data['history'] = Transaction::with('user')->paginate(10);
        $income = DB::table('transactions')
            ->select(DB::raw('sum(total_price) as totjul'))
            ->get();
    
        $data['totjul'] = $income[0]->totjul;

        return view('history', $data);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $datas = Transaction::with('user')
        ->where(function ($query) use ($search) {
            $query->where('id', 'like', "%$search%")
                ->orWhereHas('user', function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%");
                });
        })->orderBy('id', 'asc')->paginate(10);
        return response()->json($datas);
    }

    public function destroy(string $id)
    {
        $history = Transaction::findOrFail($id);
        $history->delete();
        session()->flash('success','Order data has been removed');
        return redirect()->back();
    }
}
