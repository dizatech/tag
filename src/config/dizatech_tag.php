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
