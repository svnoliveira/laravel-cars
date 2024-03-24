<?php

namespace App\Http\Controllers;

use App\Http\Requests\owners\CreateOwnerRequest;
use App\Services\owners\CreateOwnerService;


class OwnerController extends Controller {
    public function create(CreateOwnerRequest $request){
        $createOwnerService = new CreateOwnerService;
        return $createOwnerService->excecute($request->all());
    }
};