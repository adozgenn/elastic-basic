<?php

namespace App;

use ElasticScoutDriverPlus\Builders\SearchRequestBuilder;
use ElasticScoutDriverPlus\QueryDsl;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;
use Laravel\Scout\SearchableScope;

class User extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    use Searchable, QueryDsl;


    public function toSearchableArray()
    {
        return [
            'name'=>$this->name,
            'email'=>$this->email,
        ];
    }

    public static function bootSearchable(): void
    {
        static::addGlobalScope(new SearchableScope);
        static::observe(new OnlySearchableModelObserver());
        (new static)->registerSearchableMacros();
    }

    public static function searchForm(): SearchRequestBuilder
    {
        return new SearchRequestBuilder(new static(), new SearchFormQueryBuilder());
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
