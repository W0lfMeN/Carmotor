<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Response as csv;

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
        $productosComprados=explode(",",$factura['pedido']);
        $idsProductos=explode(',',$factura->product_id);
        return view('adminDirectory.facturas.showFacturas', compact('factura', 'productosComprados', 'idsProductos'));
    }

    /* Funcion que exporta la tabla facturas a un archivo csv */
    public function exportarCsv(){

        $table = Factura::all(); #Obtenemos toda la tabla facturas
        $filename = "Facturas.csv"; #Nombre del archivo
        $handle = fopen($filename, 'w+'); #Abrimos el flujo de datos
        fputcsv($handle, array('ID', 'CODIGO', 'USER_NOMBRE', 'PRODUCT_ID', 'DIRECCION', 'PRECIO',  'FECHA DE FACTURACION', 'PEDIDO')); #la cabecera

        /* Bucle que va rellenando la tabla */
        foreach($table as $row) {

            /* Parseo la fecha con Carbon */
            $row['created_at']=Carbon::parse($row['created_at'])->format('d-m-Y H:i:s');

            $cadenaProductos=str_replace(",","\n",$row['pedido']);

            fputcsv($handle,array(
                $row['id'], $row['codigo'], $row['user_nombre'],
                $row['product_id'],$row['direccion'],$row['precio']." €",
                $row['created_at'], $cadenaProductos
                )
            );
        }

        fclose($handle); #Cerramos el flujo

        /* El tipo de archivo */
        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return csv::download($filename, 'Facturas.csv', $headers); #Se abre una ventana para descargar el archivo

    }
}
