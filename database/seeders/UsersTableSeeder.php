<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;
class UsersTableSeeder extends Seeder
{
    public function run()
    {
        //syntax to get date within a year
        $dt = Carbon::today()->subDays(rand(0, 365));
        $dateNow = $dt->toDateTimeString();

        DB::table('users')->insert([
            'name' => 'Henry Augusta Harsono',
            'role' => '1',
            'contact' => '088223738700',
            'email' => 'henryaugusta4@email.com',
            'profile_url' => '',
            'date_birth' => "$dateNow",
            'gender' => 1,
            'status' => 1,
            'contact_token' => '',
            'password' => bcrypt('password'),
            'created_at' => Carbon::now()->timezone('Asia/Bangkok')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->timezone('Asia/Bangkok')->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name' => 'Fairus Zhilvan Adhipramana',
            'role' => '2',
            'contact' => '088223738701',
            'email' => 'zhilvanbitcoin@email.com',
            'profile_url' => '',
            'date_birth' => "$dateNow",
            'gender' => 1,
            'status' => 1,
            'contact_token' => '',
            'password' => bcrypt('password'),
            'created_at' => Carbon::now()->timezone('Asia/Bangkok')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->timezone('Asia/Bangkok')->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name' => 'Aurora Margareta Rompas',
            'role' => '3',
            'contact' => '088223738702',
            'email' => 'rora@email.com',
            'profile_url' => '',
            'date_birth' => "$dateNow",
            'gender' => 0,
            'status' => 1,
            'contact_token' => '',
            'password' => bcrypt('password'),
            'created_at' => Carbon::now()->timezone('Asia/Bangkok')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->timezone('Asia/Bangkok')->format('Y-m-d H:i:s')
        ]);


    }
}
