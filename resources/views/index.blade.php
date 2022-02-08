@extends('layouts.layout')
@section('content')
<section class="container">
<div class="row">
    <div class="card col-md-6 offset-md-3 my-5 p-5">
    @if(session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{session('error')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
        <div class="py-5 text-center" >
            <h2>RSVP</h2>
            <h3>Confirm Your Perticipation</h3>
        </div>
        <div class="form text-center my-5">
            <form action="{{route('cardcodecheck')}}" method="post">
                @csrf
                <h3><input type="text" name="cardcode"></h3>
                <p><button type="submit" class="btn btn-info">Login</button></p>
            </form>
        </div>
    </div>
</div>
</section>
@endsection
