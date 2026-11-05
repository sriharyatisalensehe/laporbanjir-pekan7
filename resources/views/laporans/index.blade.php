@extends('layouts.app')
@section('title', 'Daftar Laporan Banjir')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Daftar Laporan Banjir Warga</h2>
    <a href="{{ route('laporans.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i>Buat Laporan Baru
    </a>
</div>

<table class="table table-bordered align-middle">
    <thead class="table-light">
        <tr>
            <th>No</th>
            <th>Foto</th>
            <th>Pelapor</th>
            <th>Lokasi / Kecamatan</th>
            <th>Tinggi Air</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($laporans as $laporan)
        <tr>
            <td>{{ $laporans->firstItem() + $loop->index }}</td>
            <td>
                @if ($laporan->foto)
                    <img src="{{ asset('storage/' . $laporan->foto) }}" alt="Foto Banjir" width="60" height="60" class="rounded object-fit-cover">
                @else
                    <span class="text-muted">Tidak ada</span>
                @endif
            </td>
            <td>
                <strong>{{ $laporan->nama_pelapor }}</strong><br>
                <small class="text-muted">{{ $laporan->no_hp }}</small>
            </td>
            <td>
                {{ $laporan->lokasi }}<br>
                <small class="text-muted">Kec. {{ $laporan->kecamatan }}</small>
            </td>
            <td>{{ $laporan->tinggi_air }} cm</td>
            <td>
                @if ($laporan->status == 'Menunggu')
                    <span class="badge bg-warning text-dark">Menunggu</span>
                @elseif ($laporan->status == 'Diproses')
                    <span class="badge bg-info text-dark">Diproses</span>
                @else
                    <span class="badge bg-success">Selesai</span>
                @endif
            </td>
            <td>
                <a href="{{ route('laporans.show', $laporan) }}" class="btn btn-info btn-sm">Lihat</a>
                @auth
                    <a href="{{ route('laporans.edit', $laporan) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('laporans.destroy', $laporan) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus laporan ini?')">Hapus</button>
                    </form>
                @endauth
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center">Belum ada data laporan banjir.</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $laporans->links() }}
@endsection