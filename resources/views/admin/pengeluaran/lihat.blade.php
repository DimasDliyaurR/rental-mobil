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
                            <div class="row justify-content-end">
                                <div class="col-md-2">
                                    <form action="/pengeluaran/filter">
                                        @csrf
                                        <div class="input-group mb-3">
                                            <input type="date" class="form-control" value="{{ old('tanggal') }}"
                                                name="tanggal" id="tanggal">
                                            <button class="btn btn-primary" type="submit"">Filter</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-4">
                                    <form action="/pengeluaran">
                                        @csrf
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Cari pengeluaran..."
                                                value="{{ request('searkamch') }}" name="search">
                                            <button class="btn btn-primary" type="submit"">Search</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            {{-- END FORM SEARCH --}}
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
                            <div class="table-responsive" style="width: 10wv">
                                <table class="table table-striped table-bordered table-hover text-nowrap" style="width: 10w">
                                    <thead>
                                        <tr>
                                            <th class="text-center fs-6 text-uppercase" style="width: 1%">No.</th>
                                            <th class="text-center fs-6 text-uppercase">Pengeluaran</th>
                                            <th class="text-center fs-6 text-uppercase">Deskripsi</th>
                                            <th class="text-center fs-6 text-uppercase">Harga</th>
                                            <th class="text-center fs-6 text-uppercase">Tanggal</th>
                                            <th class="text-center fs-6 text-uppercase">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($data->count())
                                            @foreach ($data as $key => $row)
                                                <tr>
                                                    <td class="text-capitalize text-center"> {{ $data->firstItem() + $key }} </td>
                                                    <td class="text-capitalize text-center">{{ $row->nama_pengeluaran }}</td>
                                                    <td class="text-capitalize text-center">{{ $row->deskripsi_pengeluaran }}
                                                    </td>
                                                    <td class="text-center">Rp.
                                                        {{ number_format($row->harga_pengeluaran, 0, ',', '.') }}</td>
                                                    <td class="text-center">{{ $row->tanggal_pengeluaran }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ asset('/pengeluaran-update/' . $row->id) }}"
                                                            class="btn btn-info me-2">
                                                            <i class="bi bi-pencil-square"></i> Update
                                                        </a>
                                                        <a href="{{ asset('/pengeluaran-hapus/' . $row->id) }}"
                                                            class="btn btn-danger"
                                                            onclick="return confirm('Apakah yakin mengahapus {{ $row->nama_pengeluaran }}')">
                                                            <i class="bi bi-trash3"></i> Hapus
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6" class="text-center">Pengeluaran tidak ada.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
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
