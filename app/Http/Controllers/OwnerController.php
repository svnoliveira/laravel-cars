<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\Request;

class OwnerController extends Controller {
    public function create(Request $request){
        return Owner::create($request->all());
    }
};