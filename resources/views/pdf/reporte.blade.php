<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Reporte</title>

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
            <h2>Reporte de solicitud de reparacion</h2>

            <p><strong>Generado por: </strong>{{ Auth::user()->perfil->nombre }} <strong>fecha:</strong>
                {{ date('d-m-Y') }}</p>



            <h4>Solicitante</h4>

            <table>
                <tbody>
                    <tr>
                        <td colspan="1">
                            <strong>Nombre:</strong>
                        </td>
                        <td colspan="3">
                            {{ $solicitud->user->name }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="1">
                            Cargo:
                        </td>
                        <td colspan="3">
                            {{ $solicitud->user->perfil->cargo }}
                        </td>

                    </tr>
                    <tr>
                        <td colspan="1">
                            Carnet:
                        </td>
                        <td colspan="1">
                            {{ $solicitud->user->perfil->carnet }}
                        </td>
                        <td colspan="1">
                            Celular:
                        </td>
                        <td colspan="1">
                            {{ $solicitud->user->perfil->celular }}
                        </td>
                    </tr>
                </tbody>
            </table>

            <div style="margin: 0 auto;">
                <h3>Codigo QR</h3>
                <img style="display: inline;"
                    src="data:image/png;base64, {{ base64_encode(QrCode::size(200)->generate('https://admin.ctvbolivia.com/mantenimientos/'.$solicitud->equipo->slug.'/create')) }} ">
            </div>

            <h4>Reporte</h4>

            <strong>Descripcion de la falla</strong>
            <p>
                {{ $solicitud->descripcion }}
            </p>

            <hr>
            <br>
            <strong>Descripcion del equipo</strong>
            <p><strong>Codigo equipo: </strong> {{ $solicitud->equipo->id }}</p>
            <table class="table">
                <tbody>
                    <tr>
                        <th colspan="4">Descripcion</th>
                        <th>Fecha registro</th>
                        <td>
                            {{ $solicitud->equipo->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">{{ $solicitud->equipo->descripcion }}</td>
                    </tr>
                    <tr>
                        <th colspan="2">Marca</th>
                        <th colspan="2">Modelo</th>
                        <th colspan="2">Serie</th>
                    </tr>
                    <tr>
                        <td colspan="2">
                            {{ $solicitud->equipo->marca->nombre }}
                        </td>
                        <td colspan="2">
                            {{ $solicitud->equipo->modelo }}
                        </td>
                        <td colspan="2">
                            {{ $solicitud->equipo->serie }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Serie tec
                        </th>
                        <td colspan="2">
                            {{ $solicitud->equipo->serietec }}
                        </td>
                        <th>
                            Estado
                        </th>
                        <td colspan="2">
                            @if ($solicitud->equipo->estado == 1)
                                Operativo
                            @endif
                            @if ($solicitud->equipo->estado == 2)
                                Mantenimiento
                            @endif
                            @if ($solicitud->equipo->estado == 3)
                                Stand By
                            @endif
                            @if ($solicitud->equipo->estado == 4)
                                Malo
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Area
                        </th>
                        <td colspan="2">
                            {{ $solicitud->equipo->area }}
                        </td>
                        <th>
                            Ubicacion
                        </th>
                        <td colspan="2">
                            {{ $solicitud->equipo->ubicacion }}
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</body>

</html>
