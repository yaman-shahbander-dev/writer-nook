<?php

namespace Domain\Article\States;

use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class ArticleState extends State
{
    private string $field = 'state';

    /**
     * @throws \Spatie\ModelStates\Exceptions\InvalidConfig
     */
    public static function config(): StateConfig
    {
        return parent::config()
            ->default(Drafted::class)
            ->allowTransition(Drafted::class, Ready::class)
            ->allowTransition(Ready::class, Published::class)
            ->allowTransition(Published::class, Deleted::class)
            ->allowTransition([Drafted::class, Ready::class, Published::class], Drafted::class)
            ->allowTransition(Ready::class, Ready::class)
            ->allowTransition(Drafted::class, Deleted::class)
            ->allowTransition(Drafted::class, Drafted::class);
    }
}
