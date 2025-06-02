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
          <a href="{{ route('mata_kuliah.create')}}" class="btn btn-primary"> Tambah </a>
            <br><br><table class="table table-bordered table-striped">
                <tr class="text-center">
                    <th>Kode Mata Kuliah</th>
                    <th>Nama Mata Kuliah</th>
                    <th>Prodi</th>
                    <th>Aksi</th>
                </tr>
                @foreach ($mataKuliah as $item)
                <tr class="text-center">
                    <td>{{ $item->kode_mk }}</td>
                    <td>{{ $item->nama}}</td>
                    <td>{{ $item->prodi->nama}}</td>
                    <td>
                        <a href="{{ route('mata_kuliah.show', $item->id) }}" class="btn btn-info">Show</a>
                        <a href="{{ route('mata_kuliah.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('mata_kuliah.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger show_confirm"
                            data-toggle="tooltip" title='Delete'
                            data-nama='{{ $item->nama }}'>Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
  <!--end::Row-->
  @endsection