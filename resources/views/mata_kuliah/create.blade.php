@extends('layout.main')
@section('title','Mata Kuliah')

@section('content')
<!--begin::Row-->
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline mb-4">
                  <!--begin::Header-->
                  <div class="card-header"><div class="card-title"><b>Tambah Mata Kuliah</b></div></div>
                  <!--end::Header-->
                  <!--begin::Form-->
                  <form action="{{ route('mata_kuliah.store') }}" method="POST">
                    @csrf
                    <!--begin::Body-->
                    <div class="card-body">
                      <div class="mb-3">
                        <label for="kode_mk" class="form-label">Kode Mata Kuliah</label>
                        <input type="text" class="form-control" name="kode_mk" value="{{ old('kode_mk') }}">
                        @error('kode_mk')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="nama" class="form-label">Nama Mata Kuliah</label>
                        <input type="text" class="form-control" name="nama" value="{{ old('nama') }}">
                        @error('nama')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="prodi_id" class="form-label">Prodi</label>
                        <select class="form-control" name="prodi_id">
                          <option value="">--Pilih Prodi--</option>
                          @foreach ($prodi as $item)
                          <option value="{{ $item->id }}">{{ $item->nama }}</option>
                          @endforeach </select>
                            @error('prodi_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                      </div>
                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <!--end::Footer-->
                  </form>
                  <!--end::Form-->
                </div>

    </div>
  </div>
  <!--end::Row-->
  @endsection