<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\Order\StoreOrderRequest;

use App\Repositories\PizzaRepository;

class PizzaController extends Controller
{
    private $pizzaservice;

    public function __construct(PizzaRepository $pizzaservice)
    {
        $this->pizzaservice = $pizzaservice;
    }

    public function index(Request $request)
    {
        $size = $this->pizzaservice->getPizzaSizes();

        $toppings = $this->pizzaservice->getPizzaToppings();

        $extracheese = $this->pizzaservice->getPizzaExtras();

        return view('order', compact('size', 'toppings', 'extracheese'));
    }

    public function store(StoreOrderRequest $request)
    {
        $totalprice = $this->pizzaservice->calculateOrderTotal($request);

        dd('Total Price: '.$totalprice);

        //We may save the order data
    }
}
