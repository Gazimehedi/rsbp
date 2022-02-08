@extends('layouts.layout')
@section('content')
    <section class="container my-5">
        <div class="row">
            <div class="card col-md-8 p-5">
                <form action="{{url('commentupdate',$id)}}" method="post">@csrf
                    <div class="form-group">
                        <label for="comment">Comment</label>
                        <textarea class="form-control" name="comment" cols="30" rows="5" required></textarea>
                    </div>
                    <button class="btn btn-secondary" type="submit">Comment</button>
                </form>
            </div>
        </div>
    </section>
@endsection
