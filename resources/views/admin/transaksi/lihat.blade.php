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
                                        <th>Sub-Total</th>
                                        <th>Detail</th>
                                    </tr>
                                    @foreach ($data as $row)
                                        <tr>
                                            <td>{{ $row->nama_kendaraan }}</td>
                                            <td>{{ $row->nama_penyewa }}</td>
                                            <td><a href="{{ asset('/transaksi/data_diri/' . $row->transaksi_id) }}">Lihat
                                                    detail</a>
                                            </td>
                                            <td>{{ $row->sub_total }}</td>
                                            <td><a href="{{ asset('/transaksi/detail_transaksi/' . $row->transaksi_id) }}">Lihat
                                                    Detail</a></td>
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
