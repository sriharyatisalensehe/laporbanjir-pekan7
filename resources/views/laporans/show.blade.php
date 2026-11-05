@extends('layouts.app')
@section('title', 'Detail Laporan Banjir')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Detail Informasi Laporan Banjir</div>
            <div class="card-body text-center">
                @if ($laporan->foto)
                    <img src="{{ asset('storage/' . $laporan->foto) }}" alt="Foto Bukti" width="250" class="rounded mb-3 shadow-sm">
                @endif
                
                <h4 class="card-title text-primary mb-3">Lokasi: {{ $laporan->lokasi }} (Kec. {{ $laporan->kecamatan }})</h4>
                
                <div class="text-start px-4">
                    <p class="card-text"><strong>Nama Pelapor:</strong> {{ $laporan->nama_pelapor }} ({{ $laporan->no_hp }})</p>
                    <p class="card-text"><strong>Tinggi Air:</strong> {{ $laporan->tinggi_air }} cm</p>
                    <p class="card-text"><strong>Status Penanganan:</strong> 
                        @if ($laporan->status == 'Menunggu')
                            <span class="badge bg-warning text-dark">Menunggu</span>
                        @elseif ($laporan->status == 'Diproses')
                            <span class="badge bg-info text-dark">Diproses</span>
                        @else
                            <span class="badge bg-success">Selesai</span>
                        @endif
                    </p>
                    <p class="card-text"><strong>Keterangan:</strong> {{ $laporan->keterangan ?? '-' }}</p>
                    <p class="card-text"><small class="text-muted">Laporan dibuat pada: {{ $laporan->created_at->format('d-m-Y H:i') }}</small></p>
                </div>

                <div class="mt-4">
                    @auth
                        <a href="{{ route('laporans.edit', $laporan) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('laporans.destroy', $laporan) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus laporan ini?')">Hapus</button>
                        </form>
                    @endauth
                    <a href="{{ route('laporans.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection