<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\Certificate;
use App\Models\Document;
use App\Models\Freelancer;
use App\Models\PersonalData;
use App\Models\Purchaser;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $items = 10; // сколько дополнительно строк с персональной информацией будет создано
        PersonalData::factory($items)->create();
        $keys = PersonalData::all('login')->modelKeys(); // все логины
        for ($i = 0; $i < sizeof($keys); $i++) {
            // банально нельзя создавать пользователей с одинаковыми логинами, так что вот
            if(!User::where('login', $keys[$i])->exists()) {
                User::factory()->create(['login' => $keys[$i]]);
                $key = User::where('login', $keys[$i])->first('email'); // это почта
                Purchaser::factory()->create(['email' => $key]);
                Freelancer::factory()->create(['email' => $key]);
                Card::factory()->count(3)->create(['user' => $key]);
                Document::factory()->count(5)->create(['user' => $key]);
                Certificate::factory()->count(5)->create(['user' => $key]);
            }
        }
    }
}
