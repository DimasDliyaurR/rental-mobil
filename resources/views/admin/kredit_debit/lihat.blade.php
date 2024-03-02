@extends('layouts-admin.head')

@section('content')
    <div class="content my-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex flex-fill justify-content-end">
                                <form action="/kredit-debit">
                                    @csrf
                                    <label for="bulanTahun">Pilih Bulan dan Tahun:</label>
                                    <input class="form-control form-control-lg" type="month" id="bulanTahun"
                                        name="bulanTahun">
                                    <button type="submit" class="btn btn-primary mt-2 w-100">Buat Tabel</button>
                                </form>
                            </div>




                            <h3 class="mt-4 text-center fw-bold">Tabel Debit Kredit</h3>
                            <h4 class="text-center fw-bold mb-5">Bulan {{ $bulan }} tahun {{ $tahun }}</h4>

                            <div class="overflow-visible" style="width: 10wv">
                                <table class="table table-bordered mx-auto" style="width: 70%">
                                    @if (count($transaksi) > 0 || count($pengeluaran) > 0)
                                        <tr>
                                            <th></th>
                                            <th colspan="2" class="text-center">Saldo</th>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <th class="text-center">Debet</th>
                                            <th class="text-center">Kredit</th>
                                        </tr>
                                        <tr>
                                            <th>Debit</th>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        @foreach ($transaksi as $row)
                                            <tr>
                                                <td class="text-capitalize">Transaksi {{ $row->nama_penyewa }}</td>
                                                <td class="text-center">Rp.
                                                    {{ number_format($row->jumlah_transaksi, 0, ',', '.') }},-</td>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <th>Kredit</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        @foreach ($pengeluaran as $row)
                                            <tr>
                                                <td>{{ $row->nama_pengeluaran }}</td>
                                                <td></td>
                                                <td class="text-center">Rp.
                                                    {{ number_format($row->harga_pengeluaran, 0, ',', '.') }},-</td>
                                            </tr>
                                        @endforeach

                                        <tr>
                                            <th class="text-center">Total</th>
                                            <th class="text-center">Rp. {{ number_format($total_transaksi, 0, ',', '.') }},-
                                            </th>
                                            <th class="text-center">Rp.
                                                {{ number_format($total_pengeluaran->total_pengeluaran, 0, ',', '.') }},-
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Debit - Kredit</th>
                                            <th class="text-center" colspan="2">Rp.
                                                {{ number_format($debit_kredit, 0, ',', '.') }},-</th>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="3" class="text-center fw-bold">Data tidak ada</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection
