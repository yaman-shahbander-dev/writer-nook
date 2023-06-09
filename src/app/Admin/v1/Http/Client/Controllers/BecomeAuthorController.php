<?php

namespace App\Admin\v1\Http\Client\Controllers;

use App\Admin\v1\Http\Client\Resources\BecomeAuthorResource;
use App\Http\Controllers\Controller;
use Domain\Client\Models\BecomeAuthor;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Domain\Client\Facades\AdminAuthFacade;

class BecomeAuthorController extends Controller
{
    public function index(): JsonResponse
    {
        $this->authorize('view', app(BecomeAuthor::class));

        $becomeAuthors = AdminAuthFacade::BecomeAuthorAction();

        return BecomeAuthorResource::paginatedCollection($becomeAuthors);
    }

    public function approve(BecomeAuthor $becomeAuthor): JsonResponse
    {
        $this->authorize('approve', app(BecomeAuthor::class));

        DB::beginTransaction();

        try {
            $result = AdminAuthFacade::ApproveBecomeAuthorAction($becomeAuthor->id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }

        return $result
            ? $this->okResponse()
            : $this->failedResponse();
    }

    public function destroy(BecomeAuthor $becomeAuthor): JsonResponse
    {
        $this->authorize('delete', app(BecomeAuthor::class));

        $result = AdminAuthFacade::DeleteBecomeAuthorAction($becomeAuthor->id);

        return $result
            ? $this->okResponse()
            : $this->failedResponse();
    }
}
