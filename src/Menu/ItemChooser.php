<?php
namespace Lesstif\JiraCli\Menu;

use PhpSchool\CliMenu\CliMenu;
use PhpSchool\CliMenu\CliMenuBuilder;

class ItemChooser
{
    private $menu;

    private $selectedItem;

    public function setMenuBuilder(CliMenuBuilder $menuBuilder)
    {
        $this->menu = $menuBuilder->build();
    }

    public function getCallback()
    {
        return function (CliMenu $menu) {
            $this->selectedItem = $menu->getSelectedItem();
            $menu->close();
        };
    }

    public function select()
    {
        $this->menu->open();
        return $this->selectedItem;
    }
}
}