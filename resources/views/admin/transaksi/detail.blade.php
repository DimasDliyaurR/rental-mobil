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
                                <hr>
                                <div class="col-md-6 p-3">
                                    <h5 class="text-secondary">Tanggal Transakski</h5>
                                    <p class="fw-bold mt-3">{{ $data->tanggal_sewa }}</p>
                                </div>

                                <h3 class="text-dark fw-bold fs-2">Data Diri</h3>
                                <hr>

                                <table class="table">
                                    <tr>
                                        <td class="fw-bold">Nama Klien</td>
                                        <td class="text-capitalize">{{ $data->nama_penyewa }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="fw-bold">Foto Klien <br><img src='{{ asset($data->foto_penyewa) }}'
                                                alt="Foto KTP" class="img-fluid img-thumbnail mt-3"
                                                style="object-fit: cover; width: 304px;height: 340px;" </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">No telp</td>
                                        <td>{{ $data->no_telp }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Alamat</td>
                                        <td class="text-capitalize">{{ $data->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">No KTP</td>
                                        <td>{{ $data->no_ktp }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">No SIM</td>
                                        <td>{{ $data->no_sim }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="fw-bold">Foto KTP <br><img src='{{ asset($data->foto_ktp) }}'
                                                alt="Foto KTP" class="img-fluid img-thumbnail mt-3"
                                                style="object-fit: contain; width: 350px;height: 200px;" </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2" class="fw-bold">Foto SIM <br><img src='{{ asset($data->foto_sim) }}'
                                                alt="Foto KTP" class="img-fluid img-thumbnail mt-3"
                                                style="object-fit: contain; width: 350px;height: 200px;" </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="fw-bold">Tanda tangan <br><img src='{{ asset($data->tanda_tangan) }}'
                                                alt="Foto KTP" class="img-fluid img-thumbnail mt-3"
                                                style="object-fit: contain; width: 350px;height: 200px;" </td>
                                    </tr>
                                </table>

                                <h3 class="text-dark fs-2 fw-bold mt-5">Data Layanan</h3>
                                <hr>
                                <table class="table">
                                    <tr>
                                        <td class="fw-bold">Waktu Pengambilan</td>
                                        <td>{{ date('d-m-Y', strtotime($data->waktu_pengambilan)) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Lokasi Pengambilan</td>
                                        <td class="text-capitalize">{{ $data->lokasi_pengambilan }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Driver</td>
                                        <td>{{ ($data->driver == 1 and $data->driver != null) ? 'Iya' : 'Tidak' }}</td>
                                    </tr>
                                    @if ($data->driver != null)
                                        <tr>
                                            <td class="fw-bold">Biaya Driver</td>
                                            <td>{{ ($data->driver == 1 and $data->driver != null) ? 'Rp. ' . number_format($data->biaya_supir, 0, ',', '.') . ',-' : 'Rp. 0 ,-' }}
                                            </td>
                                        </tr>
                                    @endif
                                </table>

                                <h3 class="text-dark fs-2 fw-bold mt-5">Kondisi Mobil</h3>
                                <hr>
                                <table class="table">
                                    @foreach ($kondisi_mobil as $row)
                                        <tr>
                                            <th>{{ $loop->iteration }}</th>
                                            <td><img src="{{ asset($row->foto_mobil) }}" alt="Foto Kondisi Mobil"
                                                    class="img-fluid img-thumbnail mt-3"
                                                    style="object-fit: cover; width: 540px;height: 304px;"></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Keterangan</td>
                                            <td class="text-center text-capitalize">{{ $row->keterangan }}</td>
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
