<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\Certificate;
use App\Models\Document;
use App\Models\Feedback;
use App\Models\Freelancer;
use App\Models\PersonalData;
use App\Models\Purchaser;
use App\Models\Task;
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
        $items = 10; // сколько дополнительно строк с персональной информацией будет создано
        PersonalData::factory($items)->create();
        $keys = PersonalData::all('email')->pluck('email'); // вся почта
        for ($i = 0; $i < sizeof($keys); $i++) {
            // банально нельзя создавать пользователей с одинаковой почтой, так что вот
            if(!User::where('email', $keys[$i])->exists()) {
                User::factory()->create(['email' => $keys[$i]]);
                $pr = Purchaser::factory()->create(['email' => $keys[$i]]);
                Freelancer::factory()->create(['email' => $keys[$i]]);
                Card::factory()->count(3)->create(['user' => $keys[$i]]);
                Document::factory()->count(5)->create(['user' => $keys[$i]]);
                Certificate::factory()->count(5)->create(['user' => $keys[$i]]);
                $tds = TaskData::factory(5)->create();
                $td_keys = $tds->modelKeys();
                for ($j = 0; $j < sizeof($td_keys); $j++) {
                    Task::factory()->create(['task_data'=> $td_keys[$j], 'purchaser' => $pr->id]);
                }
            }
        }
        $fr_keys = Freelancer::all('id')->pluck('id');
        $ts_keys = Purchaser::all('id')->pluck('id');
        for ($i = 0; $i < sizeof($fr_keys); $i++){
            for ($j = 0; $j < sizeof($ts_keys); $j++){
                $td = TaskData::factory()->create();
                Feedback::create(['task_data' => $td->id, 'freelancer' => $fr_keys[$i], 'task' => $ts_keys[$j]]);
            }
        }
    }
}
