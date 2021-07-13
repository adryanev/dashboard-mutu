<?php


namespace common\helpers;

use yii2mod\helpers\ArrayHelper;

trait HitungNarasiLkTrait
{

    public function hitung($class, $exclude, $json): float
    {
        $count = 0;
        $filters = array_filter($class->attributes, function ($attribute) use ($exclude) {
            return in_array($attribute, $exclude, true) === false;
        }, ARRAY_FILTER_USE_KEY);


        //convert attribute db ke format penomoran pada json
        $attributeKeys = array_map(function ($element) {
            return NomorKriteriaHelper::changeToJsonFormat($element);
        }, array_keys($filters));


        //mendapatkan nomor tabel dari json
        $indexJson = ArrayHelper::index($json->butir, 'tabel');
        $keysJson = array_keys($indexJson);

        $arrayIntersect = array_values(array_intersect($attributeKeys, $keysJson));

        $total = sizeof($arrayIntersect);
        foreach ($arrayIntersect as $k => $attribute) {
            $nomor = NomorKriteriaHelper::changeToDbFormat($attribute);
            if ($attribute === $json->butir[$k]->tabel) {
                $template = $json->butir[$k]->template;
                $wordCountTemplate = strlen($template);

                $data = $class->$nomor;
                $wordCountData = strlen($data);

                if ($wordCountTemplate !== $wordCountData) {
                    ++$count;
                }
            }
        }

        return round(($count / $total) * 100, 2);
    }
}
