<?php

namespace Database\Seeders;

use App\Models\Config;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $role = Role::create(['name' => 'admin']);
        $role = Role::create(['name' => 'user']);

        $user = User::factory()->create([
            'name' => 'Braulio Miramontes',
            'email' => 'braulio@felamedia.com',
            'contact_id' => 'PGk4Ewhl8CQgz3o5AYUM',
            'password' => bcrypt('password'),
        ]);

        $user2 = User::factory()->create([
            'name' => 'Jorge Fela',
            'email' => 'jorge@felamedia.com',
            'password' => bcrypt('password'),
        ]);

        //Generamos el archivo de configuración
        $config = new Config();
        $config->save();

        $user->assignRole('admin');
        $user2->assignRole('admin');
    }
}
