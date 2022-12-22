<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\RzyUser;
use Illuminate\Http\Request;
use App\Services\Auth\AuthService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Traits\RespondsWithHttpStatus;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\SignUpRequest;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    protected $authService;
    use RespondsWithHttpStatus;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @OA\Post(
     *      path="/signup",
     *      operationId="signup",
     *      tags={"Sign Up"},
     *      summary="Signup User in DB",
     *      description="Signup User in DB",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"title", "content", "status"},
     *            @OA\Property(property="name", type="string", format="string", example="John Doe"),
     *            @OA\Property(property="email", type="string", format="string", example="john@gmail.com"),
     *            @OA\Property(property="password", type="string", format="string", example="password")
     *         ),
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=""),
     *             @OA\Property(property="data",type="object")
     *          )
     *       )
     *  )
     */

    public function signup(SignUpRequest $request)
    {
        return $this->authService->userSignUp($request);
    }


    /**
     * @OA\Post(
     *      path="/login",
     *      operationId="login",
     *      tags={"Login"},
     *      summary="Login User in DB",
     *      description="Login User in DB",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"title", "content", "status"},
     *            @OA\Property(property="email", type="string", format="string", example="john@gmail.com"),
     *            @OA\Property(property="password", type="string", format="string", example="password")
     *         ),
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=""),
     *             @OA\Property(property="data",type="object")
     *          )
     *       )
     *  )
     */
    public function login(LoginRequest $request)
    {
        return $this->authService->login($request);
    }
}
