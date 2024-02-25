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
                                <form action="{{ asset('/user-control/update') }}" method="post">
                                    @csrf

                                    <input type="text" value="{{ $data->id }}" hidden name="id">
                                    <div class="mb-3 col-md-6 form-floating">
                                        <input oninput="this.value = this.value.toLowerCase()" type="text"
                                            class="form-control" placeholder="..." name="username" id="username"
                                            value="{{ $data->username }}">
                                        <label for="username" class="ms-2">Username</label>

                                        @error('username')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-6 form-floating">
                                        <input oninput="this.value = this.value.toLowerCase()" type="text"
                                            class="form-control" placeholder="..." name="password" id="password"
                                            value="{{ $data->password }}">
                                        <label for="password" class="ms-2">Password</label>

                                        @error('password')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button class="btn btn-primary">Submit</button>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>
            @endsection
