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
                                @endif
                                <form action="{{ asset('/pengeluaran-tambah/tambah') }}" method="POST">
                                    @csrf
                                    {{-- Nama Pengeluaran --}}

                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <label for="nama_pengeluaran" class="form-label">Nama Pengeluaran</label>
                                            <input type="text" class="form-control" id="nama_pengeluaran"
                                                name="nama_pengeluaran">
                                        </div>
                                        @error('nama_pengeluaran')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Deskripsi Pengeluaran --}}

                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <label for="deskripsi_pengeluaran" class="form-label">Deskripsi
                                                Pengeluaran</label>
                                            <input type="text" class="form-control" id="deskripsi_pengeluaran"
                                                name="deskripsi_pengeluaran">
                                        </div>
                                        @error('deskripsi_pengeluaran')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{-- Harga Pengeluaran --}}

                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <label for="harga_pengeluaran" class="form-label">Harga Pengeluaran</label>
                                            <textarea type="text" class="form-control" id="harga_pengeluaran" name="harga_pengeluaran"></textarea>
                                        </div>
                                        @error('harga_pengeluaran')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
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
