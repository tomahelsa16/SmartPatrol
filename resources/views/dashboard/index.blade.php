@extends('layouts.layout')

@section('title', 'Dashboard')
@section('header-title', 'Monitor Patroli Hutan Real-Time')

@section('styles')
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="dashboard-grid">

        <div class="card live-view-card">
            <h3><i class="fas fa-video"></i> Siaran Langsung</h3>
            <div class="live-view">
                <div class="camera-container" id="cameraContainer">
                    <div class="camera">
                        <iframe src="http://192.168.4.1:81/stream" frameborder="0" allowfullscreen
                            style="width:100%; height:150px; border-radius:8px;">
                        </iframe>
                        <div class="camera-info">
                            <p>Suhu: 27°C</p>
                            <p>Koordinat: Lat: -6.174, Long: 106.829</p>
                        </div>
                        <a href="#" class="control-btn"><i class="fas fa-gamepad"></i></a>
                    </div>
                </div>
                
                @if($totalAktif > 4)
                <div id="cameraSlider" class="camera-slider">
                    <button class="slider-btn prev" onclick="moveSlide(-1)">&#10094;</button>
                    <button class="slider-btn next" onclick="moveSlide(1)">&#10095;</button>
                </div>
                @endif
            </div>
        </div>

        <div class="card robot-status-card">
            <h3><i class="fas fa-robot"></i> Monitor Penugasan Robot</h3>
            <p>Robot Beroperasi: <span id="active-robot-count" class="count-highlight">{{ $totalAktif }}</span> unit</p>
            
            <div class="robot-table-container">
                <table class="robot-status-table">
                    <thead>
                        <tr>
                            <th>ID Robot</th>
                            <th>Waktu</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="robot-status-tbody">
                        @forelse($robotAktif as $item)
                            <tr>
                                <td>{{ $item->robot->robot_id }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->waktu_operasional)->format('d-m-Y, H:i') }}</td>
                                <td class="
                                    @if($item->status == 'Berlangsung') txt-progress
                                    @elseif($item->status == 'Menunggu') txt-waiting
                                    @elseif($item->status == 'Dibatalkan') txt-cancelled
                                    @else txt-done @endif
                                ">
                                    {{ $item->status }}
                                </td>
                                <td>
                                    <button class="btn-detail-table" onclick="openModal('modalDetailDash{{ $item->id }}')">
                                        <i class="fas fa-eye"></i>Detail
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="text-align: center;">Tidak ada data penugasan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @foreach($robotAktif as $item)
    <div id="modalDetailDash{{ $item->id }}" class="modal">
        <div class="modal-content modal-box">

            <div class="modal-header">
                <h3>Detail Operasional</h3>
                <span class="close" onclick="closeModal('modalDetailDash{{ $item->id }}')">&times;</span>
            </div>

            <div class="form-group">
                <label>ID Robot</label>
                <input value="{{ $item->robot->robot_id }}" readonly>
            </div>

            <div class="form-group">
                <label>Waktu Operasional</label>
                <input value="{{ \Carbon\Carbon::parse($item->waktu_operasional)->format('d-m-Y, H:i') }}" readonly>
            </div>

            <div class="form-group">
                <label>Rute Patroli</label>
                <input value="{{ implode(' → ', $item->rutes->pluck('nama_tempat')->toArray()) }}" readonly>
            </div>

            <div class="form-group">
                <label>Status Saat Ini</label>
                <input class="@if($item->status == 'Berlangsung') txt-progress
                    @elseif($item->status == 'Menunggu') txt-waiting
                    @elseif($item->status == 'Dibatalkan') txt-cancelled
                    @else txt-done @endif" 
                    value="{{ $item->status }}" readonly>
            </div>

            <div class="modal-footer">
                <button class="btn-robot-detail" disabled>
                    <i class="fas fa-robot"></i> Detail Robot
                </button>
            </div>

        </div>
    </div>
    @endforeach
@endsection

@section('scripts')
    <script>
        function openModal(id) {
            const modal = document.getElementById(id);
            if(modal) modal.style.display = 'flex';
        }

        function closeModal(id) {
            const modal = document.getElementById(id);
            if(modal) modal.style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target.className === 'modal') {
                event.target.style.display = 'none';
            }
        }
    </script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
@endsection