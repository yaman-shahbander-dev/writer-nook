<?php

use Database\Factories\Client\BecomeAuthorFactory;
use Domain\Client\Actions\User\SendRequestAction;
use Domain\Client\DataTransferObjects\BecomeAuthorData;

it('deletes a become author request', function () {
    $request = BecomeAuthorFactory::new()->definition();
    $result = SendRequestAction::run(BecomeAuthorData::from($request));
    expect($result)->toBeTrue();
});
