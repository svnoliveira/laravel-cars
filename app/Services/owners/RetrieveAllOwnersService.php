<?php

namespace App\Services\owners;

use App\Models\Owner;

class RetrieveAllOwnersService {
    public function execute(){
        $owners = Owner::all();
        return $owners;
    }
}