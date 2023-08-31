<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeObserverCustom extends Command
{
    protected $files;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:observer-custom {observer}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new observer';

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
        $makeObserver = $this->argument('observer');

        if ($makeObserver === '' || is_null($makeObserver) || empty($makeObserver)) {
            return $this->error('Observer name invalid..!');
        }

        $contents = '<?php

namespace App\Observers;

class ' . $makeObserver . '
{

    public function creating(Model $m)
    {
        $m->created_by = auth()->check() ? auth()->user()->username : getSysAdmin()->username;
    }

    public function updating(Model $m)
    {
        $m->modified_by = auth()->check() ? auth()->user()->username : $m->username;
    }

}';

        $file = "$makeObserver.php";
        $path = app_path();

        $file = $path . "/Observers/$file";
        $constantDir = $path . "/Observers";

        if ($this->files->isDirectory($constantDir)) {
            if ($this->files->isFile($file)) {
                return $this->error($makeObserver . ' File Already exists!');
            }
        } else {
            $this->files->makeDirectory($constantDir, 0777, true, true);
        }

        if (!$this->files->put($file, $contents)) {
            return $this->error('Something went wrong!');
        }
        $this->info("$makeObserver generated!");
    }
}