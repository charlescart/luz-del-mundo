<?php

use Illuminate\Database\Seeder;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['code' => 'USD', 'description' => 'Dolares Americanos'],
            ['code' => 'BS', 'description' => 'Bolivar Soberano']
        ];

        foreach ($data as $currency) {
            factory(\App\Currency::class)->create([
                'code' => $currency['code'],
                'description' => $currency['description']
            ]);
        }
    }
}
