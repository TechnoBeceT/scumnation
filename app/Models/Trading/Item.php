<?php

namespace App\Models\Trading;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public $timestamps = false;

    protected $table = 'items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'item_name', 'spawn_code', 'item_image'
    ];

    /**
     * Get item category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
