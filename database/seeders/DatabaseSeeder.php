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
        $keys = PersonalData::all('email')->pluck('email'); // вся почта
        for ($i = 0; $i < sizeof($keys); $i++) {
            // банально нельзя создавать пользователей с одинаковой почтой, так что вот
            if(!User::where('email', $keys[$i])->exists()) {
                User::factory()->create(['email' => $keys[$i]]);
                Purchaser::factory()->create(['email' => $keys[$i]]);
                Freelancer::factory()->create(['email' => $keys[$i]]);
                Card::factory()->count(3)->create(['user' => $keys[$i]]);
                Document::factory()->count(5)->create(['user' => $keys[$i]]);
                Certificate::factory()->count(5)->create(['user' => $keys[$i]]);
            }
        }
    }
}
