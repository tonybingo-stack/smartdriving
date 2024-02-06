<?php

namespace App\Http\Controllers\Admin;
use App\Models\Car;


class CarController extends TemplateController
{
    public function __construct(Car $car)
    {
        parent::__construct($car, 'Admin/Car/IndexCars', 'name');
    }
}
