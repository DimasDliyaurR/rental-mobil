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
                                <table class="table table-bordered">
                                    <tr>
                                        <th></th>
                                        <th colspan="2" class="text-center">Saldo</th>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <th class="text-center">Debet</th>
                                        <th class="text-center">Kredit</th>
                                    </tr>
                                    <tr>
                                        <th>Debit</th>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    @foreach ($pengeluaran as $row)
                                        <tr>
                                            <td>{{ $row->nama_pengeluaran }}</td>
                                            <td>Rp. {{ number_format($row->harga_pengeluaran, 0, ',', '.') }},-</td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th>Kredit</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    @foreach ($transaksi as $row)
                                        <tr>
                                            <td>Transaksi</td>
                                            <td></td>
                                            <td>Rp. {{ number_format($row->jumlah_transaksi, 0, ',', '.') }},-</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th>Total</th>
                                        <th>Rp. {{ number_format($total_pengeluaran->total_pengeluaran, 0, ',', '.') }},-
                                        </th>
                                        <th>Rp. {{ number_format($total_transaksi->total_transaksi, 0, ',', '.') }},-
                                    </tr>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection
