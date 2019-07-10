@extends('layouts.app')
@section('content')

    <table class="table table-bordered">
        <tr>
            <td>Car ID</td>
            <td>Make</td>
            <td>Model</td>
        </tr>
            @foreach($car as $c)
        <tr>
            <td>{{$c->id}}</td>
            <td>{{$c->make}}</td>
            <td>{{$c->model}}</td>
        </tr>
        @endforeach
    </table>
@stop