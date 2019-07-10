@extends('layouts.app')

@section('content')

    <div class="container">
    <form action="{{url('myreview')}}" method="POST">
    {{ csrf_field() }} 

        <div class="form-group">
            Car id
            <input type="number" name="car_id">
        </div>

        <div class="form-group">
            Car make
            <input type="text" name="car_name">
        </div>

        <div class="form-group">
            Review
            <input type="text" name="review">
        </div>

        <div class="form-group">
            <input type="submit" name="Submit" class="btn btn-primary">
        </div>
    </form>

      <!-- error message -->
      @if(count($errors))
            <div class="form-group">
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
     <!-- success message -->
     @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif
    <hr>

    <div>
        Check Reviews Made
        <form action="/search" method="GET">
        {{ csrf_field() }}

         <div class="form-group">
         Enter Car ID
            <input type="search" name="search">
         </div>

         <div class="form-group">
             <input type="submit" name="Search" class="btn btn-primary">
         </div>
        </form>

    </div>

    <hr>

    <li><a href="/myreviews" class="btn btn-primary">View Reviews</a></li>
    </div>
@stop