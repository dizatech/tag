<?php

namespace Dizatech\Tag\Console\Commands;

use Illuminate\Console\Command;

class TagReload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tag:reload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Regenerate Tag Model with new methods that added you in config file.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if( !empty(config('dizatech_tag.morphedByMany')) ) {
            $methods = "";
            foreach( config('dizatech_tag.morphedByMany') as $model => $namespace ) {
                $methods .= "    public function {$model}()" . PHP_EOL .
                    "    {" . PHP_EOL .
                    '        return $this->morphedByMany(\'' .$namespace . "', 'taggable');" . PHP_EOL .
                    "    }" . PHP_EOL . PHP_EOL;
            }

            $file = substr( file_get_contents(__DIR__ . '/../../stubs/Tag.php'), 0, -2 ) . PHP_EOL . $methods . "}";

        } else {
            $file = file_get_contents(__DIR__ . '/../../stubs/Tag.php');
        }
        file_put_contents(__DIR__ . '/../../Models/Tag.php', $file);

        $this->info('The reload tag model was successful!');
    }
}
