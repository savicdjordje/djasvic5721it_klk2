<?php

namespace Database\Seeders;

use App\Models\ServiceType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $t1 = new ServiceType();
        $t1->name = 'Poliranje';
        $t1->description = 'Usluge spoljašnjeg i unutrašnjeg poliranja';
        $t1->save();

        $t2 = new ServiceType();
        $t2->name = 'Farbanje';
        $t2->description = 'Farbanje delova vozila';
        $t2->save();

        $t3 = new ServiceType();
        $t3->name = 'Lakiranje';
        $t3->description = 'Lakiranje delova vozila';
        $t3->save();

        $t4 = new ServiceType();
        $t4->name = 'Pranje vozila';
        $t4->description = 'Ručno ili automatsko pranje vozila';
        $t4->save();

        $t5 = new ServiceType();
        $t5->name = 'Dubinsko čišćenje';
        $t5->description = 'Temeljno čišćenje unutrašnjosti automobila';
        $t5->save();
    }
}
