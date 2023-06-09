<?php

use Database\Factories\Client\BecomeAuthorFactory;
use Domain\Client\Actions\Admin\GetBecomeAuthorsAction;

it('gets a paginated become author requests', function () {
    BecomeAuthorFactory::new()->count(10)->create();
    $requests = GetBecomeAuthorsAction::run();
    expect($requests)->toHaveCount(10);
});
