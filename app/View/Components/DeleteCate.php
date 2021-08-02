<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Product;
use App\Models\Category;

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
                if ($this->cate->getProduct->count() > 0) {
                    foreach ($this->cate->getProduct as $items) {
                        Product::find($items->id)->update(array('category_id' => 1));
                    }
                }
                Category::find($item->id)->update(array('parent_id' => 0));
                $this->cate->delete();
            } else {
                if ($this->cate->getProduct->count() > 0) {
                    foreach ($this->cate->getProduct as $items) {
                        Product::find($items->id)->update(array('category_id' => 1));
                    }
                }
                $this->cate->delete();
            }
        }
    }
}