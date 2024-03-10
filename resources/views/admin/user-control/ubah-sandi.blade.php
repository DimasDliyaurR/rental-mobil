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
                                <form action="{{ asset('/user/ubah-sandi') }}" method="post">
                                    @csrf
                                    <div class="mb-3 col-md-6 form-floating">
                                        <input oninput="this.value = this.value.toLowerCase()" type="text"
                                            class="form-control @error('username') is-invalid @enderror" placeholder="..."
                                            name="username" id="username">
                                        <label for="username" class="ms-2">Username</label>

                                        @error('password_lama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-6 form-floating">
                                        <input oninput="this.value = this.value.toLowerCase()" type="password"
                                            class="form-control @error('password_lama') is-invalid @enderror"
                                            placeholder="..." name="password_lama" id="password_lama">
                                        <label for="password_lama" class="ms-2">Password Lama</label>

                                        @error('password_lama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-6 form-floating">
                                        <input oninput="this.value = this.value.toLowerCase()" type="password"
                                            class="form-control @error('password_baru') is-invalid @enderror"
                                            placeholder="..." name="password_baru" id="password_lama">
                                        <label for="password_baru" class="ms-2">Password Baru</label>
                                        <small>Gunakan huruf kecil</small>

                                        @error('password_baru')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button class="btn btn-primary">Submit</button>
                                </form>
                            </div>

                        </div>
                    </div>
                    @include('sweetalert::alert')
                </div>
            @endsection
