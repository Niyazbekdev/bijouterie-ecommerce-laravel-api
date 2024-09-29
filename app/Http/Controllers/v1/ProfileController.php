<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Services\v1\profile\GetMeService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function getProfile()
    {
        return app(GetMeService::class)->execute();
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout successfully']);
    }
}
