<?php

use Illuminate\Database\Seeder;
use Laracasts\TestDummy\Factory as TestDummy;

class PointsTableSeeder extends Seeder
{

    public function run()
    {
      \DB::table('points')->delete();

      \DB::table('points')->insert(array (
          0 =>
          array (
            'id' => 1,
            'machine_id' => 1,
            'name' => 'p1',
          ),
          1 =>
          array (
            'id' => 2,
            'machine_id' => 1,
            'name' => 'p2',
          ),
          2 =>
          array (
            'id' => 3,
            'machine_id' => 2,
            'name' => 'p3',
          ),
          3 =>
          array (
            'id' => 4,
            'machine_id' => 2,
            'name' => 'p4',
          ),
          4 =>
          array (
            'id' => 5,
            'machine_id' => 3,
            'name' => 'p5',
          ),
          5 =>
          array (
            'id' => 6,
            'machine_id' => 3,
            'name' => 'p6',
          ),
          6 =>
          array (
            'id' => 7,
            'machine_id' => 4,
            'name' => 'p7',
          ),
          7 =>
          array (
            'id' => 8,
            'machine_id' => 4,
            'name' => 'p8',
          ),
        ));
    }
}
