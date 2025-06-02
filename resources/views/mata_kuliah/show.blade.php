@extends('layout.main')
@section('title','Mata Kuliah')

@section('content')
<!--begin::Row-->
<div class="row">
    <div class="col-12">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title"><b>List Mata Kuliah</b></h3>
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
                    <th>Kode Mata Kuliah</th>
                    <td>{{ $mataKuliah->kode_mk}}</td>
                </tr>
                <tr>
                    <th>Nama Mata Kuliah</th>
                    <td>{{ $mataKuliah->nama}}</td>
                </tr>
                <tr>
                    <th>Prodi</th>
                    <td>{{ $mataKuliah->prodi->nama}}</td>
                </tr>
                <tr>
                    <th>Fakultas</th>
                    <td>{{ $mataKuliah->prodi->fakultas->nama}}</td>
                </tr>
            </table>
        </div>
      </div>
        <!-- /.card -->
    </div>
</div>
<!--end::Row-->
@endsection