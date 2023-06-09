<?php

use Database\Factories\Client\BecomeAuthorFactory;
use Domain\Client\Actions\Admin\DeleteBecomeAuthorAction;

it('deletes a become author request', function () {
    $request = BecomeAuthorFactory::new()->create();
    $result = DeleteBecomeAuthorAction::run($request->id);
    expect($result)->toBeTrue();
});
