<?php

use Illuminate\Database\Seeder;

class MemberClasificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clasifications = [
            ['id' => 1, 'name' => 'Pastor Jefe de Mision', 'description' => 'Pastor jefe de mision'],
            ['id' => 2, 'name' => 'Pastor', 'description' => 'Pastor jefe de mision'],
            ['id' => 3, 'name' => 'Pastor Adjunto', 'description' => 'Pastor supletorio'],
            ['id' => 3, 'name' => 'Jefe de Obrero', 'description' => 'Pastor jefe de obreros'],
            ['id' => 4, 'name' => 'Pro Templo', 'description' => 'Integrante de la organizacion de protemplo'],
            ['id' => 5, 'name' => 'Miembro', 'description' => 'Integrante de la iglesia'],
        ];

        foreach ($clasifications as $clasification) {
            factory(App\MemberClasification::class)->create([
                'id' => $clasification['id'],
                'name' => $clasification['name'],
                'description' => $clasification['description'],
            ]);
        }
    }
}
