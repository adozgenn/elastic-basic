<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request){
        $query1 = [
                'nested'=>[
                    'path'=> 'variants',
                    'query'=>[
                        'bool'=>[
                            'should'=>[
                                'term'=>[
                                    "variants.color.keyword"=> $request->get('color')
                                ]
                            ]
                        ],
                    ]
                ]
        ];
        $query2 = [
            'nested'=>[
                'path'=> 'variants',
                'query'=>[
                    'bool'=>[
                        'should'=>[
                            'term'=>[
                                "variants.size.keyword"=> $request->get('size')
                            ]
                        ]
                    ],
                ]
            ]
        ];
        if ($request->get("color") || $request->get('search') || $request->get('brand') || $request->get('size')){
            $searchResult = Product::boolSearch();
            if ($request->has("search") && $request->get("search")){
                $searchResult->should('match', ['title' => $request->get("search")]);
            }
            if ($request->has("brand") && $request->get("brand")){
                $searchResult->must('match', ['brand.keyword' => $request->get("brand")]);
            }
            if ($request->has("color") && $request->get("color")){
                $searchResult->must($query1);
            }
            if ($request->has("size") && $request->get("size")){
                $searchResult->must($query2);
            }
        }
        else {
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
