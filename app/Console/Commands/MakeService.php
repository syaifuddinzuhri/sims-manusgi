<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeService extends Command
{
    protected $files;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {service}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new service';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        $this->files = $files;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $makeService = $this->argument('service');

        if ($makeService === '' || is_null($makeService) || empty($makeService)) {
            return $this->error('Service name invalid..!');
        }

        $contents = '<?php

namespace App\Services;

class ' . $makeService . '
{
    public function index(){
        try{

        }catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }
}';

        $file = "$makeService.php";
        $path = app_path();

        $file = $path . "/Services/$file";
        $constantDir = $path . "/Services";

        if ($this->files->isDirectory($constantDir)) {
            if ($this->files->isFile($file)) {
                return $this->error($makeService . ' File Already exists!');
            }
        } else {
            $this->files->makeDirectory($constantDir, 0777, true, true);
        }

        if (!$this->files->put($file, $contents)) {
            return $this->error('Something went wrong!');
        }
        $this->info("$makeService generated!");
    }
}
