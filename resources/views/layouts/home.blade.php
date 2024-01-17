@extends('layouts.main')

@section('home')
        <!-- BANNER -->
        <div class="container-fluid homeJumbotron">
            <div class="container d-flex flex-column mt-5 pt-5">
                <h1 class="display-5 fw-bold col-md-5 mt-5 pt-5">CARI MOBIL UNTUK KENYAMANAN <br />ANDA.</h1>
                <p class="col-md-5 mt-3 fs-4">KAMI MEMPUNYAI BEBERAPA PILIHAN <br />UNTUK ANDA.</p>
                <a href="#mobil-untuk-anda" class="tombolSelengkapnya d-flex align-items-center justify-content-center px-3">SELENGKAPNYA<i class="uil uil-arrow-circle-right ms-2"></i></a>
            </div>
        </div>
        <!-- END BANNER -->
        <!-- MOBIL UNTUK ANDA -->
        <h2 class="container text-center mt-5 pt-5" id="mobil-untuk-anda">Mobil Untuk Anda</h2>
        <div class="container mt-3">
            <div class="row gx-5">
                <div class="col-lg-3 col-md-12 searchBox p-3 py-5 mt-3">
                    <h3><i class="uil uil-filter"></i>Cari Mobil</h3>
                    <form action="">
                        <div class="input-group mt-5 mb-3">
                            <label class="input-group-text" for="inputGroupSelect01">Pilih Merek</label>
                            <select class="form-select" id="inputGroupSelect01">
                                <option selected>Choose...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupSelect01">Jenis Bahan Bakar</label>
                            <select class="form-select" id="inputGroupSelect01">
                                <option selected>Choose...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <button class="buttonCari p-2"><i class="uil uil-search"></i> Cari</button>
                    </form>
                </div>

                <div class="col-lg-8 col-md-12 listMobil ms-lg-3 mt-3">
                    <div class="row">
                        <div class="jumlahMobil d-flex align-items-center p-3">1 Mobil</div>
                    </div>

                    <div class="row cardMobil mt-3 p-2">
                        <div class="col-md">
                            <img src="img/mobil1.jpg" class="img-fluid w-100 mx-auto" alt="" />
                        </div>
                        <div class="col-md p-3">
                            <h1 class="merekMobil fw-3">Honda, hondafreed</h1>
                            <p class="hargaMobil">Rp. 450.000 / Hari</p>
                            <div class="row my-3 infoMobil">
                                <div class="col"><i class="uil uil-user me-2"></i>6 Seats</div>
                                <div class="col"><i class="uil uil-pump me-2"></i>Bensin</div>
                                <div class="col"></div>
                            </div>
                            <a href="/detil" class="lihatDetilKendaraan py-2 px-3 mt-4"> Lihat Detil <i class="uil uil-arrow-circle-right"></i> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MOBIL UNTUK ANDA -->
        <!-- HUBUNGI KAMI -->
        <h2 class="container text-center mt-5 pt-5" id="hubungi-kami">Hubungi Kami</h2>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="contact__information">
                        <i class="uil uil-phone contact__icon"></i>
                        <div>
                            <h3 class="contact__title">Call Me</h3>
                            <span class="contact_subtitle">0888-8888-8888</span>
                        </div>
                    </div>

                    <div class="contact__information">
                        <i class="uil uil-envelope contact__icon"></i>
                        <div>
                            <h3 class="contact__title">Email</h3>
                            <span class="contact_subtitle">akucintaazizi@gmail.com</span>
                        </div>
                    </div>

                    <div class="contact__information">
                        <i class="uil uil-map-marker contact__icon"></i>
                        <div>
                            <h3 class="contact__title">Location</h3>
                            <span class="contact_subtitle">Dimana-mana hatiku senang</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <form action="" method="POST" class="contact__form">
                        <div class="contact__inputs">
                            <div class="contact__content">
                                <label for="" class="contact__label">Name :</label>
                                <input type="text" name="Nama" class="contact__input" />
                            </div>

                            <div class="contact__content mt-3">
                                <label for="" class="contact__label">Phone Number :</label>
                                <input type="text" name="Nomor HP" class="contact__input" />
                            </div>

                            <div class="contact__content mt-3">
                                <label for="" class="contact__label">Email :</label>
                                <input type="email" name="Email" class="contact__input" />
                            </div>

                            <div class="contact__content mt-3">
                                <label for="" class="contact__label">Message :</label>
                                <textarea name="Message" id="" cols="0" rows="7" class="contact__input"></textarea>
                            </div>

                            <div>
                                <button type="submit" class="button mt-3">Send <i class="uil uil-message button__icon"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- END HUBUNGI KAMI -->
@endsection

