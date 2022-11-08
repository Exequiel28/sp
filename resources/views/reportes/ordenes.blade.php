<html lang="es">

<head>
    <title>Reporte</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
        
	@page {
		margin-left: 0cm;
		margin-right: 0cm;

	}

        table {
            margin-left: 0cm;
            margin-right: 0cm;
            font-size: 30px;
        }
        body {
            
            margin-left: 0.5cm;
    		margin-right: 0.5cm;
        }
    </style>
</head>

<body>
<div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">  
                            <div>
                                <h5 class="text-center">Reportes de Ordenes de Trabajos</h5><br>
                            </div>
                            <div class="row">
                            <table class="table table-striped mt-2">
                                <thead style="background-color:#009bdb">                                                       
                                    <th style="color:#fff;">No</th>
                                    <th style="color:#fff;">Producto</th>
                                    <th style="color:#fff;">Ancho</th>
                                    <th style="color:#fff;">Alto</th>
                                    <th style="color:#fff;">Copias</th>
                                    <th style="color:#fff;">Descripcion</th>
                                    <th style="color:#fff;">F. Entrega</th>
                                    <th style="color:#fff;">H. Entrega</th>
                                    <th style="color:#fff;">Precio</th>
                                    <th style="color:#fff;">P. Diseño</th>
                                    <th style="color:#fff;">Total</th>
                                    <th style="color:#fff;">Estado</th>
                                    <th style="color:#fff;">Vendedor</th>
                                </thead>  
                                <tbody>
                                @foreach ($ordenes as $orden)
                                <tr>                           
                                
                                
                                <td>{{ $orden->id }}</td>
                                <td>{{ $orden->producto }}</td>
                                <td>{{ $orden->ancho }}</td>
                                <td>{{ $orden->alto }}</td>
                                <td>{{ $orden->copias }}</td>
                                <td>{{ $orden->descripcion }}</td>
                                <td>{{ $orden->fecha_entrega }}</td>
                                <td>{{ $orden->hora_entrega }}</td>
                                <td>{{ $orden->precio }}</td>
                                <td>{{ $orden->preciodis }}</td>
                                <td>{{ $orden->total }}</td>
                                @if ($orden->estado == '1')
                            <td>
                                Diseño 
                            </td>
                        @else
                            @if ($orden->estado == '2')
                            <td>
                                    Impresion 
                            </td>
                            @else
                            <td>
                                    Acabado 
                            
                            </td>
                            @endif
                        @endif
                                <td>{{ $orden->userventa }}</td>

                             </tr>

                                @endforeach
                                </tbody>               
                            </table>
    </div>
                            </div>
                        </div>


                    </div>
                    </div>
                    </div>
</body>

</html>