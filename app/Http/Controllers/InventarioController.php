<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Inventario;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
//agregamos
use Spatie\Permission\Models\Permission;

class InventarioController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-inventario|crear-inventario|editar-inventario|borrar-inventario', ['only' => ['index']]);
         $this->middleware('permission:crear-inventario', ['only' => ['create','store']]);
         $this->middleware('permission:editar-inventario', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-inventario', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $inventarios = Inventario::paginate(5);
        return view('inventario.index',compact('inventarios'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();
        return view('inventario.create',compact('permission'));
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

        $inventarios = new Inventario();

        $inventarios->nombre = $request->get('nombre');
        $inventarios->descripcion = $request->get('descripcion');
        $inventarios->cantidad = $request->get('cantidad');
        $inventarios->precio = $request->get('precio');

        $inventarios->save();

    
        return redirect()->route('inventario.index');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inventario = Inventario::find($id);
        return view('inventario.edit2')->with('inventario',$inventario);

        //
    }

    public function edi($id)
    {
        $inventario = Inventario::find($id);
        return view('inventario.edit3')->with('inventario',$inventario);

        //
    }

    public function show($id)
    {
        $inventario = Inventario::find($id);
        return view('inventario.edit3')->with('inventario',$inventario);

        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**public function update2(Request $request, $id)
    {
        $inventario = Inventario::find($id);

        $inventario->nombre = $request->get('nombre');
        $inventario->descripcion = $request->get('descripcion');
        $inventario->cantidad = $request->get('cantidad');
        $inventario->precio = $request->get('precio');

        $inventario->save();

    
        return redirect()->route('inventario.index');
        //
    }*/

    public function update(Request $request, $id)
    {
       
        $inventario = Inventario::find($id);
        $var1 = $request->get('cantidad');
        $var = $request->get('cantidad2');
        $inventario->cantidad = $var1+$var;
        $inventario->save();

    
        return redirect()->route('inventario.index');
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
        Inventario::find($id)->delete();
        return redirect()->route('inventario.index')->with('eliminar'. 'OK');//
    }

    public function increment(Request $request)
    {
        $inventario = Inventario::find($request->id);
        return view('inventario.increment',compact('inventario'));
    }
}
