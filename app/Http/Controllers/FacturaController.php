<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FacturaController extends Controller
{
    //

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Aqui se llama para retornar la vista de index de facturas
        try {
            $facturas=Factura::sortable('id')->Codigo($request->codigo)->paginate(10)->withQueryString();
        } catch (\Kyslik\ColumnSortable\Exceptions\ColumnSortableException $e) {
            dd($e);
        }

        return view('adminDirectory.facturas.indexFacturas', compact('facturas', 'request'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function show(Factura $factura)
    {
        //
        return view('adminDirectory.facturas.showFacturas', compact('factura'));
    }

    public function exportarCsv(){
        dd("hola");
        $table = Factura::all();
        $filename = "Facturas.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('id', 'codigo', 'user_nombre', 'product_id', 'direccion', 'precio',  'created_at', 'productos'));

        foreach($table as $row) {
            fputcsv($handle,array(
                $row['id'], $row['codigo'], $row['user_nombre'],
                $row['product_id'],$row['direccion'],$row['precio'],
                $row['created_at'], $row['productos']
                )
            );
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        /* return Response::download($filename, 'Facturas.csv', $headers); */

        return redirect()->route('facturas.index')->with("mensaje", "Tabla exportada correctamente");
    }
}
