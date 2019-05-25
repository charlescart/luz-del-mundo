<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Charles Rodriguez', 'email' => 'charlesrodriguez19@gmail.com'],
            ['name' => 'Aaron Rodriguez', 'email' => 'aaron@gmail.com'],
            ['name' => 'Oriana Rodriguez', 'email' => 'oriana@gmail.com'],
            ['name' => 'Oriannys Rodriguez', 'email' => 'oriannys@gmail.com'],
            ['name' => 'Gonzalo Zavala', 'email' => 'gonzalo@gmail.com'],
            ['name' => 'Charles Rodriguezz', 'email' => 'admin@gmail.com'],
            ['name' => 'Pastor Rodriguez', 'email' => 'pastor@gmail.com'],
        ];

        foreach ($data as $people) {
            $user = factory(App\User::class)->create([
                'name' => $people['name'],
                'email' => $people['email'],
            ]);

            $products = factory(App\Product::class, 20)->create([
                'user_id' => $user->id,
            ]);

            $finances = factory(App\Finance::class, 10)->create([
                'user_id' => $user->id,
            ]);

            if($user->id == 6) { /* Si es admin@gmail.com */
                factory(App\Finance::class)->create([
                    'user_id' => $user->id,
                    'finance_classification_id' => 4,
                    'currency_id' => 1,
                    'debit_to' => 1,
                    'amount' => 4,
                    'debt' => null,
                    'tithe' => 0,
                ]);

                factory(App\Finance::class)->create([
                    'user_id' => $user->id,
                    'finance_classification_id' => 4,
                    'currency_id' => 2,
                    'debit_to' => 1,
                    'amount' => 4,
                    'debt' => null,
                    'tithe' => 0,
                ]);
            }

        }
    }
}
