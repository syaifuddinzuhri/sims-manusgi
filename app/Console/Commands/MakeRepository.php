<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeRepository extends Command
{
    protected $files;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {repository}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates a new repository';

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
        $makeRepository = $this->argument('repository');

        if ($makeRepository === '' || is_null($makeRepository) || empty($makeRepository)) {
            return $this->error('Repository name invalid..!');
        }

        $explode = explode('/', $makeRepository);

        if (count($explode) == 1) {
            $this->mainPath($explode[0]);
        } else {
            $repositoryName = $explode[count($explode) - 1];
            unset($explode[count($explode) - 1]);
            $this->nestedPath($explode, $repositoryName);
        }
    }

    public function mainPath($repositoryName)
    {

        $contents = '<?php

namespace App\Repositories;
use App\Traits\GlobalTrait;

class ' . $repositoryName . '
{

    use GlobalTrait;

    /**
    * Create a new ' . $repositoryName . '
    *
    * @return void
    */
    public function __construct()
    {

    }

    public function index(){
        try{

        }catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }
}';

        $file = "$repositoryName.php";
        $path = app_path();

        $file = $path . "/Repositories/$file";
        $repoDir = $path . "/Repositories";
        $this->generateRepo($repoDir, $repositoryName, $file, $contents);
    }

    public function nestedPath($explode, $repositoryName)
    {

        $namespace = implode("\\", $explode);
        $filePath = implode("/", $explode);
        $contents = '<?php

namespace App\Repositories\\' . $namespace . ';
use App\Traits\GlobalTrait;

class ' . $repositoryName . '
{

    use GlobalTrait;

    /**
    * Create a new ' . $repositoryName . '
    *
    * @return void
    */
    public function __construct()
    {

    }

    public function index(){
        try{

        }catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }
}';

        $file = "$repositoryName.php";
        $path = app_path();

        $file = $path . "/Repositories/" . $filePath . "/$file";
        $repoDir = $path . "/Repositories/" . $filePath;
        $this->generateRepo($repoDir, $repositoryName, $file, $contents);
    }

    public function generateRepo($repoDir, $repositoryName, $file, $contents)
    {
        if ($this->files->isDirectory($repoDir)) {
            if ($this->files->isFile($file)) {
                return $this->error($repositoryName . ' File Already exists!');
            }
        } else {
            $this->files->makeDirectory($repoDir, 0777, true, true);

        }

        if (!$this->files->put($file, $contents)) {
            return $this->error('Something went wrong!');
        }
        $this->info("$repositoryName generated!");
    }
}
