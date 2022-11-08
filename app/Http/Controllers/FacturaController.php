<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Inventario;
use App\Models\Useinventario;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Orden;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
//agregamos
use Spatie\Permission\Models\Permission;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       // $pedido = Pedido::find();
       // $ordenes=DB::table('ordenes')
       // ->select('*')
       // ->where('id_pedido',$id);

        return view('facturacion.index');
    }

    public function index2($id)
    {
        //
        $pedido = Pedido::find($id);
        $ordenes=DB::table('ordenes')
        ->select('*')
        ->where('id_pedido',$id);

        return view('facturacion.index2',compact('pedido', 'ordenes'));
    }

    public function recibo($id)
    {
        $pedido = Pedido::find($id);
        $ordenes = DB::table('ordenes')
        ->where('id_pedido','=', $id)
        ->get();

        $cliente = Pedido::with('clientes')
   ->whereHas('clientes');
   $ordenestotal = DB::table('ordenes')->select('total')->where('id_pedido','=', $id)->sum('total');

return view('facturacion.recibo', compact('ordenes', 'cliente', 'ordenestotal'))->with('pedido',$pedido);
    }
    public function factura($id)
    {
        $pedido = Pedido::find($id);
        $ordenes = DB::table('ordenes')
        ->where('id_pedido','=', $id)
        ->get();

        $cliente = Pedido::with('clientes')
   ->whereHas('clientes');
   $ordenestotal = DB::table('ordenes')->select('total')->where('id_pedido','=', $id)->sum('total');

return view('facturacion.factura', compact('ordenes', 'cliente', 'ordenestotal'))->with('pedido',$pedido);
    }
    public function cfiscal($id)
    {
        //
        $pedido = Pedido::find($id);
        $ordenes = DB::table('ordenes')
        ->where('id_pedido','=', $id)
        ->get();

        $cliente = Pedido::with('clientes')
   ->whereHas('clientes');
   $ordenestotal = DB::table('ordenes')->select('total')->where('id_pedido','=', $id)->sum('total');

return view('facturacion.cfiscal', compact('ordenes', 'cliente', 'ordenestotal'))->with('pedido',$pedido);
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
        //
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
}
