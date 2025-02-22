<?php

namespace App\Http\Controllers\Api\V1\Dashboard;

use App\Models\Ad;
use App\Helper\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Resources\AdResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Api\V1\AdRequest;
use Illuminate\Support\Facades\Validator;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ads = Ad::with(['user', 'category'])->latest()->paginate(5);

        if ($ads) {
            if ($ads->total() > $ads->perPage()) {
                $data = [
                    'records' => AdResource::collection($ads),
                    'pagination_links' => [
                        'current_page' => $ads->currentPage(),
                        'per_page' => $ads->perPage(),
                        'total' => $ads->total(),
                        'links' => [
                            'first' => $ads->url(1),
                            'prev'  => $ads->previousPageUrl(),
                            'next' => $ads->nextPageUrl(),
                            'last' => $ads->url($ads->lastPage()),
                        ],
                    ],
                ];
            } else {
                $data = AdResource::collection($ads);
            }
            return ApiResponse::sendResponse(200, 'Ads retrived successfully', $data);
        }
        return ApiResponse::sendResponse(200, 'Ads Not Found');
    }

    public function latest()
    {
        $ads = Ad::with(['user', 'category'])->latest()->take(5)->get();
        if ($ads) {
            return ApiResponse::sendResponse(200, 'Latest ads retrieved successfully', AdResource::collection($ads));
        }
        return ApiResponse::sendResponse(200, 'Latest ads Not Found');
    }

    public function category($category)
    {
        $ads = Ad::with(['user', 'category'])->where('category_id', $category)
            ->with('category')
            ->paginate(5);

        if (!$ads->isEmpty()) {
            if ($ads->total() > $ads->perPage()) {
                $data = [
                    'records' => AdResource::collection($ads),
                    'pagination_links' => [
                        'current_page' => $ads->currentPage(),
                        'per_page' => $ads->perPage(),
                        'total' => $ads->total(),
                        'links' => [
                            'first' => $ads->url(1),
                            'prev'  => $ads->previousPageUrl(),
                            'next' => $ads->nextPageUrl(),
                            'last' => $ads->url($ads->lastPage()),
                        ],
                    ],
                ];
            } else {
                $data = AdResource::collection($ads);
            }
            return ApiResponse::sendResponse(200, 'Ads whith category retrieved successfully', $data);
        }
        return ApiResponse::sendResponse(200, 'Ads whith category Not Found');
    }

    public function search(Request $request)
    {
        $word = $request->input('search') ?? null;
        $ads = Ad::when($word != null, function ($q) use ($word) {
            $q->where('title', 'LIKE', '%' . $word . '%');
        })->latest()->paginate(5);

        if ($ads->count() > 0) {
            if ($ads->total() > $ads->perPage()) {
                $data = [
                    'records' => AdResource::collection($ads),
                    'pagination_links' => [
                        'current_page' => $ads->currentPage(),
                        'per_page' => $ads->perPage(),
                        'total' => $ads->total(),
                        'links' => [
                            'first' => $ads->url(1),
                            'prev'  => $ads->previousPageUrl(),
                            'next' => $ads->nextPageUrl(),
                            'last' => $ads->url($ads->lastPage()),
                        ],
                    ],
                ];
            } else {
                $data = AdResource::collection($ads);
            }
            return ApiResponse::sendResponse(200, 'Ads whith category retrieved successfully', $data);
        }
        return ApiResponse::sendResponse(200, 'No Matching Data');
    }

    public function myAds(Request $request)
    {
    
        if (!Gate::allows('super-admin')) {
            return ApiResponse::sendResponse(403, 'You are not allowed for this action');
        }

        $ads = Ad::where('user_id', $request->user()->id)
            ->with('category')
            ->paginate(5);

        if (!$ads->isEmpty()) {
            if ($ads->total() > $ads->perPage()) {
                $data = [
                    'records' => AdResource::collection($ads),
                    'pagination_links' => [
                        'current_page' => $ads->currentPage(),
                        'per_page' => $ads->perPage(),
                        'total' => $ads->total(),
                        'links' => [
                            'first' => $ads->url(1),
                            'prev'  => $ads->previousPageUrl(),
                            'next' => $ads->nextPageUrl(),
                            'last' => $ads->url($ads->lastPage()),
                        ],
                    ],
                ];
            } else {
                $data = AdResource::collection($ads);
            }
            return ApiResponse::sendResponse(200, 'My ads retrieved successfully', $data);
        }
        return ApiResponse::sendResponse(200, 'You don\'t have any ads yet');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdRequest $request)
    {
        if (!Gate::allows('super-admin')) {
            return ApiResponse::sendResponse(403, 'You are not allowed for this action');
        }
        try {
            $data = $request->validated();
            $data['user_id'] = $request->user()->id;
            $reacord = Ad::create($data);

            if ($reacord) {
                return ApiResponse::sendResponse(201, 'Your Ad created successfully', new AdResource($reacord));
            }
            return ApiResponse::sendResponse(200, 'Failed creation ad');
        } catch (\Exception $e) {
            return ApiResponse::sendResponse(500, 'Something went wrong', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdRequest $request, Ad $ad)
    {
        if ($ad->user_id != $request->user()->id) {
            return ApiResponse::sendResponse(403, 'You aren\'t allowed to take this action');
        }

        try {

            $data = $request->validated();
            $reacord  = tap($ad)->update($data);
            if ($reacord) {
                return ApiResponse::sendResponse(201, 'Your Ad updated successfully', new AdResource($ad));
            }
            return ApiResponse::sendResponse(200, 'Failed update ad');
        } catch (\Exception $e) {
            return ApiResponse::sendResponse(500, 'Something went wrong', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Ad $ad)
    {
        if ($ad->user_id != $request->user()->id) {
            return ApiResponse::sendResponse(403, 'You aren\'t allowed to take this action');
        }

        try {

            $reacord  =  $ad->delete();
            if ($reacord) {
                return ApiResponse::sendResponse(200, 'Your Ad deleted successfully');
            }
            return ApiResponse::sendResponse(200, 'Failed to delete ad');
        } catch (\Exception $e) {
            return ApiResponse::sendResponse(500, 'Something went wrong', ['error' => $e->getMessage()]);
        }
    }
}
