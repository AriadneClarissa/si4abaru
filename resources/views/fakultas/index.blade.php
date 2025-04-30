<h1>Fakultas</h1>

<table>
    <tr>
        <th>nama</th>
        <th>Singkatan</th>
        <th>Dekan</th>
        <th>Wakil Dekan</th>
    </tr>
@foreach ($fakultlas as $item)
    <tr>
        <td>{{ $item->nama }}</td>
        <td>{{ $item->singkatan }}</td>
        
    </tr>
    {($item->nama )} {{$item->singkatan}} <br>
@endforeach
</table>