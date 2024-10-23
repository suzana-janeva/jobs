<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use Laravel\Passport\TokenRepository;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;

class AuthenticationController extends Controller
{
    protected $repo;

    public function __construct()
    {
        $this->repo = new UserRepository();
    }

     /**
     * @OA\Post(
     *      path="/api/register",
     *      description="Returns user data",
     *      tags={"Authentication"},
     *      summary="POST register user",
     *      operationId="RegisterUser",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UserRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful created",
     *          @OA\JsonContent(ref="#/components/schemas/User")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      ),
     * )
     */
    public function register(UserRequest $request): JsonResponse
    {
        $user = $this->repo->saveUser($request);

        return response()->json([
            'user'    => new UserResource($user),
            'message' => 'You have successfully registered',
        ], 201);
    }

     /**
     * @OA\Post(
     *      path="/api/login",
     *      description="Returns user data",
     *      tags={"Authentication"},
     *      summary="POST Login user",
     *      operationId="LoginUser",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UserLoginRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/UserLogin")
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Invalid Credentials",
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Invalid request body"
     *      ),
     * )
     */
    public function login(UserLoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->get('password'), $user->password)) {

            $response = Http::asForm()->post(route('passport.token'), [
                'grant_type'    => 'password',
                'client_id'     => env('PASSWORD_GRANT_CLIENT_ID'),
                'client_secret' => env('PASSWORD_GRANT_CLIENT_SECRET'),
                'username'      => $request->get('email'),
                'password'      => $request->get('password'),
                'scope'         => '*',
            ]);      

            if ($response->successful()) {
                return $response->json();
            }
        }

        return response()->json(['error' => 'Invalid Credentials'], 401);
    }

    /**
     * @OA\Post(
     *     path="/api/logout",
     *     description="Logout user",
     *     tags={"Authentication"},
     *     summary="POST Logout user",
     *     operationId="Logout",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Response(
     *          response=204,
     *          description="Successfully logged out",
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized"
     *      )
     * )
     */
    public function logout(Request $request)
    {
        $user = Auth::guard('api')->user();
    
        if ($user && $user->token()) {
            app(TokenRepository::class)->revokeAccessToken($user->token()->id);
            return response()->json(null, 204);
        }
    
        return response()->json(['message' => 'No active token found or user already logged out'], 400);
    }

}
