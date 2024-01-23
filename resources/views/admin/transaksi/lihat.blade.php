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
                                <form method="GET" action="">
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">
                                            Cari Data :
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="text" name="cari" id="cari" class="form-control" placeholder="Cari Data" autofocus value="{{ $cari }}">
                                        </div>
                                    </div>
                                </form>
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
                                            <td><img src="{{ asset($row->tanda_tangan) }}" alt="Foto Tanda Tangan" style="width: 10rem;height:5rem;object-fit:contain;"></td>
                                            <td><a href="#" class="btn btn-danger mx-3">Hapus</a><a
                                                    href="{{ asset($row->id) }}" class="btn btn-info">update</a></td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-3">

                            {{ $data->links() }}
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection
