<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MenuRecursive
{
    private $htmlSelect;
    private $data;
    public function __construct($data)
    {
        $this->html = '';
        $this->data = $data;
    }

    public function menuRecursiveAdd($parentId = 0, $text = '')
    {
        foreach ($this->data as $value) {
            if ($value['parent_id'] == $parentId) {
                $this->htmlSelect .= "<option value='" . $value['id'] . "'>" . $text . $value['name'] . "</option>";
                $this->menuRecursiveAdd($value['id'], $text . "-- ");
            }
        }
        return $this->htmlSelect;
    }

    public function menuRecursiveEdit($parentIdMenuEdit, $parentId = 0, $text = '')
    {
        foreach ($this->data as $value) {
            if ($value['parent_id'] == $parentId) {
                if ($parentIdMenuEdit == $value['id']) {
                    $this->htmlSelect .= "<option selected value='" . $value['id'] . "'>" . $text . $value['name'] . "</option>";
                } else {
                    $this->htmlSelect .= "<option value='" . $value['id'] . "'>" . $text . $value['name'] . "</option>";
                }
                $this->menuRecursiveEdit($parentIdMenuEdit, $value['id'], $text . "-- ");
            }
        }
        return $this->htmlSelect;
    }
}