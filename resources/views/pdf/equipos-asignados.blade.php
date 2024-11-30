<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Equipos asignados</title>

    <style>
        .container{
            max-width: 1200px;
            margin: 0 auto;
            font-size: 1.1em;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .titulo{
            text-align: center;
            font-size: 2em;
            font-weight: bold;
        }
        th, td {
            border: 1px solid;
            
        }
        table{
            width: 100%;
            border: 1px solid;
            border-collapse: collapse;
        }
        .head > th{
            padding: 5px 0;
        }
        .body > th{
            font-weight: initial;
            padding: 5px 0;
        }
        
    </style>
</head>

<body>
    <div class="container mx-auto">
        <div>
            <h2>Reporte de equipos asignados</h2>

            <p><strong>Generado por: </strong>{{ Auth::user()->perfil->nombre }} <strong>fecha:</strong> {{ date('d-m-Y') }}</p>

        
            <div class="">
                <h4>Usuario</h4>

                <div class="flex gap-4 flex-wrap">
                    <p><strong>Nombre:</strong> {{ $user->perfil->nombre }}</p>
                    <p><strong>Carnet:</strong> {{ $user->perfil->carnet }} </p>
                    <p><strong>Cargo: </strong>{{ $user->perfil->cargo }} </p>
                    <p><strong>Celular:</strong> {{ $user->perfil->celular }} </p>
                </div>

                <h4>Detalle equipos asignados</h4>

                <div class="">
                    <table class="">
                        <thead class="">
                            <tr>
                                <th scope="col" class="">
                                    Descripcion
                                </th>
                                <th scope="col" class="">
                                    Modelo
                                </th>
                                <th scope="col" class=" ">
                                    Serie
                                </th>
                                <th scope="col" class=" ">
                                    Fecha asignacion
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user->asignados as $item)
                                <tr class="bg-white dark:bg-gray-800">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ Str::limit($item->equipo->descripcion, 50) }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $item->equipo->modelo }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->equipo->serie }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->fecha_asignacion }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="font-semibold text-gray-900 dark:text-white">
                                <th scope="row" class="px-6 py-3 text-base">Total asignados</th>
                                <td colspan="3" class="px-6 py-3">{{ count($user->asignados) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
            <hr>
        </div>
    </div>
</body>

</html>
