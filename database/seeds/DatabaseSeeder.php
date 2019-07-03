<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(CurrencyTableSeeder::class);
         $this->call(FinanceClassificationsTableSeeder::class);
         $this->call(ProductsTableSeeder::class);
         $this->call(PermissionsTableSeeder::class);
         $this->call(MemberClasificationsTableSeeder::class);
         $this->call(CountriesProvincesCitiesTableSeeder::class);
//         $this->call(FinancesTableSeeder::class);
    }
}
