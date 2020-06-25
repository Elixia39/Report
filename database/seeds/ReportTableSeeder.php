<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reports')->insert([
            'folder_id' => 1,
            'report_date' => Carbon::now(),
            'medicines' => "朝",
            'curricilum1' => "test1",
            'curricilum2' => "test2",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
