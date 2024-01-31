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
                                <table class="table table-bordered" style="width: 10w">
                                    <tr>
                                        <th>Kendaraan</th>
                                        <th>Merek</th>
                                        <th>plat</th>
                                        <th>Tahun Kendaraan</th>
                                        <th>Bahan Bakar</th>
                                        <th>Harga Sewa (D)</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach ($data as $row)
                                        <tr>
                                            <td>{{ $row->nama_brand }}</td>
                                            <td>{{ $row->nama_merek }}</td>
                                            <td>{{ $row->plat }}</td>
                                            <td>{{ $row->tahun_mobil }}</td>
                                            <td>{{ $row->bahan_bakar }}</td>
                                            <td>{{ $row->harga_sewa }}</td>
                                            <td>{{ $row->status }}</td>
                                            <td><a href="{{ asset('kendaraan/' . $row->id) }}"
                                                    class="btn {{ $row->status === 'Sudah Terpakai' ? 'btn-primary' : '' }}">{{ $row->status === 'Sudah Terpakai' ? 'Ubah' : '' }}</a>
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
@endsection
