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
                                        <th>Penyewa</th>
                                        <th>Data Diri</th>
                                        <th>Detail</th>
                                        <th>Tanda Tangan</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach ($data as $row)
                                        <tr>
                                            <td>{{ $row->nama_kendaraan }}</td>
                                            <td>{{ $row->nama_penyewa }}</td>
                                            <td><a href="{{ asset('/transaksi/data_diri/' . $row->id) }}">Lihat
                                                    detail</a>
                                            </td>
                                            <td><a href="{{ asset('/transaksi/detail_transaksi/' . $row->id) }}">Lihat
                                                    Detail</a></td>
                                            @if ($row->foto_ttd == null)
                                                <td><a href="/transaksi-tangan/{{ $row->id }}">Belum</a></td>
                                            @else
                                                <td><a href="/transaksi-tangan/{{ $row->id }}">Sudah</a></td>
                                            @endif
                                            <td><a href="#" class="btn btn-danger">Hapus</a></td>
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
