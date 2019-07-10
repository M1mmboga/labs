@extends('layouts.app')
@section('content')

<div class="container">

    
<form action="{{url('/newcar')}}" method="POST">
            
            {{ csrf_field() }} 
    
            Register A New Car
    
            <div class="form-group">
                Car Make
                <input type="text" name="make">
            </div>
    
            <div class="form-group">
                Car Model
                <input type="text" name="model">
            </div>
    
            <div class="form-group">
                Produced On
                <input type="date" name="produced_on">
            </div>
    
            <div class="form-group">
                <input type="submit" name="Submit" class="btn btn-primary">
            </div>
    
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
    
            @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
        </form>

        <hr>

        <a href="/car" class="btn btn-primary">Show All Cars</a>
</div>


@stop