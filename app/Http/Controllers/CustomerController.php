<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CustomerController extends Controller
{
    // 1. Menampilkan Katalog Alat Fotografi/Videografi
    public function katalog()
    {
        $alats = Alat::with('kategori')->where('stok', '>', 0)->get();
        return view('customer.katalog', compact('alats'));
    }

    // 2. Memproses Transaksi Sewa Otomatis (Memenuhi Poin 9 UAS)
    public function sewa(Request $request, $id)
    {
        $request->validate([
            'tgl_sewa' => 'required|date|after_or_equal:today',
            'tgl_kembali' => 'required|date|after:tgl_sewa',
        ]);

        $alat = Alat::findOrFail($id);
        
        // Hitung durasi hari pinjam
        $tglSewa = Carbon::parse($request->tgl_sewa);
        $tglKembali = Carbon::parse($request->tgl_kembali);
        $durasi = $tglSewa->diffInDays($tglKembali);

        // Hitung total harga
        $totalHarga = $alat->harga_sewa * $durasi;

        // Simpan Transaksi Otomatis mencakup pelaku (user_id) dan waktu
        Transaksi::create([
            'user_id' => auth()->id(), // Mencatat pelaku otomatis
            'pelanggan_id' => null,     // Dikosongkan karena menggunakan akun user
            'alat_id' => $alat->id,
            'tgl_sewa' => $request->tgl_sewa,
            'tgl_kembali' => $request->tgl_kembali,
            'total_harga' => $totalHarga,
            'status' => 'dipinjam',
        ]);

        // Kurangi stok barang
        $alat->decrement('stok');

        return redirect()->route('customer.riwayat')->with('success', 'Penyewaan alat berhasil direkam otomatis!');
    }

    // 3. Menampilkan Riwayat Transaksi Milik Sendiri (Memenuhi Poin 9 UAS)
    public function riwayat()
    {
        // Hanya mengambil transaksi milik user yang sedang login
        $transaksis = Transaksi::with('alat')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('customer.riwayat', compact('transaksis'));
    }
}