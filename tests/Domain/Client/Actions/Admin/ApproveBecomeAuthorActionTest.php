<?php

use Database\Factories\Client\BecomeAuthorFactory;
use Domain\Client\Actions\Admin\ApproveBecomeAuthorAction;

it('approves a become author request', function () {
    $request = BecomeAuthorFactory::new()->create();
    $result = ApproveBecomeAuthorAction::run($request->id);
    expect($result)->toBeTrue();
});
