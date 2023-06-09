<?php

namespace App\User\v1\Http\Client\Controllers;

use App\Admin\v1\Http\Client\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\User\v1\Http\Client\Requests\BecomeAuthorRequest;
use App\User\v1\Http\Client\Requests\RegisterRequest;
use App\User\v1\Http\Client\Resources\UserResource;
use Domain\Client\DataTransferObjects\AuthData;
use Domain\Client\DataTransferObjects\BecomeAuthorData;
use Domain\Client\Models\BecomeAuthor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Domain\Client\Facades\UserAuthFacade;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = UserAuthFacade::register(AuthData::from($request));
        return $user
            ? $this->okResponse(UserResource::make($user))
            : $this->failedResponse();
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $user = UserAuthFacade::login(AuthData::from($request));
        return $user
            ? $this->okResponse(UserResource::make($user))
            : $this->failedResponse();
    }

    public function logout(Request $request): JsonResponse
    {
        $result = UserAuthFacade::logout($request->user());
        return $result
            ? $this->okResponse()
            : $this->failedResponse();
    }

    public function sendRequest(BecomeAuthorRequest $request): JsonResponse
    {
        $this->authorize('send', app(BecomeAuthor::class));

        $result = UserAuthFacade::sendRequest(BecomeAuthorData::from($request));

        return $result
            ? $this->okResponse()
            : $this->failedResponse();
    }
}
