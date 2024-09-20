<table>
    <thead>
    <tr>
        <th>Codigo</th>
        <th>Descripcion</th>
        <th>Observaciones</th>
        <th>Modelo</th>
        <th>Serie</th>
        <th>Cantidad</th>
        <th>Marca</th>
        <th>Equipo</th>
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
            <td>{{ $item->cantidad }}</td>
            <td>{{ $item->marca->nombre }}</td>
            <td>{{ $item->equipo_id }}</td>
            <td>{{ $item->created_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>