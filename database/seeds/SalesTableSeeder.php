<?php

use App\Models\Trading\Sale;
use Illuminate\Database\Seeder;

class SalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sales = [
			['item_id' => 1, 'price' => 10.00, 'daily_limit' => 0],
        ];

        foreach ($sales as $key => $sale) {
			Sale::create($sale);
		}
    }
}
