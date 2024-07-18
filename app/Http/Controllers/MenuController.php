<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $cari = $request->pencarian;

        $jumlahdatatampil = 5;
        $page = $request->query('page', 1);
        $nourut = ($jumlahdatatampil * ($page - 1)) + 1;

        $data['nourut'] = $nourut;

        $data['menu'] = Menu::paginate($jumlahdatatampil);
        $pencarian['Menu'] = Menu::where('name', 'LIKE', '%' . $cari . '$');
        return view('menu', $data);
    }
    public function cari(Request $request)
    {
        $cari = $request->pencarian;

        $data['menu'] = DB::table('menus')
            ->where('name', 'like', "%" . $cari . "%")
            ->paginate();

        return view('menu', $data);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $menus = Menu::where('name', 'like', '%' . $search . '%')->paginate(10);

        return response()->json($menus);
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
            'name' => 'required',
            'price' => 'required|numeric',
        ]);
        if ($request->price < 0) {
            session()->flash('error', 'The price you enter must exceed Rp.0');
            return redirect()->back();
        }

        Menu::create($request->all());

        session()->flash('success', 'menu data has been add');
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
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        if ($request->price < 0) {
            session()->flash('error', 'The price you enter must exceed Rp.0');
            return redirect()->back();
        }
        $menu = Menu::findOrFail($id);
        $menu->update($request->all());

        session()->flash('success', 'menu data has been Updated');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */

  

    public function destroy(string $id)
    {
        $menu = Menu::findOrFail($id)->delete();
        session()->flash('success', 'menu data has been deleted');
        return redirect()->back();
    }
}
