<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Services\CreateOwnerService;
use Illuminate\Http\Request;

class OwnerController extends Controller {
    public function create(Request $request){
        $createOwnerService = new CreateOwnerService;
        return $createOwnerService->excecute($request->all());
    }
};