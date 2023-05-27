<?php

if ( ! function_exists('getIds')) {
    function getIds($collection): array
    {
        $ids = [];
        foreach ($collection as $item) {
            $ids[] = $item->id;
        }
        return $ids;
    }
}
