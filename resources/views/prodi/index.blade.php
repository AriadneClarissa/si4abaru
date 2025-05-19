@extends('layout.main')
@section('title', 'Program Studi')
    

@section('content')
<div class="card">
    <div class="card-header">
      <h3 class="card-title">List Prodi</h3>
      <div class="card-tools">
        <button
          type="button"
          class="btn btn-tool"
          data-lte-toggle="card-collapse"
          title="Collapse"
        >
          <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
          <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
        </button>
        <button
          type="button"
          class="btn btn-tool"
          data-lte-toggle="card-remove"
          title="Remove"
        >
          <i class="bi bi-x-lg"></i>
        </button>
      </div>
    </div>
    <div class="card-body">
      <a href="{{route('prodi.create')}}" class="btn btn-primary"> Tambah</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Singkatan</th>
                    <th>Kaprodi</th>
                    <th>Sekretaris</th>
                    <th>Fakultas</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($prodi as $item)
                    <tr>
                        <td>{{ $item->nama}}</td>
                        <td>{{ $item->singkatan}}</td>
                        <td>{{ $item->kaprodi}}</td>
                        <td>{{ $item->sekretaris}}</td>
                        <td>{{ $item->fakultas->nama}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

    