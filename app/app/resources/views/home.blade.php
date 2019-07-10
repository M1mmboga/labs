@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                    Proceed below:
                    <ul>
                        <li><a href="/car">Show All Cars</a></li>
                        <li><a href="registerCar">Register a Car</a></li>
                        <li><a href="/reviews">Make a Review</a></li>
                        <li><a href="/myreviews">Show All Reviews</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
