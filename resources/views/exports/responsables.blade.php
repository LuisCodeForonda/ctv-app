<table>
    <thead>
    <tr>
        <th>Codigo</th>
        <th>Nombre</th>
        <th>Cargo</th>
        <th>Carnet</th>
        <th>Celular</th>
        <th>Fecha creacion</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->nombre }}</td>
            <td>{{ $item->cargo }}</td>
            <td>{{ $item->carnet }}</td>
            <td>{{ $item->celular }}</td>
            <td>{{ $item->created_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>