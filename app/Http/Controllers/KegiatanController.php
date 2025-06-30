<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::all();
        return view('kegiatan.index', compact('kegiatans'));
    }

    public function create()
    {
        return view('kegiatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required|date',
            'foto' => 'nullable|image|max:2048'
        ]);

        $data = $request->only(['nama_kegiatan', 'deskripsi', 'tanggal']);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto_kegiatan', 'public');
        }

        Kegiatan::create($data);
        return redirect()->route('kegiatan.index')->with('success', 'Data kegiatan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('kegiatan.edit', compact('kegiatan'));
    }

    public function update(Request $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $request->validate([
            'nama_kegiatan' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required|date',
            'foto' => 'nullable|image|max:2048'
        ]);

        $data = $request->only(['nama_kegiatan', 'deskripsi', 'tanggal']);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto_kegiatan', 'public');
        }

        $kegiatan->update($data);
        return redirect()->route('kegiatan.index')->with('success', 'Data kegiatan berhasil diubah.');
    }

    public function destroy($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->delete();
        return redirect()->route('kegiatan.index')->with('success', 'Data kegiatan berhasil dihapus.');
    }
}

