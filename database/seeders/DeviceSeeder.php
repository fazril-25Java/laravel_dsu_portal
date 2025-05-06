<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Device;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Add test data for devices
        Device::create([
            'name' => 'Device A',
            'type' => 'Laptop',
            'description' => 'A high-performance laptop',
            'images' => ['image1.jpg', 'image2.jpg'], // Assuming images is cast as an array
            'status' => 'available',
        ]);

        Device::create([
            'name' => 'Device B',
            'type' => 'Tablet',
            'description' => 'A lightweight tablet',
            'images' => ['image3.jpg', 'image4.jpg'],
            'status' => 'available',
        ]);

        Device::create([
            'name' => 'Device C',
            'type' => 'Smartphone',
            'description' => 'A powerful smartphone',
            'images' => ['image5.jpg', 'image6.jpg'],
            'status' => 'booked',
        ]);
    }
}
