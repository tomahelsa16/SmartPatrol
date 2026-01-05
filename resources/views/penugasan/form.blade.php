@extends('layouts.layout')

@section('title', 'Tambah Penugasan')
@section('header-title', 'Form Tambah Penugasan')

@section('styles')
    {{-- Menggunakan CSS yang sudah diseragamkan --}}
    <link rel="stylesheet" href="{{ asset('css/penugasan/form.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="header">
        <h3><i class="fas fa-tasks"></i> Tambah Penugasan Baru</h3>
    </div>

    <form class="edit-form" action="{{ route('penugasan.store') }}" method="POST">
        @csrf

        {{-- ========== ROBOT ========== --}}
        <div class="form-group">
            <label>ID Robot</label>
            <select name="robot_id" class="form-control" required>
                <option value="" disabled selected>-- Pilih Robot --</option>
                @foreach ($robots as $r)
                    <option value="{{ $r->id }}">{{ $r->robot_id }}</option>
                @endforeach
            </select>
        </div>

        {{-- ========== JUMLAH TITIK ========== --}}
        <div class="form-group">
            <label>Berapa Titik Lokasi?</label>
            <select id="jumlah_titik" class="form-control" required>
                <option value="" disabled selected>-- Pilih Jumlah Titik (Minimal 3) --</option>
                <option value="3">3 Titik</option>
                <option value="4">4 Titik</option>
                <option value="5">5 Titik</option>
                <option value="6">6 Titik</option>
            </select>
            <small class="helper-text">*Tentukan jumlah rute yang akan dilewati robot.</small>
        </div>

        {{-- ========== WAKTU ========== --}}
        <div class="form-group mt-3">
            <label> Waktu Mulai Operasional</label>
            <input type="datetime-local" name="waktu_operasional" class="form-control" required>
        </div>

        {{-- ========== BUTTONS ========== --}}
        <div class="edit-footer">
            <a href="{{ route('penugasan') }}" class="btn-cancel-page">
                Batal
            </a>
            <button type="submit" class="btn-save-page">
                Simpan
            </button>
        </div>

    </form>
</div>
@endsection

@section('scripts')
<script>
    const ruteData = @json($rutes);

    document.getElementById('jumlah_titik').addEventListener('change', function() {
        let jumlah = parseInt(this.value);
        let container = document.getElementById('dynamic-rute-area');

        container.innerHTML = '';

        if (jumlah < 3) return;

        for (let i = 1; i <= jumlah; i++) {
            let label = "Titik " + i;
            let icon = "fa-map-pin";
            
            if (i === 1) {
                label += " (Mulai)";
                icon = "fa-play-circle";
            }
            if (i === jumlah) {
                label += " (Akhir)";
                icon = "fa-flag-checkered";
            }

            container.innerHTML += `
                <div class="form-group">
                    <label><i class="fas ${icon}"></i> ${label}</label>
                    <select name="titik_${i}" class="form-control" required>
                        <option value="" disabled selected>-- Pilih ${label} --</option>
                        ${ruteData.map(r => `<option value="${r.id}">${r.nama_tempat}</option>`).join("")}
                    </select>
                </div>
            `;
        }
    });
</script>
@endsection