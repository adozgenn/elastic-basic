<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request){
        $query = [
                'nested'=>[
                    'path'=> 'variants',
                    'query'=>[
                        'bool'=>[
                            'should'=>[
                                'term'=>[
                                    "variants.color.keyword"=> "green"
                                ]
                            ]
                        ],
                    ]
                ]
        ];
        $searchResult = null;
        if ($request->has("search") && $request->get("search")){
            $searchResult = Product::boolSearch()->should('match', ['title' => $request->get("search")]);
        } else {
            $searchResult = Product::matchAllSearch();
        }
        if ($request->has("sort") && $request->get("sort")){
            $sorts = explode('-',$request->get("sort"));
            if(count($sorts) === 2){
                $searchResult = $searchResult->sort($sorts[0], $sorts[1]);
            }
        }
        $searchResult = $searchResult->execute();
        $mappedResults = $searchResult->documents()->map(function ($document){
            return [
                "id"=>$document->getId(),
                'title'=>$document->getContent()['title'],
                'price'=>$document->getContent()['price'],
                'brand'=>$document->getContent()['brand'],
                'discount_rate'=>$document->getContent()['discount_rate'],
                'created_at'=>$document->getContent()['created_at'],
            ];
        });
        return response()->json($mappedResults);
    }
}
