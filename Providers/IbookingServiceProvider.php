<?php

namespace Modules\Ibooking\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Ibooking\Events\Handlers\RegisterIbookingSidebar;

class IbookingServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->app['events']->listen(BuildingSidebar::class, RegisterIbookingSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('events', array_dot(trans('ibooking::events')));
            $event->load('plans', array_dot(trans('ibooking::plans')));
            $event->load('prices', array_dot(trans('ibooking::prices')));
            $event->load('days', array_dot(trans('ibooking::days')));
            $event->load('slots', array_dot(trans('ibooking::slots')));
            $event->load('reservations', array_dot(trans('ibooking::reservations')));
            // append translations






        });
    }

    public function boot()
    {
        $this->publishConfig('ibooking', 'permissions');
        $this->publishConfig('ibooking', 'settings');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Ibooking\Repositories\EventRepository',
            function () {
                $repository = new \Modules\Ibooking\Repositories\Eloquent\EloquentEventRepository(new \Modules\Ibooking\Entities\Event());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Ibooking\Repositories\Cache\CacheEventDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Ibooking\Repositories\PlanRepository',
            function () {
                $repository = new \Modules\Ibooking\Repositories\Eloquent\EloquentPlanRepository(new \Modules\Ibooking\Entities\Plan());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Ibooking\Repositories\Cache\CachePlanDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Ibooking\Repositories\PriceRepository',
            function () {
                $repository = new \Modules\Ibooking\Repositories\Eloquent\EloquentPriceRepository(new \Modules\Ibooking\Entities\Price());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Ibooking\Repositories\Cache\CachePriceDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Ibooking\Repositories\DayRepository',
            function () {
                $repository = new \Modules\Ibooking\Repositories\Eloquent\EloquentDayRepository(new \Modules\Ibooking\Entities\Day());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Ibooking\Repositories\Cache\CacheDayDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Ibooking\Repositories\SlotRepository',
            function () {
                $repository = new \Modules\Ibooking\Repositories\Eloquent\EloquentSlotRepository(new \Modules\Ibooking\Entities\Slot());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Ibooking\Repositories\Cache\CacheSlotDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Ibooking\Repositories\ReservationRepository',
            function () {
                $repository = new \Modules\Ibooking\Repositories\Eloquent\EloquentReservationRepository(new \Modules\Ibooking\Entities\Reservation());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Ibooking\Repositories\Cache\CacheReservationDecorator($repository);
            }
        );
// add bindings






    }
}
