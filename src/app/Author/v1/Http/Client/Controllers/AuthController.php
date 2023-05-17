<?php

namespace App\Author\v1\Http\Client\Controllers;

use App\Author\v1\Http\Client\Requests\LoginRequest;
use App\Author\v1\Http\Client\Resources\AuthorResource;
use App\Http\Controllers\Controller;
use Domain\Client\Actions\Author\LoginAction;
use Domain\Client\Actions\Shared\RevokeTokenAction;
use Domain\Client\DataTransferObjects\AuthData;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
   public function login(LoginRequest $request): JsonResponse
   {
       $author = LoginAction::run(AuthData::from($request));
       return $author
           ? $this->okResponse(AuthorResource::make($author))
           : $this->failedResponse();
   }

   public function logout(Request $request): JsonResponse
   {
        $result = RevokeTokenAction::run($request->user());
        return $result
            ? $this->okResponse()
            : $this->failedResponse();
   }
}
