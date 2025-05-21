<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $s1 = new Service();
        $s1->service_type_id = 3;
        $s1->name = 'Lakiranje haube';
        $s1->description = 'Temeljno lakiranje haube automobila.';
        $s1->price = 12000;
        $s1->image = 'images/lakiranje_haube.jpg';
        $s1->published = true;
        $s1->featured = true;
        $s1->save();

        $s2 = new Service();
        $s2->service_type_id = 1;
        $s2->name = 'Poliranje farova';
        $s2->description = 'Profesionalno poliranje prednjih farova.';
        $s2->price = 4000;
        $s2->image = 'images/poliranje_farova.jpg';
        $s2->published = true;
        $s2->featured = false;
        $s2->save();

        $s3 = new Service();
        $s3->service_type_id = 3;
        $s3->name = 'Kompletno lakiranje';
        $s3->description = 'Lakiranje celog vozila sa izborom boje.';
        $s3->price = 35000;
        $s3->image = 'images/full_lakiranje.jpg';
        $s3->published = true;
        $s3->featured = true;
        $s3->save();

        $s4 = new Service();
        $s4->service_type_id = 4;
        $s4->name = 'Ekspres pranje';
        $s4->description = 'Brzo spoljašnje i unutrašnje pranje vozila.';
        $s4->price = 1500;
        $s4->image = 'images/pranje.jpg';
        $s4->published = true;
        $s4->featured = false;
        $s4->save();

        $s5 = new Service();
        $s5->service_type_id = 5;
        $s5->name = 'Dubinsko čišćenje sedišta';
        $s5->description = 'Dubinsko pranje i čišćenje sedišta.';
        $s5->price = 5000;
        $s5->image = 'images/ciscenje.jpg';
        $s5->published = true;
        $s5->featured = true;
        $s5->save();
    }
}
