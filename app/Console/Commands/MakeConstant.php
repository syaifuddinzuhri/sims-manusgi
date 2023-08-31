<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeConstant extends Command
{
    protected $files;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:constant {constant}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new constant';

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
        $makeConstant = $this->argument('constant');

        if ($makeConstant === '' || is_null($makeConstant) || empty($makeConstant)) {
            return $this->error('Constant name invalid..!');
        }

        $contents = '<?php

namespace App\Constants;

class ' . $makeConstant . '
{

}';

        $file = "$makeConstant.php";
        $path = app_path();

        $file = $path . "/Constants/$file";
        $constantDir = $path . "/Constants";

        if ($this->files->isDirectory($constantDir)) {
            if ($this->files->isFile($file)) {
                return $this->error($makeConstant . ' File Already exists!');
            }
        } else {
            $this->files->makeDirectory($constantDir, 0777, true, true);
        }

        if (!$this->files->put($file, $contents)) {
            return $this->error('Something went wrong!');
        }
        $this->info("$makeConstant generated!");
    }
}
