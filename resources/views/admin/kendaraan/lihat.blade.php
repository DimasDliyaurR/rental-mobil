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


                                <div class="col">
                                    <a href="{{ asset('history-kendaraan') }}" class="btn btn-info mt-2"><i
                                            class="fa-solid fa-clock-rotate-left"></i> History hapus </a>
                                </div>
                                <div class="col-md-4">
                                    <form action="/kendaraan">
                                        @csrf
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Cari nama kendaraan, plat nomor, tahun kendaraan..."
                                                value="{{ request('search') }}" name="search">
                                            <button class="btn btn-primary" type="submit"">Search</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                            {{-- END FORM SEARCH --}}
                            <div class="overflow-visible" style="width: 10wv">
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
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover text-nowrap" style="width: 10w">
                                        <thead>
                                            <tr>
                                                <th class="text-center fs-6 text-uppercase" style="width: 1%">No.</th>
                                                <th class="text-center fs-6 text-uppercase">Kendaraan</th>
                                                <th class="text-center fs-6 text-uppercase">Merek</th>
                                                <th class="text-center fs-6 text-uppercase">plat</th>
                                                <th class="text-center fs-6 text-uppercase">Tahun Kendaraan</th>
                                                <th class="text-center fs-6 text-uppercase">Bahan Bakar</th>
                                                <th class="text-center fs-6 text-uppercase">Harga Sewa (D)</th>
                                                <th class="text-center fs-6 text-uppercase">Status</th>
                                                <th class="text-center fs-6 text-uppercase">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($data->count())
                                                @foreach ($data as $key => $row)
                                                    <tr>
                                                        <td class="text-capitalize text-center">{{ $data->firstItem() + $key }}</td>
                                                        <td class="text-capitalize text-center">{{ $row->nama_brand }}</td>
                                                        <td class="text-capitalize text-center">{{ $row->nama_merek }}</td>
                                                        <td class="text-uppercase text-center"><span
                                                                id="plat">{{ $row->plat }}</span></td>
                                                        <td class="text-center">{{ $row->tahun_mobil }}</td>
                                                        <td class="text-capitalize text-center">{{ $row->bahan_bakar }}</td>
                                                        <td class="text-center">
                                                            {{ number_format($row->harga_sewa, 0, ',', '.') }}
                                                        </td>
                                                        <td class="text-capitalize text-center">
                                                            {{ $row->status === 'Sudah Terpakai' ? 'Mobil Jalan' : '' }}
                                                            {{ $row->status === 'Tidak Terpakai' ? 'Mobil Belum terpakai' : '' }}
                                                            {{ $row->status === 'booking' ? 'Telah Disewa' : '' }}
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="row">
                                                                <div class="col">
                                                                    @if ($row->status === 'Sudah Terpakai')
                                                                        <a href="{{ asset('kendaraan-kembali/' . $row->id) }}"
                                                                            onclick="return confirm('Apakah Anda yakin ?')"
                                                                            class="btn {{ $row->status === 'Sudah Terpakai' ? 'btn-success' : '' }}">{!! $row->status === 'Sudah Terpakai' ? '<i class="bi bi-p-circle"></i> Update Status' : '' !!}
                                                                        </a>
                                                                    @endif
                                                                </div>
                                                                <div class="col">
                                                                    <a href="{{ asset('kendaraan-update/' . $row->id) }}"
                                                                        class="btn btn-info"><i class="bi bi-pencil-square"></i>
                                                                        Update
                                                                    </a>
                                                                </div>
                                                                <div class="col">
                                                                    <a href="{{ asset('kendaraan/' . $row->id . '/hapus') }}"
                                                                        class="btn btn-danger"
                                                                        onclick="return confirm('Apakah yakin mengahapus {{ $row->plat }}')">
                                                                        <i class="bi bi-trash3"></i> Hapus
                                                                    </a>
                                                                </div>
                                                            </div>


                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="8" class="text-center">Kendaraan tidak ada.</td>
                                                </tr>
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

    </div>
@endsection
