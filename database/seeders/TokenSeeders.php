<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;
class TokenSeeders extends Seeder
{
    public function run()
    {
        //syntax to get date within a year

        DB::table('api_key')->insert([
            'key' => 'razkyfebriansyah#t31tg42s',
        ]);

        DB::table('api_key')->insert([
            'key' => 'firriezkeyefaq',
        ]);

    }
}
