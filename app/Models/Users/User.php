<?php

namespace App\Models\Users;

use App\Traits\Models\Finance;
use App\Traits\Models\HasInventory;
use App\Traits\Models\Statistics;
use App\Traits\Models\UserTrait;
use App\Transformers\GlobalUserTransformer;
use App\Transformers\UserTransformer;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, UserTrait, Finance, Statistics, HasInventory;

    protected $appends = ['rank'];
    public $transformer = UserTransformer::class;
    public $globalUserTransformer = GlobalUserTransformer::class;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nickname', 'steam_name', 'avatar', 'steamid', 'scumid', 'name', 'surname', 'email', 'profile_url'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'steamid', 'scumid', 'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the route discord notification key for the model.
     *
     * @var array
     */
    public function routeNotificationForDiscord()
    {
        return '702559672833409037';
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'steamid';
    }

    /**
    * Get the identifier that will be stored in the subject claim of the JWT.
    *
    * @return mixed
    */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
 
     /**
    * Return a key value array, containing any custom claims to be added to the JWT.
    *
    * @return array
    */
     public function getJWTCustomClaims()
     {
        return [];
     }

     public function getRankAttribute(){
        $collection = collect(Statistic::orderBy('elo', 'DESC')->get());
        $data       = $collection->where('user_id', $this->id);
        $value      = $data->keys()->first() + 1;
        return $value;
    }
}
