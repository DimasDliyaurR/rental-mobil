invoice
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('asset/css/invoiceStyle.css') }}" />
</head>

<body>
    <div class="my-5 page" size="A4">
        <div class="p-5">
            <div class="invoice-header mb-3">
                <h1>Mari Rent Car</h1>
            </div>
            <section class="top-content bb d-flex justify-content-between">
                <div class="logo">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('asset/img/logo.jpg') }}" alt="logo" class="img-fluid rounded me-3" />
                        <div class="mari-rent-car">
                            <p>MRC</p>
                            <p>0888-8888-8888</p>
                            <p>Peterongan, Jombang</p>
                        </div>
                    </div>
                </div>
                <div class="top-left">
                    <div class="">
                        <h5>Invoice</h5>
                    </div>
                </div>
            </section>
            <div class="invoice-details mt-2 p-4">
                <!-- DATA PENYEWA -->
                <div class="data-penyewa mb-3">
                    <div class="row">
                        <div class="col">
                            <h4>Data Penyewa</h4>
                        </div>
                    </div>
                    <div class="d-flex flex-row justify-content-between">
                        <table class="data-table">
                            <tr>
                                <td>Pemesan</td>
                                <td class="px-2">:</td>
                                <td><b>{{ $transaksi->nama_penyewa }}</b></td>
                            </tr>
                            <tr>
                                <td>No. Telepon</td>
                                <td class="px-2">:</td>
                                <td>{{ $transaksi->no_telp }}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td class="px-2">:</td>
                                <td>{{ $transaksi->alamat }}</td>
                            </tr>
                            <tr>
                                <td>No. KTP</td>
                                <td class="px-2">:</td>
                                <td>{{ $transaksi->no_ktp }}</td>
                            </tr>
                            <tr>
                                <td>No. SIM</td>
                                <td class="px-2">:</td>
                                <td>{{ $transaksi->no_sim }}</td>
                            </tr>
                        </table>
                        <img src="{{ asset($transaksi->foto_penyewa) }}" class="foto-user" alt="Foto Penyewa" />
                    </div>
                </div>

                <!-- END DATA PENYEWA -->

                <div class="row mt-5">
                    <div class="col-5">
                        <div class="data-kendaraan mb-3">
                            <div class="row">
                                <div class="col">
                                    <h4>Data Kendaraan</h4>
                                </div>
                            </div>
                            <table class="data-table-kendaraan">
                                <tr>
                                    <td>Unit</td>
                                    <td class="px-2">:</td>
                                    <td>{{ $transaksi->nama_brand }} <br> {{ $transaksi->nama_merek }}</td>
                                </tr>
                                <tr>
                                    <td>Plat Nomor</td>
                                    <td class="px-2">:</td>
                                    <td>{{ $transaksi->plat }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col">
                        <div class="data-transaksi">
                            <div class="row">
                                <div class="col">
                                    <h4>Data Layanan</h4>
                                </div>
                            </div>
                            <table class="data-table-transaksi">
                                <tr>
                                    <td>Tanggal Sewa</td>
                                    <td class="px-3">:</td>
                                    <td>{{ date('d-m-Y', strtotime($transaksi->tanggal_sewa)) }}</td>
                                </tr>
                                <tr>
                                    <td>Durasi</td>
                                    <td class="px-3">:</td>
                                    <td>{{ $transaksi->durasi }} Hari</td>
                                </tr>
                                <tr>
                                    <td>Waktu Pengambilan</td>
                                    <td class="px-3">:</td>
                                    <td>{{ date('d-m-Y', strtotime($transaksi->waktu_pengambilan)) }}</td>
                                </tr>
                                <tr>
                                    <td>Lokasi Ambil</td>
                                    <td class="px-3">:</td>
                                    <td>{{ $transaksi->lokasi_pengambilan }}</td>
                                </tr>
                                <tr>
                                    <td>Driver/Lepas Kunci</td>
                                    <td class="px-3">:</td>
                                    <td>{{ $transaksi->driver == 1 ? 'Iya' : 'Tidak' }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Kembali</td>
                                    <td class="px-3">:</td>
                                    <td>{{ date('d-m-Y', strtotime($transaksi->tanggal_kembali)) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Waktu Kembali</td>
                                    <td class="px-3">:</td>
                                    <td>{{ $transaksi->waktu_kembali }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="invoice-details mt-1">
                <h4>Lampiran</h4>
                <div class="row mt-4">
                    <h6>Foto SIM dan KTP</h6>
                </div>
                <div class="row">
                    <div class="col">
                        <img src="{{ asset($transaksi->foto_ktp) }}" class="foto-lampiran mt-2 mx-1" alt="Foto KTP" />
                        <img src="{{ asset($transaksi->foto_sim) }}" class="foto-lampiran mt-2 mx-1" alt="Foto SIM" />
                    </div>
                </div>
                <div class="row mt-4">
                    <h6>Indikator bahan Bakar</h6>
                </div>
                <div class="row">
                    <div class="col">
                        <img src="{{ asset($transaksi->foto_kondisi_bbm) }}" class="foto-lampiran mt-2 mx-1"
                            alt="Foto BBM" />
                    </div>
                </div>
                <div class="row mt-4">
                    <h6>Kondisi Kendaraan</h6>
                </div>
                <div class="row">

                    <div class="col">
                        @foreach ($detail_foto_mobils as $row)
                            <img src="{{ asset($row->foto_mobil) }}" class="foto-lampiran mt-2 mx-1"
                                alt="Foto Kondisi Mobil" />
                            <p>{{ $row->keterangan }}</p>
                        @endforeach
                    </div>
                </div>
            </div>

            <table class="invoice-table mt-2">
                <thead>
                    <tr>
                        <th colspan="2" class="text-center">
                            <h5>Rincian Pembayaran</h5>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Keterangan</th>
                        <th>Biaya</th>
                    </tr>
                    <tr>
                        <td>Biaya Sewa Mobil</td>
                        <td>Rp. {{ number_format($transaksi->harga_sewa * $transaksi->durasi, 0, ',', '.') }},-
                        </td>
                    </tr>
                    {{ $transaksi->biaya_supir }}
                    @if ($transaksi->driver == 1)
                        <tr>
                            <td>Biaya Supir</td>
                            <td>Rp. {{ number_format($transaksi->biaya_supir, 0, ',', '.') }},-</td>
                        </tr>
                    @endif
                    <tr>
                        <td><strong>Total</strong></td>
                        <td><strong>Rp.
                                {{ number_format($transaksi->harga_sewa * $transaksi->durasi + ($transaksi->biaya_supir != null ? $transaksi->biaya_supir : 0), 0, ',', '.') }},-</strong>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="container mx-5 syarat-dan-ketentuan">
            <h6>Syarat dan Ketentuan</h6>
            <ol>
                <li>Syarat menyewa : KTP/SIM c dan Kendaraan R2</li>
                <li>DP Minimal <b>Rp. 50.000</b> (jika terjadi pembatalan DP tidak bisa dikembalikan)</li>
                <li>Pembayaran 100% pada saat pengambilan kendaraan</li>
                <li>Durasi Rental adalah <b>12/24 Jam (kelipatan)</b></li>
                <li>Kelebihan Jam maksimal <b>2 Jam (Over Time)</b>, jika lebih dari 1 jam saat pengembalian akan di
                    kenakan biaya <b>Rp. 25.000/jam</b> (jika tidak ada perjanjian)</li>
                <li>Apabila terjadi kecelakaan Pihak Penyewa di wajibkan membayar <b>Rp. 250.000,- / Spot ( Pertitik
                        )</b></li>
                <li>Jika Terjadi Kecelakaan Berat Pihak Penyewa wajib menanggung Biaya <b>Kerugian</b> MRC, biaya
                    <b>Perbaikan</b> dan biaya <b>sewa 50%</b> selama kendaraan dalam masa perbaikan.
                </li>
                <li>Pihak Penyewa <b>Dilarang</b> : Memindah Tangankan, Menyewakan, Menggadaikan, Menjual Kendaraan,
                    Membawa Obat – Obatan Terlarang.</li>
                <li>
                    Pihak <b>MRC</b> berhak mengambil <b>Langkah- Langkah pengamanan</b>. Atau bahkan mengambil
                    kendaraan secara sepihak, secara paksa (Merusak Pagar, Mendobrak Pintu menggunakan alat-alat yang di
                    perlukan). Bilamana
                    menurut pertimbangan keamanan diperlukan oleh pihak rental untuk mendapatkan Kembali unit kendaraan
                    dan pihak penyewa membebaskan pihak rental dari segala tuntutan hukum terkait tindakan yang di ambil
                    pihak rental.
                </li>
                <li>Pihak penyewa <b>dilarang</b> mengambil tindakan <b>tanpa seizin MRC</b> seperti <b>pengantian
                        sparepart apapum dalam kendaraan saat kendaraan mengalami kendala</b>. Team MRC akan. <b>siap
                        membantu 24 jam</b>.</li>
                <li>Pihak <b>MRC tidak bertanggung jawab</b> atas segala kehilangan barang yang tertinggal di dalam
                    kendaraan.</li>
                <li>Penyewa wajib menggembalikan <b>BBM</b> seperti semula, jika tidak penyewa dikenakan biaya per bar
                    sebesar <b>Rp. 50.000,-</b></li>
                <li>
                    Biaya kebersihan sebersar <b>Rp. 50.000,-</b> akan di kenakan jika pihak penyewa mengembalikan
                    kedaraan interior dalam kondisi kotor seperti terdapat :
                    <b>Muntahan, Bulu Binatang, Alat kontrasepsi, Kulit Kacang, dsb.</b>
                </li>
                <li>
                    Pihak <b>Penyewa wajib berfoto</b> dengan kendaraan pada saat serah terima kendaraan. Seluruh foto
                    dan dokumentasi menjadi hak milik <b>MRC</b> dan penyewa tidak keberatan di publikasikan guna
                    kepentingan rental dan
                    pihak penyewa membebaskan <b>MRC</b> dari semua tuntutan Hukum.
                </li>
            </ol>
        </div>

        <div class="mx-5 mt-5 d-flex justify-content-between">
            <div class="ttdClient text-center">
                <h6>TTD</h6>
                <h6>Penyewa</h6>
                <img src="{{ asset($transaksi->tanda_tangan) }}" width="150px" height="150px"
                    style="object-fit: contain" alt="" />
                <p class="namaTerang">{{ $transaksi->nama_penyewa }}</p>
            </div>
            {{-- <div class="ttd-Admin text-center">
                <h6>TTD</h6>
                <h6>Mari Rent Car</h6>
                <img src="{{ asset('asset/img/admin.png') }}" width="150px" height="150px" style="object-fit: contain"
                    alt="" />
                <p class="namaTerang">Anandhari Alfitho</p>
            </div> --}}
        </div>
    </div>

    <script>
        window.print();
    </script>
</body>

</html>
