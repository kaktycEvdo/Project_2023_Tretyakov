<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\Certificate;
use App\Models\Document;
use App\Models\Freelancer;
use App\Models\Message;
use App\Models\PersonalData;
use App\Models\Purchaser;
use App\Models\TaskData;
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
        PersonalData::factory(10)->create();
        User::factory(10)->create();
        Purchaser::factory(10)->create();
        Freelancer::factory(10)->create();
        Card::factory(20)->create();
        Document::factory(20)->create();
        Certificate::factory(20)->create();
        Message::factory(200)->create();
        TaskData::factory(150)->create();
    }
}
