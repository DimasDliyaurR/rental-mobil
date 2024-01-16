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
                                @livewire('tambah-transaksi-form')
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection
