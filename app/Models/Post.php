<?php

namespace App\Models;

use App\OnlySearchableModelObserver;
use App\SearchFormQueryBuilder;
use ElasticScoutDriverPlus\Builders\SearchRequestBuilder;
use ElasticScoutDriverPlus\QueryDsl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Laravel\Scout\SearchableScope;

class Post extends Model
{
    use HasFactory;
    use Searchable, QueryDsl;

    public $fillable = ['title', 'content', 'tags'];

    public function toSearchableArray()
    {
        return [
            'title'=>$this->title,
            'content'=>$this->content,
            'tags'=>$this->tags,
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



}
