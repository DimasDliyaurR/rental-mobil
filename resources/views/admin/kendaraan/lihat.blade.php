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
                                <table class="table table-bordered" style="width: 10w">
                                    <tr>
                                        <th>Kendaraan</th>
                                        <th>plat</th>
                                        <th>Tersedia</th>
                                        <th>Tahun Kendaraan</th>
                                        <th>Bahan Bakar</th>
                                        <th>Harga Sewa (D)</th>
                                        <th>Foto Mobil</th>
                                    </tr>
                                    @foreach ($data as $row)
                                        <tr>
                                            <td>{{ $row->nama_kendaraan }}</td>
                                            <td>{{ $row->plat }}</td>
                                            <td>{{ $row->unit_available }}</td>
                                            <td>{{ $row->tahun_mobil }}</td>
                                            <td>{{ $row->bahan_bakar }}</td>
                                            <td>{{ $row->harga_sewa }}</td>
                                            <td><img src="{{ asset($row->foto_mobil) }}" alt="Foto Mobil"></td>
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
