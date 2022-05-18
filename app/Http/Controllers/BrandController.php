<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

/* A ESTA CLASE EL USUARIO NORMAL NO PODRÁ ACCEDER */
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Retornamos la vista del indexBrands pasandole el listado de brands que hay en la base de datos
        /* $brands=Brand::orderBy('id','desc')->paginate(5)->withQueryString(); */

        try {
            $brands=Brand::sortable()->paginate(5)->withQueryString();
        } catch (\Kyslik\ColumnSortable\Exceptions\ColumnSortableException $e) {
            dd($e);
        }

        return view('adminDirectory.brands.indexBrands', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Retornamos la vista del create
        return view('adminDirectory.brands.createBrand');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validamos el brand que nos llega y lo guardamos en caso de que sea correcto
        $request->validate([
            'nombre'=>['required', 'string', 'min:2', 'unique:brands,nombre'],
            'descripcion' => ['nullable','string','min:5']
        ]);

        /* Si llega aqui es que está todo correcto */

        Brand::create($request->all()); # Guardamos la marca creada

        return redirect()->route('brands.index')->with('mensaje', 'Marca Creada');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //Retornamos la vista del showBrand
        // return view('adminDirectory.brands.showBrand', compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //Retornamos la vista del editBrand
        return view('adminDirectory.brands.editBrand', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        //Validamos lo que llega del editBrand y lo guardamos en caso de que sea correcto
        $request->validate([
            'nombre'=>['required', 'string', 'min:2', 'unique:brands,nombre,'. $brand->id],
            'descripcion' => ['nullable','string','min:5']
        ]);

        $brand->update($request->all());

        //nos vamos a index
        return redirect()->route('brands.index')->with('mensaje', 'Marca Editada correctamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        //Borramos el brand que se nos indique
        $brand->delete();

        //nos vamos a index
        return redirect()->route('brands.index')->with('mensaje', 'Marca Borrada');

    }
}
