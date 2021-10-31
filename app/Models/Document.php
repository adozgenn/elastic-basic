<?php

namespace App\Models;

use App\OnlySearchableModelObserver;
use App\SearchFormQueryBuilder;
use ElasticScoutDriverPlus\Builders\SearchRequestBuilder;
use ElasticScoutDriverPlus\QueryDsl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Laravel\Scout\Searchable;
use Laravel\Scout\SearchableScope;
use Spatie\PdfToText\Pdf;

class Document extends Model
{
    use HasFactory;
    use Searchable, QueryDsl;

    public $fillable = ['title', 'path', 'content'];


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

    public function toSearchableArray()
    {
        return [
            "path" => $this->path,
            "title" => $this->title,
            "content" => (new Pdf())
                ->setPdf(Storage::path("test.pdf"))
                ->text()
        ];
    }
}
