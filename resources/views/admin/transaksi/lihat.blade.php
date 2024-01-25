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
                                        <th>Nama Brand</th>
                                        <th>Nama Merek</th>
                                        <th>Penyewa</th>
                                        <th>Data Diri</th>
                                        <th>Detail</th>
                                        <th>Tanda Tangan</th>
                                        <th>Action</th>
                                        <th>Invoice</th>
                                    </tr>
                                    @foreach ($data as $row)
                                        <tr>
                                            <td>{{ $row->nama_brand }}</td>
                                            <td>{{ $row->nama_merek }}</td>
                                            <td>{{ $row->nama_penyewa }}</td>
                                            <td><a href="{{ asset('/transaksi/data_diri/' . $row->id) }}">Lihat
                                                    detail</a>
                                            </td>
                                            <td><a href="{{ asset('/transaksi/detail_transaksi/' . $row->id) }}">Lihat
                                                    Detail</a></td>
                                            <td><img src="{{ asset($row->tanda_tangan) }}" alt="Foto Tanda Tangan"></td>
                                            <td><a href="#" class="btn btn-danger mx-3">Hapus</a><a
                                                    href="{{ asset($row->id) }}" class="btn btn-info">update</a></td>
                                            <td><a href="{{ asset('transaksi/invoice/' . $row->id) }}"
                                                    class="btn btn-info">Invoice</a></td>
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
