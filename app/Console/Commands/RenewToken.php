<?php

namespace App\Console\Commands;
use App\Services\ContactServices;
use Illuminate\Console\Command;

class RenewToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:renew-token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $contactServices = new ContactServices();
        $data = $contactServices->renewToken();
        dd($data);
    }
}
