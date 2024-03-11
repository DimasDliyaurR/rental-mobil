@extends('layouts-admin.head')

@section('content')
    <div class="content my-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1>{{ $title }}</h1>
                            {{-- END FORM SEARCH --}}
                            <div class="overflow-visible" style="width: 10wv">
                                @if (session()->has('success'))
                                    <div class="text-lg text-white bg-green p-3 rounded mb-3">{{ session('success') }}</div>
                                @elseif(session()->has('error'))
                                    <div class="text-lg text-white bg-danger p-3 rounded mb-3">{{ session('error') }}</div>
                                @endif
                                <div class="table-responsive">
                                    <table class="table table-bordered" style="width: 10w">
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
                                        @if ($data->count())
                                            @foreach ($data as $row)
                                                <tr>
                                                    <td class="text-capitalize text-center">{{ $loop->iteration }}</td>
                                                    <td class="text-capitalize text-center">
                                                        {{ $row->brand_kendaraan->nama_brand }}</td>
                                                    <td class="text-capitalize text-center">
                                                        {{ $row->brand_kendaraan->nama_merek }}</td>
                                                    <td class="text-uppercase text-center"><span
                                                            id="plat">{{ $row->plat }}</span></td>
                                                    <td class="text-center">{{ $row->brand_kendaraan->tahun_mobil }}</td>
                                                    <td class="text-capitalize text-center">
                                                        {{ $row->brand_kendaraan->bahan_bakar }}</td>
                                                    <td class="text-center">
                                                        {{ number_format($row->brand_kendaraan->harga_sewa, 0, ',', '.') }}
                                                    </td>
                                                    <td class="text-capitalize text-center">
                                                        {{ $row->status === 'Sudah Terpakai' ? 'Mobil Jalan' : 'Mobil Kembali' }}
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="row">
                                                            <div class="col">
                                                                @if ($row->status === 'Sudah Terpakai')
                                                                    <a href="{{ asset('kendaraan/' . $row->id) }}"
                                                                        class="btn {{ $row->status === 'Sudah Terpakai' ? 'btn-success' : '' }}">{!! $row->status === 'Sudah Terpakai' ? '<i class="bi bi-p-circle"></i> Update Status' : '' !!}
                                                                    </a>
                                                                @endif
                                                            </div>
                                                            <div class="col">
                                                                <a href="{{ asset('history-kendaraan/restore/' . $row->id) }}"
                                                                    class="btn btn-info me-2">
                                                                    <i class="bi bi-pencil-square"></i> Restore
                                                                </a>


                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="9" class="text-center">History tidak ada.</td>
                                            </tr>
                                        @endif

                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection
