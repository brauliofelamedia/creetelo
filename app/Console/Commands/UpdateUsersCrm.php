<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;
use Illuminate\Console\Command;

class UpdateUsersCrm extends Command
{
    protected $signature = 'app:update-users-crm';
    protected $description = 'Llama a la ruta dashboard.sync para actualizar registros';

    public function handle()
    {
         // Genera la URL completa a partir del nombre de la ruta
         $url = route('dashboard.sync');
        
         // Realiza la petición GET a la URL
         $response = Http::get($url);
         
         $this->info('Petición realizada a: ' . $url);
         $this->info('Resultado: ' . $response->body());
         
         return Command::SUCCESS;
    }
}
