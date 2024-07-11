<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\HandleResponseTrait;
use App\Models\Team;

class TeamsController extends Controller
{
    use HandleResponseTrait;

    public function getAll(Request $request) {
        $sortKey =($request->sort && $request->sort == "HP") || ( $request->sort && $request->sort == "LP") ? "price" :"created_at";
        $sortWay = $request->sort && $request->sort == "HP" ? "desc" : ( $request->sort && $request->sort  == "LP" ? "asc" : "desc");

        $teams = Team::orderBy($sortKey, $sortWay)
        ->get();

        return $this->handleResponse(
            true,
            "عملية ناجحة",
            [],
            [
                $teams
            ],
            [
                "parameters" => [
                    "sort" => [
                        "HP" => "height price",
                        "LP" => "lowest price",
                    ]
                ],
                "sort" => [
                    "default" => "لو مبعتش حاجة هيفلتر ع اساس الاحدث",
                    "sort = HP" => "لو بعت ال 'sort' ب 'HP' هيفلتر من الاغلى للارخص",
                    "sort = LP" => "لو بعت ال 'sort' ب 'LP' هيفلتر من الارخص للاغلى",
                ]
            ]
        );
    }

}
