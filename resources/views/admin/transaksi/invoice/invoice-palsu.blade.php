{{-- {{ $transaksi->tanda_tangan }}
{{ $transaksi->nama_penyewa }}
{{ $transaksi->no_telp }}
{{ $transaksi->alamat }}
{{ $transaksi->no_ktp }}
{{ $transaksi->no_sim }} --}}
{{-- <img src="{{ storage_path() $transaksi->foto_penyewa }}" alt="Foro"> --}}
<img src="{{ asset('asset/img/logo.jpg') }}" alt="logo" class="img-fluid rounded me-3" />

{{ storage_path() . '/' . $transaksi->foto_penyewa }}
{{-- {{ $transaksi->nama_brand }}
{{ $transaksi->nama_merek }}
{{ $transaksi->plat }}
{{ $transaksi->tanggal_sewa }}
{{ $transaksi->durasi }}
{{ $transaksi->waktu_pengambilan }}
{{ $transaksi->lokasi_pengambilan }}
{{ $transaksi->driver }}
{{ $transaksi->tanggal_kembali }}
{{ $transaksi->waktu_kembali }}
{{ $transaksi->foto_ktp }}
{{ $transaksi->foto_sim }}
{{ $transaksi->foto_kondisi_bbm }} --}}

{{-- <div class="col">
    @foreach ($detail_foto_mobils as $row)
        <img src="{{ asset($row->foto_mobil) }}" class="foto-lampiran mt-2 mx-1" alt="Foto Kondisi Mobil" />
        <p>{{ $row->keterangan }}</p>
    @endforeach
</div> --}}
