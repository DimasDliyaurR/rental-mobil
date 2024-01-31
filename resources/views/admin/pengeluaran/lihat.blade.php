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
                                        <th>Pengeluaran</th>
                                        <th>Deskripsi</th>
                                        <th>Harga</th>
                                        <th>Tanggal</th>
                                    </tr>
                                    @foreach ($data as $row)
                                        <tr>
                                            <td>{{ $row->nama_pengeluaran }}</td>
                                            <td>{{ $row->deskripsi_pengeluaran }}</td>
                                            <td>{{ $row->harga_pengeluaran }}</td>
                                            <td>{{ $row->tanggal_pengeluaran }}</td>
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
