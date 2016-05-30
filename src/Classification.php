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
            $o[$groupLabel][$value['code']] = $value['code'].' '.$value['name'];
        }
        return $o;
    }

    public function getSelectWidget($name, $selectedValue = null)
    {
        $data = $this->getSelectArray();

        $o = '<select name="'.$name.'">';
        foreach ($data as $label => $d) {
            $o .= '<optgroup label="'.$label.'">';
            foreach ($d as $value => $name) {
                $o .= '<option value="'.$value.'"';
                if ($selectedValue == $value) {
                    $o .= ' selected="selected"';
                }
                $o .= '>'.$name.'</option>';
            }
            $o .= '</optgroup>';
        }
        $o .= '</select>';

        return $o;
    }

    public function getSelectWidget4($name, $selectedValue = null)
    {
        $o = '';
        $data = $this->getSelectArray4($selectedValue);

        foreach ($data as $index => $items) {
            $o .= '<select';
            if ($index == 3) {
                $o .= ' name="'.$name.'"';
            }
            $o .= '><option></option>';
            $o .= $this->fillWidget4SelectOptions($items);
            $o .= '</select>';
        }

        return '<div class="wispiring-cec-combo">'.$o.'</div>';
    }

    private function fillWidget4SelectOptions($items)
    {
        $o = '';
        foreach ($items as $d) {
            $o .= '<option value="'.$d['code'].'"';
            if (isset($d['parent'])) {
                $o .= ' data-parent="'.$d['parent'].'"';
            }
            if ($d['selected']) {
                $o .= ' selected="selected"';
            }
            $o .= '>'.$d['code'].' '.$d['name'].'</option>';
        }

        return $o;
    }

    public function getSelectArray4($selectedValue = null)
    {
        $o = [[],[],[],[]];

        if ($selectedValue) {
            $selected = $this->data[$selectedValue];
        } else {
            $selected = [
                'code' => null,
                'top_category' => null,
                'first_category' => null,
                'second_category' => null,
            ];
        }

        foreach ($this->data as $key => $value) {
            $keyLen = strlen($key);
            switch ($keyLen) {
                case 1:
                    $o[0][$key]= $this->simplifyItemDataArray($value, null, $selected['top_category']);
                    break;
                case 2:
                    $o[1][$key]= $this->simplifyItemDataArray($value, 'top_category', $selected['first_category']);
                    break;
                case 3:
                    $o[2][$key]= $this->simplifyItemDataArray($value, 'first_category', $selected['second_category']);
                    break;
                case 4:
                    $o[3][$key]= $this->simplifyItemDataArray($value, 'second_category', $selected['code']);
                    // some second_category are missing
                    if (!isset($o[2][$value['second_category']])) {
                        $o[2][$value['second_category']] = [
                            'code' => $value['second_category'],
                            'name' => $value['name'],
                            'description' => $o[1][$value['first_category']]['description'],
                            'parent' => $value['first_category'],
                            'selected' => ($selected['code'] == $value['code']),
                        ];
                    }
                    break;
                default:
                    break;
            }
        }

        return $o;
    }

    private function simplifyItemDataArray($item, $parentKey = null, $selectedValue = null)
    {
        $o = [
            'code' => $item['code'],
            'name' => $item['name'],
            'description' => $item['description'],
            'selected' => ($selectedValue && ($item['code'] == $selectedValue)),
        ];
        if ($parentKey) {
            $o['parent'] = $item[$parentKey];
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
