@extends('layouts.main')


@section('detil')
            <!-- BANNER -->
            <div class="container-fluid detilJumbotron">
                <div class="container py-5 d-flex justify-content-center align-items-center">
                    <h3 class="fw-bold my-5">Detil Kendaraan</h3>
                </div>
            </div>
            <!-- END BANNER -->
            <!-- KONTEN -->
            <div class="container mt-5">
                <div class="brand-harga">
                    <div class="row">
                        <div class="col-md-8">
                            <h2>Toyota Avanza</h2>
                        </div>
                        <div class="col-md-4 harga text-md-end">
                            <h2>Rp. 500.000,-</h2>
                            <p class="text-md-end fw-normal">/Hari</p>
                        </div>
                    </div>
                </div>
                <div class="info-singkat d-flex">
                    <div class="wadah-info text-center p-3">
                        <div class="row">
                            <i class="uil uil-calendar-alt"></i>
                        </div>
                        <div class="row"><h2>2012</h2></div>
                        <div class="row"><p>Tahun Registrasi</p></div>
                    </div>
                    <div class="wadah-info text-center p-3 mx-3">
                        <div class="row">
                            <i class="uil uil-pump"></i>
                        </div>
                        <div class="row"><h2>Bensin</h2></div>
                        <div class="row"><p>Bahan Bakar</p></div>
                    </div>
                    <div class="wadah-info text-center p-3">
                        <div class="row">
                            <i class="uil uil-users-alt"></i>
                        </div>
                        <div class="row"><h2>6</h2></div>
                        <div class="row"><p>Seats</p></div>
                    </div>
                </div>
                <div class="bungkus-deskripsi-mobil mt-5">
                    <div class="tulisan-deskripsi-mobil">
                        <p class="p-3">Deskripsi Kendaraan</p>
                    </div>
                    <p class="px-5 py-3">Honda Freed 1500 cc transmision automatic seating capacity 6</p>
                </div>
                <div class="line mt-3"></div>
                <!-- GAMBAR MOBIL -->
                <div class="gambar-mobil text-center mt-3">
                    <div class="row mt-3">
                        <div class="col">
                            <img src="img/mobil1.jpg" alt="" />
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <img src="img/kendaraan.jpg" alt="" />
                        </div>
                    </div>
                </div>
            </div>
            <!-- END KONTEN -->
@endsection
