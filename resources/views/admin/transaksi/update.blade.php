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
                                @if (session()->has('success'))
                                    <div class="alert alert-success alert-dismissible fade show col-md-6" role="alert">
                                        {{ session('success') }}! <a href="/transaksi" class="alert-link text-white">Lihat
                                            daftar transaksi</a>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @elseif(session()->has('error'))
                                    <div class="alert alert-danger alert-dismissible fade show col-md-6" role="alert">
                                        {{ session('error') }}!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <form action="{{ asset('/transaksi/update') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <input type="text" name="id" value="{{ $data->id }}" hidden>


                                    {{-- DATA PENYEWA --}}
                                    <div class="data-penyewa mt-5 border-bottom">
                                        <h4 class="mb-3"><b>DATA KLIEN</b></h4>

                                        {{-- Foto Penyewa --}}
                                        <div class="mb-3">
                                            <div class="col-md-6">
                                                <label for="foto_penyewa" class="form-label">Foto Klien</label>
                                                <input type="file" id="formFileLg" name="foto_penyewa"
                                                    class="form-control form-control-lg @error('foto_penyewa') is-invalid @enderror"
                                                    multiple>
                                                <img src="{{ asset($data->foto_penyewa) }}"
                                                    class="img-fluid img-thumbnail mt-2" alt="Foto Penyewa"
                                                    style="object-fit: cover; width: 200px;height: 300px;">
                                                @error('foto_penyewa')
                                                    <span class="invalid-feedback">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- Nama Penyewa --}}
                                        <div class="mb-3">
                                            <div class="form-floating col-md-6">
                                                <input oninput="this.value = this.value.toLowerCase()" type="text"
                                                    name="nama_penyewa"
                                                    class="form-control text-capitalize @error('nama_penyewa') is-invalid @enderror"
                                                    value="{{ $data->nama_penyewa }}" placeholder="...">
                                                <label for="nama_penyewa" class="ms-2">Nama Penyewa</label>
                                                @error('nama_penyewa')
                                                    <span class="invalid-feedback">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- No Telp --}}
                                        <div class="mb-3">
                                            <div class="form-floating col-md-6">
                                                <input type="text" id="no_telp" name="no_telp"
                                                    class="form-control text-capitalize @error('no_telp') is-invalid @enderror"
                                                    value="{{ $data->no_telp }}" placeholder="...">
                                                <label for="no_telp" class="ms-2">Nomor Telepon</label>

                                                @error('no_telp')
                                                    <span class="invalid-feedback">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Alamat --}}
                                        <div class="mb-3">
                                            <div class="form-floating col-md-6">
                                                <input oninput="this.value = this.value.toLowerCase()" type="text"
                                                    id="alamat" name="alamat"
                                                    class="form-control text-capitalize @error('alamat') is-invalid @enderror"
                                                    value="{{ $data->alamat }}" placeholder="...">
                                                <label for="alamat" class="ms-2">Alamat Klien</label>
                                                @error('alamat')
                                                    <span class="invalid-feedback">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- No KTP --}}
                                        <div class="mb-3">
                                            <div class="form-floating col-md-6">
                                                <input type="text" id="no_ktp" name="no_ktp"
                                                    class="form-control text-capitalize @error('no_ktp') is-invalid @enderror"
                                                    value="{{ $data->no_ktp }}" placeholder="...">
                                                <label for="no_ktp" class="ms-2">Nomor KTP</label>
                                                @error('no_ktp')
                                                    <span class="invalid-feedback">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- No SIM --}}
                                        <div class="mb-3">
                                            <div class="form-floating col-md-6">
                                                <input type="text" id="no_sim" name="no_sim"
                                                    class="form-control text-capitalize @error('no_sim') is-invalid @enderror"
                                                    value="{{ $data->no_sim }}" placeholder="...">
                                                <label for="no_sim" class="ms-2">Nomor SIM</label>
                                                @error('no_sim')
                                                    <span class="invalid-feedback">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Foto KTP --}}
                                        <div class="mb-3 row">
                                            <div class="mb-3 col-lg-3">
                                                <label for="foto_ktp" class="form-label">Foto KTP</label>
                                                <input type="file" id="foto_ktp" name="foto_ktp"
                                                    value="{{ $data->foto_ktp }}"
                                                    class="form-control @error('foto_ktp') is-invalid @enderror" multiple>
                                                <img src="{{ asset($data->foto_ktp) }}"
                                                    class="img-fluid img-thumbnail mt-3" alt="Foto KTP"
                                                    style="object-fit: contain; width: 250px;height: 175px;">
                                                @error('foto_ktp')
                                                    <span class="invalid-feedback">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            {{-- SIM --}}
                                            <div class="mb-3 col-lg-3">
                                                <label for="foto_sim" class="form-label">Foto SIM</label>
                                                <input type="file" id="foto_sim" name="foto_sim"
                                                    value="{{ $data->foto_sim }}"
                                                    class="form-control @error('foto_sim') is-invalid @enderror" multiple>
                                                <img src="{{ asset($data->foto_sim) }}"
                                                    class="img-fluid img-thumbnail mt-3" alt="Foto SIM" width="540"
                                                    height="540"
                                                    style="object-fit: contain; width: 250px;height: 175px;">
                                                @error('foto_sim')
                                                    <span class="invalid-feedback">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    {{-- END DATA PENYEWA --}}




                                    {{-- DATA KENDARAAN DISEWA --}}
                                    <div class="data-kendaraan-disewa border-bottom pb-3 mt-4">
                                        <h4 class="mb-3 mt-4"><b>KENDARAAN YANG DISEWA</b></h4>

                                        {{-- Kendaraan --}}
                                        <div class="mb-3">
                                            <div class="col-md-6">
                                                <label for="kendaraan" class="form-label">Daftar Kendaraan</label>
                                                <select
                                                    class="form-select form-select-lg @error('kendaraan') is-invalid @enderror"
                                                    aria-label="Default select example" id="kendaraan" name="kendaraan">
                                                    <option value='{{ $data->kendaraan_id }}' selected hidden>
                                                        {{ $kendaraan->brand_kendaraan->nama_brand }}
                                                        {{ $kendaraan->brand_kendaraan->nama_merek }} ||
                                                        {{ $kendaraan->plat }}
                                                    </option>
                                                    @foreach ($kendaraan_field as $row)
                                                        <option value="{{ $row->id }}"
                                                            {{ $data->kendaraan_id == $row->id ? 'selected' : '' }}>
                                                            {{ $row->nama_brand . ' ' . $row->nama_merek }} ||
                                                            {{ $row->plat }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                @error('kendaraan')
                                                    <span class="invalid-feedback">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Foto BBM --}}
                                        <div class="mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label" for="foto_bbm">
                                                    Foto BBM
                                                </label>
                                                <input
                                                    class="form-control form-control-lg mb-3 @error('foto_bbm') is-invalid @enderror"
                                                    name="foto_kondisi_bbm" type="file" value="{{ $data->foto_bbm }}"
                                                    id="formFileLg" multiple>
                                                <img src="{{ asset($data->foto_kondisi_bbm) }}"
                                                    class="img-fluid img-thumbnail" alt="Foto Kondisi BBM" width="540"
                                                    height="540"
                                                    style="object-fit: contain; width: 250px;height: 175px;">
                                                @error('foto_bbm')
                                                    <span class="invalid-feedback">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Jumlah BBM --}}
                                        <div class="mb-3">
                                            <div class="form-floating col-md-6">
                                                <input type="text" id="jumlah_bbm" name="jumlah_bbm"
                                                    class="form-control  text-capitalize @error('jumlah_bbm') is-invalid @enderror"
                                                    value="{{ $data->jumlah_bbm }}" placeholder="...">
                                                <label for="jumlah_bbm" class="ms-2">Jumlah BBM</label>
                                                @error('jumlah_bbm')
                                                    <span class="invalid-feedback">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Tabel Brand Kendaraan --}}
                                        <div class="mt-3 col-md-6">
                                            <div class="accordion accordion-flush rounded border"
                                                id="accordionFlushExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="flush-headingOne">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                            aria-expanded="false" aria-controls="flush-collapseOne">
                                                            <b>Foto Kondisi Mobil</b>
                                                        </button>
                                                    </h2>
                                                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                                                        aria-labelledby="flush-headingOne"
                                                        data-bs-parent="#accordionFlushExample">
                                                        <div class="accordion-body" id="kondisiMobil">
                                                            {{-- Kondisi Mobil --}}
                                                            <div class="d-flex justify-content-end">
                                                                <div class="btn btn-info rounded mr-3" id="add"
                                                                    onclick="addKondisiMobil()">Add +</div>

                                                                <div class="btn btn-danger rounded" id="remove">Hapus -
                                                                </div>
                                                            </div>

                                                            @foreach ($detail_foto_mobil as $row)
                                                                <div>
                                                                    {{-- Koondisi Mobil --}}
                                                                    <div class="mb-3">
                                                                        <hr
                                                                            class="border border-secondary border-2 opacity-50">
                                                                        <div class="mb-3" id="kondisi-mobil">
                                                                            <label class="form-label"
                                                                                for="kondisi_mobil_old">Kondisi
                                                                                Mobil</label>
                                                                            <input class="form-control form-control"
                                                                                name="kondisi_mobil_old[]" type="file"
                                                                                id="formFile"
                                                                                value="{{ $row->foto_mobil }}" multiple>
                                                                            <input type="text"
                                                                                name="kondisi_mobil_old_id[]"
                                                                                value="{{ $row->id }}" hidden>
                                                                            @error('kondisi_mobil_old')
                                                                                <span class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </span>
                                                                            @enderror
                                                                            <img src="{{ asset($row->foto_mobil) }}"
                                                                                class="img-fluid img-thumbnail mt-3"
                                                                                alt="Foto Mobil" width="540"
                                                                                height="540"
                                                                                style="object-fit: contain; width: 250px;height: 175px;">
                                                                        </div>
                                                                        <div class="mb-3 form-floating"
                                                                            id="keterangan-kondisi-mobil">
                                                                            <input
                                                                                oninput="this.value = this.value.toLowerCase()"
                                                                                type="text" id="keterangan_old[]"
                                                                                name="keterangan_old[]"
                                                                                class="form-control text-capitalize"
                                                                                value="{{ $row->keterangan }}"
                                                                                placeholder="...">
                                                                            <label for="keterangan_old[]"
                                                                                class="">Keterangan</label>
                                                                            @error('keterangan_old')
                                                                                <span class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="col">

                                                                            <a href="{{ asset('kondisi_mobil/' . $row->id . '/hapus') }}"
                                                                                class="btn btn-danger"
                                                                                onclick="return confirm('Apakah yakin ingin menghapus ?')">hapus</a>
                                                                        </div>
                                                                    </div>


                                                                </div>
                                                            @endforeach
                                                            <div id="form-kondisi-mobil"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>





                                    </div>
                                    {{-- ENDDATA KENDARAAN DISEWA --}}

                                    {{-- Kendaraan Form Start --}}

                                    {{-- DATA SEWA --}}
                                    <div class="mt-4">
                                        <h4><b>DATA SEWA</b></h4>
                                        {{-- Driver --}}
                                        <div class="mb-3">
                                            <div class="col-md-6" id="driver">
                                                <label class="form-label" for="driver">
                                                    Pakai Driver?
                                                </label>
                                                <div class="form-check mx-3 mb-2">
                                                    <input class="form-check-input @error('driver') is-invalid @enderror"
                                                        type="radio" name="driver" value="1" id="driver-iya"
                                                        {{ $data->driver !== null && $data->driver == 1 ? 'checked' : '' }}
                                                        style="font-size: 24px">
                                                    <label class="form-check-label" for="driver-iya">
                                                        Iya
                                                    </label>
                                                </div>
                                                <div class="form-check mx-3 mb-2">
                                                    <input class="form-check-input @error('driver') is-invalid @enderror"
                                                        type="radio" name="driver" value="0" id="driver-tidak"
                                                        {{ $data->driver !== null && $data->driver == 0 ? 'checked' : '' }}
                                                        style="font-size: 24px">
                                                    <label class="form-check-label" for="driver-tidak">
                                                        Tidak
                                                    </label>
                                                </div>
                                                @error('driver')
                                                    <span class="invalid-feedback">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>

                                            @if ($data->biaya_supir != null)
                                                <div class="mt-4 col-md-6 card w-screen p-2" id="p"
                                                    style="background-color: #e8f4ea; color: #2b4c40;">
                                                    <label class="form-table" for="biaya_supir">
                                                        Biaya Driver
                                                    </label>
                                                    <input type="text" class="form-control" name="biaya_supir"
                                                        id="biaya_supir" value="{{ $data->biaya_supir }}">
                                                </div>
                                            @endif
                                        </div>

                                        {{-- Lokasi Pengambilan --}}
                                        <div class="mb-3">
                                            <div class="form-floating col-md-6">
                                                <input oninput="this.value = this.value.toLowerCase()" type="text"
                                                    id="lokas_pengambilan" name="lokasi_pengambilan"
                                                    class="form-control text-capitalize @error('lokasi_pengambilan') is-invalid @enderror"
                                                    value="{{ $data->lokasi_pengambilan }}" placeholder="...">
                                                <label for="lokasi_pengambilan" class="ms-2">Lokasi Pengambilan</label>

                                                @error('lokasi_pengembalian')
                                                    <span class="invalid-feedback">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>


                                        {{-- Waktu Pengambilan --}}
                                        <div class="mb-3">
                                            <div class="col-md-6">
                                                <label for="waktu_pengambilan" class="form-label">Waktu
                                                    Pengambilan</label>
                                                <input
                                                    class="form-control form-control-lg @error('waktu_pengambilan') is-invalid @enderror"
                                                    id="waktu_pengambilan" type="date" name="waktu_pengambilan"
                                                    value="{{ $data->waktu_pengambilan }}">
                                                @error('waktu_pengambilan')
                                                    <span class="invalid-feedback">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Durasi --}}
                                        <div class="mb-3">
                                            <div class="form-floating col-md-6">
                                                <input type="text" name="durasi" id="durasi"
                                                    class="form-control text-capitalize @error('durasi') is-invalid @enderror"
                                                    value="{{ $data->durasi }}" placeholder="...">
                                                <label for="durasi" class="ms-2">Durasi sewa dalam hari</label>

                                                @error('durasi')
                                                    <span class="invalid-feedback">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>






                                    </div>
                                    {{-- END DATA SEWA --}}

                                    <div class="mb-3">
                                        <div class="form-floating col-md-6">
                                            <input type="text" name="promo" id="promo"
                                                class="form-control text-capitalize @error('promo') is-invalid @enderror"
                                                value="{{ $data->promo }}" placeholder="...">
                                            <div class="form-text">Isi 0 jika tidak ada potongan</div>
                                            <label for="promo" class="ms-2">Promo sewa dalam hari</label>

                                            @error('promo')
                                                <span class="invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>





                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <label for="signature" class="form-label">Tanda Tangan</label>
                                            <div class="sign-container ">
                                                <canvas width="300" height="150" style="border:1px solid grey"
                                                    id="tanda_tangan_pad"></canvas>
                                                <input name="tanda_tangan" id="tanda_tangan" style="display: none"
                                                    hidden>
                                            </div>
                                            <button id="clear" class="btn btn-danger btn-sm mt-3">Reset</button>
                                            @error('tanda_tangan')
                                                <span class="invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="mb-3">
                                            <img src="{{ asset($data->tanda_tangan) }}" alt="foto Tanda tangan">
                                        </div>

                                    </div>
                                    <div class="d-flex flex-column flex-md-row gap-2">

                                        <button class="btn btn-primary ml-1" onclick="unmask_transaksi()">Submit</button>
                                        @if ($kendaraan->status == 'Sudah Terpakai')
                                            <a href="{{ asset('kendaraan-kembali/' . $data->kendaraan_id) }}"
                                                class="btn btn-success ml-1"
                                                onclick="return confirm('Apakah anda yakin kendaraan sudah kembali ?')">Update
                                                Status
                                                Kendaraan Sudah kembali</a>
                                        @endif

                                        @if ($kendaraan->status == 'booking')
                                            <a href="{{ asset('kendaraan-bayar/' . $data->kendaraan_id) }}"
                                                class="btn btn-info ml-1">Update Status
                                                sudah membayar</a>
                                        {{-- @elseif ($kendaraan->status == 'booking') --}}
                                        @else
                                            {{-- <a href="{{ asset('kendaraan-tidak-bayar/' . $data->kendaraan_id) }}"
                                                class="btn btn-info ml-1">Update Status
                                                belum membayar</a> --}}
                                        @endif
                                    </div>
                                    {{-- Kendaraan Form End --}}
                                </form>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
        {{-- @include('sweetalert::alert') --}}

    </div>

    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <script>
        $(document).ready(() => {
            new SignaturePad(document.querySelector("#tanda_tangan_pad"));
        });

        function deletePad() {
            new SignaturePad(document.querySelector("#tanda_tangan_pad")).clear();
        }
    </script>
@endsection
