<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Mime\Message;

class CarController extends Controller
{
    //
    public function allcars()
    {
        //read all cars

        $car = Car::select('*')->get();

        return view('car.allcars', ['car' => $car]);


    }

    public function particularcar($id)
    {
        //read particular car by id
    }
    
    public function newcar(Request $request)
    {
        //create new car

        $this->validate(request(), [
            'make' => 'required|unique:cars',
            'model' => 'required|unique:cars',
            'produced_on' => 'required|unique:cars',
        ]);

        $car = new Car();

        $car->make = $request->input('make');
        $car->model = $request->input('model');
        $car->produced_on = $request->input('produced_on');
        $car->save();
        return Redirect::back()->with('message','New car successfully saved');

    
    }

    public function registerCar()
    {
        return view('car.registercars');
    }
}
