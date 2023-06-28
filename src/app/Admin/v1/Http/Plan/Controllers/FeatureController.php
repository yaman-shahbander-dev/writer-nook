<?php

namespace App\Admin\v1\Http\Plan\Controllers;

use App\Admin\v1\Http\Plan\Requests\CreatePlanFeaturesRequest;
use App\Admin\v1\Http\Plan\Requests\UpdatePlanFeaturesRequest;
use App\Admin\v1\Http\Plan\Resources\FeatureResource;
use App\Http\Controllers\Controller;
use Domain\Plan\DataTransferObjects\FeatureData;
use Domain\Plan\Models\Feature;
use Domain\Plan\Facades\AdminFeatureFacade;
use Illuminate\Http\JsonResponse;

class FeatureController extends Controller
{
    public function index(): JsonResponse
    {
        $this->authorize('view', app(Feature::class));

        $features = AdminFeatureFacade::index();

        return FeatureResource::paginatedCollection($features);
    }

    public function show(Feature $feature): JsonResponse
    {
        $this->authorize('view', app(Feature::class));

        $feature = AdminFeatureFacade::show($feature->id);

        return $feature
            ? $this->okResponse(FeatureResource::make($feature))
            : $this->failedResponse();
    }

    public function store(CreatePlanFeaturesRequest $request): JsonResponse
    {
        $this->authorize('store', app(Feature::class));

        $feature = AdminFeatureFacade::store(FeatureData::from($request->all()));

        return $feature
            ? $this->okResponse(FeatureResource::make($feature))
            : $this->failedResponse();
    }

    public function update(UpdatePlanFeaturesRequest $request, Feature $feature): JsonResponse
    {
        $this->authorize('update', $feature);

        $result = AdminFeatureFacade::update(FeatureData::from($request->all()));

        return $result
            ? $this->okResponse()
            : $this->failedResponse();
    }

    public function destroy(Feature $feature): JsonResponse
    {
        $this->authorize('delete', $feature);

        $result = AdminFeatureFacade::delete($feature->id);

        return $result
            ? $this->okResponse()
            : $this->failedResponse();
    }
}
