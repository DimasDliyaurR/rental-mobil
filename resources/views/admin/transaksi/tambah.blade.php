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
                                    <div class="form-text bg-green rounded p-2">
                                        {{ session('success') }}
                                    </div>
                                @elseif(session()->has('error'))
                                    <div class="alert-error">
                                        <div class="form-text bg-danger rounded p-2">
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
                                    {{-- Foto Penyewa --}}
                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <label for="foto_penyewa" class="form-label">Foto Penyewa</label>
                                            <input type="file" accept="image/*" capture="camera" id="formFileLg"
                                                name="foto_penyewa" class="form-control form-control-lg" multiple>
                                        </div>
                                        @error('foto_penyewa')
                                            <span class="form-text text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- Nama Penyewa --}}
                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <label for="nama_penyewa" class="form-label">Nama Penyewa</label>
                                            <input type="text" name="nama_penyewa" class="form-control"
                                                value="{{ old('nama_penyewa') }}">
                                        </div>
                                        @error('nama_penyewa')
                                            <span class="form-text text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- No Telp --}}
                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <label for="no_telp" class="form-label">Nomor Telepon</label>
                                            <input type="text" id="no_telp" name="no_telp" class="form-control"
                                                value="{{ old('no_telp') }}">
                                        </div>
                                        @error('no_telp')
                                            <span class="form-text text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- Alamat --}}
                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <label for="alamat" class="form-label">Alamat Pembeli</label>
                                            <input type="text" id="alamat" name="alamat" class="form-control"
                                                value="{{ old('alamat') }}">
                                        </div>
                                        @error('alamat')
                                            <span class="form-text text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- No KTP --}}
                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <label for="no_ktp" class="form-label">Nomor KTP</label>
                                            <input type="text" id="no_ktp" name="no_ktp" class="form-control"
                                                value="{{ old('no_ktp') }}">
                                        </div>
                                        @error('no_ktp')
                                            <span class="form-text text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- No KTP --}}
                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <label for="foto_ktp" class="form-label">Foto KTP</label>
                                            <input type="file" accept="image/*" capture="camera" id="foto_ktp"
                                                name="foto_ktp" class="form-control form-control-lg" multiple>
                                        </div>
                                        @error('foto_ktp')
                                            <span class="form-text text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- No SIM --}}
                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <label for="no_sim" class="form-label">Nomor SIM</label>
                                            <input type="text" id="no_sim" name="no_sim" class="form-control"
                                                value="{{ old('no_sim') }}">
                                        </div>
                                        @error('no_sim')
                                            <span class="form-text text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- Foto SIM --}}
                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <label for="foto_sim" class="form-label">Foto SIM</label>
                                            <input type="file" accept="image/*" capture="camera" id="foto_sim"
                                                name="foto_sim" class="form-control form-control-lg" multiple>
                                        </div>
                                        @error('foto_sim')
                                            <span class="form-text text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- Data Diri Form End --}}

                                    {{-- Kendaraan Form Start --}}

                                    {{-- Kendaraan --}}
                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <label for="kendaraan" class="form-label">Kendaraan</label>
                                            <select type="email" class="form-control" id="kendaraan" name="kendaraan">
                                                <option selected disabled hidden>
                                                    {{ count($kendaraan) == 0 ? 'Kendaraan tidak ada yang tersedia' : ' -- Pilih Kendaraan -- ' }}
                                                </option>
                                                @foreach ($kendaraan as $row)
                                                    <option value="{{ $row->id }}">
                                                        {{ $row->nama_merek }}||{{ $row->plat }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('kendaraan')
                                            <span class="form-text text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- Waktu Pengambilan --}}
                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <label for="waktu_pengambilan" class="form-label">Waktu
                                                Pengambilan</label>
                                            <input class="form-control" id="waktu_pengambilan" type="date"
                                                name="waktu_pengambilan" value="{{ old('waktu_pengambilan') }}">
                                        </div>
                                        @error('waktu_pengambilan')
                                            <span class="form-text text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- Lokasi Pengambilan --}}
                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <label for="lokasi_pengambilan" class="form-label">Lokasi Pengambilan</label>
                                            <input class="form-control" id="lokas_pengambilan" name="lokasi_pengambilan"
                                                value="{{ old('lokasi_pengambilan') }}">
                                        </div>
                                        @error('lokasi_pengembalian')
                                            <span class="form-text text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- Driver --}}
                                    <div class="mb-3" id="driver">
                                        <div class="mb-3">
                                            <label class="form-label" for="driver" id="driver">
                                                Memakai Driver atau tidak ?
                                            </label>

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="driver"
                                                    value="1" id="driver-iya"
                                                    {{ old('driver') !== null && old('driver') == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Iya
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="driver"
                                                    value="0" id="driver-tidak"
                                                    {{ old('driver') !== null && old('driver') == 0 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexRadioDefault2">
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

                                    {{-- Durasi --}}
                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="durasi">
                                                Durasi (h)
                                            </label>
                                            <input class="form-control" name="durasi">
                                        </div>
                                        @error('durasi')
                                            <span class="form-text text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- Foto BBM --}}
                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="foto_kondisi_bbm">
                                                Foto BBM
                                            </label>
                                            <input class="form-control form-control-lg" name="foto_kondisi_bbm"
                                                type="file" accept="image/*" capture="camera" id="formFileLg"
                                                multiple>
                                        </div>
                                        @error('foto_kondisi_bbm')
                                            <span class="form-text text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- Tabel Brand Kendaraan --}}
                                    <div class="mt-3">
                                        <div class="accordion accordion-flush rounded border" id="accordionFlushExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingOne">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                        aria-expanded="false" aria-controls="flush-collapseOne">
                                                        # Foto Kondisi Mobil
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
                                                                    <input type="text" class="form-control"
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

                                    {{-- Jumlah BBM --}}
                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="jumlah_bbm">
                                                Jumlah BBM
                                            </label>
                                            <input class="form-control form-control-lg" name="jumlah_bbm">
                                        </div>
                                        @error('jumlah_bbm')
                                            <span class="form-text text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <label for="signature" class="form-label">Tanda Tangan</label>
                                            <div class="sign-container">

                                                <div id="sig"></div>
                                                <textarea id="signature64" name="tanda_tangan" style="display: none"></textarea>
                                            </div>
                                            <button id="clear" class="btn btn-danger btn-sm">Reset</button>
                                            @error('tanda_tangan')
                                                <span class="form-text text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <button class="btn btn-primary">Submit</button>
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
