<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($buku) ? 'EDIT BUKU' : 'TAMBAH BUKU' }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="card">
    <h2>📚 {{ isset($buku) ? 'Form Edit Buku' : 'Form Tambah Buku' }}</h2>

    @if ($errors->any())
        <div class="pesan gagal">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif

    <form method="POST"
          action="{{ isset($buku) ? route('buku.update', $buku->id_buku) : route('buku.store') }}">
        @csrf
        @if (isset($buku))
            @method('PUT')
        @endif

        <label>Judul Buku</label>
        <input type="text" name="judul" value="{{ old('judul', $buku->judul ?? '') }}" required>

        <label>ISBN</label>
        <input type="text" name="isbn" value="{{ old('isbn', $buku->isbn ?? '') }}" required>

        <label>Tahun Terbit</label>
        <input type="number" name="tahun_terbit" value="{{ old('tahun_terbit', $buku->tahun_terbit ?? '') }}" required>

        <label>Pengarang</label>
        <input type="text" name="pengarang" value="{{ old('pengarang', $buku->pengarang ?? '') }}" required>

        <label>Kategori</label>
        @php
            $daftar = ['Novel','Komik','Pendidikan','Teknologi','Kesehatan','Komedi','Kartun','Kuliner','Lainnya'];
            $dipilih = old('kategori', $buku->kategori ?? '');
        @endphp
        <select name="kategori" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach ($daftar as $k)
                <option value="{{ $k }}" {{ $dipilih == $k ? 'selected' : '' }}>{{ $k }}</option>
            @endforeach
        </select>

        <button type="submit">Simpan</button>
    </form>

    <p style="text-align:center;"><a href="{{ route('buku.index') }}">← Kembali ke Katalog</a></p>
</div>

</body>
</html>