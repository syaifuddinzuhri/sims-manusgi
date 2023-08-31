<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeTrait extends Command
{
    protected $files;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:trait {trait}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new trait';

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
        $makeTrait = $this->argument('trait');

        if ($makeTrait === '' || is_null($makeTrait) || empty($makeTrait)) {
            return $this->error('Trait name invalid..!');
        }

        $contents = '<?php

namespace App\Traits;

trait ' . $makeTrait . '
{
    public function index(){
    }
}';

        $file = "$makeTrait.php";
        $path = app_path();

        $file = $path . "/Traits/$file";
        $constantDir = $path . "/Traits";

        if ($this->files->isDirectory($constantDir)) {
            if ($this->files->isFile($file)) {
                return $this->error($makeTrait . ' File Already exists!');
            }
        } else {
            $this->files->makeDirectory($constantDir, 0777, true, true);
        }

        if (!$this->files->put($file, $contents)) {
            return $this->error('Something went wrong!');
        }
        $this->info("$makeTrait generated!");
    }
}
