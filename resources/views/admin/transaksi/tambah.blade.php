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
                                <form action="" method="post">
                                    @csrf
                                    {{-- Data Diri Form Start --}}
                                    {{-- Data Diri Form End --}}

                                    {{-- Kendaraan Form Start --}}

                                    {{-- Kendaraan --}}
                                    <div class="mb-3">
                                        <label for="kendaraan" class="form-label">Kendaraan</label>
                                        <select type="email" class="form-control" id="kendaraan">
                                            <option selected disabled> -- Pilih Kendaraan -- </option>
                                            @foreach ($kendaraan as $row)
                                                <option value="{{ $row->id }}">{{ $row->nama_kendaraan }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Tanggal Pengambilan --}}
                                    <div class="mb-3">
                                        <label for="tanggal_pengambilan" class="form-label">Tanggal Pengambilan</label>
                                        <input class="form-control" id="tanggal_pengambilan" type="date">
                                    </div>

                                    {{-- Lokasi Pengambilan --}}
                                    <div class="mb-3">
                                        <label for="lokas_pengambilan" class="form-label">Lokasi Pengambilan</label>
                                        <input class="form-control" id="lokas_pengambilan">
                                    </div>

                                    {{-- Driver --}}

                                    <div class="mb-3">
                                        <label class="form-label" for="driver">
                                            Memakai Driver atau tidak ?
                                        </label>
                                        <select class="form-control" name="driver">
                                            <option disabled selected>-- Pilih --</option>
                                            <option value="1">Iya</option>
                                            <option value="0">Tidak</option>
                                        </select>
                                    </div>

                                    {{-- Durasi --}}

                                    <div class="mb-3">
                                        <label class="form-label" for="durasi">
                                            Durasi (h)
                                        </label>
                                        <input class="form-control" name="durasi">
                                    </div>

                                    {{-- Tanggal Kembali --}}
                                    <div class="mb-3">
                                        <label class="form-label" for="tanggal_kembali">
                                            Tanggal Kembali
                                        </label>
                                        <input class="form-control" name="tanggal_kembali" type="date">
                                    </div>

                                    {{-- Waktu Kembali --}}
                                    <div class="mb-3">
                                        <label class="form-label" for="waktu_kembali">
                                            Waktu Kembali
                                        </label>
                                        <input class="form-control" name="waktu_kembali" type="time">
                                    </div>

                                    {{-- Foto BBM --}}
                                    <div class="mb-3">
                                        <label class="form-label" for="foto_bbm">
                                            Foto BBM
                                        </label>
                                        <input class="form-control form-control-lg" name="foto_bbm" type="file"
                                            id="formFileLg" multiple>
                                    </div>

                                    {{-- Jumlah BBM --}}
                                    <div class="mb-3">
                                        <label class="form-label" for="jumlah_bbm">
                                            Jumlah BBM
                                        </label>
                                        <input class="form-control form-control-lg" name="jumlah_bbm" id="formFileLg"
                                            multiple>
                                    </div>
                                    {{-- Kendaraan Form End --}}
                                    <button class="btn btn-primary" style="width: 100%">Submit</button>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection
