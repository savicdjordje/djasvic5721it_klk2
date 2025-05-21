<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $r1 = new Reservation();
        $r1->user_id = 3;
        $r1->service_id = 1;
        $r1->car_brand = 'Audi';
        $r1->car_model = 'A4';
        $r1->car_plate = 'BG-123-AA';
        $r1->note = 'Molim vas da se obrati pažnja na zadnji deo haube.';
        $r1->scheduled_at = '2025-04-01 10:00:00';
        $r1->approved = false;
        $r1->save();

        $r2 = new Reservation();
        $r2->user_id = 4;
        $r2->service_id = 2;
        $r2->car_brand = 'Toyota';
        $r2->car_model = 'Yaris';
        $r2->car_plate = 'NS-456-BB';
        $r2->note = 'Farovi su veoma izgrebani.';
        $r2->scheduled_at = '2025-04-03 14:30:00';
        $r2->approved = true;
        $r2->save();

        $r3 = new Reservation();
        $r3->user_id = 5;
        $r3->service_id = 3;
        $r3->car_brand = 'BMW';
        $r3->car_model = '320d';
        $r3->car_plate = 'KG-789-CC';
        $r3->note = 'Kompletno lakiranje, boja: metalik siva.';
        $r3->scheduled_at = '2025-04-05 09:00:00';
        $r3->approved = true;
        $r3->save();

        $r4 = new Reservation();
        $r4->user_id = 4;
        $r4->service_id = 4;
        $r4->car_brand = 'Toyota';
        $r4->car_model = 'Yaris';
        $r4->car_plate = 'NS-456-BB';
        $r4->note = 'Potreban brz termin ujutru.';
        $r4->scheduled_at = '2025-04-06 08:00:00';
        $r4->approved = false;
        $r4->save();

        $r5 = new Reservation();
        $r5->user_id = 3;
        $r5->service_id = 5;
        $r5->car_brand = 'Audi';
        $r5->car_model = 'A4';
        $r5->car_plate = 'BG-123-AA';
        $r5->note = 'Unutrašnjost jako zaprljana, fokus na sedištima.';
        $r5->scheduled_at = '2025-04-07 12:00:00';
        $r5->approved = true;
        $r5->save();
    }
}
