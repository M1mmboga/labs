@extends('layouts.app')
@section('content')

<div>
       <h3>Student Data</h3>

       <table class="table table-bordered">
       
       <tr>
           <th>Car ID</th>
           <th>Car Name</th>
           <th>Review</th>
           
       </tr>

     @foreach($rev as $row)
     <tr>
         <td>{{$row['car_id']}}</td>
         <td>{{$row['car_name']}}</td>
         <td>{{$row['review']}}</td>
        
     </tr>
     @endforeach

     
       </table>
    </div>

@stop