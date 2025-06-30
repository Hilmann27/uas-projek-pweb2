<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    public function index()
    {
        if (!session('admin_id')) {
            return redirect('/login')->withErrors(['login' => 'Silakan login dulu.']);
        }

        $keuangans = Keuangan::all();
        return view('keuangan.index', compact('keuangans'));
    }

    public function create()
    {
        if (!session('admin_id')) {
            return redirect('/login')->withErrors(['login' => 'Silakan login dulu.']);
        }

        return view('keuangan.create');
    }

    public function store(Request $request)
    {
        if (!session('admin_id')) {
            return redirect('/login')->withErrors(['login' => 'Silakan login dulu.']);
        }

        $request->validate([
            'jenis' => 'required|in:masuk,keluar',
            'jumlah' => 'required|integer',
            'tanggal' => 'required|date',
            'keterangan' => 'required'
        ]);

        Keuangan::create($request->all());
        return redirect()->route('keuangan.index')->with('success', 'Data keuangan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        if (!session('admin_id')) {
            return redirect('/login')->withErrors(['login' => 'Silakan login dulu.']);
        }

        $keuangan = Keuangan::findOrFail($id);
        return view('keuangan.edit', compact('keuangan'));
    }

    public function update(Request $request, $id)
    {
        if (!session('admin_id')) {
            return redirect('/login')->withErrors(['login' => 'Silakan login dulu.']);
        }

        $keuangan = Keuangan::findOrFail($id);

        $request->validate([
            'jenis' => 'required|in:masuk,keluar',
            'jumlah' => 'required|integer',
            'tanggal' => 'required|date',
            'keterangan' => 'required'
        ]);

        $keuangan->update($request->all());
        return redirect()->route('keuangan.index')->with('success', 'Data keuangan berhasil diubah.');
    }

    public function destroy($id)
    {
        if (!session('admin_id')) {
            return redirect('/login')->withErrors(['login' => 'Silakan login dulu.']);
        }

        $keuangan = Keuangan::findOrFail($id);
        $keuangan->delete();
        return redirect()->route('keuangan.index')->with('success', 'Data keuangan berhasil dihapus.');
    }
}
