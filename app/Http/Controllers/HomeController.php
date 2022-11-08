<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Inventario;
use App\Models\Useinventario;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Orden;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use PDF;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $countpen = Pedido::where('estado','=','1')->count();

        $countter = Pedido::where('estado','=','2')->count();

        $countent = Pedido::where('estado','=','3')->count();

        $countdis = Orden::where('estado','=','1')->count();

        $countimp = Orden::where('estado','=','2')->count();

        $countaca = Orden::where('estado','=','3')->count();

        $data =[
            'countpen'=>$countpen,
            'countter'=>$countter,
            'countent'=>$countent,
            'countdis'=>$countdis,
            'countimp'=>$countimp,
            'countaca'=>$countaca,
        ]    ;  

        return view('home',$data);
    }

public function reportes(Request $request){
    // $countprod = Orden::select('producto')->count();
    //$ordenes = DB::table('ordenes')->select('producto')->groupBy('producto')->count('*') ;
    //$ordenes = Orden::all('*');
    // $ordenes = Orden::whereBetween('created_at', [$fecha1, $fecha2])->get();
    //  return view('reportes.index');
    $userv = User::all();
    $data = array("lista_users" => $userv);

     

    $fecha1 = $request->get('fecha1');
    $fecha2 = $request->get('fecha2');

    $ordenes = Orden::whereBetween('fecha_entrega', [$fecha1, $fecha2])->get();

    $fecha3 = $request->get('fecha3');
    $fecha4 = $request->get('fecha4');

 //SELECT SUM(`total`) FROM `ordenes` WHERE `fecha_entrega` >= '2022-09-29' AND `fecha_entrega`<'2022-10-28'

 //$ordenestotal = DB::table('ordenes')->select('total')->sum('total')->whereBetween('fecha_entrega', [$fecha3, $fecha4])

 $ordenestotal = DB::table('ordenes')->select('total')->whereBetween('fecha_entrega', [$fecha3, $fecha4])->sum('total');

 $fecha5 = $request->get('fecha5');
 $fecha6 = $request->get('fecha6');

 $ordenesprod = DB::table('ordenes')
                ->select('producto',DB::raw('COUNT(*) as venta'))
                ->whereBetween('fecha_entrega', [$fecha5, $fecha6])
                ->groupBy('producto')
                ->get();
 
 //dd($ordenesprod);
 
 $fecha7 = $request->get('fecha7');
 $fecha8 = $request->get('fecha8');
 $userventa = $request->get('userventa');

 //$ordenesuser = DB::table('ordenes')->where('userventa','=',$userventa)->whereBetween('fecha_entrega', [$fecha3, $fecha4])
//->get();

$ordenesuser = DB::table('ordenes')
                ->select('userventa',DB::raw('COUNT(*) as cantidad'))
                ->where('userventa','=',$userventa)
                ->whereBetween('fecha_entrega', [$fecha7, $fecha8])
                ->groupBy('userventa')
                ->get();

$ordenestotaluser = DB::table('ordenes')
->where('userventa','=',$userventa)
->whereBetween('fecha_entrega', [$fecha7, $fecha8])
->sum('total');

//if (!empty($fecha5) && !empty($fecha6)) {
 //   view()->share('reportes.productos',$ordenesprod);
 //   $pdf = PDF::loadView('reportes.productos', ['ordenesprod' => $ordenesprod]);
 //   return $pdf->download('Productos.pdf');
//}        
 
$data1 =[
    'fecha1'=>$fecha1,
    'fecha2'=>$fecha2,
    'fecha3'=>$fecha3,
    'fecha4'=>$fecha4,
    'fecha5'=>$fecha5,
    'fecha6'=>$fecha6,
    'fecha7'=>$fecha7,
    'fecha8'=>$fecha8,
]    ; 

return view('reportes.index', $data, compact('ordenes','ordenestotal','ordenesprod', 'ordenesuser', 'ordenestotaluser'))->with($data1);
        


}

public function downloadPDF(Request $request)
    {
        
        $fecha5 = $request->get('fecha5');
        $fecha6 = $request->get('fecha6');

        $ordenesprod = DB::table('ordenes')
                        ->select('producto',DB::raw('COUNT(*) as venta'))
                        ->whereBetween('fecha_entrega', [$fecha5, $fecha6])
                        ->groupBy('producto')
                        ->get();

        view()->share('reportes.productos',$ordenesprod);
        $pdf = PDF::loadView('reportes.productos', ['ordenesprod' => $ordenesprod]);
        return $pdf->download('Productos.pdf');
    }

    public function downloadPDF1(Request $request)
    {
        $fecha1 = $request->get('fecha1');
        $fecha2 = $request->get('fecha2');

        $ordenes = Orden::whereBetween('fecha_entrega', [$fecha1, $fecha2])->get();


        view()->share('reportes.productos',$ordenes);
        $pdf = PDF::loadView('reportes.ordenes', ['ordenes' => $ordenes])->setPaper('A4', 'landscape')->set_option('dpi', 256);
        return $pdf->download('Ordenes.pdf');
    }

    public function downloadPDF2(Request $request)
    {
        $fecha3 = $request->get('fecha3');
        $fecha4 = $request->get('fecha4');
    
        $ordenestotal = DB::table('ordenes')->select('total')->whereBetween('fecha_entrega', [$fecha3, $fecha4])->sum('total');
        $ordenestotalv = DB::table('ordenes')->select('precio')->whereBetween('fecha_entrega', [$fecha3, $fecha4])->sum('precio');
        $ordenestotald = DB::table('ordenes')->select('preciodis')->whereBetween('fecha_entrega', [$fecha3, $fecha4])->sum('preciodis');

        $ordenesproductos = DB::table('ordenes')
        ->select('producto','precio',DB::raw('COUNT(*) as venta'))
        ->whereBetween('fecha_entrega', [$fecha5, $fecha6])
        ->sum('precio')
        ->groupBy('producto')
        ->get();

        view()->share('reportes.productos',$ordenestotal);
        $pdf = PDF::loadView('reportes.ordenestotal', ['ordenestotal' => $ordenestotal])->setPaper('A4', 'landscape')->set_option('dpi', 256);
        return $pdf->download('Reporte de ventas de Ordenes.pdf');
    }



public function consulta(Request $request){


    // $countprod = Orden::select('producto')->count();
 
    
 
     //$ordenes = DB::table('ordenes')->select('producto')->groupBy('producto')->count('*') ;
 //$ordenes = Orden::all('*');
    $fecha1 = $request->get('fecha1');
    $fecha2 = $request->get('fecha2');
 
 
    $ordenes = Orden::whereBetween('fecha_entrega', [$fecha1, $fecha2])
 ->get();
     return view('reportes.index', compact('ordenes'));
 
 
 
 
 }

}
