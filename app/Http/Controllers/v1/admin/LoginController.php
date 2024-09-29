<?php

namespace App\Http\Controllers\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\StoreLoginRequest;
use App\Services\v1\profile\LoginService;

class LoginController extends Controller
{
    public function __invoke(StoreLoginRequest $request)
    {
        return app(LoginService::class)->execute($request->validated(), 1);
    }
}
