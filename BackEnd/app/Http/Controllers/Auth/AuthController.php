<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterUserRequest;

class AuthController extends Controller
{
    private RegisterUserRequest $registerUserRequest;
    private AuthService $authService;

   /**
    * @param AuthService $registerAccountService
    */
    public function __construct(AuthService $authService){
        $this->authService = $authService ;
    }

    public function register(  RegisterUserRequest $request) 
    {
     
        $registerUserDTO = $request->toDTO();
        $this->authService->register($registerUserDTO);
        return response()->json([
            'message' => 'register successfully'
        ],200);
        
    }
}