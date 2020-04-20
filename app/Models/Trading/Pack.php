<?php

namespace App\Models\Trading;

use Illuminate\Database\Eloquent\Model;

class Pack extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'pack_name', 'price'
    ];

    /**
     * Get item category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Get packs content.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contents() {
        return $this->hasMany(PackContent::class, 'pack_id');
    }
}
