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
                                @if (session()->has('success'))
                                    <div class="text-lg text-white bg-green p-3 rounded mb-3 col-md-6">{{ session('success') }}</div>
                                @elseif(session()->has('error'))
                                    <div class="text-lg text-white bg-danger p-3 rounded mb-3 col-md-6">{{ session('error') }}</div>
                                @endif
                                <form method="post" action="{{ asset('/kendaraan-tambah/tambah') }}">
                                    @csrf

                                    {{-- Nama Kendaraan --}}
                                    <div class="mb-3 mt-4 col-md-6">
                                        <label for="nama_kendaraan" class="form-label">Nama Brand</label>
                                        <select class="form-control form-control-lg" id="nama_brand" name="nama_brand"
                                            value="{{ old('nama_brand') }}">
                                            <option selected disabled hidden>
                                                {{ count($brand) == 0 ? 'Kendaraan Tidak ada yang Tersedia' : '--Pilih--' }}
                                            </option>
                                            @foreach ($brand as $row)
                                                <option value="{{ $row->id }}">
                                                    {{ $row->nama_brand }} || {{ $row->nama_merek }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="form-text">Klik untuk memilih Nama Kendaraan</span>
                                        @error('nama_brand')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Plat --}}
                                    <div class="mb-3 col-md-6 form-floating">
                                        <input type="text" class="form-control" placeholder="..." id="plat" name="plat"
                                        value="{{ old('plat') }}">
                                        <label for="plat" class="ms-2">Plat</label>

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
