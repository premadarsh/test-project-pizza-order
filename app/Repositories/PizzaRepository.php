<?php
namespace App\Repositories;

use App\Models\Size;
use App\Models\Pizzaoptions;

class PizzaRepository
{

    public function getPizzaSizes()
    {
        return Size::orderBy('position')->get();
    }

    public function getPizzaToppings()
    {
        return Pizzaoptions::toppings()->get();
    }

    public function getPizzaExtras()
    {
        return Pizzaoptions::extracheese()->get();
    }

    public function calculateOrderTotal($request)
    {
        $totalPrice = 0;

        $size = $this->getPizzaSizes();

        $toppings = $this->getPizzaToppings();

        $extraCheese = $this->getPizzaExtras();

        if ($request->has('size'))
        {
            $selectedSizePrice = $size->where('id', $request->size)->first()->price;
            $totalPrice += $selectedSizePrice;
        }

        if ($request->has('toppings'))
        {
            $selectedToppingPrice = $toppings->where('id', $request->toppings)->first()->price;
            $totalPrice += $selectedToppingPrice;
        }

        if ($request->has('extra_cheese'))
        {
            $selectedCheesePrice = $extraCheese->where('size_id', $request->size)->first()->price;

            $totalPrice += $selectedCheesePrice;
        }

        return $totalPrice;
    }

}
