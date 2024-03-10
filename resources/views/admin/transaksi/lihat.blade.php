@extends('layouts-admin.head')

@section('content')
    <div class="content my-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1>{{ $title }}</h1>

                            {{-- FORM SEARCH --}}
                            <div class="row justify-content-between mt-4">
                                <div class="col-md-3">
                                    <form action="/transaksi/filter">
                                        @csrf
                                        <label for="tanggal" class="me-2 align-middle">Cari tanggal sewa : </label>
                                        <div class="input-group mb-3">
                                            <input type="date" class="form-control" value="{{ old('tanggal') }}"
                                                name="tanggal" id="tanggal">
                                            <button class="btn btn-primary" type="submit"">Filter</button>
                                        </div>

                                    </form>
                                </div>

                                <div class="col-md-5">
                                    <form action="/transaksi">
                                        @csrf
                                        <label for="search" class="me-2 align-middle"
                                            style="color: rgba(1, 1, 1, 0)">cari</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control"
                                                placeholder="Cari nama penyewa, kendaraan, plat kendaraan..."
                                                value="{{ request('search') }}" name="search" id="search">
                                            <button class="btn btn-primary" type="submit"">Cari</button>
                                        </div>
                                    </form>
                                </div>


                            </div>
                            {{-- END FORM SEARCH --}}
                            <div class="overflow-visible">
                                @if (session()->has('success'))
                                    <div class="alert alert-success alert-dismissible fade show " role="alert">
                                        {{ session('success') }}!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @elseif(session()->has('error'))
                                    <div class="alert alert-danger alert-dismissible fade show " role="alert">
                                        {{ session('error') }}!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                @if (auth()->user()->level == 'owner')
                                    <div class="col-md-4 mt-2 mb-4">
                                        <a href="{{ asset('transaksi-hapus') }}" class="btn btn-danger"
                                            data-confirm-delete="true">Hapus Foto
                                            Transaksi</a>
                                    </div>
                                @endif

                                <div class="table-responsive">
                                    {{-- <table class="table table-bordered mt-3 dataTable dtr-inline collapsed" id="example1"
                                        style="width: 10w">
                                        <tr>
                                            <th class="text-center fs-6 text-uppercase">No.</th>
                                            <th class="text-center fs-6 text-uppercase">Penyewa</th>
                                            <th class="text-center fs-6 text-uppercase">Nama Kendaraan</th>
                                            <th class="text-center fs-6 text-uppercase">Plat Kendaraan</th>
                                            <th class="text-center fs-6 text-uppercase">Detail</th>
                                            <th class="text-center fs-6 text-uppercase">Tanggal Sewa</th>
                                            <th class="text-center fs-6 text-uppercase">Invoice</th>
                                            <th class="text-center fs-6 text-uppercase">Action</th>
                                            <th class="text-center fs-6 text-uppercase"><i class="fa fa-sort-amount-asc"
                                                    aria-hidden="true"></i></th>
                                        </tr>
                                        @if ($data->count())
                                            @foreach ($data as $key => $row)
                                                <tr>
                                                    <td class="text-capitalize text-center">{{ $data->firstItem() + $key }}
                                                    </td>
                                                    <td class="text-capitalize text-center">{{ $row->nama_penyewa }}</td>
                                                    <td class="text-capitalize text-center">
                                                        {{ $row->nama_merek . ' ' . $row->nama_brand }}</td>
                                                    <td class="text-uppercase text-center">{{ $row->plat }}</td>

                                                    <td class="text-center"><a
                                                            href="{{ asset('/transaksi/detail_transaksi/' . $row->id) }}">Lihat
                                                            Detail</a></td>
                                                    <td class="text-center">
                                                        {{ date('d-m-Y', strtotime($row->tanggal_sewa)) . ' ' . date('h:i:s', strtotime($row->waktu_kembali)) }}
                                                    </td>
                                                    <td class="text-center">
                                                        <a target="blank"
                                                            href="{{ asset('transaksi/invoice/' . $row->id) }}"
                                                            class="btn btn-success">
                                                            <i class="bi bi-receipt"></i> Invoice
                                                        </a>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ asset('/transaksi/update/' . $row->id) }}"
                                                            class="btn btn-info me-2">
                                                            <i class="bi bi-pencil-square"></i> Update
                                                        </a>
                                                        <a href="{{ asset('transaksi/delete/' . $row->id) }}"
                                                            class="btn btn-danger"
                                                            onclick="return confirm('Apakah yakin mengahapus {{ $row->nama_penyewa }}')">
                                                            <i class="bi bi-trash3"></i> Hapus
                                                        </a>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="7" class="text-center">Transaksi tidak ada.</td>
                                            </tr>
                                        @endif
                                    </table> --}}

                                    <table id="example2"
                                        class="table table-striped table-bordered table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th class="text-center fs-6 text-uppercase">No.</th>
                                                <th class="text-center fs-6 text-uppercase">Penyewa</th>
                                                <th class="text-center fs-6 text-uppercase">Nama Kendaraan</th>
                                                <th class="text-center fs-6 text-uppercase">Plat Kendaraan</th>
                                                <th class="text-center fs-6 text-uppercase">Detail</th>
                                                <th class="text-center fs-6 text-uppercase">Tanggal Sewa</th>
                                                <th class="text-center fs-6 text-uppercase">Invoice</th>
                                                <th class="text-center fs-6 text-uppercase">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($data->count())
                                                @foreach ($data as $key => $row)
                                                    <tr>
                                                        <td class="text-capitalize text-center">
                                                            {{ $data->firstItem() + $key }}
                                                        </td>
                                                        <td class="text-capitalize text-center">{{ $row->nama_penyewa }}
                                                        </td>
                                                        <td class="text-capitalize text-center">
                                                            {{ $row->nama_merek . ' ' . $row->nama_brand }}</td>
                                                        <td class="text-uppercase text-center">{{ $row->plat }}</td>

                                                        <td class="text-center"><a
                                                                href="{{ asset('/transaksi/detail_transaksi/' . $row->id) }}">Lihat
                                                                Detail</a></td>
                                                        <td class="text-center">
                                                            {{ date('d-m-Y', strtotime($row->tanggal_sewa)) . ' ' . date('h:i:s', strtotime($row->waktu_kembali)) }}
                                                        </td>
                                                        <td class="text-center">
                                                            <a target="blank"
                                                                href="{{ asset('transaksi/invoice/' . $row->id) }}"
                                                                class="btn btn-success">
                                                                <i class="bi bi-receipt"></i> Invoice
                                                            </a>
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="{{ asset('/transaksi/update/' . $row->id) }}"
                                                                class="btn btn-info me-2">
                                                                <i class="bi bi-pencil-square"></i> Update
                                                            </a>

                                                            <a href="{{ asset('transaksi/delete/' . $row->id) }}"
                                                                class="btn btn-danger" data-confirm-delete="true">
                                                                <i class="bi bi-trash3"></i> Hapus
                                                            </a>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @else
                                                <td colspan="8" class="text-center">Data Tidak Ada</td>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div>
                                Showing
                                @if ($data->count())
                                    {{ $data->firstItem() }}
                                @else
                                    0
                                @endif
                                to
                                @if ($data->count())
                                    {{ $data->lastItem() }}
                                @else
                                    0
                                @endif
                                of
                                {{ $data->total() }} datas
                            </div>
                            <div class="d-flex justify-content-end">
                                {{ $data->links() }}
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
        @include('sweetalert::alert')
    </div>
@endsection
