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
                                @endif
                                <form action="{{ asset('/pengeluaran-tambah/tambah') }}" method="POST">
                                    @csrf
                                    {{-- Nama Pengeluaran --}}

                                    <div class="mb-3 mt-4">
                                        <div class="col-md-6 form-floating">
                                            <input oninput="this.value = this.value.toLowerCase()" type="text" id="nama_pengeluaran"
                                            name="nama_pengeluaran" class="form-control"
                                            value="{{ old('nama_pengeluaran') }}" placeholder="Masukkan nama pengeluaran">
                                            <label for="nama_pengeluaran" class="ms-2">Nama Pengeluaran</label>

                                            @error('nama_pengeluaran')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Deskripsi Pengeluaran --}}

                                    <div class="mb-3">
                                        <div class="col-md-6 form-floating">


                                            <textarea oninput="this.value = this.value.toLowerCase()" class="form-control" placeholder="Masukkan deskripsi pengeluaran" id="deskripsi_pengeluaran"
                                            name="deskripsi_pengeluaran" style="height: 100px" value="{{ old('deskripsi_pengeluaran') }}"></textarea>
                                            <label for="deskripsi_pengeluaran" class="ms-2">Deskripsi
                                                Pengeluaran</label>


                                            @error('deskripsi_pengeluaran')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- Harga Pengeluaran --}}

                                    <div class="mb-3">
                                        <div class="col-md-6 form-floating">
                                            <input type="text" id="harga_pengeluaran" name="harga_pengeluaran" class="form-control"
                                            value="{{ old('harga_pengeluaran') }}" placeholder="Masukkan deskripsi pengeluaran">
                                            <label for="harga_pengeluaran" class="ms-2">Harga Pengeluaran</label>
                                            <small>Contoh: 50000 | tanpa menggunakan Rp atau tanda apapun</small>
                                            @error('harga_pengeluaran')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <button class="btn btn-primary">Submit</button>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection
