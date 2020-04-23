<?php

namespace App\Models\Logs;

use App\Models\Users\User;
use App\Transformers\KillTransformer;
use Illuminate\Database\Eloquent\Model;

class Kill extends Model
{
    const IS_EVENT = 'event';
    const NOT_EVENT = 'not_event';

    public $timestamps = false;
    public $transformer = KillTransformer::class;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'killer_id', 'killerX', 'killerY', 'killerZ', 'victim_id', 'victimX', 'victimY', 'victimZ', 'date', 'type', 'distance', 'sector'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'datetime',
    ];

    /**
     * Get the killer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function killer()
    {
        return $this->belongsTo(User::class, 'killer_id');
    }

    /**
     * Get the victim.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function victim()
    {
        return $this->belongsTo(User::class, 'victim_id');
    }
}
