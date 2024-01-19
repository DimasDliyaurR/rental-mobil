@extends('layouts-admin.head')

@section('content')
    <div class="content my-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1>{{ $title }}</h1>
                            <div class="overflow-visible" style="width: 10wv">
                                <form method="post" action="{{ asset('/kendaraan-tambah/tambah') }}">
                                    @csrf

                                    {{-- Nama Kendaraan --}}
                                    <div class="mb-3">
                                        <label for="nama_kendaraan" class="form-label">Nama Kendaraan</label>
                                        <select class="form-control" id="nama_kendaraan" name="nama_kendaraan"
                                            value="{{ old('nama_kendaraan') }}">
                                            <option selected disabled>--Pilih--</option>
                                            @foreach ($brand as $row)
                                                <option value="{{ $row->id }}">{{ $row->nama_kendaraan }}</option>
                                            @endforeach
                                        </select>
                                        <span class="form-text">Klik untuk memilih Nama Kendaraan</span>
                                        @error('nama_kendaraan')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Plat --}}
                                    <div class="mb-3">
                                        <label for="plat" class="form-label">Plat</label>
                                        <input type="text" class="form-control" id="plat" name="plat"
                                            value="{{ old('plat') }}">
                                        <span class="form-text">Contoh : W 8989 DR</span>
                                        @error('plat')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection
