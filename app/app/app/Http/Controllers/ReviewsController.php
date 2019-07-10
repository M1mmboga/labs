<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\Review;

class ReviewsController extends Controller
{
    //

   
    public function store(Request $request)
    {
        $this->validate(request(), [
            'car_id' => 'required|exists:cars,id',
            'car_name' => 'required|exists:cars,make',
            'review' => 'required',
        ]);

        $revieww = new Review();
        $revieww->car_id = $request->input('car_id');
        $revieww->car_name = $request->input('car_name');
        $revieww->review = $request->input('review');
        $revieww->save();

        return Redirect::back()->with('message','Review updated successfully');
    }

    public function index()
    {
        //
        $rev = Review::all()->toArray();
        return view('car.allreviews', compact('rev'));
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $rev = DB::table('reviews')->where('car_id','like','%'.$search.'%')->paginate(8);
        return view('car.onereview',compact('rev'));
    }

}
