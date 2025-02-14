<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ManageStoreCommand extends Command{

    protected $signature = 'store:manage {--action=} {--store=}';

    public function handle(){

        $action = $this->option('action');
        $storeId = $this->option('store');

        switch ($action) {
            case 'activate':
                $this->activateStore($storeId);
                $this->info("Store {$storeId} activated.");
                break;
            case 'deactivate':
                $this->deactivateStore($storeId);
                $this->info("Store {$storeId} deactivated.");
                break;
            default:
                $this->error('Invalid action. Use "activate" or "deactivate".');
        }
    }

    private function activateStore($storeId){

        // Create Supervisor configuration
        $this->createSupervisorConfig($storeId);

        // Optionally dispatch an initial setup job
        // InitialSetupJob::dispatch()->onQueue("store_{$storeId}_setup");

        Log::info("Store {$storeId} activated and queues configured.");
    }

    private function deactivateStore($storeId){

        // Remove Supervisor configuration
        $this->removeSupervisorConfig($storeId);

        // Clear Redis queues
        // Redis::del(["store_{$storeId}_order_transfer", "store_{$storeId}_order_update"]);

        Log::info("Store {$storeId} deactivated and queues cleared.");
    }

    private function createSupervisorConfig($storeId){

        $configPath = "/etc/supervisor/conf.d/store_{$storeId}.conf";
        $configContent = "
        [program:store_{$storeId}]
        process_name=%(program_name)s_%(process_num)02d
        command=php /var/www/easylink/artisan queue:work redis --queue=store_{$storeId}_order_transfer,store_{$storeId}_order_update --sleep=3 --tries=3
        autostart=true
        autorestart=true
        user=www-data
        numprocs=3
        redirect_stderr=true
        stdout_logfile= /var/www/log/store_{$storeId}.log
        ";

        file_put_contents($configPath, $configContent);
        exec('sudo supervisorctl reread');
        exec('sudo supervisorctl update');
        exec("sudo supervisorctl start store_{$storeId}:*");

    }

    private function removeSupervisorConfig($storeId)
    {
        $configPath = "/etc/supervisor/conf.d/store_{$storeId}.conf";

        if (file_exists($configPath)) {
            unlink($configPath);
            exec('sudo supervisorctl reread');
            exec('sudo supervisorctl update');
            exec("sudo supervisorctl stop store_{$storeId}:*");
        }

    }
    
}
