# Laravel Tag Package
[![Latest Version on Packagist](https://img.shields.io/packagist/v/dizatech/tag.svg?style=flat-square)](https://packagist.org/packages/dizatech/tag)
[![GitHub issues](https://img.shields.io/github/issues/dizatech/tag?style=flat-square)](https://github.com/dizatech/tag/issues)
[![GitHub stars](https://img.shields.io/github/stars/dizatech/tag?style=flat-square)](https://github.com/dizatech/tag/stargazers)
[![GitHub forks](https://img.shields.io/github/forks/dizatech/tag?style=flat-square)](https://github.com/dizatech/tag/network)
[![Total Downloads](https://img.shields.io/packagist/dt/dizatech/tag.svg?style=flat-square)](https://packagist.org/packages/tag/attachment)
[![GitHub license](https://img.shields.io/github/license/dizatech/tag?style=flat-square)](https://github.com/dizatech/tag/blob/master/LICENSE)

A laravel package for manage your tags, that use ajax, bootstrap, select2 and sweetalert2 for client side and use from many to many polymorphic relationship in models.
<p align="center"><img src="https://s18.picofile.com/file/8436883692/tag.gif?raw=true"></p>

## How to install and config [dizatech/tag](https://github.com/dizatech/tag) package?

```bash

composer require dizatech/tag

```

#### Install and publish files

```bash

Publish 'lacopa' packages pages:
php artisan tag:install --lacopa | --lacopa --force | -l -f | -lf

Publish empty pages for another projects:
php artisan tag:install --force | -f 

```

#### Use create and edit input components

```html

Use this component in your 'create' pages:
<x-tag></x-tag>
OR set custom properties, defaults: label="برچسب‌ها" name="tags" page="create"
<x-tag label="برچسب‌ها" name="tags" page="create"></x-tag>

And use this component in your 'edit' pages:
<x-tag page="edit" id="{{ $post->id }}" $model="{{ get_class($post) }}"></x-tag>

```

```blade

Use this Blade tag in your page:
@tagScripts()

OR use this tag in script section of page:
@slot('script')

    @tagScripts()

@endslot

```

#### Use index, create and edit pages and customize this pages

- If you use from <code>lacopa</code> add below code in your sidebar:
    ```blade
    
    @component('tag::components.sidebar.menu')@endcomponent
    
    ```
- If you want to use <code>tag package</code> in another project, you can use <code>/resources/views/vendor/tag</code> directory

    ```html
    
    Use below component in your create page structure:
    <x-tag-create></x-tag-create>
  
    Use below component in your edit page structure:
    <x-tag-edit tag="{{ $tag->id }}"></x-tag-edit>
  
    Use below component in your index page structure:
    <x-tag-index></x-tag-index>
    
    ```

#### Config files options

```php

<?php

return [
    // Minimum Input Length for search keyword
    'minimumInputLength' => 2,

    // Recommended: Set your models that has many-to-many-polymorphic relation with Tag model
    'morphedByMany' => [
        // For example
        // 'articles'  => 'App\Models\Article',
    ],
];

// Notice: if you update 'morphedByMany' option, use this command each time
php artisan tag:reload

```

#### Set the <code>Taggable</code> Trait on models

```php

<?php

namespace Modules\Course\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dizatech\Tag\Services\Traits\Taggable;

class Post extends Model
{
    use HasFactory, SoftDeletes, Taggable;
}

```

#### Attach tags to models

```php

<?php

$post->tags()->sync($request->tags);

```

