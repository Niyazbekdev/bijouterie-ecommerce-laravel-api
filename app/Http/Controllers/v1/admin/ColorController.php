<?php

namespace App\Http\Controllers\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\StoreColorRequest;
use App\Http\Resources\v1\TranslateNameREsource;
use App\Models\Color;
use App\Services\v1\admin\color\StoreColorService;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index(Request $request)
    {
        $searchTerm = mb_strtolower($request->search, 'UTF-8');

        $colors = Color::where(function ($query) use ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query->whereRaw('LOWER(JSON_EXTRACT(name, "$.kaa")) LIKE ?', ["%{$searchTerm}%"])
                    ->orWhereRaw('LOWER(JSON_EXTRACT(name, "$.ru")) LIKE ?', ["%{$searchTerm}%"]);
            });
        })->select('id', 'name')->get();

        return TranslateNameREsource::collection($colors);
    }

    public function store(StoreColorRequest $request)
    {
        return app(StoreColorService::class)->execute($request->validated());
    }

    public function show(Color $color)
    {
        return new TranslateNameREsource($color);
    }

    public function update(StoreColorRequest $request, Color $color)
    {
        $color->update([
            'name' => $request->name,
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    public function destroy(Color $color)
    {
        $color->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
