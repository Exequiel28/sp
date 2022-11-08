<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Inventario;
use App\Models\Useinventario;
use App\Models\Cliente;

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
//agregamos
use Spatie\Permission\Models\Permission;



class ClienteController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:ver-clientes|crear-clientes|editar-clientes|borrar-clientes', ['only' => ['index']]);
         $this->middleware('permission:crear-clientes', ['only' => ['create','store','edit']]);
         $this->middleware('permission:editar-clientes', ['only' => ['update']]);
         $this->middleware('permission:borrar-clientes', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $texto=trim($request->get('texto'));
        $clientes=DB::table('clientes')
        ->select('id','nombre','apellido','direccion','telefono','nrc','nit','dui')
        ->where('nombre', 'LIKE', '%'.$texto.'%')
        ->orwhere('apellido', 'LIKE', '%'.$texto.'%')
        ->orwhere('telefono', 'LIKE', '%'.$texto.'%')
        ->orwhere('dui', 'LIKE', '%'.$texto.'%')
        ->paginate(5);

return view('clientes.index',compact('clientes','texto'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();
        return view('clientes.create',compact('permission'));
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
        $this->validate($request, [
            'dui' => 'required|unique:clientes,dui',
            'nombre' => 'required',
            'apellido' => 'required',
            'telefono' => 'required'

        ]);

        $cliente = new Cliente();
        $cliente->nombre = $request->get('nombre');
        $cliente->apellido = $request->get('apellido');
        $cliente->direccion = $request->get('direccion');
        $cliente->telefono = $request->get('telefono');
        $cliente->nrc = $request->get('nrc');
        $cliente->nit = $request->get('nit');
        $cliente->dui = $request->get('dui');

        $cliente->save();

    
        return redirect()->route('clientes.index');
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
        $cliente = Cliente::find($id);
        return view('clientes.show')->with('clientes',$cliente);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Cliente::find($id);
        return view('clientes.edit')->with('clientes',$cliente);
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
        $cliente = Cliente::find($id); 
        $cliente->nombre = $request->input('nombre');         
        $cliente->apellido = $request->input('apellido');  
        $cliente->direccion = $request->input('direccion');         
        $cliente->telefono = $request->input('telefono');         
        $cliente->nrc = $request->input('nrc');      
        $cliente->nit = $request->input('nit');   
        $cliente->dui = $request->input('dui');   
        $cliente->save();

        $nombre = $request->input('nombre');         
        return redirect()->route('clientes.index')->with(['message' => 'Los datos de '.$nombre.' se actualizaron correctamente']);
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
        
        DB::table("clientes")->where('id',$id)->delete();
        return redirect()->route('clientes.index'); 
        //
    }
}
