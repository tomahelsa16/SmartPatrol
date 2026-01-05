<?php

return [

    // =====================================================
    // FITUR WAJIB: Navigasi
    // =====================================================
    'navigasi' => [
        'gps',
        'imu',
        'kompas',
        'lidar',
        'ultrasonic',
    ],

    // =====================================================
    // FITUR WAJIB: Sensor Lingkungan
    // =====================================================
    'sensor_lingkungan' => [
        'sensor_suhu',
        'sensor_kelembapan',
        'sensor_gas',
        'sensor_udara',
        'sensor_tanah',
    ],

    // =====================================================
    // FITUR WAJIB: Sistem Kamera
    // =====================================================
    'sistem_kamera' => [
        'rgb_camera',
        'infra_camera',
        'thermal_camera',
    ],

    // =====================================================
    // FITUR TAMBAHAN: AI & Keamanan
    // =====================================================
    'ai_keamanan' => [
        'motion_detection',
        'ai_object_detection',
        'animal_detection',
        'perimeter_alert',
    ],

    // =====================================================
    // FITUR TAMBAHAN: Energi & Proteksi
    // =====================================================
    'energi_proteksi' => [
        'battery_sensor',
        'auto_return_base',
        'temp_protection',
    ],

    // =====================================================
    // FITUR TAMBAHAN: Sistem Komunikasi
    // =====================================================
    'komunikasi' => [
        'lte_module',
        'lora_module',
        'wifi_module',
    ],
];
