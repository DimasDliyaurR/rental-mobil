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
                                    <div class="form-text bg-green rounded p-2 col-md-6">
                                        {{ session('success') }}
                                    </div>
                                @elseif(session()->has('error'))
                                    <div class="alert-error">
                                        <div class="form-text bg-danger rounded p-2 col-md-6">
                                            {{ session('error') }}
                                        </div>
                                    </div>
                                @elseif($errors->any())
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif

                                <form action="{{ asset('transaksi-tambah/tambah') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf

                                    {{-- DATA PENYEWA --}}
                                    <div class="data-penyewa my-5 border-bottom pb-3">

                                        <h4 class="mb-3"><b>ISI DATA KLIEN</b></h4>
                                        {{-- Foto Penyewa --}}
                                        <div class="mb-3 row">
                                            <div class="col-md-6">
                                                <label for="foto_penyewa" class="form-label">Foto Klien</label>
                                                <input type="file" accept="image/*" capture="camera" id="formFileLg"
                                                    name="foto_penyewa" class="form-control form-control-lg" multiple>
                                                    @error('foto_penyewa')
                                                    <span class="form-text text-danger">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                            </div>
                                        </div>

                                        {{-- Nama Penyewa --}}
                                        <div class="mb-3 row">
                                            <div class="col-md-6 form-floating">
                                                <input oninput="this.value = this.value.toLowerCase()" type="text" class="form-control" id="nama_penyewa" placeholder="Masukkan nama penyewa" name="nama_penyewa" value="{{ old('nama_penyewa') }}">
                                                <label for="nama_penyewa" class="ms-2">Nama Klien</label>
                                                @error('nama_penyewa')
                                                <span class="form-text text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- No Telp --}}
                                        <div class="mb-3 row">
                                            <div class="col-md-6 form-floating">
                                                <input type="text" id="no_telp" name="no_telp" class="form-control"
                                                value="{{ old('no_telp') }}" placeholder="Masukkan nomor telepon">
                                                <label for="no_telp" class="ms-2">Nomor Telepon</label>
                                                @error('no_telp')
                                                <span class="form-text text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Alamat --}}
                                        <div class="mb-3 row">
                                            <div class="col-md-6 form-floating">
                                                <input oninput="this.value = this.value.toLowerCase()" type="text" id="alamat" name="alamat" class="form-control"
                                                value="{{ old('alamat') }}" placeholder="Masukkan alamat">
                                                <label for="alamat" class="ms-2">Alamat Klien</label>
                                                @error('alamat')
                                                <span class="form-text text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- No KTP --}}
                                        <div class="mb-3 row">
                                            <div class="col-md-6 form-floating">
                                                <input type="text" id="no_ktp" name="no_ktp" class="form-control"
                                                value="{{ old('no_ktp') }}" placeholder="Masukkan nomor KTP">
                                                <label for="no_ktp" class="ms-2">Nomor KTP Klien</label>
                                                @error('no_ktp')
                                                <span class="form-text text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- No SIM --}}
                                        <div class="mb-4 row">
                                            <div class="col-md-6 form-floating">
                                                <input type="text" id="no_sim" name="no_sim" class="form-control"
                                                value="{{ old('no_sim') }}" placeholder="Masukkan nomor SIM">
                                                <label for="no_sim" class="ms-2">Nomor SIM Klien</label>
                                                @error('no_sim')
                                                <span class="form-text text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Foto KTP --}}
                                        <div class="my-3 row">
                                            <div class="col-lg-3">
                                                <label for="foto_ktp" class="form-label">Foto KTP</label>
                                                <input type="file" accept="image/*" capture="camera" id="foto_ktp"
                                                    name="foto_ktp" class="form-control form-control-lg" multiple>
                                                    @error('foto_ktp')
                                                    <span class="form-text text-danger">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                            </div>

                                            {{-- FOTO SIM --}}
                                            <div class="col-lg-3">
                                                <label for="foto_sim" class="form-label">Foto SIM</label>
                                                <input type="file" accept="image/*" capture="camera" id="foto_sim"
                                                    name="foto_sim" class="form-control form-control-lg" multiple>
                                                    @error('foto_sim')
                                                    <span class="form-text text-danger">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                            </div>
                                        </div>


                                    </div>
                                    {{-- END DATA PENYEWA --}}
                                    {{-- Data Diri Form End --}}

                                    {{-- Kendaraan Form Start --}}
                                    {{-- KENDARAAN DISEWA --}}
                                    <div class="data-kendaraan-disewa border-bottom pb-3">
                                        <h4 class="mb-3"><b>KENDARAAN YANG AKAN DISEWA</b></h4>
                                        {{-- Kendaraan --}}
                                        <div class="mb-3">
                                            <div class="col-md-6">
                                                <label for="kendaraan" class="form-label">Daftar Kendaraan</label>
                                                <select class="form-select form-select-lg" aria-label="Default select example" id="kendaraan" name="kendaraan">
                                                    <option selected disabled hidden>
                                                        {{ count($kendaraan) == 0 ? 'Kendaraan tidak ada yang tersedia' : 'Pilih Kendaraan...' }}
                                                    </option>
                                                    @foreach ($kendaraan as $row)
                                                        <option value="{{ $row->id }}">
                                                            {{ $row->nama_brand . ' ' . $row->nama_merek }} || {{ $row->plat }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                @error('kendaraan')
                                                <span class="form-text text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Foto BBM --}}
                                        <div class="mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label" for="foto_kondisi_bbm">
                                                    Foto BBM
                                                </label>
                                                <input class="form-control form-control-lg" name="foto_kondisi_bbm"
                                                    type="file" accept="image/*" capture="camera" id="formFileLg"
                                                    multiple>
                                                    @error('foto_kondisi_bbm')
                                                    <span class="form-text text-danger">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                            </div>
                                        </div>

                                        {{-- Jumlah BBM --}}
                                        <div class="mb-3">
                                            <div class="col-md-6 form-floating">
                                                <input type="text" id="jumlah_bbm" name="jumlah_bbm" class="form-control"
                                                value="{{ old('jumlah_bbm') }}" placeholder="Masukkan jumlah bbm">
                                                <label for="jumlah_bbm" class="ms-2">Jumlah BBM</label>

                                                @error('jumlah_bbm')
                                                <span class="form-text text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Tabel Brand Kendaraan --}}
                                        <div class="mt-3 col-md-6">
                                            <div class="accordion accordion-flush rounded border" id="accordionFlushExample">
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
                                                                <div class="btn btn-info rounded" id="add"
                                                                    onclick="addKondisiMobil()">Add +</div>
                                                            </div>
                                                            <div class="" id="form-kondisi-mobil">
                                                                {{-- Koondisi Mobil --}}
                                                                <div class="mb-3">
                                                                    <hr class="border border-secondary border-2 opacity-50">
                                                                    <div class="mb-3" id="kondisi-mobil">
                                                                        <label class="form-label" for="kondisi_mobil">Kondisi
                                                                            Mobil</label>
                                                                        <input class="form-control form-control"
                                                                            name="kondisi_mobil[]" type="file"
                                                                            accept="image/*" capture="camera" id="formFile"
                                                                            multiple>
                                                                        @error('kondisi_mobil')
                                                                            <span class="form-text text-danger">
                                                                                {{ $message }}
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="mb-3" id="keterangan-kondisi-mobil">
                                                                        <label
                                                                            for="keterangan[]"class="form-label">Keterangan</label>
                                                                        <input oninput="this.value = this.value.toLowerCase()" type="text" class="form-control"
                                                                            id="keterangan" name="keterangan[]"
                                                                            value="{{ old('keterangan[]') }}">
                                                                        @error('keterangan')
                                                                            <span class="form-text text-danger">
                                                                                {{ $message }}
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- END KENDARAAN DISEWA --}}


                                    <div class="data-penyewaan mt-5">
                                        <h4 class="mb-3"><b>DATA SEWA</b></h4>

                                        {{-- Driver --}}
                                        <div class="mb-3 col-md-6" id="driver">
                                            <div class="mb-3">
                                                <label class="form-label" for="driver" id="driver" >
                                                    Pakai Driver?
                                                </label>

                                                <div class="form-check mx-3 mb-2">
                                                    <input class="form-check-input" type="radio" name="driver"
                                                        value="1" id="driver-iya"
                                                        {{ old('driver') !== null && old('driver') == 1 ? 'checked' : '' }} style="font-size: 24px">
                                                    <label class="form-check-label" for="driver-iya">
                                                        Iya
                                                    </label>
                                                </div>
                                                <div class="form-check mx-3">
                                                    <input class="form-check-input" type="radio" name="driver"
                                                        value="0" id="driver-tidak"
                                                        {{ old('driver') !== null && old('driver') == 0 ? 'checked' : '' }} style="font-size: 24px">
                                                    <label class="form-check-label" for="driver-tidak">
                                                        Tidak
                                                    </label>
                                                </div>
                                            </div>
                                            @error('driver')
                                                <span class="form-text text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror

                                        </div>

                                        {{-- Lokasi Pengambilan --}}
                                        <div class="mb-3 mt-5">
                                            <div class="col-md-6 form-floating">
                                                <input oninput="this.value = this.value.toLowerCase()" type="text" id="lokas_pengambilan" name="lokasi_pengambilan" class="form-control"
                                                value="{{ old('lokasi_pengambilan') }}" placeholder="Lokasi pengambilan">
                                                <label for="lokasi_pengambilan" class="ms-2">Lokasi Pengambilan</label>

                                                @error('lokasi_pengembalian')
                                                <span class="form-text text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Waktu Pengambilan --}}
                                        <div class="mb-3">
                                            <div class="col-md-6">
                                                <label for="waktu_pengambilan" class="form-label">Tanggal
                                                    Pengambilan</label>
                                                <input class="form-control form-control-lg" id="waktu_pengambilan" type="date"
                                                    name="waktu_pengambilan" value="{{ old('waktu_pengambilan') }}">
                                                    @error('waktu_pengambilan')
                                                    <span class="form-text text-danger">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                            </div>
                                        </div>

                                        {{-- Durasi --}}
                                        <div class="mb-3">
                                            <div class="col-md-6 form-floating">
                                                <input type="text" id="durasi" name="durasi" class="form-control"
                                                value="{{ old('durasi') }}" placeholder="Durasi sewa">
                                                <label for="durasi" class="ms-2">Durasi sewa dalam hari</label>
                                                @error('durasi')
                                                <span class="form-text text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>



                                        <div class="mb-3">
                                            <div class="mb-3 col-md-6">
                                                <label for="signature" class="form-label">Tanda Tangan</label>
                                                <div class="sign-container">
                                                    <div id="sig"></div>
                                                    <style>
                                                        #sig{
                                                            width: 500px
                                                        }
                                                        @media only screen and (min-width: 768px) and (max-width: 991px) {
                                                            #sig{
                                                                width: 400px
                                                            }
                                                        }
                                                        @media only screen and (max-width: 767px) {
                                                            #sig{
                                                                width: 300px
                                                            }
                                                        }
                                                    </style>
                                                    <textarea id="signature64" name="tanda_tangan" style="display: none"></textarea>
                                                </div>
                                                <button id="clear" class="btn btn-danger btn-sm mt-3">Reset</button>
                                                @error('tanda_tangan')
                                                    <span class="form-text text-danger">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <button class="btn btn-primary">Submit</button>
                                    </div>

                                    {{-- Kendaraan Form End --}}
                                </form>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection
