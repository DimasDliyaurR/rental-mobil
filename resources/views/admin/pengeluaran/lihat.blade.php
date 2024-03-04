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
                                <div class="bg-green rounded p-2">
                                    {{ session('success') }}
                                </div>
                            @elseif(session()->has('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <div class="table-responsive" style="width: 10wv">
                                <table class="table table-bordered table-hover text-nowrap" style="width: 10w">
                                    <tr>
                                        <th class="text-center fs-6 text-uppercase" style="width: 1%">No.</th>
                                        <th class="text-center fs-6 text-uppercase">Pengeluaran</th>
                                        <th class="text-center fs-6 text-uppercase">Deskripsi</th>
                                        <th class="text-center fs-6 text-uppercase">Harga</th>
                                        <th class="text-center fs-6 text-uppercase">Tanggal</th>
                                        <th class="text-center fs-6 text-uppercase">Action</th>
                                    </tr>
                                    @if ($data->count())
                                        @foreach ($data as $row)
                                            <tr>
                                                <td class="text-capitalize text-center">{{ $loop->iteration }}</td>
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
                                </table>
                            </div>
                            <div class="d-flex justify-content-center">
                                {{ $data->links() }}
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection
