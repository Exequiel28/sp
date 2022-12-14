<html lang="es">

<head>
    <title>Laravel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        table {
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <h5 class=" font-weight-bold">DOMPDF Tutorial</h5>


<div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped mt-2">
                                <thead style="background-color:#009bdb">
                                    <tr>
                                        <td style="color:#fff;">Producto</td>
                                        <td style="color:#fff;">Venta</td>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($ordenesprod as $orden)
                                    <tr>
                                        <td>
                                        {{ $orden->producto }}
                                        </td>
                                        <td>
                                            {{ $orden->venta }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>                 
                            </div>
                        </div>
                    </div>
                    </div>
</body>

</html>