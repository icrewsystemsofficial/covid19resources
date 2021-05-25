<?php

namespace App\Search;

use Algolia\ScoutExtended\Searchable\Aggregator;

class SearchAggregator extends Aggregator
{
    /**
     * The names of the models that should be aggregated.
     *
     * @var string[]
     */
    protected $models = [
//         \App\Models\Twitter::class,
        \App\Models\Resource::class
    ];
}
