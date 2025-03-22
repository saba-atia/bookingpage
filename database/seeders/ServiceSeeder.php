<?php

namespace Database\Seeders;

use App\Models\service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run()
    {
        // إضافة غرف وخدمات وهمية
        Service::create([
            'name' => 'Standard Single Room',
            'description' => 'A comfortable single room with basic amenities.',
            'price' => 100.00,
            'is_available' => true,
            'room_type' => 'single',
            'breakfast' => true,
            'wifi' => true,
        ]);
    
        Service::create([
            'name' => 'Deluxe Double Room',
            'description' => 'A luxurious double room with premium amenities.',
            'price' => 200.00,
            'is_available' => true,
            'room_type' => 'double',
            'breakfast' => true,
            'lunch' => true,
            'dinner' => true,
            'wifi' => true,
            'gym' => true,
            'pool' => true,
        ]);
    
        Service::create([
            'name' => 'Executive Suite',
            'description' => 'An executive suite with a living area and premium services.',
            'price' => 300.00,
            'is_available' => true,
            'room_type' => 'suite',
            'breakfast' => true,
            'lunch' => true,
            'dinner' => true,
            'room_service' => true,
            'parking' => true,
            'wifi' => true,
            'gym' => true,
            'pool' => true,
        ]);
    }
}
