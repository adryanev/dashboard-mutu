<?php


namespace common\helpers;

trait HitungPenilaianTrait
{

    public function hitung($class, $exclude, $indikators)
    {
        $count = 0;
        // filter unused attribute for counting
        $filters = array_filter($class->attributes, function ($attribute) use ($exclude) {
            return in_array($attribute, $exclude, true) === false;
        }, ARRAY_FILTER_USE_KEY);

        // convert db attribute to json format number
        $attributeKeys = array_map(function ($element) {
            return NomorKriteriaHelper::changeToJsonFormat($element);
        }, array_keys($filters));


        // get only available number
        $intersect = array_intersect($attributeKeys, $indikators);

        foreach ($intersect as $number) {
            //convert back to db number
            $attribute = NomorKriteriaHelper::changeToDbFormat($number);

            //sum all the grading
            if (!empty($class->$attribute)) {
                $count += $class->$attribute;
            }
        }

        return $count;
    }
}
