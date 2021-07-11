<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DeleteCate
{
    public $cate;
    public $cates;
    public function __construct($cates, $cate)
    {
        $this->cate = $cate;
        $this->cates = $cates;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function deleteCategoryRecursive($id)
    {
        foreach ($this->cates as $item) {
            if ($item['parent_id'] == $id) {
                $item->delete();
                $this->deleteCategoryRecursive($item['id']);
            } else {
                $this->cate->delete();
            }
        }
    }
}