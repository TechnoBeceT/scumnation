<?php

namespace App\Models\Trading;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class CategoryType extends Model
{
    use HasSlug;
    
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type_name', 'slug'
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('type_name')
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
     * Get this type categories.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories() {
        return $this->hasMany(Category::class, 'category_type');
    }

}
