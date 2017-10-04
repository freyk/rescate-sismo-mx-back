<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected $toTruncate = [
        'persons'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment() === 'production') {
            exit('I just stopped you getting fired.');
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        $this->cleanDatabase();

        $this->call(PersonsTableSeeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

    private function cleanDatabase()
    {
        foreach ($this->toTruncate as $table) {
            DB::table($table)->truncate();
        }
    }
}
