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
                                    <div class="bg-green rounded p-2">
                                        {{ session('success') }}
                                    </div>
                                @elseif(session()->has('error'))
                                    <div class="bg-danger rounded p-2">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <table class="table table-bordered" style="width: 10w">
                                    <tr>
                                        <th>Penyewa</th>
                                        <th>Nama Kendaraan</th>
                                        <th>Plat Kendaraan</th>
                                        <th>Detail</th>
                                        <th>Tanggal Sewa</th>
                                        <th>Action</th>
                                        <th>Invoice</th>
                                    </tr>
                                    @foreach ($data as $row)
                                        <tr>
                                            <td>{{ $row->nama_penyewa }}</td>
                                            <td>{{ $row->nama_merek . ' ' . $row->nama_brand }}</td>
                                            <td>{{ $row->plat }}</td>

                                            <td><a href="{{ asset('/transaksi/detail_transaksi/' . $row->id) }}">Lihat
                                                    Detail</a></td>
                                            <td>{{ date('d-m-Y', strtotime($row->tanggal_sewa)) . ' ' . date('h:i:s', strtotime($row->waktu_kembali)) }}
                                            </td>
                                            <td><a href="{{ asset('transaksi/delete/' . $row->id) }}"
                                                    class="btn btn-danger">Hapus</a><a
                                                    href="{{ asset('/transaksi/update/' . $row->id) }}"
                                                    class="btn btn-info">update</a></td>
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
