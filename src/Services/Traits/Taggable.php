<?php

namespace Dizatech\Tag\Services\Traits;

use Dizatech\Tag\Models\Tag;

trait Taggable {

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

}
