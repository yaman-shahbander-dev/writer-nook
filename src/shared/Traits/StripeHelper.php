<?php

namespace Shared\Traits;

use Stripe\Exception\ApiConnectionException;
use Stripe\Exception\ApiErrorException;
use Stripe\Exception\AuthenticationException;
use Stripe\Exception\CardException;
use Stripe\Exception\InvalidRequestException;
use Illuminate\Http\Response;

trait StripeHelper
{
    public function getExceptionDto(
        ?\Exception $exception = null,
        ?int $state = null,
        ?string $massage = null
    ): array {
        $message = $massage ?? $exception?->getMessage();
        if ($exception instanceof CardException) {
            $massage = $exception->getError()->message;
            $state = Response::HTTP_UNPROCESSABLE_ENTITY;
        } elseif ($exception instanceof InvalidRequestException) {
            $massage = 'Invalid parameters were supplied to Stripe\'s API';
            $state = Response::HTTP_UNPROCESSABLE_ENTITY;
        } elseif ($exception instanceof AuthenticationException) {
            $massage = 'Authentication with Stripe\'s API failed';
            $state = Response::HTTP_UNAUTHORIZED;
        } elseif ($exception instanceof ApiConnectionException) {
            $massage = 'Network communication with Stripe failed';
            $state = Response::HTTP_BAD_REQUEST;
        } elseif ($exception instanceof ApiErrorException) {
            $massage = 'Payment Server  Error';
            $state = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return [
            'state' => $state,
            'massage' => $massage
        ];
    }
}
