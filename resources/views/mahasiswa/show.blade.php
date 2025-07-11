@extends('layout.main')
@section('title','Mahasiswa')

@section('content')
<!--begin::Row-->
<div class="row">
    <div class="col-12">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title"> List Mahasiswa </h3>
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
            <table class="table table-bordered table-striped">
              <tr>
                    <th>Foto</th>
                    <td><img src="{{ asset('foto/'.$mahasiswa->foto)}}" class="img-fluid" width="80px"></td>
                </tr>  
              <tr>
                    <th>Nama</th>
                    <td>{{ $mahasiswa->nama}}</td>
                </tr>
                <tr>
                    <th>NPM</th>
                    <td>{{ $mahasiswa->npm}}</td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>{{ $mahasiswa->jk}}</td>
                </tr>
                <tr>
                    <th>Tempat, Tanggal Lahir</th>
                    <td>{{ $mahasiswa->tempat_lahir}}, {{ $mahasiswa->tanggal_lahir}}</td>
                </tr>
                <tr>
                    <th>Asal SMA</th>
                    <td>{{ $mahasiswa->asal_sma}}</td>
                </tr>
                <tr>
                    <th>Prodi</th>
                    <td>{{ $mahasiswa->prodi->nama}}</td>
                </tr>
                <tr>
                    <th>Fakultas</th>
                    <td>{{ $mahasiswa->prodi->fakultas->nama}}</td>
                </tr>
                
            </table>
        </div>
      </div>
        <!-- /.card -->
    </div>
</div>
<!--end::Row-->
@endsection