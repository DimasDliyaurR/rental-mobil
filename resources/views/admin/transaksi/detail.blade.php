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
                                <div class="w-screen p-3">
                                    <h5 class="text-secondary">Tanggal Transakski</h5>
                                    <p class="fw-bold mt-3">{{ $data->tanggal_sewa }}</p>
                                </div>

                                <h3 class="text-dark">Data Diri</h3>
                                <hr>

                                <table class="table">
                                    <tr>
                                        <td>Nama Pemesan</td>
                                        <td>{{ $data->nama_penyewa }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Foto Penyewa <br><img src='{{ asset($data->foto_penyewa) }}'
                                                alt="Foto KTP" class="img-fluid img-thumbnail mt-3"
                                                style="object-fit: cover; width: 304px;height: 340px;" </td>
                                    </tr>
                                    <tr>
                                        <td>No telp</td>
                                        <td>{{ $data->no_telp }}</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>{{ $data->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <td>No KTP</td>
                                        <td>{{ $data->no_ktp }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Foto KTP <br><img src='{{ asset($data->foto_ktp) }}'
                                                alt="Foto KTP" class="img-fluid img-thumbnail mt-3"
                                                style="object-fit: cover; width: 540px;height: 304px;" </td>
                                    </tr>
                                    <tr>
                                        <td>No SIM</td>
                                        <td>{{ $data->no_sim }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Foto SIM <br><img src='{{ asset($data->foto_sim) }}'
                                                alt="Foto KTP" class="img-fluid img-thumbnail mt-3"
                                                style="object-fit: cover; width: 540px;height: 304px;" </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Foto SIM <br><img src='{{ asset($data->tanda_tangan) }}'
                                                alt="Foto KTP" class="img-fluid img-thumbnail mt-3"
                                                style="object-fit: cover; width: 540px;height: 304px;" </td>
                                    </tr>
                                </table>

                                <h3 class="text-dark">Data Layanan</h3>
                                <hr>
                                <table class="table">
                                    <tr>
                                        <td>Waktu Pengambilan</td>
                                        <td>{{ $data->waktu_pengambilan }}</td>
                                    </tr>
                                    <tr>
                                        <td>Lokasi Pengambilan</td>
                                        <td>{{ $data->lokasi_pengambilan }}</td>
                                    </tr>
                                    <tr>
                                        <td>Driver</td>
                                        <td>{{ ($data->driver == 1 and $data->driver != null) ? 'Iya' : 'Tidak' }}</td>
                                    </tr>
                                    @if ($data->driver != null)
                                        <tr>
                                            <td>Biaya Supir</td>
                                            <td>{{ ($data->driver == 1 and $data->driver != null) ? 'Rp. ' . number_format($data->biaya_supir, 0, ',', '.') . ',-' : 'Rp. 0 ,-' }}
                                            </td>
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
@endsection
