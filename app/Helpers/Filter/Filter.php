<?php

namespace App\Helpers\Filter;

class Filter extends FilterAbstract
{


    /**
     * @param $value
     */
    public function search($value)
    {
        $this->builder->where('name', 'LIKE', "%$value%");
    }

    public function catalogCategory($value)
    {
        if (count(json_decode($value)) > 0)
            $this->builder->whereIn('category_id', json_decode($value));
    }

}
