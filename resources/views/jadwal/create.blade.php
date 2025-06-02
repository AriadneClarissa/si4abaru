@extends('layout.main')
@section('title','Jadwal')

@section('content')
<!--begin::Row-->
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline mb-4">
                  <!--begin::Header-->
                  <div class="card-header"><div class="card-title"><b>Tambah Jadwal</b></div></div>
                  <!--end::Header-->
                  <!--begin::Form-->
                  <form action="{{ route('jadwal.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!--begin::Body-->
                    <div class="card-body">
                      <div class="mb-3">
                        <label for="tahun_akademik" class="form-label">Tahun Akademik</label>
                        <input type="text" class="form-control" name="tahun_akademik" value="{{ old('tahun_akademik') }}">
                        @error('tahun_akademik')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="kode_smt" class="form-label">Kode Semester</label>
                        <input type="text" class="form-control" name="kode_smt" value="{{ old('kode_smt') }}">
                        @error('kode_smt')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="kelas" class="form-label">Kelas</label>
                        <input type="text" class="form-control" name="kelas" value="{{ old('kelas') }}">
                        @error('kelas')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="mata_kuliah_id" class="form-label">Mata Kuliah</label>
                        <select class="form-control" name="mata_kuliah_id">
                          <option value="">--Pilih Mata Kuliah--</option>
                          @foreach ($mataKuliah as $item)
                          <option value="{{ $item->id }}">{{ $item->nama }}</option>
                          @endforeach </select>
                            @error('mata_kuliah_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                      </div>
                      <div class="mb-3">
                            <label for="dosen_id" class="form-label">Dosen</label>
                            <select class="form-control" name="dosen_id">
                            <option value="">--Pilih Dosen--</option>
                            @foreach ($dosen as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('dosen_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                      <div class="mb-3">
                        <label for="sesi_id" class="form-label">Sesi</label>
                        <select class="form-control" name="sesi_id">
                          <option value="">--Pilih Sesi--</option>
                          @foreach ($sesi as $item)
                          <option value="{{ $item->id }} " >
                            {{ $item->nama }}</option>
                          @endforeach </select>
                            @error('sesi_id')
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