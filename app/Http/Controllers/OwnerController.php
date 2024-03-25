<?php

namespace App\Http\Controllers;

use App\Http\Requests\owners\{
    CreateOwnerRequest,
    DeleteOwnerRequest,
    UpdateOwnerRequest
};
use App\Services\owners\{
    CreateOwnerService,
    DeleteOwnerByIdService,
    RetrieveAllOwnersService,
    RetrieveOwnersByIdService,
    UpdateOwnerService
};
use Illuminate\Support\Facades\Route;

class OwnerController extends Controller {
    public function create(CreateOwnerRequest $request){
        $createOwnerService = new CreateOwnerService;
        return $createOwnerService->execute($request->all());
    }

    public function update(UpdateOwnerRequest $request, $id){
        $id = (int)$id;
        $updateOwnerService = new UpdateOwnerService();
        return $updateOwnerService->execute($id, $request->all());
    }

    public function retrieve($id = null) {
        if (is_null($id)){
            $retrieveAllOwnersService = new RetrieveAllOwnersService();
            return $retrieveAllOwnersService->execute();
        } else {
            $id = (int)$id;
            $retrieveOwnerByIdService = new RetrieveOwnersByIdService();
            return $retrieveOwnerByIdService->execute($id);
        };
    }

    public function destroy(DeleteOwnerRequest $request, $id) {
        $id = (int)$id;
        $deleteOwnerByIdService = new DeleteOwnerByIdService();
        return $deleteOwnerByIdService->execute($id);
    }
};