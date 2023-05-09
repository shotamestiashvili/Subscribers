<?php

namespace Domain\Mail\Models;

use Domain\Mail\DataTransferObjects\FilterData;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class FiltersCast implements  CastsAttributes
{
    public function get($model, string $key, $value, array $attributes): FilterData
    {
       $filterArray = json_decode($value, true);

       return $filterArray
           ? FilterData::from($filterArray)
           : FilterData::from(FilterData::empty());
    }

    public function set($model, string $key, $value, array $attributes)
    {
       return ['filters' => json_encode($value)];
    }
}
