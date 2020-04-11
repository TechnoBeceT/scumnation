<?php

namespace App\Models\Trading;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasSlug;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_type', 'category_name', 'slug'
    ];
    
    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('category_name')
            ->saveSlugsTo('slug');
    }
    
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get category type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoryType() {
        return $this->belongsTo(CategoryType::class, 'category_type');
    }

    /**
     * Get category items.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items() {
        return $this->hasMany(Item::class, 'category_id');
    }
}
