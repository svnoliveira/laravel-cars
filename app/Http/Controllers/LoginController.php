<?php

namespace App\Http\Controllers;

use App\Http\Requests\owners\LoginRequest;
use App\Services\owners\loginService;

class LoginController extends Controller {
    public function Login(LoginRequest $request) {
        $loginService = new loginService();
        return $loginService->excecute($request->all());
    }
};