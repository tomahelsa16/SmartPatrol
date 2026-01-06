@extends('layouts.layout')

@section('title', 'Tambah Robot')
@section('header-title', 'Tambah Robot')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/tambah/robot.create.css') }}">
@endsection

@section('content')

<div class="robot-container">

    <div class="header">
        <h3><i class="fas fa-robot"></i> Tambah Data Robot</h3>
    </div>

    <form action="{{ route('robot.store') }}" method="POST" class="robot-form-page">
        @csrf

        {{-- ID ROBOT --}}
        <div class="form-group">
            <label>ID Robot</label>
            <input type="text" name="robot_id" required>
        </div>

        <h4 class="section-title">Fitur Robot</h4>

        <div class="feature-section">

            {{-- Navigasi --}}
            <div class="feature-group">
                <label class="feature-title">Navigasi</label>
                <select name="features[]" multiple class="feature-select">
                    <option value="gps">GPS</option>
                    <option value="imu">IMU</option>
                    <option value="kompas">Kompas Digital</option>
                    <option value="lidar">LIDAR</option>
                    <option value="ultrasonic">Ultrasonic</option>
                </select>
            </div>

            {{-- Sensor Lingkungan --}}
            <div class="feature-group">
                <label class="feature-title">Sensor Lingkungan</label>
                <select name="features[]" multiple class="feature-select">
                    <option value="sensor_suhu">Sensor Suhu</option>
                    <option value="sensor_kelembapan">Sensor Kelembapan</option>
                    <option value="sensor_gas">Sensor Gas</option>
                    <option value="sensor_udara">Sensor Udara</option>
                    <option value="sensor_tanah">Sensor Tanah</option>
                </select>
            </div>

            {{-- Sistem Kamera --}}
            <div class="feature-group">
                <label class="feature-title">Sistem Kamera</label>
                <select name="features[]" multiple class="feature-select">
                    <option value="rgb_camera">Kamera RGB</option>
                    <option value="infra_camera">Kamera Infra Merah</option>
                    <option value="thermal_camera">Kamera Thermal</option>
                </select>
            </div>

            {{-- AI --}}
            <div class="feature-group">
                <label class="feature-title">AI & Keamanan</label>
                <select name="features[]" multiple class="feature-select">
                    <option value="motion_detection">Motion Detection</option>
                    <option value="ai_object_detection">Object Detection</option>
                    <option value="animal_detection">Animal Detection</option>
                    <option value="perimeter_alert">Perimeter Alert</option>
                </select>
            </div>

            {{-- Energi --}}
            <div class="feature-group">
                <label class="feature-title">Energi & Proteksi</label>
                <select name="features[]" multiple class="feature-select">
                    <option value="battery_sensor">Sensor Baterai</option>
                    <option value="auto_return_base">Auto Return</option>
                    <option value="temp_protection">Temperature Protection</option>
                </select>
            </div>

        </div>

        <div id="featureError" class="error-message"></div>

        <div class="form-footer">
            {{-- Route FIXED --}}
            <a href="{{ route('tambah_robot') }}" class="btn-cancel-page">Batal</a>
            <button type="submit" class="btn-save-page" id="btnSubmit" disabled>Simpan</button>
        </div>

    </form>

</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.feature-select').select2({
            width: '100%',
            placeholder: "Pilih fitur...",
            allowClear: true,
            closeOnSelect: false
        });

        // Validasi minimal 1 fitur
        $('.feature-select').on('change', function () {
            const selected = $('.feature-select option:selected').length;
            if (selected > 0) {
                $('#btnSubmit').prop('disabled', false);
                $('#featureError').html('');
            } else {
                $('#btnSubmit').prop('disabled', true);
                $('#featureError').html('Pilih minimal satu fitur!');
            }
        });
    });
</script>
@endsection
