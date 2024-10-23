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

    /**
     * @OA\Get(
     *     path="/api/user",
     *     description="Profile",
     *     tags={"User"},
     *     summary="GET user profile",
     *     operationId="profile",
     *     security={ {"bearerAuth": {} }},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/User")
     *      ),
     *
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     *
     */
    public function index()
    {
        $user = Auth::guard('api')->user();

        $data = new UserResource($user);

        return response()->json($data, 200);
    }

    /**
     * @OA\Get(
     *     path="/api/user/{id}",
     *     description="Show user",
     *     tags={"User"},
     *     summary="GET User",
     *     operationId="showUser",
     *     security={ {"bearerAuth": {} }},
     *    @OA\Parameter(
     *          name="id",
     *          description="User id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/UserResource")
     *      ),
     *
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized"
     *      ),
     *     @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     *
     */
    public function show(User $user)
    {
        $this->authorize('view',$user);

        $data = new UserResource($user);

        return response()->json($data, 200);
    }

    /**
     * @OA\Put(
     *     path="/api/user/{id}",
     *     description="UPDATE user",
     *     tags={"User"},
     *     summary="UPDATE User",
     *     operationId="updateUser",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *          name="id",
     *          description="User id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UserUpdateRequest")
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/UserResource")
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found"
     *      )
     * )
     *
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $this->repo->updateUser($request, $user);

        $dataResource = new UserResource($user);

        return response()->json($dataResource, 200);
    }
}
