<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class ElasticPostsQuery extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elastic:posts {--type=eloquent}';

    public function handle()
    {
//        //must
//        $searchResult = Post::boolSearch()
//            ->must(['match' => ['title' => 'Magnam culpa quidem.']])
//            ->execute();

        //filter
//        $searchResult = Post::boolSearch()
//            ->filter(['term' => ['title' => 'magnam']])
//            ->execute();


        //should
//        $searchResult = Post::boolSearch()
//            ->should('term', ['title'=>'culpa'])
//            ->should('term', ['title'=>'magnam'])
//            ->should('term', ['title'=>'quidem'])
//            ->minimumShouldMatch(3)
//            ->execute();


        //trashed config/scout.php  'soft_delete' => true  olmalı
//        $searchResult = Post::boolSearch()
//            ->onlyTrashed()
//            ->execute();


        //Full Text Search matchPhrasePrefixSearch Available methods analyzer, field, query, maxExpansions
//        $searchResult = Post::matchPhrasePrefixSearch()
//            ->field('title')
//            ->query('cu')
//            ->zeroTermsQuery('all')
//            ->execute();

        //matchPhraseSearch yukardaki ek fonksiyonlar
//        $searchResult = Post::matchPhraseSearch()
//            ->field('title')
//            ->query('culpa')
//            ->execute();


        $searchResult = Post::rawSearch()
            ->query(['match' => ['content' => 'culpa']])
            ->highlightRaw(['fields' => ['content' => ['number_of_fragments' => 1]]])
            ->execute();
        $matches = $searchResult->matches();
        $highlight = $matches->first()->highlight();

        $snippets = $highlight->getSnippets('content');

//        $result = $searchResult->highlights();

        dd($snippets);

    }
}
