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
                                    <div class="alert alert-success alert-dismissible fade show col-md-6" role="alert">
                                        {{ session('success') }}!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @elseif(session()->has('error'))
                                    <div class="alert alert-danger alert-dismissible fade show col-md-6" role="alert">
                                        {{ session('error') }}!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <form method="post" action="{{ asset('/kendaraan-tambah/tambah-brand') }}"
                                    enctype="multipart/form-data">
                                    @csrf

                                    {{-- Nama Kendaraan --}}
                                    <div class="mb-3 mt-4 col-md-6 form-floating">

                                        <input oninput="this.value = this.value.toLowerCase()" type="text"
                                            class="form-control @error('nama_brand') is-invalid @enderror" placeholder="..."
                                            id="nama_brand" name="nama_brand" value="{{ old('nama_brand') }}">
                                        <label for="nama_kendaraan" class="ms-2">Nama Brand</label>


                                        <span class="form-text">Contoh : Toyota , Honda</span>
                                        @error('nama_brand')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Nama Merek --}}
                                    <div class="mb-3 col-md-6 form-floating">
                                        <input oninput="this.value = this.value.toLowerCase()" type="text"
                                            class="form-control @error('nama_merek') is-invalid @enderror" placeholder="..."
                                            id="nama_merek" name="nama_merek" value="{{ old('nama_merek') }}">
                                        <label for="nama_merek" class="ms-2">Nama Merek</label>


                                        <span class="form-text">Contoh : BRIO SATYA S MT</span>
                                        @error('nama_merek')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Foto Kendaraan --}}
                                    <div class="mb-3 col-md-6">
                                        <label for="foto_kendaraan" class="form-label">Foto Kendaraan</label>
                                        <input type="file"
                                            class="form-control form-control-lg @error('foto_kendaraan') is-invalid @enderror"
                                            id="foto_kendaraan" name="foto_kendaraan" multiple>
                                        <span class="form-text">Hanya menerima file dengan exstension pg, jpeg, png, bmp,
                                            gif, svg, atau webp</span>
                                        @error('foto_kendaraan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Tahun Mobil --}}
                                    <div class="mb-3 col-md-6 form-floating">
                                        <input type="text"
                                            class="form-control @error('tahun_mobil') is-invalid @enderror"
                                            placeholder="..." id="tahun_mobil" name="tahun_mobil"
                                            value="{{ old('tahun_mobil') }}">
                                        <label for="tahun_mobil" class="ms-2">Tahun Mobil</label>


                                        <span class="form-text">Contoh : 2013</span>
                                        @error('tahun_mobil')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Bahan Bakar --}}
                                    <div class="mb-3 col-md-6 form-floating">
                                        <input oninput="this.value = this.value.toLowerCase()" type="text"
                                            class="form-control @error('bahan_bakar') is-invalid @enderror"
                                            placeholder="..." id="bahan_bakar" name="bahan_bakar"
                                            value="{{ old('bahan_bakar') }}">
                                        <label for="bahan_bakar" class="ms-2">Bahan Bakar</label>


                                        <span class="form-text">Contoh : Solar , Bensin</span>
                                        @error('bahan_bakar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Harga Sewa --}}
                                    <div class="mb-3 col-md-6 form-floating">
                                        <input type="text" class="form-control @error('harga_sewa') is-invalid @enderror"
                                            placeholder="..." id="harga_sewa" name="harga_sewa"
                                            value="{{ old('harga_sewa') }}">
                                        <label for="harga_sewa" class="ms-2">Harga Sewa</label>

                                        <span class="form-text">Contoh : 30000 | Tanpa Menggunakan Rp atau titik(.) atau
                                            symbol yang lain</span>
                                        @error('harga_sewa')
                                            <div class="invalid-feedback">{{ $message }}</div>
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
                                                aria-labelledby="flush-headingOne"
                                                data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <div class="table-responsive">
                                                        <table
                                                            class="table table-striped table-bordered table-hover text-nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <td class="text-center fs-6 text-uppercase fw-bold">No
                                                                    </td>
                                                                    <td class="text-center fs-6 text-uppercase fw-bold">
                                                                        Nama
                                                                        Brand
                                                                    </td>
                                                                    <td class="text-center fs-6 text-uppercase fw-bold">
                                                                        Tahun
                                                                        Mobil
                                                                    </td>
                                                                    <td class="text-center fs-6 text-uppercase fw-bold">
                                                                        Bahan
                                                                        Bakar
                                                                    </td>
                                                                    <td class="text-center fs-6 text-uppercase fw-bold">
                                                                        Harga
                                                                        Sewa
                                                                        (h)</td>
                                                                    <td class="text-center fs-6 text-uppercase fw-bold">
                                                                        Foto
                                                                        Kendaraan</td>
                                                                    <td class="text-center fs-6 text-uppercase fw-bold">
                                                                        Action
                                                                    </td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($data as $key => $row)
                                                                    <tr>
                                                                        <td class="text-center text-capitalize">
                                                                            {{ $data->firstItem() + $key }}</td>
                                                                        <td class="text-center text-capitalize">
                                                                            {{ $row->nama_brand . ' ' . $row->nama_merek }}
                                                                        </td>
                                                                        <td class="text-center text-capitalize">
                                                                            {{ $row->tahun_mobil }}</td>
                                                                        <td class="text-center text-capitalize">
                                                                            {{ $row->bahan_bakar }}</td>
                                                                        <td class="text-center text-capitalize">
                                                                            {{ $row->harga_sewa }}</td>
                                                                        <td class="text-center text-capitalize"><img
                                                                                src="{{ asset($row->foto_kendaraan) }}"
                                                                                alt="Gambar Transportasi" width="300"
                                                                                height="200"
                                                                                style="object-fit: contain;background-repeat: no-repeat;">
                                                                        </td>
                                                                        <td class="text-center text-capitalize">
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
                                                            </tbody>
                                                        </table>
                                                        <div>
                                                            Showing
                                                            @if ($data->count())
                                                                {{ $data->firstItem() }}
                                                            @else
                                                                0
                                                            @endif
                                                            to
                                                            @if ($data->count())
                                                                {{ $data->lastItem() }}
                                                            @else
                                                                0
                                                            @endif
                                                            of
                                                            {{ $data->total() }} datas
                                                        </div>
                                                        <div class="d-flex justify-content-end">
                                                            {{ $data->links() }}
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
    @include('sweetalert::alert')
    </div>
@endsection
