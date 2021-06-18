<?php

namespace Dizatech\Tag;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Dizatech\Tag\Console\Commands\TagInstall;
use Dizatech\Tag\Console\Commands\TagReload;
use Dizatech\Tag\Facades\TagFacade;
use Dizatech\Tag\Repositories\TagRepository;
use Dizatech\Tag\View\Components\Tag;
use Dizatech\Tag\View\Components\TagCreate;
use Dizatech\Tag\View\Components\TagEdit;
use Dizatech\Tag\View\Components\TagIndex;

class DizatechTagServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        TagFacade::shouldProxyTo(TagRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        $this->loadViewsFrom(__DIR__ . '/views','tag');

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->loadViewComponentsAs('', [
            Tag::class,
            TagCreate::class,
            TagEdit::class,
            TagIndex::class
        ]);

        $this->mergeConfigFrom(__DIR__ . '/config/dizatech_tag.php', 'dizatech_tag');

        $this->publishes([
            __DIR__.'/config/dizatech_tag.php' => config_path('dizatech_tag.php')
        ], 'dizatech_tag');

        $this->publishes([
            __DIR__.'/views/panel/tag/white/tag_create.blade.php' => resource_path('views/vendor/tag/tag_create.blade.php'),
            __DIR__.'/views/panel/tag/white/tag_edit.blade.php' => resource_path('views/vendor/tag/tag_edit.blade.php'),
            __DIR__.'/views/panel/tag/white/tag_index.blade.php' => resource_path('views/vendor/tag/tag_index.blade.php'),
        ], 'tag_white_page');

        $this->publishes([
            __DIR__.'/views/panel/tag/lacopa/tag_create.blade.php' => resource_path('views/vendor/tag/tag_create.blade.php'),
            __DIR__.'/views/panel/tag/lacopa/tag_edit.blade.php' => resource_path('views/vendor/tag/tag_edit.blade.php'),
            __DIR__.'/views/panel/tag/lacopa/tag_index.blade.php' => resource_path('views/vendor/tag/tag_index.blade.php'),
        ], 'tag_lacopa_page');

        if ($this->app->runningInConsole()) {
            $this->commands([
                TagReload::class,
                TagInstall::class
            ]);
        }

        Blade::directive('tagScripts', function () {
            return <<<HTML
                  <script>
                    $(".select2_search_tags").select2({
                        dir: 'rtl',
                        language: 'fa',
                        theme: 'bootstrap',
                        minimumInputLength: {{ config("dizatech_tag.minimumInputLength") }},
                        ajax: {
                            url: baseUrl + '/panel/ajax/search/tags',
                            dataType: 'json'
                        }
                    });
                </script>
            HTML;
        });
    }
}
