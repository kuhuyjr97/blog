<?php

namespace App\Http\Controllers\Auth;

use App\Enums\ResponseEnum;
use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\LoginFailException;
use App\Http\Requests\LoginUserRequest;
use App\Exceptions\UnauthorizedException;
use Illuminate\Support\Facades\Log;
use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SucceedResponse;

class AuthController extends Controller
{
    private Authservice $loginService;

    public function __construct(AuthService $loginService)
    {
        $this->loginService = $loginService;
    }
    public function login(LoginUserRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');
        try {
            $loginResult = $this->loginService->login($credentials['email'], $credentials['password']);
            $responseBody = [
                'user' => $loginResult['user'],
                'token' => $loginResult['token'],
            ];
            $response = new SucceedResponse(ResponseEnum::RES_STATUS_SUCCESS, '', ResponseEnum::HTTP_STATUS_SUCCESS);
            return
                $response->json($responseBody);
        } catch (UnauthorizedException $e) {
            $response = new ErrorResponse($e->getCode(), $e->getMessage(), ResponseEnum::HTTP_STATUS_UNAUTHENTICATED);
            return $response->json();
        }
    }
    public function logout(Request $request): JsonResponse
    {
        Log::info('headers', ['authorization', $request->header('authorization')]);
        $request->user()->currentAccessToken()->delete();
        $responseBody = [
            'message' => ResponseEnum::RES_MSG_SUCCESS,
        ];
        $response = new SucceedResponse(ResponseEnum::RES_STATUS_SUCCESS, '', ResponseEnum::HTTP_STATUS_SUCCESS);
        return $response->json($responseBody);
    }
}
