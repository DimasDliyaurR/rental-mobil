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

                                {{-- Tabel Brand Kendaraan --}}
                                <table class="table table-bordered">
                                    <tr>
                                        <td class="text-center fs-6 text-uppercase fw-bold">No</td>
                                        <td class="text-center fs-6 text-uppercase fw-bold">Nama Brand
                                        </td>
                                        <td class="text-center fs-6 text-uppercase fw-bold">Tahun Mobil
                                        </td>
                                        <td class="text-center fs-6 text-uppercase fw-bold">Bahan Bakar
                                        </td>
                                        <td class="text-center fs-6 text-uppercase fw-bold">Harga Sewa
                                            (h)</td>
                                        <td class="text-center fs-6 text-uppercase fw-bold">Foto
                                            Kendaraan</td>
                                        <td class="text-center fs-6 text-uppercase fw-bold">Action</td>
                                    </tr>
                                    @if ($data->count())
                                        @foreach ($data as $row)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">
                                                    {{ $row->nama_brand . ' ' . $row->nama_merek }}</td>
                                                <td class="text-center">{{ $row->tahun_mobil }}</td>
                                                <td class="text-center">{{ $row->bahan_bakar }}</td>
                                                <td class="text-center">{{ $row->harga_sewa }}</td>
                                                <td class="text-center"><img src="{{ asset($row->foto_kendaraan) }}"
                                                        alt="Gambar Transportasi" width="480" height="480"
                                                        style="object-fit: contain;background-repeat: no-repeat;">
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ asset('history-brand/restore/' . $row->id) }}"
                                                        class="btn btn-info me-2">
                                                        <i class="bi bi-pencil-square"></i> Restore
                                                    </a>
                                                </td>


                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak ada history.</td>
                                        </tr>
                                    @endif
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
@endsection
