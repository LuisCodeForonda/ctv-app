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
            <h2>Reporte de mantenimiento</h2>

            <p><strong>Generado por: </strong>{{ Auth::user()->perfil->nombre }} <strong>fecha:</strong> {{ date('d-m-Y') }}</p>

        
            <div class="">
                <h4>Equipo</h4>

                <div class="flex gap-4 flex-wrap">
                    <p><strong>Descripcion:</strong> {{ $mantenimiento->equipo->descripcion }}</p>
                    <p><strong>Modelo:</strong> {{ $mantenimiento->equipo->modelo }} </p>
                    <p><strong>Serie: </strong>{{ $mantenimiento->equipo->serie }} </p>
                    <p><strong>Estado:</strong> {{ config('constants.estados')[$mantenimiento->equipo->estado] }} </p>
                </div>

                <h4>Mantenimiento</h4>

                <p>
                    {{ $mantenimiento->descripcion }}
                </p>
                
                <h4>Tecnico</h4>
                <p><strong>Realizado en fecha:</strong> {{ $mantenimiento->created_at }}, <strong>por:</strong> {{ $mantenimiento->user->perfil->nombre }}</p>
                <div class="">
                    <h5>Detalle del mantenimiento</h5>
                    <table class="">
                        <thead class="">
                            <tr>
                                <th scope="col" class="">
                                    Tipo
                                </th>
                                <th scope="col" class="">
                                    Descripcion
                                </th>
                                <th scope="col" class=" ">
                                    Costo
                                </th>
                                <th scope="col" class=" ">
                                    observacion
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mantenimiento->detalle as $item)
                                <tr class="bg-white dark:bg-gray-800">
                                    <td class="px-6 py-4">
                                        {{ config('constants.tipo')[$item->tipo] }}
                                    </td>
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ Str::limit($item->descripcion, 50) }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $item->costo }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->observacion }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        {{-- <tfoot>
                            <tr class="font-semibold text-gray-900 dark:text-white">
                                <th scope="row" class="px-6 py-3 text-base">Total asignados</th>
                                <td colspan="3" class="px-6 py-3">{{ count($mante->asignados) }}</td>
                            </tr>
                        </tfoot> --}}
                    </table>
                </div>

            </div>
        </div>
    </div>
</body>

</html>
