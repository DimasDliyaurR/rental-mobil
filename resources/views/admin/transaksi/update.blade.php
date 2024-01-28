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
                                <form action="{{ asset('/transaksi/update') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <input type="text" name="id" value="{{ $data->id }}" hidden>

                                    {{-- Foto Penyewa --}}
                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <label for="foto_penyewa" class="form-label">Foto Penyewa</label>
                                            <input type="file" id="formFileLg" name="foto_penyewa"
                                                class="form-control form-control-lg" multiple>
                                            <img src="{{ asset($data->foto_penyewa) }}" class="img-fluid img-thumbnail"
                                                alt="Foto Penyewa" style="object-fit: cover; width: 200px;height: 300px;">
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
                                                value="{{ $data->nama_penyewa }}">
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
                                                value="{{ $data->no_telp }}">
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
                                                value="{{ $data->alamat }}">
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
                                                value="{{ $data->no_ktp }}">
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
                                            <input type="file" id="foto_ktp" name="foto_ktp"
                                                value="{{ $data->foto_ktp }}" class="form-control form-control-lg"
                                                multiple>
                                            <img src="{{ asset($data->foto_ktp) }}" class="img-fluid img-thumbnail"
                                                alt="Foto KTP" style="object-fit: cover; width: 200px;height: 100px;">
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
                                                value="{{ $data->no_sim }}">
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
                                            <input type="file" id="foto_sim" name="foto_sim"
                                                value="{{ $data->foto_sim }}" class="form-control form-control-lg"
                                                multiple>
                                            <img src="{{ asset($data->foto_sim) }}" class="img-fluid img-thumbnail"
                                                alt="Foto SIM" width="540" height="540"
                                                style="object-fit: cover; width: 200px;height: 100px;">
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
                                                <option disabled> -- Pilih Kendaraan -- </option>
                                                @foreach ($kendaraan as $row)
                                                    <option value="{{ $row->id }}"
                                                        {{ $data->kendaraan_id == $row->id ? 'selected' : '' }}x>
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
                                                name="waktu_pengambilan" value="{{ $data->waktu_pengambilan }}">
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
                                                value="{{ $data->lokasi_pengambilan }}">
                                        </div>
                                        @error('lokasi_pengembalian')
                                            <span class="form-text text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- Driver --}}
                                    <div class="mb-3">
                                        <div class="mb-3" id="driver">
                                            <label class="form-label" for="driver">
                                                Memakai Driver atau tidak ?
                                            </label>

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="driver"
                                                    value="1" id="driver-iya"
                                                    {{ $data->driver !== null && $data->driver == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Iya
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="driver"
                                                    value="0" id="driver-tidak"
                                                    {{ $data->driver !== null && $data->driver == 0 ? 'checked' : '' }}>
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

                                        @if ($data->biaya_supir != null)
                                            <div class="mb-3 card w-screen p-2" id="p"
                                                style="background-color: rgb(180, 216, 232); color: rgb(10, 124, 173);">
                                                <label class="form-table" for="biaya_supir">
                                                    Biaya Supir
                                                </label>
                                                <input type="text" class="form-control" name="biaya_supir"
                                                    id="biaya_supir" value="{{ $data->biaya_supir }}">
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Durasi --}}
                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="durasi">
                                                Durasi (h)
                                            </label>
                                            <input class="form-control" name="durasi" value="{{ $data->durasi }}">
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
                                            <label class="form-label" for="foto_bbm">
                                                Foto BBM
                                            </label>
                                            <input class="form-control form-control-lg" name="foto_bbm" type="file"
                                                value="{{ $data->foto_bbm }}" id="formFileLg" multiple>
                                            <img src="{{ asset($data->foto_kondisi_bbm) }}"
                                                class="img-fluid img-thumbnail" alt="Foto Kondisi BBM" width="540"
                                                height="540" style="object-fit: cover; width: 200px;height: 100px;">
                                        </div>
                                        @error('foto_bbm')
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

                                                        @foreach ($detail_foto_mobil as $row)
                                                            <div class="" id="form-kondisi-mobil">
                                                                {{-- Koondisi Mobil --}}
                                                                <div class="mb-3">
                                                                    <hr
                                                                        class="border border-secondary border-2 opacity-50">
                                                                    <div class="mb-3" id="kondisi-mobil">
                                                                        <label class="form-label"
                                                                            for="kondisi_mobil">Kondisi
                                                                            Mobil</label>
                                                                        <input class="form-control form-control"
                                                                            name="kondisi_mobil[]" type="file"
                                                                            id="formFile" multiple>
                                                                        @error('kondisi_mobil')
                                                                            <span class="form-text text-danger">
                                                                                {{ $message }}
                                                                            </span>
                                                                        @enderror
                                                                        <img src="{{ asset($row->foto_mobil) }}"
                                                                            class="img-fluid img-thumbnail"
                                                                            alt="Foto Mobil" width="540"
                                                                            height="540"
                                                                            style="object-fit: cover; width: 200px;height: 100px;">
                                                                    </div>
                                                                    <div class="mb-3" id="keterangan-kondisi-mobil">
                                                                        <label
                                                                            for="keterangan[]"class="form-label">Keterangan</label>
                                                                        <input type="text" class="form-control"
                                                                            id="keterangan" name="keterangan[]"
                                                                            value="{{ $row->keterangan }}">
                                                                        @error('keterangan')
                                                                            <span class="form-text text-danger">
                                                                                {{ $message }}
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
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
                                            <input class="form-control form-control-lg" name="jumlah_bbm"
                                                value="{{ $data->jumlah_bbm }}">
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
                                        <div class="mb-3">
                                            <img src="{{ asset($data->tanda_tangan) }}" alt="foto Tanda tangan">
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
