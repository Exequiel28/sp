<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Inventario;
use App\Models\Useinventario;
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
         $this->middleware('permission:crear-inventario', ['only' => ['create','store','edit']]);
         $this->middleware('permission:editar-inventario', ['only' => ['update', 'update2', 'update3', 'update4', 'increment', 'increment1', 'increment2', 'usando', 'uso', 'agregar']]);
         $this->middleware('permission:borrar-inventario', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //$inventarios = Inventario::paginate(5);
        //return view('inventario.index',compact('inventarios'));
        $texto=trim($request->get('texto'));
        $inventarios=DB::table('inventarios')
        ->select('id','cod','nombre','descripcion','cantidad','precio')
        ->where('cod', 'LIKE', '%'.$texto.'%')
        ->orwhere('nombre', 'LIKE', '%'.$texto.'%')
        ->paginate(5);

return view('inventario.index',compact('inventarios','texto'));
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
        $this->validate($request, [
            'cod' => 'required|unique:inventarios,cod',
            'nombre' => 'required',
            'descripcion' => 'required',
            'cantidad' => 'required',
            'precio' => 'required'

        ]);

        $inventarios = new Inventario();
        $inventarios->cod = $request->get('cod');
        $inventarios->nombre = $request->get('nombre');
        $inventarios->descripcion = $request->get('descripcion');
        $inventarios->cantidad = $request->get('cantidad');
        $inventarios->precio = $request->get('precio');

        $inventarios->save();

    
        return redirect()->route('inventario.index');
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
        return view('inventario.edit')->with('inventario',$inventario);

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
        $inventario->cod = $request->input('cod'); 
        $inventario->nombre = $request->input('nombre');         
        $inventario->descripcion = $request->input('descripcion');         
        $inventario->cantidad = $request->input('cantidad');         
        $inventario->precio = $request->input('precio');         
        $inventario->save();

    
        return redirect()->route('inventario.index');
        //
    }
    public function increment($id)
    {
       // $inventario = Inventario::find($request->id);
        //return view('inventario.increment',compact('inventario'));

        $inventario = Inventario::find($id);
        return view('inventario.edit2')->with('inventario',$inventario);


        
    }

    public function update2(Request $request, $id)
    {
       
        $this->validate($request, [
            'cantidad2' => 'required',
        ]);
    
        $inventario = Inventario::find($id);

       
        $var1 = $request->get('cantidad');
        $var = $request->get('cantidad2');
        $nombre = $request->get('nombre');
        $inventario->cantidad = $var1+$var;
        $inventario->save();

    
        return redirect()->route('inventario.index')->with(['message' => 'El valor de '.$nombre.' se actualizo correctamente']);
        //
    }

    public function increment1($id)
    {
       // $inventario = Inventario::find($request->id);
        //return view('inventario.increment',compact('inventario'));

        $inventario = Inventario::find($id);
        return view('inventario.edit3')->with('inventario',$inventario);


        
    }
    
    public function update3(Request $request, $id)
    {
       
        $this->validate($request, [
            'cantidad2' => 'required',
        ]);
    
        $inventario = Inventario::find($id);

       
        $var1 = $request->get('cantidad');
        $var = $request->get('cantidad2');
        $nombre = $request->get('nombre');
        
            if ($var1> $var) {
                //echo "<script>alert('EL valor ingresado $var1 es mayor al registrado');</script>";
                //return view('inventario.edit3')->with('inventario',$inventario);

                return redirect()->back()->with(['message' => 'EL valor ingresado '.$var1.' es mayor al registrado']);
                
            } else {
                $inventario->cantidad = $var-$var1; 
            $inventario->save();
            return redirect()->route('inventario.index')->with(['message' => 'El valor de '.$nombre.' se actualizo correctamente']);
            }
        

    
       
        //
    }
    
    public function increment2($id)
    {
       // $inventario = Inventario::find($request->id);
        //return view('inventario.increment',compact('inventario'));

        $useinventario = Useinventario::find($id);
        return view('inventario.edit4')->with('useinventario',$useinventario);


        
    }
    
    public function update4(Request $request, $id)
    {
       
        $this->validate($request, [
            'uso2' => 'required',
        ]);
    
        $useinventario = Useinventario::find($id);

       
        $var1 = $request->get('uso');
        $var = $request->get('uso2');
        $nombre = $request->get('nombre');
        $cal = $var-$var1; 
        
            if ($var1> $var) {
                //echo "<script>alert('EL valor ingresado $var1 es mayor al registrado');</script>";
                //return view('inventario.edit3')->with('inventario',$inventario);

                return redirect()->back()->with(['message' => 'EL valor ingresado '.$var1.' es mayor al registrado']);
                
            } else {
               
                if ($cal < 1) {
                    $useinventario->uso = $cal;
                    $useinventario->estado = '2';
                    $useinventario->save();
                    return redirect()->route('inventario.uso')->with(['message' => 'El valor de '.$nombre.' se actualizo correctamente']);                
                   
                } else {
                    $useinventario->uso = $cal;
                    $useinventario->save();
                    return redirect()->route('inventario.uso')->with(['message' => 'El valor de '.$nombre.' se actualizo correctamente']);                
                }
                
            }
        

    
       
        //
    }

    public function agregar($id)
    {
       // $inventario = Inventario::find($request->id);
        //return view('inventario.increment',compact('inventario'));

        $inventario = Inventario::find($id);
        return view('inventario.agregar')->with('inventario',$inventario);

        
    }



    public function usando(Request $request, $id)
    {
       
        $this->validate($request, [
            'cantidad2' => 'required',
            'cantidad' => 'required',
            'uso' => 'required'
        ]);
    
        $inventario = Inventario::find($id);

       
        $var1 = $request->get('cantidad');
        $var = $request->get('cantidad2');
        $nombre = $request->get('nombre');
        
            if ($var1> $var) {
                //echo "<script>alert('EL valor ingresado $var1 es mayor al registrado');</script>";
                //return view('inventario.edit3')->with('inventario',$inventario);

                return redirect()->back()->with(['message' => 'EL valor ingresado '.$var1.' es mayor al registrado']);
                
            } else {
                $inventario->cantidad = $var-$var1; 
            $inventario->save();
            
            
            $useinventario = new Useinventario();
            $useinventario->cod = $request->get('cod');
            $useinventario->nombre = $request->get('nombre');
            $useinventario->descripcion = $request->get('descripcion');
            $useinventario->cantidad = $request->get('cantidad');
            $useinventario->precio = $request->get('precio');
            $useinventario->uso = $request->get('uso');
            $useinventario->estado = $request->get('estado');
    
            $useinventario->save();
            return redirect()->route('inventario.uso')->with(['message' => 'El valor de '.$nombre.' se actualizo correctamente']);
            }
    }

    public function uso(Request $request)
    {

        //$inventarios = Inventario::paginate(5);
        //return view('inventario.index',compact('inventarios'));
       // $texto=trim($request->get('texto'));
       // $useinventarios=DB::table('useinventarios')
       // ->select('id','cod','nombre','descripcion','cantidad','precio','uso','estado')
       // ->where('cod', 'LIKE', '%'.$texto.'%')
       // ->orwhere('nombre', 'LIKE', '%'.$texto.'%')
       // ->paginate(5);
       
       $useinventarios=Useinventario::all();
       

        return view('inventario.uso',compact('useinventarios'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       // Inventario::find($id)->delete();
       // return redirect()->route('inventario.index');
       DB::table("inventarios")->where('id',$id)->delete();
        return redirect()->route('inventario.index'); 
    }

    
    
}
