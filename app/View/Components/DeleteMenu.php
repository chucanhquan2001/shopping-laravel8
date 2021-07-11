<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DeleteMenu
{
    public $menu;
    public $menus;
    public function __construct($menus, $menu)
    {
        $this->menu = $menu;
        $this->menus = $menus;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function deleteMenuRecursive($id)
    {
        foreach ($this->menus as $item) {
            if ($item['parent_id'] == $id) {
                $item->delete();
                $this->deleteMenuRecursive($item['id']);
            } else {
                $this->menu->delete();
            }
        }
    }
}