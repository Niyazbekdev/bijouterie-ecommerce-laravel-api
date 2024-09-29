<?php

namespace App\Http\Controllers\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\StoreBrendRequest;
use App\Http\Resources\v1\NameResource;
use App\Models\Brend;
use App\Services\v1\admin\brend\IndexBrendService;
use App\Services\v1\admin\brend\StoreBrendService;
use App\Services\v1\admin\brend\UpdateBrendService;
use Illuminate\Http\Request;

class BrendController extends Controller
{
    public function index(Request $request)
    {
        return app(IndexBrendService::class)->execute($request);
    }

    public function store(StoreBrendRequest $request)
    {
        $brend = app(StoreBrendService::class)->execute($request->validated());

        return response()->json([
            'success' => $brend,
        ]);
    }

    public function show(Brend $brend)
    {
        return new NameResource($brend);
    }

    public function update(StoreBrendRequest $request, Brend $brend)
    {
        return app(UpdateBrendService::class)->execute($request->validated(), $brend);
    }

    public function destroy(Brend $brend)
    {
        $brend->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}
