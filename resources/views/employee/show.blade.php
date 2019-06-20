@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card-panel grey-text text-darken-2 mt-20">
            <h4 class="grey-text text-darken-1 center">Employee Details</h4>
            <div class="row">
                <div class="row collection mt-20">
                    <!-- Show this image on small devices -->
                    <div class="hide-on-med-only hide-on-large-only row">
                        <div class="col s8 offset-s2 mt-20">
                            <img class="p5 card-panel emp-img-big" src="{{asset($employee->picture)}}">
                        </div>
                    </div>
                    <div class="col m8 l8 xl8">
                        <h5 class="pl-15 mt-20">{{$employee->first_name}} {{$employee->last_name}}</h5>
                        <p class="pl-15 mt-20"><i class="material-icons left">location_city</i>{{$employee->address}}</p>
                        <p class="pl-15"><i class="material-icons left">location_on</i>{{$employee->city_name}}, {{$employee->state_name}}, {{$employee->country_name}}</p>
                        <p class="pl-15"><i class="material-icons left">person_outline</i>{{$employee->gender_name}}</p>
                    </div>
                    <!-- Hide this image on small devices -->
                    <div class="hide-on-small-only col m4 l4 xl3">
                        <img class="p5 card-panel emp-img-big" src="{{asset($employee->picture)}}">
                    </div>
                </div>
                <div class="collection">
                    <div class=" row">
                        <p class="pl-15"><span class="bold col s5 m4 l4 xl3">Age :</span><span class="col m8 l8 xl9">{{$employee->age}}</span></p>
                    </div>
                    <div class="row">
                        <p class="pl-15"><span class="bold col s5 m4 l4 xl3">Phone :</span><span class="col m8 l8 xl9">{{$employee->phone}}</span></p>
                    </div>
                    <div class="row">
                        <p class="pl-15"><span class="bold col s5 m4 l4 xl3">Department :</span><span class="col m8 l8 xl9">{{$employee->dept_name}}</span></p>
                    </div>
                    <div class="row">
                        <p class="pl-15"><span class="bold col s5 m4 l4 xl3">Division :</span><span class="col m8 l8 xl9">{{$employee->division_name}}</span></p>
                    </div>
                    <div class="row">
                        <p class="pl-15"><span class="bold col s5 m4 l4 xl3">Email :</span><span class="col m8 l8 xl9">{{$employee->email}}</span></p>
                    </div>
                    <div class="row">
                        <p class="pl-15"><span class="bold col s5 m4 l4 xl3">Salary :</span><span class="col m8 l8 xl9">${{$employee->s_amount}}/-</span></p>
                    </div>
                    <div class="row">
                        <p class="pl-15"><span class="bold col s5 m4 l4 xl3">Joined Date :</span><span class="col m8 l8 xl9">{{$employee->join_date}}</span></p>
                    </div>
                    <div class="row">
                        <p class="pl-15"><span class="bold col s5 m4 l4 xl3">Date of Birth :</span><span class="col m8 l8 xl9">{{$employee->birth_date}}</span></p>
                    </div>
                </div>
                <form onsubmit="return confirm('Do you really want to delete?');" action="{{ url('/delete-employee/'.$employee->id) }}" method="GET">
                    @csrf()
                    <button class="btn red col s3 offset-s2 m3 offset-m2 l3 offset-l2 xl3 offset-xl2" type="submit" {{-- id="delete" --}}>Delete</button>
                </form>
                <a class="btn orange col s3 offset-s2 m3 offset-m2 l3 offset-l2 xl3 offset-xl2" href="{{ URL::to('/edit-employee/'.$employee->id) }}">Update</a>
            </div>
                <div class="card-action">
                    <a href="{{ route('employees') }}">Go Back</a>
                </div>
        </div>
    </div>
@endsection