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
                                <form method="post" action="{{ asset('brand/update') }}" enctype="multipart/form-data">
                                    @csrf

                                    <input type="text" name="id" value="{{ $data->id }}" hidden>

                                    {{-- Nama Kendaraan --}}
                                    <div class="mb-3 mt-4 col-md-6 form-floating">

                                        <input oninput="this.value = this.value.toLowerCase()" type="text"
                                            class="form-control" placeholder="..." id="nama_brand" name="nama_brand"
                                            value="{{ $data->nama_brand }}">
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
                                            value="{{ $data->nama_merek }}">
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
                                        <img src="{{ asset($data->foto_kendaraan) }}" class="img-fluid img-thumbnail"
                                            alt="Foto Kondisi BBM" width="540" height="540"
                                            style="object-fit: contain; width: 250px;height: 175px;">
                                        @error('foto_kendaraan')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Tahun Mobil --}}
                                    <div class="mb-3 col-md-6 form-floating">
                                        <input type="text" class="form-control" placeholder="..." id="tahun_mobil"
                                            name="tahun_mobil" value="{{ $data->tahun_mobil }}">
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
                                            value="{{ $data->bahan_bakar }}">
                                        <label for="bahan_bakar" class="ms-2">Bahan Bakar</label>


                                        <span class="form-text">Contoh : Solar , Bensin</span>
                                        @error('bahan_bakar')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Harga Sewa --}}
                                    <div class="mb-3 col-md-6 form-floating">
                                        <input type="text" class="form-control" placeholder="..." id="harga_sewa"
                                            name="harga_sewa" value="{{ $data->harga_sewa }}">
                                        <label for="harga_sewa" class="ms-2">Harga Sewa</label>

                                        <span class="form-text">Contoh : 30000 | Tanpa Menggunakan Rp atau titik(.) atau
                                            symbol yang lain</span>
                                        @error('harga_sewa')
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
    </div>

    </div>
@endsection
