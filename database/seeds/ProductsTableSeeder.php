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
        ];

        foreach ($data as $people) {
            $user = factory(App\User::class)->create([
                'name' => $people['name'],
                'email' => $people['email'],
            ]);

            $products = factory(App\Product::class, 20)->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
