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
                                <form action="{{ asset('/user-control/tambah') }}" method="post">
                                    @csrf
                                    <div class="mb-3 col-md-6 form-floating">
                                        <input oninput="this.value = this.value.toLowerCase()" type="text"
                                            class="form-control @error('username') is-invalid @enderror" placeholder="..." name="username" id="username">
                                        <label for="username" class="ms-2">Username</label>
                                        <small>Gunakan huruf kecil</small>

                                        @error('username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-6 form-floating">
                                        <input oninput="this.value = this.value.toLowerCase()" type="text"
                                            class="form-control @error('password') is-invalid @enderror" placeholder="..." name="password" id="password">
                                        <label for="password" class="ms-2">Password</label>
                                        <small>Gunakan huruf kecil</small>

                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button class="btn btn-primary">Submit</button>
                                </form>
                            </div>

                            {{-- Tabel User --}}
                            <div class="mt-3">
                                <div class="accordion accordion-flush rounded border" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingOne">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                aria-expanded="false" aria-controls="flush-collapseOne">
                                                <b>Tabel User</b>
                                            </button>
                                        </h2>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse"
                                            aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body" id="kondisiMobil">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tr>
                                                            <th class="text-center fs-6 text-uppercase">No</th>
                                                            <th class="text-center fs-6 text-uppercase">Username</th>
                                                            <th class="text-center fs-6 text-uppercase">Role</th>
                                                            <th class="text-center fs-6 text-uppercase">Action</th>
                                                        </tr>
                                                        @foreach ($data as $row)
                                                            <tr>
                                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                                <td class="text-center">{{ $row->username }}</td>
                                                                <td class="text-center">{{ $row->level }}</td>
                                                                <td class="text-center">
                                                                    <a href="{{ asset('/user-control/update/' . $row->id) }}"
                                                                        class="btn btn-info me-2">
                                                                        <i class="bi bi-pencil-square"></i> Update
                                                                    </a>
                                                                    <a href="{{ asset('/user-control/hapus/' . $row->id) }}"
                                                                        class="btn btn-danger">
                                                                        <i class="bi bi-trash3"></i> Hapus
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    @include('sweetalert::alert')
                </div>
            @endsection
