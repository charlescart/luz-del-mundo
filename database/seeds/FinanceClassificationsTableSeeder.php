<?php

use Illuminate\Database\Seeder;

class FinanceClassificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Ingreso Gral', 'description' => 'Ingreso para consumo personal', 'color' => null, 'class' => 'success'],
            ['name' => 'Ingreso 5%', 'description' => 'Ingreso para vestimenta y representacion personal', 'color' => '#ffc800b8', 'class' => 'warning'],
            ['name' => 'Debito', 'description' => 'Retiro o gasto', 'color' => '#ff003b52', 'class' => 'danger'],
            ['name' => 'Diezmo', 'description' => 'Gasto de diezmo', 'color' => '#ff003b52', 'class' => 'info'],
        ];

        foreach ($data as $classification) {
            $result = factory(App\FinanceClassification::class)->create([
                'name' => $classification['name'],
                'description' => $classification['description'],
                'color' => $classification['color'],
                'class' => $classification['class']
            ]);
        }
    }
}
