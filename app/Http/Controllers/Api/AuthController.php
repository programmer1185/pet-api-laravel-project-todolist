<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    /** @var AuthService $authService */
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @OA\Post(
     *      path="/login",
     *      operationId="login",
     *      tags={"Todo List"},
     *      summary="login",
     *      description="Returns token",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/LoginRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/User")
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable"
     *      )
     *     )
     */
    public function login(LoginRequest $request): Response
    {
        return response($this->authService->login($request->getDto()));
    }

    /**
     * @OA\Post(
     *      path="/register",
     *      operationId="register",
     *      tags={"Todo List"},
     *      summary="register",
     *      description="Returns token",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/RegisterRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/User")
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable"
     *      )
     *     )
     */
    public function register(RegisterRequest $request): Response
    {
        return response($this->authService->register($request->getDto()));
    }
}
