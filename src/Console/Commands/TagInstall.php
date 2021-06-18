<?php

namespace Dizatech\Tag\Console\Commands;

use Illuminate\Console\Command;

class TagInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tag:install {--l|lacopa} {--f|force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish config and view pages, run migrate and regenerate tag model.';

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
     * @return int
     */
    public function handle()
    {
        if ($this->option('force')) {
            $this->call('vendor:publish', ['--tag' => 'dizatech_tag', '--force' => true]);
            // lacopa
            if ($this->option('lacopa')) {
                $this->call('vendor:publish', ['--tag' => 'tag_lacopa_page', '--force' => true]);
            //empty
            } else {
                $this->call('vendor:publish', ['--tag' => 'tag_white_page', '--force' => true]);
            }
        } else {
            $this->call('vendor:publish', ['--tag' => 'dizatech_tag']);
            // lacopa
            if ($this->option('lacopa')) {
                $this->call('vendor:publish', ['--tag' => 'tag_lacopa_page']);
            //empty
            } else {
                $this->call('vendor:publish', ['--tag' => 'tag_white_page']);
            }
        }
        $this->call('tag:reload');
        $this->call('migrate');

        $this->info('The Installation was successful!');
    }
}
