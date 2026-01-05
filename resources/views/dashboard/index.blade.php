@extends('layouts.layout')

@section('title', 'Dashboard')
@section('header-title', 'Monitor Patroli Hutan Real-Time')

@section('styles')
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="dashboard-grid">

        <!-- CARD: Live View -->
        <div class="card live-view-card">
            <h3><i class="fas fa-video"></i> Siaran Langsung</h3>
            <div class="live-view">
                <!-- Kamera akan dimuat dinamis berdasarkan jumlah robot -->
                <div class="camera-container" id="cameraContainer">
                    <!-- Kamera 1 -->
                    <div class="camera">
                        <iframe src="http://192.168.4.1:81/stream" frameborder="0" allowfullscreen
                            style="width:100%; height:150px; border-radius:8px;">
                            <div class="camera-info">
                                <p>Suhu: 27°C</p>
                                <p>Koordinat: Lat: -6.174, Long: 106.829</p>
                            </div>
                        </iframe>
                        <!-- Kontrol Manual menggunakan logo (ikon) -->
                        <a href="#" class="control-btn"><i class="fas fa-gamepad"></i></a> <!-- Ikon gear -->
                    </div>
                    <!-- Kamera 2, 3, 4... akan dimuat sesuai jumlah robot -->
                </div>
                <!-- Jika lebih dari 4 kamera, tampilkan slider -->
                <div id="cameraSlider" class="camera-slider">
                    <button class="slider-btn prev" onclick="moveSlide(-1)">&#10094;</button>
                    <button class="slider-btn next" onclick="moveSlide(1)">&#10095;</button>
                </div>
            </div>
        </div>

        <!-- CARD: Status Robot -->
        <div class="card robot-status-card">
            <h3><i class="fas fa-robot"></i> Robot Sedang Beroperasi</h3>
            <p>Total Aktif: <span id="active-robot-count" class="count-highlight">0</span> unit</p>
            <div class="robot-table-container">
                <table class="robot-status-table">
                    <thead>
                        <tr>
                            <th>ID Robot</th>
                            <th>Waktu Operasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="robot-status-tbody">
                        <!-- Data Dummy untuk Robot 1 -->
                        <tr>
                            <td>R-001</td>
                            <td>Operasi: 2 Jam</td>
                            <td><a href="#detailsR001" class="details-link">Detail</a></td>
                        </tr>

                        <!-- Data Dummy untuk Robot 2 -->
                        <tr>
                            <td>R-002</td>
                            <td>Operasi: 1 Jam 30 Menit</td>
                            <td><a href="#detailsR002" class="details-link">Detail</a></td>
                        </tr>

                        <!-- Data Dummy untuk Robot 3 -->
                        <tr>
                            <td>R-003</td>
                            <td>Operasi: 1 Jam</td>
                            <td><a href="#detailsR003" class="details-link">Detail</a></td>
                        </tr>

                        <!-- Data Dummy untuk Robot 4 -->
                        <tr>
                            <td>R-004</td>
                            <td>Operasi: 30 Menit</td>
                            <td><a href="#detailsR004" class="details-link">Detail</a></td>
                        </tr>

                        <!-- Data Dummy untuk Robot 5 -->
                        <tr>
                            <td>R-005</td>
                            <td>Operasi: 15 Menit</td>
                            <td><a href="#detailsR005" class="details-link">Detail</a></td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>

    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/dashboard.js') }}"></script>
@endsection
