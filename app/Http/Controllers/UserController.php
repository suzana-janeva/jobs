<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    protected $repo;

    public function __construct()
    {
        $this->repo = new UserRepository();
    }

    public function index()
    {
        $user = Auth::guard('api')->user();

        $data = new UserResource($user);

        return response()->json($data, 200);
    }

    public function show(User $user)
    {
        $this->authorize('view',$user);

        $data = new UserResource($user);

        return response()->json($data, 200);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $this->repo->updateUser($request, $user);

        $dataResource = new UserResource($user);

        return response()->json($dataResource, 200);
    }
}
