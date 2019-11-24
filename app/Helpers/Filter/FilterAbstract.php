<?php

namespace App\Helpers\Filter;

/**
 * Абстракция фильтра
 * Class FilterAbstract
 * @package App\Helpers\Filter
 */
abstract class FilterAbstract {

    /**
     * @var $builder
     */
    protected $builder;
    /**
     * @var $request
     */
    protected $request;

    /**
     * FilterAbstract constructor.
     * @param $builder
     * @param $request
     */
    public function __construct($builder, $request)
    {
        $this->builder = $builder;
        $this->request = $request;
        $this->apply();
    }

    public static function init($builder, $request)
    {
        return new Filter($builder, $request);
    }

    /**
     *
     */
    public function apply() {
        foreach ($this->filters() as $filter => $value)
        {
            if(method_exists($this, $filter))
            {
                $this->$filter($value);
            }
        }
        return $this->builder;
    }

    /**
     * @return mixed
     */
    public function filters() {
        return $this->request->all();
    }

}
