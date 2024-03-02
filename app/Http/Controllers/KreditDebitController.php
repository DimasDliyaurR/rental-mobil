<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\KreditDebit;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use App\Models\Brand_Kendaraan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KreditDebitController extends Controller
{
    public function index(Request $request)
    {

        // Mendapatkan nilai bulan dan tahun dari request
        $bulan_tahun = $request->input('bulanTahun');

        if ($bulan_tahun) {
            // Jika ada nilai bulanTahun dalam request
            // Mengekstrak bulan dan tahun dari nilai yang diterima
            list($tahun, $bulan) = explode('-', $bulan_tahun . '-01'); // Menambahkan '-01' untuk memastikan selalu tanggal 1
        } else {
            // Jika tidak ada nilai bulanTahun dalam request, gunakan bulan dan tahun saat ini
            $tahun = Carbon::now()->year;
            $bulan = Carbon::now()->month;
        }

        // Mengubah angka bulan menjadi nama bulan
        $nama_bulan = Carbon::createFromDate($tahun, $bulan, 1)->format('F');

        if ($bulan_tahun) {
            $transaksi = DB::table("transaksi")
                ->select(DB::raw("SUM(COALESCE((brand_kendaraan.harga_sewa,0) * transaksi.durasi, 0)) - COALESCE(transaksi.promo , 0) + COALESCE(transaksi.biaya_supir, 0)) as jumlah_transaksi, transaksi.nama_penyewa"))
                ->join("kendaraan", "transaksi.kendaraan_id", "=", "kendaraan.id")
                ->join("brand_kendaraan", "kendaraan.brand_kendaraan_id", "=", "brand_kendaraan.id")
                ->whereMonth('transaksi.created_at', '=', $bulan)
                ->whereYear('transaksi.created_at', '=', $tahun)
                ->groupBy("transaksi.nama_penyewa")
                ->orderBy('transaksi.created_at')
                ->get();




            $pengeluaran = DB::table("pengeluaran")
                ->select(DB::raw("SUM(pengeluaran.harga_pengeluaran) total_pengeluaran"), "pengeluaran.*")
                ->groupBy("pengeluaran.harga_pengeluaran", "pengeluaran.id", "pengeluaran.nama_pengeluaran", "pengeluaran.deskripsi_pengeluaran", "pengeluaran.tanggal_pengeluaran", "pengeluaran.created_at", "pengeluaran.updated_at")
                ->whereMonth('pengeluaran.created_at', '=', $bulan)
                ->whereYear('pengeluaran.created_at', '=', $tahun)
                ->orderBy('pengeluaran.created_at')
                ->get();

            $total_pengeluaran = DB::table("pengeluaran")
                ->select(DB::raw("SUM(pengeluaran.harga_pengeluaran) total_pengeluaran"))
                ->whereMonth('pengeluaran.created_at', '=', $bulan)
                ->whereYear('pengeluaran.created_at', '=', $tahun)
                ->get()
                ->first();

            $total_transaksi = DB::table("transaksi")
                ->select(DB::raw("SUM(COALESCE((brand_kendaraan.harga_sewa - transaksi.promo) * transaksi.durasi, 0) + COALESCE(transaksi.biaya_supir, 0)) as jumlah_transaksi"))
                ->join("kendaraan", "transaksi.kendaraan_id", "=", "kendaraan.id")
                ->join("brand_kendaraan", "kendaraan.brand_kendaraan_id", "=", "brand_kendaraan.id")
                ->whereMonth('transaksi.created_at', '=', $bulan)
                ->whereYear('transaksi.created_at', '=', $tahun)
                ->groupBy("transaksi.nama_penyewa")
                ->orderBy('transaksi.created_at')
                ->get();

            // Menghitung total dari hasil subquery
            $total_transaksi = $total_transaksi->sum('jumlah_transaksi');
        } else {

            $transaksi = DB::table("transaksi")
                ->select(DB::raw("SUM(COALESCE((brand_kendaraan.harga_sewa - transaksi.promo) * transaksi.durasi, 0) + COALESCE(transaksi.biaya_supir, 0)) as jumlah_transaksi, transaksi.nama_penyewa"))
                ->join("kendaraan", "transaksi.kendaraan_id", "=", "kendaraan.id")
                ->join("brand_kendaraan", "kendaraan.brand_kendaraan_id", "=", "brand_kendaraan.id")
                ->groupBy("transaksi.nama_penyewa")
                ->orderBy('transaksi.created_at')
                ->get();


            $pengeluaran = DB::table("pengeluaran")
                ->select(DB::raw("SUM(pengeluaran.harga_pengeluaran) total_pengeluaran"), "pengeluaran.*")
                ->groupBy("pengeluaran.harga_pengeluaran", "pengeluaran.id", "pengeluaran.nama_pengeluaran", "pengeluaran.deskripsi_pengeluaran", "pengeluaran.tanggal_pengeluaran", "pengeluaran.created_at", "pengeluaran.updated_at")
                ->orderBy('pengeluaran.created_at')
                ->get();

            $total_pengeluaran = DB::table("pengeluaran")
                ->select(DB::raw("SUM(pengeluaran.harga_pengeluaran) total_pengeluaran"))
                ->get()
                ->first();

            $total_transaksi = DB::table("transaksi")
                ->select(DB::raw("SUM(COALESCE((brand_kendaraan.harga_sewa - transaksi.promo) * transaksi.durasi, 0) + COALESCE(transaksi.biaya_supir, 0)) as jumlah_transaksi"))
                ->join("kendaraan", "transaksi.kendaraan_id", "=", "kendaraan.id")
                ->join("brand_kendaraan", "kendaraan.brand_kendaraan_id", "=", "brand_kendaraan.id")
                ->groupBy("transaksi.nama_penyewa")
                ->orderBy('transaksi.created_at')
                ->get();

            // Menghitung total dari hasil subquery
            $total_transaksi = $total_transaksi->sum('jumlah_transaksi');
        }

        return view("admin.kredit_debit.lihat", [
            "title" => "Laporan",
            "action" => "Kredit_Debit_Lihat",
            "transaksi" => $transaksi,
            "pengeluaran" => $pengeluaran,
            "total_pengeluaran" => $total_pengeluaran,
            "total_transaksi" => $total_transaksi,
            'debit_kredit'  => $total_transaksi - $total_pengeluaran->total_pengeluaran,
            'bulan' => $nama_bulan,
            'tahun' => $tahun
        ]);
    }

    public function jadwal()
    {
        return view("admin.jadwal.lihat", [
            "title" => "Jadwal",
            "action" => "lihat_jadwal",
        ]);
    }

    public function get_event()
    {
        $data = Transaksi::select("kendaraan.status", "brand_kendaraan.nama_merek", "brand_kendaraan.nama_brand", "transaksi.id", "transaksi.waktu_pengambilan", "transaksi.tanggal_kembali", "kendaraan.plat", "transaksi.waktu_kembali")
            ->join("kendaraan", "transaksi.kendaraan_id", "=", "kendaraan.id")->join("brand_kendaraan", "kendaraan.brand_kendaraan_id", "=", "brand_kendaraan.id")
            ->where("transaksi.waktu_kembali", "!=", now())
            ->get()
            ->map(fn ($item) => [
                "id" => $item->id,
                "title" => ucwords($item->nama_brand . " " . $item->nama_merek . " | " . $item->plat),
                "start" => $item->waktu_pengambilan,
                "end" => $item->tanggal_kembali,
                "description" => $item->status,
            ]);

        return response()->json($data);
    }
}
