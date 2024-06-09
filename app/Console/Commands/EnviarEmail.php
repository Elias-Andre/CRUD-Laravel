<?php

namespace App\Console\Commands;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Console\Command;

class EnviarEmail extends Command
{
    protected $signature = 'email:enviar-email';
    protected $description = 'Enviar e-mail de boas-vindas aos novos usuarios';

    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        $users = User::where(`created_at`,`>=`, now()->subHours(20))
            ->where(`boasvindas_email_enviado`,false)
            ->get();
        foreach ($users as $user) {
            Log::info(`Enviar e-mail de boas-vindas para: ` . $user->email);
        $user->boasvindas_email_enviado = true;
        $user->save();
        }
        return 0;
    }
}
