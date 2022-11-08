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
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
//agregamos
use Spatie\Permission\Models\Permission;

class PedidoController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-pedidos|crear-pedidos|editar-pedidos|borrar-pedidos', ['only' => ['index', 'pendientes', 'entregados', 'terminados']]);
         $this->middleware('permission:crear-pedidos', ['only' => ['create','store','edit']]);
         $this->middleware('permission:editar-pedidos', ['only' => ['update', 'agregar']]);
         $this->middleware('permission:borrar-pedidos', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$texto=trim($request->get('texto'));
       // $pedidos=DB::table('pedidos')
       // ->select('id','estado','descripcion','userventa','id_cliente')
       // ->where('descripcion', 'LIKE', '%'.$texto.'%')
        //->paginate(5);

        $texto = $request->texto;
        //$pedidos = Pedido::with(['clientes'])
        //->where('descripcion','LIKE','%' .$texto. '%')           
        //->paginate(5);
        //    $data =[
        //        'pedidos'=>$pedidos,
        //        'texto'=>$texto,
        //    ]    ;   
        //        return view('pedidos.index',$data) ;  
 
   // return view('pedidos.index',compact('pedidos'));
   $pedidos = Pedido::with('clientes')
   ->whereHas('clientes', function($query) use($texto){
    if ($texto) {
        return $query->where('nombre', 'LIKE', '%'.$texto.'%')
        ->orwhere('descripcion','LIKE','%' .$texto. '%') ;
    }
   })
   ->orderBy('id','desc')
   ->paginate(5);

  // return view('pedidos.index',['pedidos'=>$pedidos]);
   $data =[
            'pedidos'=>$pedidos,
            'texto'=>$texto,
        ]    ;   
            return view('pedidos.index',$data) ; 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
    
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
            'descripcion' => 'required'

        ]);
        
        
        $idcliente = $request->get('id_cliente');
        $pedidos = new Pedido();
        $pedidos->estado = 1;
        $pedidos->descripcion = $request->get('descripcion');
        $pedidos->userventa = $request->get('userventa');
        $pedidos->id_cliente = $request->get('id_cliente');

        $pedidos->save();
       // $ordenes=DB::table('ordenes')
       // ->select('*')
       // ->where('id_pedido',$idcliente)
       // ->paginate(5);

       return redirect()->route('pedidos.index');
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
        $pedido = Pedido::find($id);
        $ordenes=DB::table('ordenes')
        ->select('*')
        ->where('id_pedido',$id)
        ->paginate(5);

        $countter = Orden::where('estado','=','4')
        ->where('id_pedido', '=', $id)->count();
        $countotal = Orden::where('id_pedido', '=', $id)->count();
        
        $data =[
            'countter'=>$countter,
            'countotal'=>$countotal,
        ]    ;  


return view('pedidos.show', $data, compact('ordenes'))->with('pedidos',$pedido);
        
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
        DB::table("pedidos")->where('id',$id)->delete();
        return redirect()->back();
    }


    public function agregar($id)
    {
        $cliente = Cliente::find($id);
        $permission = Permission::get();

       
        return view('pedidos.create',compact('permission'))->with('clientes',$cliente);
    }


    public function pendientes()
    {

         $pedidos = Pedido::with('clientes')
      ->where('estado','1')
      ->orderBy('id','desc')
      ->paginate(5);
      $data =[
               'pedidos'=>$pedidos,
           ]    ;   
               return view('pedidos.pendientes',$data) ; 
    }

    public function terminados()
    {

         $pedidos = Pedido::with('clientes')
      ->where('estado','2')
      ->orderBy('id','desc')
      ->paginate(5);
      $data =[
               'pedidos'=>$pedidos,
           ]    ;   
               return view('pedidos.terminados',$data) ; 
    }
    public function entregados()
    {

         $pedidos = Pedido::with('clientes')
      ->where('estado','3')
      ->orderBy('id','desc')
      ->paginate(5);
      $data =[
               'pedidos'=>$pedidos,
           ]    ;   
               return view('pedidos.entregados',$data) ; 
    }

    public function cestado($id)
    {

         $pedidos = Pedido::with('clientes')
      ->where('id', $id);
      $pedidos->update(['estado' => '3']);
      return redirect()->back();
    }

    public function cestado1($id)
    {

         $pedidos = Pedido::with('clientes')
      ->where('id', $id);
      $pedidos->update(['estado' => '2']);
      return redirect()->route('pedidos.index');
    }

}



