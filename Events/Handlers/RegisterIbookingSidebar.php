<?php

namespace Modules\Ibooking\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterIbookingSidebar implements \Maatwebsite\Sidebar\SidebarExtender
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
            $group->item(trans('ibooking::common.ibooking'), function (Item $item) {
                $item->icon('fa fa-outdent');
                $item->weight(10);
                $item->authorize(
                     /* append */
                );
                $item->item(trans('ibooking::events.plural'), function (Item $item) {
                    $item->icon('fa fa-calendar-o');
                    $item->weight(0);
                    $item->append('admin.ibooking.event.create');
                    $item->route('admin.ibooking.event.index');
                    $item->authorize(
                        $this->auth->hasAccess('ibooking.events.index')
                    );
                });
                $item->item(trans('ibooking::plans.plural'), function (Item $item) {
                    $item->icon('fa fa-calendar-check-o');
                    $item->weight(0);
                    $item->append('admin.ibooking.plan.create');
                    $item->route('admin.ibooking.plan.index');
                    $item->authorize(
                        $this->auth->hasAccess('ibooking.plans.index')
                    );
                });
                /*
                $item->item(trans('ibooking::prices.plural'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.ibooking.price.create');
                    $item->route('admin.ibooking.price.index');
                    $item->authorize(
                        $this->auth->hasAccess('ibooking.prices.index')
                    );
                });
                */
                
                $item->item(trans('ibooking::days.plural'), function (Item $item) {
                    $item->icon('fa fa-calendar');
                    $item->weight(0);
                    $item->append('admin.ibooking.day.create');
                    $item->route('admin.ibooking.day.index');
                    $item->authorize(
                        $this->auth->hasAccess('ibooking.days.index')
                    );
                });
               
                /*
                $item->item(trans('ibooking::slots.title.slots'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.ibooking.slot.create');
                    $item->route('admin.ibooking.slot.index');
                    $item->authorize(
                        $this->auth->hasAccess('ibooking.slots.index')
                    );
                });
                */
               
                $item->item(trans('ibooking::reservations.plural'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.ibooking.reservation.create');
                    $item->route('admin.ibooking.reservation.index');
                    $item->authorize(
                        $this->auth->hasAccess('ibooking.reservations.index')
                    );
                });

                $item->item(trans('ibooking::reservations.bulkload.title'), function (Item $item) {
                    $item->icon('fa fa-upload');
                    $item->weight(0);
                    $item->route('admin.ibooking.bulkload.index');
                    $item->authorize(
                        $this->auth->hasAccess('ibooking.bulkload.import')
                    );
                });
               
// append






            });
        });

        return $menu;
    }
}
