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
                                        {{ session('success') }}!
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
                                <form method="post" action="{{ asset('/kendaraan/update/' . $data->id) }}">
                                    @csrf

                                    {{-- Nama Kendaraan --}}
                                    <div class="mb-3 mt-4 col-md-6">
                                        <label for="nama_kendaraan" class="form-label">Nama Brand</label>
                                        <select class="form-control form-control-lg text-capitalize @error('nama_brand') is-invalid @enderror" id="nama_brand" name="nama_brand">
                                            {{-- <option selected value="{{ $data->id }}">
                                                {{ $data->nama_brand . '||' . $data->nama_merek }}
                                            </option> --}}
                                            @foreach ($brand as $row)
                                                <option value="{{ $row->id }}" class="text-capitalize"
                                                    {{ $row->id == $data->id ? 'selected' : '' }}>
                                                    {{ $row->nama_brand }} {{ $row->nama_merek }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="form-text">Klik untuk memilih Nama Kendaraan</span>
                                        @error('nama_brand')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Plat --}}
                                    <div class="mb-3 col-md-6 form-floating">
                                        <input type="text" class="form-control @error('plat') is-invalid @enderror" placeholder="..." id="plat"
                                            name="plat" value="{{ $data->plat }}">
                                        <label for="plat" class="ms-2">Plat</label>

                                        <span class="form-text">Contoh : W 8989 DR</span>
                                        @error('plat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
        @include('sweetalert::alert')
    </div>
@endsection
