<?php

namespace Wispiring\ChinaEconomyClassification;

class Classification
{
    const STANDARD = 'GB/4754';
    private $dataSource;
    private $data;

    public function __construct($dataSource = null)
    {
        if (null === $dataSource) {
            $this->dataSource = 'Y2011';
        }
        $className = '\Wispiring\ChinaEconomyClassification\Data\\'.$this->dataSource;
        $this->data = new $className();
        $this->data = $this->data->get();
    }

    public function getArray()
    {
        return $this->data;
    }

    public function getJson()
    {
        return json_encode($this->data);
    }

    public function getByCode($code)
    {
        return isset($this->data[$code]) ? $this->data[$code] : null;
    }

    public function getSelectArray()
    {
        $o = [];
        foreach ($this->data as $key => $value) {
            if (strlen($value['code']) !== 4) {
                continue;
            }
            $groupLabel = $value['top_category'].' '.$this->data[$value['top_category']]['name'];
            if (!isset($o[$groupLabel])) {
                $o[$groupLabel] = [];
            }
            $o[$groupLabel][$value['code']]= $value['code'].' '.$value['name'];
        }
        return $o;
    }

    public function getByName($name)
    {
        foreach ($this->data as $value) {
            if ($value['name'] === $name) {
                return $value;
            }
        }
    }

    public function getByTopCategory($categoryValue)
    {
        return $this->getByCategory('top_category', $categoryValue);
    }

    public function getByFirstCategory($categoryValue)
    {
        return $this->getByCategory('first_category', $categoryValue);
    }

    public function getBySecondCategory($categoryValue)
    {
        return $this->getByCategory('second_category', $categoryValue);
    }

    public function getByThirdCategory($categoryValue)
    {
        return $this->getByCode($categoryValue);
    }

    private function getByCategory($categoryKey, $categoryValue)
    {
        $o = [];
        foreach ($this->data as $key => $value) {
            if ($value[$categoryKey] === $categoryValue) {
                $o[$key] = $value;
            }
        }
        return $o;
    }
}
