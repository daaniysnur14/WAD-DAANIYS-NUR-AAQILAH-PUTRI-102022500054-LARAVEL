<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>PENGELOLAAN MASTER DATA BUKU</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body { background-color: white; display: block; }
        table { width: 100%; border-collapse: collapse; }
        th { background-color: rgb(240, 200, 205); border: 1px solid black; }
        td { border: 1px solid black; padding: 8px 12px; }
        .aksi a, .aksi button { display: inline-block; width: auto; margin: 0; padding: 6px 12px; font-size: 14px; border-radius: 6px; text-decoration: none; }
        .aksi a { background: #0d6efd; color: white; }
        .aksi form { display: inline; }
    </style>
</head>
<body>

<h1><center>KATALOG BUKU</center></h1>

<p style="font-size: 18px;">
    Selamat datang di halaman Katalog Buku. Halaman ini menyajikan daftar lengkap master data buku perpustakaan yang mencakup informasi judul, nomor ISBN, tahun terbit, hingga nama pengarang untuk memudahkan pencarian referensi.
</p>

@if (session('sukses'))
    <div class="pesan sukses">{{ session('sukses') }}</div>
@endif

<table border="1" cellpadding="8" style="margin-bottom: 20px; text-align: center;">
    <tr>
        <td style="background-color: #f8d7da;"><b>Total Buku</b><br>{{ $total }}</td>
        <td style="background-color: #d1e7dd;"><b>Pengarang</b><br>{{ $pengarang }}</td>
        <td style="background-color: #cff4fc;"><b>Kategori</b><br>{{ $kategori }}</td>
        <td style="background-color: #fff3cd;"><b>Tahun Terbaru</b><br>{{ $tahunTerbaru }}</td>
    </tr>
</table>

<table>
    <tr>
        <th>Nomor</th>
        <th>Judul Buku</th>
        <th>ISBN</th>
        <th>Tahun Terbit</th>
        <th>Pengarang</th>
        <th>Kategori</th>
        <th>Aksi</th>
    </tr>
    @forelse ($buku as $b)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $b->judul }}</td>
        <td>{{ $b->isbn }}</td>
        <td>{{ $b->tahun_terbit }}</td>
        <td>{{ $b->pengarang }}</td>
        <td>{{ $b->kategori }}</td>
        <td class="aksi">
            <a href="{{ route('buku.edit', $b->id_buku) }}">Edit</a>
            <form action="{{ route('buku.destroy', $b->id_buku) }}" method="POST"
                  onsubmit="return confirm('Yakin hapus buku ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" style="background:#dc3545;">Hapus</button>
            </form>
        </td>
    </tr>
    @empty
    <tr><td colspan="7" style="text-align:center;">Belum ada data buku.</td></tr>
    @endforelse
</table>
<br>
<p><a href="{{ route('buku.create') }}">Klik di sini untuk menuju halaman tambah buku</a></p>

</body>
</html>