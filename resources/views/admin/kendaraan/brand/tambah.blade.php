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
                                    <div class="text-lg text-white bg-green p-3 rounded mb-3 col-md-6">
                                        {{ session('success') }}</div>
                                @elseif(session()->has('error'))
                                    <div class="text-lg text-white bg-danger p-3 rounded mb-3 col-md-6">
                                        {{ session('error') }}</div>
                                @endif
                                <form method="post" action="{{ asset('/kendaraan-tambah/tambah-brand') }}"
                                    enctype="multipart/form-data">
                                    @csrf

                                    {{-- Nama Kendaraan --}}
                                    <div class="mb-3 mt-4 col-md-6 form-floating">

                                        <input oninput="this.value = this.value.toLowerCase()" type="text"
                                            class="form-control" placeholder="..." id="nama_brand" name="nama_brand"
                                            value="{{ old('nama_brand') }}">
                                        <label for="nama_kendaraan" class="ms-2">Nama Brand</label>


                                        <span class="form-text">Contoh : Toyota , Honda</span>
                                        @error('nama_brand')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Nama Merek --}}
                                    <div class="mb-3 col-md-6 form-floating">
                                        <input oninput="this.value = this.value.toLowerCase()" type="text"
                                            class="form-control" placeholder="..." id="nama_merek" name="nama_merek"
                                            value="{{ old('nama_merek') }}">
                                        <label for="nama_merek" class="ms-2">Nama Merek</label>


                                        <span class="form-text">Contoh : BRIO SATYA S MT</span>
                                        @error('nama_merek')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Foto Kendaraan --}}
                                    <div class="mb-3 col-md-6">
                                        <label for="foto_kendaraan" class="form-label">Foto Kendaraan</label>
                                        <input type="file" class="form-control form-control-lg" id="foto_kendaraan"
                                            name="foto_kendaraan" multiple>
                                        <span class="form-text">Hanya menerima file dengan exstension pg, jpeg, png, bmp,
                                            gif, svg, atau webp</span>
                                        @error('foto_kendaraan')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Tahun Mobil --}}
                                    <div class="mb-3 col-md-6 form-floating">
                                        <input type="text" class="form-control" placeholder="..." id="tahun_mobil"
                                            name="tahun_mobil" value="{{ old('tahun_mobil') }}">
                                        <label for="tahun_mobil" class="ms-2">Tahun Mobil</label>


                                        <span class="form-text">Contoh : 2013</span>
                                        @error('tahun_mobil')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Bahan Bakar --}}
                                    <div class="mb-3 col-md-6 form-floating">
                                        <input oninput="this.value = this.value.toLowerCase()" type="text"
                                            class="form-control" placeholder="..." id="bahan_bakar" name="bahan_bakar"
                                            value="{{ old('bahan_bakar') }}">
                                        <label for="bahan_bakar" class="ms-2">Bahan Bakar</label>


                                        <span class="form-text">Contoh : Solar , Bensin</span>
                                        @error('bahan_bakar')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Harga Sewa --}}
                                    <div class="mb-3 col-md-6 form-floating">
                                        <input type="text" class="form-control" placeholder="..." id="harga_sewa"
                                            name="harga_sewa" value="{{ old('harga_sewa') }}">
                                        <label for="harga_sewa" class="ms-2">Harga Sewa</label>

                                        <span class="form-text">Contoh : 30000 | Tanpa Menggunakan Rp atau titik(.) atau
                                            symbol yang lain</span>
                                        @error('harga_sewa')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>

                                <a href="{{ asset('history-brand') }}" class="btn btn-info mt-2"><i
                                        class="fa-solid fa-clock-rotate-left"></i> History hapus </a>

                                {{-- Tabel Brand Kendaraan --}}
                                <div class="mt-3">
                                    <div class="accordion accordion-flush rounded border" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingOne">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                    aria-expanded="false" aria-controls="flush-collapseOne">
                                                    <b>Tabel Brand Kendaraan</b>
                                                </button>
                                            </h2>
                                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                                aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <td class="text-center fs-6 text-uppercase fw-bold">No</td>
                                                                <td class="text-center fs-6 text-uppercase fw-bold">Nama
                                                                    Brand
                                                                </td>
                                                                <td class="text-center fs-6 text-uppercase fw-bold">Tahun
                                                                    Mobil
                                                                </td>
                                                                <td class="text-center fs-6 text-uppercase fw-bold">Bahan
                                                                    Bakar
                                                                </td>
                                                                <td class="text-center fs-6 text-uppercase fw-bold">Harga
                                                                    Sewa
                                                                    (h)</td>
                                                                <td class="text-center fs-6 text-uppercase fw-bold">Foto
                                                                    Kendaraan</td>
                                                                <td class="text-center fs-6 text-uppercase fw-bold">Action
                                                                </td>
                                                            </tr>
                                                            @foreach ($data as $row)
                                                                <tr>
                                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                                    <td class="text-center">
                                                                        {{ $row->nama_brand . ' ' . $row->nama_merek }}
                                                                    </td>
                                                                    <td class="text-center">{{ $row->tahun_mobil }}</td>
                                                                    <td class="text-center">{{ $row->bahan_bakar }}</td>
                                                                    <td class="text-center">{{ $row->harga_sewa }}</td>
                                                                    <td class="text-center"><img
                                                                            src="{{ asset($row->foto_kendaraan) }}"
                                                                            alt="Gambar Transportasi" width="120"
                                                                            height="120"
                                                                            style="object-fit: contain;background-repeat: no-repeat;">
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <a href="{{ asset('brand-update/' . $row->id) }}"
                                                                            class="btn btn-info me-2">
                                                                            <i class="bi bi-pencil-square"></i> Update
                                                                        </a>
                                                                        <a href="{{ asset('brand/' . $row->id . '/hapus') }}"
                                                                            class="btn btn-danger"
                                                                            onclick="return confirm('Apakah yakin menghapus {{ $row->nama_brand . ' ' . $row->nama_merek }}')">
                                                                            <i class="bi bi-trash3"></i> Hapus
                                                                        </a>
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

    </div>
@endsection
