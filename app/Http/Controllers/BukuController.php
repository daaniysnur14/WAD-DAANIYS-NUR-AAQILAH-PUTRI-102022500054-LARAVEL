<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    private function aturan()
    {
        return [
            'judul'        => 'required|max:150',
            'isbn'         => 'required|max:20',
            'tahun_terbit' => 'required|integer',
            'pengarang'    => 'required|max:100',
            'kategori'     => 'required|max:50',
        ];
    }

    // READ
    public function index()
    {
        $buku = Buku::orderBy('id_buku')->get();

        $total        = $buku->count();
        $pengarang    = $buku->pluck('pengarang')->unique()->count();
        $kategori     = $buku->pluck('kategori')->unique()->count();
        $tahunTerbaru = $buku->max('tahun_terbit');

        return view('buku.index', compact('buku', 'total', 'pengarang', 'kategori', 'tahunTerbaru'));
    }

    // CREATE (form)
    public function create()
    {
        return view('buku.form');
    }

    // CREATE (simpan)
    public function store(Request $request)
    {
        Buku::create($request->validate($this->aturan()));
        return redirect()->route('buku.index')->with('sukses', 'Buku berhasil ditambahkan!');
    }

    // UPDATE (form)
    public function edit(Buku $buku)
    {
        return view('buku.form', compact('buku'));
    }

    // UPDATE (simpan)
    public function update(Request $request, Buku $buku)
    {
        $buku->update($request->validate($this->aturan()));
        return redirect()->route('buku.index')->with('sukses', 'Buku berhasil diperbarui!');
    }

    // DELETE
    public function destroy(Buku $buku)
    {
        $buku->delete();
        return redirect()->route('buku.index')->with('sukses', 'Buku berhasil dihapus!');
    }
}