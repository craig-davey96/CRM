<?php

use Illuminate\Database\Seeder;

class task_types extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('task_types')->insert([
            'task_type_name' => 'Pending'
        ]);
        DB::table('task_types')->insert([
            'task_type_name' => 'In Progress'
        ]);
        DB::table('task_types')->insert([
            'task_type_name' => 'Initial Testing'
        ]);
        DB::table('task_types')->insert([
            'task_type_name' => 'Final Testing'
        ]);
        DB::table('task_types')->insert([
            'task_type_name' => 'Complete'
        ]);

    }
}
