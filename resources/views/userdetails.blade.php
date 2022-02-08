@extends('layouts.layout')
@section('content')
    <section class="container">
        <div class="row">
            <div class="card col-md-8 offset-md-2 my-5 p-5">
                @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('success')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <form action="{{url('updateperticipation/'.$check[0]->id)}}" method='post'>@csrf
                <div class="card-body">
                    <div class="image text-center my-4">
                        <img src="{{asset($check[0]->typeImage)}}" width="200" >
                    </div>
                    <div class="my-2">
                        <h3>Hi {{$check[0]->masterName}}</h3>
                        <h4>Your are invited to out opening</h4>
                        <h6 class="my-3 ml-5 pl-5">{{$check[0]->typeDescription}}</h6>
                    </div>
                    <div class="mt-5">
                        <h4>Please update following information</h4>
                        <table class="w-100 text-center">
                            <thead>
                                <th></th>
                                <th>Participation</th>
                                <th>Vaccination</th>
                            </thead>
                            <tr>
                                <td><strong>You</strong></td>
                                <td>
                                    <input type="checkbox" name="userpartic" value="1" {{$check[0]->masterParticipation == 1 ? "checked" : ""}}>
                                </td>
                                <td>
                                    <input type="checkbox" name="uservacci" value="1" {{$check[0]->masterVaccination == 1 ? "checked" : ""}}>
                                </td>
                            </tr>
                        </table>
                        <div class="py-3 row">
                            <div class="col-md-4"><strong>Contact Number</strong></div>
                            <div class="col-md-8 form-group" ><input class="form-control" type="text" name="usernum" value="{{$check[0]->mobileNo}}" placeholder="input text" required></div>
                            <div class="col-md-4"><strong>E-Mail</strong></div>
                            <div class="col-md-8 form-group" ><input type="text" class="form-control" name="useremail" value="{{$check[0]->eMail}}" placeholder="input text" required></div>
                        </div>
                    </div>
                    <div>
                        <h4>Others Perticipation & Vaccination Status</h4>
                        <table class="w-100 text-center my-4" >
                            <thead>
                                <th class="p-3"></th>
                                <th class="p-3">Enter Name</th>
                                <th class="p-3">Participation</th>
                                <th class="p-3">Vaccination</th>
                            </thead>
                            @foreach ($related as $relitem)
                            <input type="hidden" name="relid[]" value="{{$relitem->id}}">
                            <tr>
                                <td><strong>{{$relitem->relationship}}</strong></td>
                                <td class="form-group"><input class="form-control" type="text" name="relname[]" value="{{$relitem->relationshipName}}"></td>
                                <td class="form-group"><input class="form-check-input" type="checkbox" name="relpartic[]" value="1" {{$relitem->relationshipParticipation == 1 ? "checked" : ""}}></td>
                                <td class="form-group"><input class="form-check-input" type="checkbox" name="relvacci[]" value="1" {{$relitem->relationshipVaccination == 1 ? "checked" : ""}}></td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="text-center mt-5">
                        <button type="submit" class="btn btn-secondary btn-lg mx-3">Save</button>
                        <a class="btn btn-danger btn-lg mx-3" href="{{url('comment/'.$check[0]->id)}}">Exit</a>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </section>
@endsection
