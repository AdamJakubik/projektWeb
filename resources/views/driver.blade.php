<title>Řidiči</title>

<span class="header">
    <h1>Řidiči</h1>
</span>
<table class="table" >
    <thead>
        <tr>
            <th>ID</th>
            <th>Jméno</th>
            <th>Datum narození</th>
            <th>Původ</th>
            <th>Výhry</th>
            <th>Titul mistra světa</th>
            <th>DNF</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->made }}</td>
                <td>{{ $item->country_name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
