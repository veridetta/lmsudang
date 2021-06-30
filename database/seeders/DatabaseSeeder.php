<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([UsersTableSeeder::class]);
        $this->call([AcademicSeeder::class]);
        $this->call([GradeSeeder::class]);
        $this->call([TeacherSeeder::class]);
        $this->call([ScheduleSeeder::class]);
        $this->call([StudentSeeder::class]);
        $this->call([AttendanceSeeder::class]);
        $this->call([StaffSeeder::class]);
        $this->call([TaskSeeder::class]);
    }
}
