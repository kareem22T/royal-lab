<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\HandleResponseTrait;

class BranchController extends Controller
{
    use HandleResponseTrait;
    // Method to get all branches
    public function getAllBranches()
    {
        $branches = Branch::with("city", "region")->get();
        return $this->handleResponse(
            false,
            "",
            [],
            [$branches],
            [
            ]
        );
    }

    // Method to search branches based on city_id, address, or region_id
    public function searchBranches(Request $request)
    {
        $query = Branch::query();

        if ($request->has('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        if ($request->has('address')) {
            $query->where('address', 'like', '%' . $request->address . '%')->orWhere('address_ar', 'like', '%' . $request->address . '%');
        }

        if ($request->has('region_id')) {
            $query->where('region_id', $request->region_id);
        }

        $branches = $query->with("city", "region")->get();

        return $this->handleResponse(
            false,
            "",
            [],
            [$branches],
            [
            ]
        );
    }
}
