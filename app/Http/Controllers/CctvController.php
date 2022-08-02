<?php

namespace App\Http\Controllers;

use App\Models\Cctv;
use Illuminate\Http\Request;

class CctvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:daftar_cctv', ['only' => ['index', 'store']]);
    }
    public function index()
    {
        $cctvs = Cctv::all();
        return view('pages.cctv.index', compact('cctvs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.cctv.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'url' => 'required|url',
        ]);

        Cctv::create($data);
        session()->flash('success');
        return redirect(route('cctv.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cctv  $cctv
     * @return \Illuminate\Http\Response
     */
    public function show(Cctv $cctv)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cctv  $cctv
     * @return \Illuminate\Http\Response
     */
    public function edit(Cctv $cctv)
    {
        return view('pages.cctv.create', compact('cctv'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cctv  $cctv
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cctv $cctv)
    {
        $data = $request->validate([
            'url' => 'required|url',
        ]);

        $cctv->update($data);
        session()->flash('success');
        return redirect(route('cctv.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cctv  $cctv
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cctv $cctv)
    {
        $cctv->delete();
        session()->flash('success');
        return redirect(route('cctv.index'));
    }
}
