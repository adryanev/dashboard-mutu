<?php


namespace common\helpers;

trait HitungNarasiLedTrait
{

    public function hitung($class, $exclude)
    {

        $count = 0;
        $filters = array_filter($class->attributes, function ($attribute) use ($exclude) {
            return in_array($attribute, $exclude, true) === false;
        }, ARRAY_FILTER_USE_KEY);

        $total = sizeof($filters);

        foreach ($filters as $attribute) {
            if (!empty($attribute)) {
                ++$count;
            }
        }

        return round(($count/$total) * 100, 2);
    }
}
