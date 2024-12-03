<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Equipos asignados</title>

    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            font-size: 1.1em;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .titulo {
            text-align: center;
            font-size: 2em;
            font-weight: bold;
        }

        th,
        td {
            border: 1px solid;

        }

        table {
            width: 100%;
            border: 1px solid;
            border-collapse: collapse;
        }

        .head>th {
            padding: 5px 0;
        }

        .body>th {
            font-weight: initial;
            padding: 5px 0;
        }
    </style>
</head>

<body>
    <div class="container mx-auto">
        <div>
            <h2>Reporte de equipo</h2>

            <p><strong>Generado por: </strong>{{ Auth::user()->perfil->nombre }} <strong>fecha:</strong>
                {{ date('d-m-Y') }}</p>


            <div class="">
                <h4>Equipo</h4>

                <div style="">
                    <div>
                        <h3>Descripcion</h3>
                        <p class="descripcion">{{ $equipo->descripcion }}</p>
                        <table class="table">
                            <tbody>
                                <tr class="body">
                                    <th scope="" class="" colspan="2">
                                        <strong>Detalle</strong>
                                    </th>
                                </tr>
                                <tr class="body">
                                    <th scope="" class="">
                                        <strong>Marca</strong>
                                    </th>
                                    <td>
                                        {{ $equipo->marca->nombre }}
                                    </td>
                                </tr>
                                <tr class="body">
                                    <th scope="" class="">
                                        <strong>Modelo</strong>
                                    </th>
                                    <td>
                                        {{ $equipo->modelo }}
                                    </td>
                                </tr>
                                <tr class="body">
                                    <th scope="" class="">
                                        <strong>Serie</strong>
                                    </th>
                                    <td>
                                        {{ $equipo->serie }}
                                    </td>
                                </tr>
                                <tr class="body">
                                    <th scope="" class="">
                                        <strong>Codigo</strong>
                                    </th>
                                    <td>
                                        {{ $equipo->serietec }}
                                    </td>
                                </tr>
                                <tr class="body">
                                    <th scope="" class="">
                                        <strong>Fecha creacion</strong>
                                    </th>
                                    <td>
                                        {{ $equipo->created_at }}
                                    </td>
                                </tr>
                                <tr class="body">
                                    <th scope="" class="">
                                        <strong>Fecha actualizacion</strong>
                                    </th>
                                    <td>
                                        {{ $equipo->created_at }}
                                    </td>
                                </tr>
                                <tr class="body">
                                    <th scope="" class="">
                                        <strong>Estado</strong>
                                    </th>
                                    <td>
                                        <p>{{ config('constants.estados')[$equipo->estado] }} </p>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div style="margin: 0 auto;">
                        <h3>Codigo QR</h3>
                        <img style="display: inline;"
                            src="data:image/png;base64, {{ base64_encode(QrCode::size(200)->generate('https://admin.ctvbolivia.com/dashboard/equipo/' . $equipo->slug)) }} ">
                    </div>
                </div>

                <div style="">
                    <h3 style="padding-bottom: 1em">Componentes del equipo</h3>
                    @foreach ($equipo->componentes as $item)
                        <table style="margin-bottom: 1em;">
                            <tbody style="">
                                <tr style="font-weight: initial">
                                    <th scope="" style="" colspan="4">
                                        Descripcion
                                    </th>
                                </tr>
                                <tr>
                                    <td colspan="4">{{ $item->descripcion }}</td>
                                </tr>
                                <tr>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Serie</th>
                                    <th>Cantidad</th>
                                </tr>
                                <tr>
                                    <td>{{ $item->marca->nombre }}</td>
                                    <td>{{ $item->modelo }}</td>
                                    <td>{{ $item->serie }}</td>
                                    <td>{{ $item->cantidad }}</td>
                                </tr>
                            </tbody>
                        </table>
                    @endforeach
                </div>

                <div style="">
                    <h3 style="padding-bottom: 1em">Historial de mantenimientos del equipo</h3>
                    @foreach ($equipo->mantenimientos as $item)
                        <table style="margin-bottom: 1em;">
                            <tbody style="">
                                <tr style="font-weight: initial">
                                    <th scope="" style="" colspan="4">
                                        Descripcion
                                    </th>
                                </tr>
                                <tr>
                                    <td colspan="4">{{ $item->descripcion }}</td>
                                </tr>
                                <tr>
                                    <th colspan="2">Tecnico</th>
                                    <th colspan="2">fecha mantenimiento</th>
                                </tr>
                                <tr>
                                    <td colspan="2">{{ $item->user->perfil->nombre }}</td>
                                    <td colspan="2">{{ $item->created_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>

</html>
