<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Inventario;
use App\Models\Useinventario;
use App\Models\Producto;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
//agregamos
use Spatie\Permission\Models\Permission;

class ProductoController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:ver-productos|crear-productos|editar-productos|borrar-productos', ['only' => ['index']]);
         $this->middleware('permission:crear-productos', ['only' => ['create','store','edit']]);
         $this->middleware('permission:editar-productos', ['only' => ['update', 'cambio_de_estado']]);
         $this->middleware('permission:borrar-productos', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $texto=trim($request->get('texto'));
        $productos=DB::table('productos')
        ->select('id','codigo','nombre','descripcion','estado')
        ->where('nombre', 'LIKE', '%'.$texto.'%')
        ->orwhere('codigo', 'LIKE', '%'.$texto.'%')
        ->orwhere('descripcion', 'LIKE', '%'.$texto.'%')
        ->paginate(5);

return view('productos.index',compact('productos','texto'));
       
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
        return view('productos.create',compact('permission'));
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
            'codigo' => 'required|unique:productos,codigo',
            'nombre' => 'required',
            'descripcion' => 'required'

        ]);

        $producto = new Producto();
        $producto->codigo = $request->get('codigo');
        $producto->nombre = $request->get('nombre');
        $producto->descripcion = $request->get('descripcion');
        $producto->estado = 1;
    

        $producto->save();

    
        return redirect()->route('productos.index');
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
        $producto = Producto::find($id);
        return view('productos.edit')->with('productos',$producto);
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
        $this->validate($request, [
            'codigo' => 'required',
            'nombre' => 'required',
            'descripcion' => 'required'

        ]);
          
            $producto = Producto::find($id); 
            $producto->codigo = $request->input('codigo');      
            $producto->nombre = $request->input('nombre');         
            $producto->descripcion = $request->input('descripcion');
            $producto->estado = $request->input('estado');
            $producto->save();
            $nombre = $request->input('nombre');         
        return redirect()->route('productos.index')->with(['message' => 'Los datos de '.$nombre.' se actualizaron correctamente']);
        
        //
    }
 


public function cambio_de_estado($id)
{
    $producto = Producto::find($id);

    if ($producto->estado == 1) {
        $productos = Producto::with('estado')
        ->where('id', $id);
        $productos->update(['estado' => '2']);
        return redirect()->back();
    } else {
        $productos = Producto::with('estado')
        ->where('id', $id);
        $productos->update(['estado' => '1']);
        return redirect()->back();
    }


}

    




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("productos")->where('id',$id)->delete();
        return redirect()->back();
    }
}
