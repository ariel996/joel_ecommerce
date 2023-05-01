<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Nicolaslopezj\Searchable\SearchableTrait;
// use Laravel\Scout\Searchable;

class Product extends Model
{
    use SearchableTrait, HasFactory;

    protected $searchable = [
        // column with priorities
        'columns' => [
            'products.name' => 6,
            'products.details' => 3,
            'products.description' => 2,
        ],
    ];

    protected $guarded = [];

    public function scopeMightAlsoLike($query) {
        return $query->inRandomOrder()->take(3);
    }

    public function category() {
        return $this->belongsTo('App\Models\Category');
    }

    public function tags() {
        return $this->belongsToMany('App\Models\Tag');
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }


    public function toSearchableArray() {
        $array = $this->toArray();
        $extraFields = [
            'category' => $this->category->name
        ];
        return array_merge($array, $extraFields);
    }
}
