<?php

namespace App\Http\Controllers;

use App\Models\UserProduct;
use Illuminate\Http\Request;

class UserProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Retornamos el view de la vista
        try {
            $productosUser=UserProduct::sortable('id')->paginate(10)->withQueryString();
        } catch (\Kyslik\ColumnSortable\Exceptions\ColumnSortableException $e) {
            dd($e);
        }
        return view('adminDirectory.productos_users.indexProductosUsers', compact('productosUser'));
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
     * @param  \App\Models\UserProduct  $userProduct
     * @return \Illuminate\Http\Response
     */
    public function show(UserProduct $userProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserProduct  $userProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(UserProduct $userProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserProduct  $userProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserProduct $userProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserProduct  $userProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserProduct $userProduct)
    {
        //
    }
}
