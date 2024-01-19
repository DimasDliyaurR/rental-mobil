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
                                    <div class="text-lg text-white bg-green p-3 rounded mb-3">{{ session('success') }}</div>
                                @elseif(session()->has('error'))
                                    <div class="text-lg text-white bg-danger p-3 rounded mb-3">{{ session('error') }}</div>
                                @endif
                                <form method="post" action="{{ asset('/kendaraan-tambah/tambah-brand') }}"
                                    enctype="multipart/form-data">
                                    @csrf

                                    {{-- Nama Kendaraan --}}
                                    <div class="mb-3">
                                        <label for="nama_kendaraan" class="form-label">Nama Kendaraan</label>
                                        <input type="text" class="form-control" id="nama_kendaraan" name="nama_kendaraan"
                                            value="{{ old('nama_kendaraan') }}" value="{{ old('nama_kendaraan') }}">
                                        <span class="form-text">Contoh : Brio Satya S MT</span>
                                        @error('nama_kendaraan')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Foto Kendaraan --}}
                                    <div class="mb-3">
                                        <label for="foto_kendaraan" class="form-label">Foto Kendaraan</label>
                                        <input type="file" class="form-control" id="foto_kendaraan" name="foto_kendaraan"
                                            multiple>
                                        <span class="form-text">Hanya menerima file dengan exstension pg, jpeg, png, bmp,
                                            gif, svg, atau webp</span>
                                        @error('foto_kendaraan')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Tahun Mobil --}}
                                    <div class="mb-3">
                                        <label for="tahun_mobil" class="form-label">Tahun Mobil</label>
                                        <input type="text" class="form-control" id="tahun_mobil" name="tahun_mobil"
                                            value="{{ old('tahun_mobil') }}">
                                        <span class="form-text">Contoh : 2013</span>
                                        @error('tahun_mobil')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Bahan Bakar --}}
                                    <div class="mb-3">
                                        <label for="bahan_bakar" class="form-label">Bahan Bakar</label>
                                        <input type="text" class="form-control" id="bahan_bakar" name="bahan_bakar"
                                            value="{{ old('bahan_bakar') }}">
                                        <span class="form-text">Contoh : Solar , Bensin</span>
                                        @error('bahan_bakar')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Harga Sewa --}}
                                    <div class="mb-3">
                                        <label for="harga_sewa" class="form-label">Harga Sewa</label>
                                        <input type="text" class="form-control" id="harga_sewa" name="harga_sewa"
                                            value="{{ old('harga_sewa') }}">
                                        <span class="form-text">Contoh : 30000 | Tanpa Menggunakan Rp atau titik(.) atau
                                            symbol yang lain</span>
                                        @error('harga_sewa')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>

                                {{-- Tabel Brand Kendaraan --}}
                                <div class="mt-3">
                                    <div class="accordion accordion-flush rounded border" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingOne">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                    aria-expanded="false" aria-controls="flush-collapseOne">
                                                    # Tabel Brand Kendaraan
                                                </button>
                                            </h2>
                                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                                aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <td>No</td>
                                                            <td>Nama Brand</td>
                                                            <td>Tahun Mobil</td>
                                                            <td>Bahan Bakar</td>
                                                            <td>Harga Sewa (h)</td>
                                                            <td>Foto Kendaraan</td>
                                                        </tr>
                                                        @foreach ($data as $row)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $row->nama_kendaraan }}</td>
                                                                <td>{{ $row->tahun_mobil }}</td>
                                                                <td>{{ $row->bahan_bakar }}</td>
                                                                <td>{{ $row->harga_sewa }}</td>
                                                                <td><img src="{{ asset($row->foto_kendaraan) }}"
                                                                        alt="Gambar Transportasi" width="480"
                                                                        height="480"
                                                                        style="background-size: contain;background-repeat: no-repeat;">
                                                                </td>


                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
    </div>

    </div>
@endsection
