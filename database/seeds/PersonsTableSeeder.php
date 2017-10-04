<?php

use Illuminate\Database\Seeder;

class PersonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $personStatus = new App\API\v1\Models\PersonStatus;
        $statusOptions = $personStatus->pluck('option');

        foreach (range(1, 30) as $index) {
            factory(App\API\v1\Models\Person::class)->create([
                'status' => $statusOptions->random()
            ]);
        }
    }
}
