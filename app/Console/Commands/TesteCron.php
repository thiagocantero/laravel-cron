<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

class TesteCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'teste:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Executa agendamento de algum Comando específico';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {

        
        $arquivo = "backup-". Carbon::now()->format('d-m-Y'). ".gz";

        $comando = "mysqldump --user=" . env('DB_USERNAME') .
        " --password=" . env('DB_PASSWORD') . 
        " --host=" . env('DB_HOST') . " " 
        . env('DB_DATABASE') . "  | gzip > " 
        . storage_path() . "/app/backup/" . $arquivo;

        $returnVar = NULL;
        $output  = NULL;
  
        exec($comando, $output, $returnVar);

        info("Seu Backup foi realizado em ". now());


    }
}
