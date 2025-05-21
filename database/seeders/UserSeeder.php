<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = new User();
        $admin->full_name = 'Admin Adminovic';
        $admin->email = 'admin@pwa.rs';
        $admin->password = Hash::make('admin123');
        $admin->role = 'admin';
        $admin->save();

        $editor = new User();
        $editor->full_name = 'Edita Uredjivac';
        $editor->email = 'editor@pwa.rs';
        $editor->password = Hash::make('editor123');
        $editor->role = 'editor';
        $editor->save();

        $user1 = new User();
        $user1->full_name = 'Petar Korisnik';
        $user1->email = 'user@pwa.rs';
        $user1->password = Hash::make('user123');
        $user1->role = 'registered';
        $user1->save();

        $user2 = new User();
        $user2->full_name = 'Marko Test';
        $user2->email = 'marko@test.com';
        $user2->password = Hash::make('test123');
        $user2->role = 'registered';
        $user2->save();

        $user3 = new User();
        $user3->full_name = 'Jelena Primer';
        $user3->email = 'jelena@test.com';
        $user3->password = Hash::make('test123');
        $user3->role = 'registered';
        $user3->save();
    }
}
