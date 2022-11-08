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

class OrdenController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-ordenes|crear-ordenes|editar-ordenes|borrar-ordenes', ['only' => ['index']]);
         $this->middleware('permission:crear-ordenes', ['only' => ['create','store','edit']]);
         $this->middleware('permission:editar-ordenes', ['only' => ['update']]);
         $this->middleware('permission:borrar-ordenes', ['only' => ['destroy']]);
         $this->middleware('permission:ver-impresion', ['only' => ['camestado2']]);
         $this->middleware('permission:ver-diseño', ['only' => ['']]);
         $this->middleware('permission:ver-acabado', ['only' => ['camestado3']]);
         $this->middleware('permission:ver-especial', ['only' => ['']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        $ordenes=DB::table('ordenes')
        ->select('*')

        ->paginate(10);

return view('pedidos.show',compact('ordenes'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $pedido = Pedido::find($id);
        $permission = Permission::get();
        $productos = Producto::all()
        ->where('estado','1');
        $data = array("lista_productos" => $productos);
       return view('ordenes.create',$data, compact('permission'))->with('pedidos',$pedido);
    
      // return response()->view("ordenes.create", $data, 200);

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
            'unidadm' => 'required',
            'producto' => 'required',
            'ancho' => 'required',
            'alto' => 'required',
            'precio' => 'required',
            'preciodis' => 'required',
            'fecha_entrega' => 'required',
            'hora_entrega' => 'required',
            'descripcion' => 'required',
            'copias' => 'required',
        ]);
        
        $precio = $request->get('precio');
        $preciodis = $request->get('preciodis');
        $copias = $request->get('copias');
        $subtotal= (($precio*$copias)+$preciodis);
        $unidadm = $request->get('unidadm');
        $ancho = $request->get('ancho');
        $alto = $request->get('alto');

    if ($unidadm == 1) {
        $anchoc = $ancho *(1.0 / 100);
        $altoc = $alto *(1.0 / 100);

        $orden = new Orden();
        $orden->estado = 1;
        $orden->producto = $request->get('producto');
        $orden->ancho = $anchoc;
        $orden->alto = $altoc;
        $orden->fecha_entrega = $request->get('fecha_entrega');
        $orden->hora_entrega = $request->get('hora_entrega');
        $orden->precio = $request->get('precio');
        $orden->preciodis = $request->get('preciodis');
        $orden->total =$subtotal;
        $orden->userventa = $request->get('userventa');
        $orden->id_pedido = $request->get('id_pedido');
        $orden->descripcion = $request->get('descripcion');
        $orden->copias = $copias;

        $orden->save();

        return redirect()->route('pedidos.index');
    } else {
        if ($unidadm == 2) {
            $anchoc = $ancho;
            $altoc = $alto;

            $orden = new Orden();
            $orden->estado = 1;
            $orden->producto = $request->get('producto');
            $orden->ancho = $anchoc;
            $orden->alto = $altoc;
            $orden->fecha_entrega = $request->get('fecha_entrega');
            $orden->hora_entrega = $request->get('hora_entrega');
            $orden->precio = $request->get('precio');
            $orden->preciodis = $request->get('preciodis');
            $orden->total =$subtotal;
            $orden->userventa = $request->get('userventa');
            $orden->id_pedido = $request->get('id_pedido');
            $orden->descripcion = $request->get('descripcion');
            $orden->copias = $copias;

            $orden->save();

            return redirect()->route('pedidos.index');
        } else {
            $anchoc = $ancho *(1.0 / 39.37);
            $altoc = $alto *(1.0 / 39.37);

            $orden = new Orden();
            $orden->estado = 1;
            $orden->producto = $request->get('producto');
            $orden->ancho = $anchoc;
            $orden->alto = $altoc;
            $orden->fecha_entrega = $request->get('fecha_entrega');
            $orden->hora_entrega = $request->get('hora_entrega');
            $orden->precio = $request->get('precio');
            $orden->preciodis = $request->get('preciodis');
            $orden->total =$subtotal;
            $orden->userventa = $request->get('userventa');
            $orden->id_pedido = $request->get('id_pedido');
            $orden->descripcion = $request->get('descripcion');
            $orden->copias = $copias;

            $orden->save();

            return redirect()->route('pedidos.index');
        }
        
    }
    




        
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
        
        $ordenes = Orden::find($id);
        return view('ordenes.show', compact('ordenes'))->with('ordenes',$ordenes);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ordenes = Orden::find($id);
        $productos = Producto::all();
        $data = array("lista_productos" => $productos);
        return view('ordenes.edit', $data)->with('ordenes',$ordenes);
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
            'unidadm' => 'required',
            'producto' => 'required',
            'ancho' => 'required',
            'alto' => 'required',
            'precio' => 'required',
            'preciodis' => 'required',
            'fecha_entrega' => 'required',
            'hora_entrega' => 'required',
            'descripcion' => 'required',
            'copias' => 'required',

        ]);
        
        $precio = $request->get('precio');
        $preciodis = $request->get('preciodis');
        $subtotal= $precio+$preciodis;
        $unidadm = $request->get('unidadm');
        $ancho = $request->get('ancho');
        $alto = $request->get('alto');

    if ($unidadm == 1) {
        $anchoc = $ancho *(1.0 / 100);
        $altoc = $alto *(1.0 / 100);

        $orden = Orden::find($id); 
        $orden->estado = 1;
        $orden->producto = $request->get('producto');
        $orden->ancho = $anchoc;
        $orden->alto = $altoc;
        $orden->fecha_entrega = $request->get('fecha_entrega');
        $orden->hora_entrega = $request->get('hora_entrega');
        $orden->precio = $request->get('precio');
        $orden->preciodis = $request->get('preciodis');
        $orden->total =$subtotal;
        $orden->userventa = $request->get('userventa');
        $orden->id_pedido = $request->get('id_pedido');
        $orden->descripcion = $request->get('descripcion');
        $orden->copias = $request->get('copias');

        $orden->save();

        return redirect()->route('pedidos.index');
    } else {
        if ($unidadm == 2) {
            $anchoc = $ancho;
            $altoc = $alto;

            $orden = Orden::find($id); 
            $orden->estado = 1;
            $orden->producto = $request->get('producto');
            $orden->ancho = $anchoc;
            $orden->alto = $altoc;
            $orden->fecha_entrega = $request->get('fecha_entrega');
            $orden->hora_entrega = $request->get('hora_entrega');
            $orden->precio = $request->get('precio');
            $orden->preciodis = $request->get('preciodis');
            $orden->total =$subtotal;
            $orden->userventa = $request->get('userventa');
            $orden->id_pedido = $request->get('id_pedido');
            $orden->descripcion = $request->get('descripcion');
            $orden->copias = $request->get('copias');

            $orden->save();

            return redirect()->route('pedidos.index');
        } else {
            $anchoc = $ancho *(1.0 / 39.37);
            $altoc = $alto *(1.0 / 39.37);

            $orden = Orden::find($id); 
            $orden->estado = 1;
            $orden->producto = $request->get('producto');
            $orden->ancho = $anchoc;
            $orden->alto = $altoc;
            $orden->fecha_entrega = $request->get('fecha_entrega');
            $orden->hora_entrega = $request->get('hora_entrega');
            $orden->precio = $request->get('precio');
            $orden->preciodis = $request->get('preciodis');
            $orden->total =$subtotal;
            $orden->userventa = $request->get('userventa');
            $orden->id_pedido = $request->get('id_pedido');
            $orden->descripcion = $request->get('descripcion');
            $orden->copias = $request->get('copias');

            $orden->save();

            return redirect()->route('pedidos.index');
        }
        
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
        DB::table("ordenes")->where('id',$id)->delete();
        return redirect()->back();
    }

    public function index2(Request $request)
    {
        // $pedido = Pedido::find($id);
   // $ordenes=DB::table('ordenes')
   // ->select('*') 
   // ->orderBy('id','desc')  
    //->paginate(5);

    //return view('ordenes.index',compact('ordenes'));

    $texto = $request->texto;

        $ordenes = Orden::with('pedidos')
        ->whereHas('pedidos', function($query) use($texto){
        if ($texto) {
        return $query->where('descripcion', 'LIKE', '%'.$texto.'%')
        ->orwhere('descripcion','LIKE','%' .$texto. '%') 
        ->orwhere('producto','LIKE','%' .$texto. '%') ;
        }
        })
        ->orderBy('id','desc')
        ->paginate(10);

        $data =[
            'ordenes'=>$ordenes,
            'texto'=>$texto,
        ]    ;   
            return view('ordenes.index',$data) ; 
    }

    public function ordendis(Request $request)
    {
        
   $ordenes=DB::table('ordenes')
   ->select('*') 
   ->where('estado','1')
   ->orderBy('id','desc')  
   ->paginate(5);

    return view('ordenes.ordendis',compact('ordenes'));

    }

    public function ordenimp(Request $request)
    {
        
   $ordenes=DB::table('ordenes')
   ->select('*') 
   ->where('estado','2')
   ->orderBy('id','desc')  
   ->paginate(5);

    return view('ordenes.ordenimp',compact('ordenes'));

    }
    public function ordenaca(Request $request)
    {
        
   $ordenes=DB::table('ordenes')
   ->select('*') 
   ->where('estado','3')
   ->orderBy('id','desc')  
   ->paginate(5);

    return view('ordenes.ordenaca',compact('ordenes'));

    }

    public function camestado1($id)
    {

         $ordenes = Orden::with('pedidos')
      ->where('id', $id);
      $ordenes->update(['estado' => '2']);
      return redirect()->back();
    }

    public function camestado2($id)
    {

         $ordenes = Orden::with('pedidos')
      ->where('id', $id);
      $ordenes->update(['estado' => '3']);
      return redirect()->back();
    }

    public function camestado3($id)
    {

         $ordenes = Orden::with('pedidos')
      ->where('id', $id);
      $ordenes->update(['estado' => '4']);
      return redirect()->back();
    }
   
}
