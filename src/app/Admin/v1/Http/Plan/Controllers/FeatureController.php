<?php

namespace App\Admin\v1\Http\Plan\Controllers;

use App\Admin\v1\Http\Plan\Requests\CreatePlanFeaturesRequest;
use App\Admin\v1\Http\Plan\Resources\FeatureResource;
use App\Http\Controllers\Controller;
use Domain\Plan\DataTransferObjects\FeatureData;
use Domain\Plan\Models\Feature;
use Domain\Plan\Facades\AdminFeatureFacade;
use Illuminate\Http\JsonResponse;

class FeatureController extends Controller
{
    public function store(CreatePlanFeaturesRequest $request): JsonResponse
    {
        $this->authorize('store', app(Feature::class));

        $feature = AdminFeatureFacade::store(FeatureData::from($request->all()));

        return $feature
            ? $this->okResponse(FeatureResource::make($feature))
            : $this->failedResponse();
    }
}
