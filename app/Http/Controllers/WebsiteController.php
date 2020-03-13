<?php

namespace App\Http\Controllers;

use App\Http\Resources\WebsiteResource;
use App\Website;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $data = request()->validate([
            'order_field' => [Rule::in(['name', 'created_at'])],
            'order_direction' => [Rule::in(['desc', 'asc'])],
            'q' => ['max:255'],
        ]);

        $websites = Website::query()
            ->when(isset($data['order_field']), function (Builder $query) use ($data) {
                $query->orderBy($data['order_field'], $data['order_direction'] ?? 'asc');
            })
            ->when(isset($data['q']), function (Builder $query) use ($data) {
                $query->where('name', 'like', "%{$data['q']}%");
            })
            ->paginate(10);

        return WebsiteResource::collection($websites);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'url' => ['required', 'string', 'max:255', 'url', Rule::unique('websites', 'url')],
        ]);

        Website::create($data);

        return response()->json(['message' => 'Successfully created a website']);
    }
}
