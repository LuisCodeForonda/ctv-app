<table>
    <thead>
    <tr>
        <th>Codigo</th>
        <th>Descripcion</th>
        <th>Observaciones</th>
        <th>Modelo</th>
        <th>Serie</th>
        <th>Serie Tec</th>
        <th>Estado</th>
        <th>Area</th>
        <th>Ubicacion</th>
        <th>Marca</th>
        <th>Fecha creacion</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->descripcion }}</td>
            <td>{{ $item->observaciones }}</td>
            <td>{{ $item->modelo }}</td>
            <td>{{ $item->serie }}</td>
            <td>{{ $item->serietec }}</td>
            <td>{{ $item->estado }}</td>
            <td>{{ $item->area }}</td>
            <td>{{ $item->ubicacion }}</td>
            <td>{{ $item->marca->nombre }}</td>
            <td>{{ $item->created_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>