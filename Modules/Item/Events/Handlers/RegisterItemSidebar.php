<?php

namespace Modules\Item\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterItemSidebar implements \Maatwebsite\Sidebar\SidebarExtender
{
    /**
     * @var Authentication
     */
    protected $auth;

    /**
     * @param Authentication $auth
     *
     * @internal param Guard $guard
     */
    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    public function handle(BuildingSidebar $sidebar)
    {
        $sidebar->add($this->extendWith($sidebar->getMenu()));
    }

    /**
     * @param Menu $menu
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('item::items.title.items'), function (Item $item) {
                $item->icon('fa fa-copy');
                $item->weight(10);
                $item->authorize(
                     /* append */
                );
                $item->item(trans('item::rarities.title.rarities'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.item.rarity.create');
                    $item->route('admin.item.rarity.index');
                    $item->authorize(
                        $this->auth->hasAccess('item.rarities.index')
                    );
                });
                $item->item(trans('item::types.title.types'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.item.type.create');
                    $item->route('admin.item.type.index');
                    $item->authorize(
                        $this->auth->hasAccess('item.types.index')
                    );
                });
                $item->item(trans('item::items.title.items'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.item.item.create');
                    $item->route('admin.item.item.index');
                    $item->authorize(
                        $this->auth->hasAccess('item.items.index')
                    );
                });
// append



            });
        });

        return $menu;
    }
}
