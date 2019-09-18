<?php

namespace Modules\Ibooking\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Ibooking\Entities\Price;
use Modules\Ibooking\Http\Requests\CreatePriceRequest;
use Modules\Ibooking\Http\Requests\UpdatePriceRequest;
use Modules\Ibooking\Repositories\PriceRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class PriceController extends AdminBaseController
{
    /**
     * @var PriceRepository
     */
    private $price;

    public function __construct(PriceRepository $price)
    {
        parent::__construct();

        $this->price = $price;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $prices = $this->price->all();
        return view('ibooking::admin.prices.index', compact('prices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('ibooking::admin.prices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreatePriceRequest $request
     * @return Response
     */
    public function store(CreatePriceRequest $request)
    {
        $this->price->create($request->all());

        return redirect()->route('admin.ibooking.price.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('ibooking::prices.title.prices')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Price $price
     * @return Response
     */
    public function edit(Price $price)
    {
        return view('ibooking::admin.prices.edit', compact('price'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Price $price
     * @param  UpdatePriceRequest $request
     * @return Response
     */
    public function update(Price $price, UpdatePriceRequest $request)
    {
        $this->price->update($price, $request->all());

        return redirect()->route('admin.ibooking.price.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('ibooking::prices.title.prices')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Price $price
     * @return Response
     */
    public function destroy(Price $price)
    {
        $this->price->destroy($price);

        return redirect()->route('admin.ibooking.price.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('ibooking::prices.title.prices')]));
    }
}
