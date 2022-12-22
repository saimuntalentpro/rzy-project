<?php

namespace App\Services\Auth;
use App\Models\RzyUser;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Traits\RespondsWithHttpStatus;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthService
{
    use RespondsWithHttpStatus;

    protected $model;

    public function __construct(RzyUser $user)
    {
        $this->model = $user;
    }

    public function userSignUp($request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $inputs = $request->all();
            $inputs['password'] = Hash::make($request->password);
            $user = $this->model->create($inputs);
            if ($user) {
                return $this->success(
                    "Signup has been done successfully!",
                    new UserResource($user),
                    Response::HTTP_CREATED
                );
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->failure(
                'Something is wrong! Please try again later!',
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    public function login($request)
    {
        try {
            DB::beginTransaction();
            $user = $this->model->where('email', '=', trim($request->email))->first();

            if ($user && Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Rezy')->accessToken;
                return $this->loginSuccess(
                    "Login Successful, credentials matched!",
                    new UserResource($user),
                    Response::HTTP_CREATED,
                    $token
                );
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->failure(
                'Something is wrong! Please try again later!',
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    // public function logout(): JsonResponse
    // {
    //     if (Auth::user()) {
    //         $token = \auth()->user()->token();
    //         $token->revoke();
    //         $payload = [
    //             'code' => 200,
    //             'app_message' => 'You have been successfully logged out!',
    //         ];
    //         return response()->json($payload, 200);
    //     }
    //     $payload = [
    //         'code' => 401,
    //         'app_message' => 'not found',
    //     ];
    //     return response()->json($payload, 401);
    // }
}
