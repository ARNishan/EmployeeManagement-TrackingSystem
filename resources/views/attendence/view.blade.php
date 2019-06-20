@extends('layouts.app')
@section('content')
<div class="container">
    <h4 class="grey-text text-darken-1 center">View Attendence : {{ $date->att_date }}</h4>
    {{-- Search --}}
 {{--    <div class="row mb-0">
        <ul class="collapsible">
            <li>
                <div class="collapsible-header">
                    <i class="material-icons">search</i>
                    Search Employees
                </div>
                <div class="collapsible-body">
                    <div class="row mb-0">
                        <form action="{{route('employees.search')}}" method="POST">
                            @csrf()
                            <div class="input-field col s12 m6 l5 xl6">
                                <input id="search" type="text" name="search" >
                                <label for="search">Search Employee</label>
                                <span class="{{$errors->has('search') ? 'helper-text red-text' : '' }}">{{$errors->has('search') ? $errors->first('search') : '' }}</span>
                            </div>
                            <div class="input-field col s12 m6 l4 xl4">
                                <select name="options" id="options">
                                    <option value="first_name">First Name</option>
                                    <option value="last_name">Last Name</option>
                                    <option value="email">Email</option>
                                    <option value="address">Address</option>
                                </select>
                                <label for="options">Search by:</label>
                            </div>
                            <br>
                            <div class="col l2">
                                <button type="submit" class="btn waves-effect waves-light">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </li>
        </ul>
    </div> --}}
    {{-- Search END --}}
        <!-- Show All Employee List as a Card -->
    <div class="card">
        <div class="card-content">
            <div class="row">
                <h5 class="pl-15 grey-text text-darken-2">View Attendence</h5>
                <!-- Table that shows Employee List -->
                <table class="responsive-table col s12 m12 l12 xl12">
                    <thead class="grey-text text-darken-1">
                        <tr>
                            <th>No</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Attendence</th>
                            {{-- <th>Options</th> --}}
                        </tr>
                    </thead>
                    <tbody id="emp-table">
                        <!-- Check if there are any employee to render in view -->
                        @if($attendence->count())
                         <?php
                         $i = 0;
                         ?>
                            @foreach($attendence as $row)
                            <?php $i++; ?>
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>
                                    <img class="emp-img" src="{{asset($row->picture)}}">
                                    </td>
                                    <td>{{$row->first_name}} {{$row->last_name}}</td>
                                    <td>{{$row->att_date}}</td>
                                    <td>{{$row->att_time}}</td>
                                    <td>{{$row->attendence}}</td>
                                   {{--  <td>
                                    <a href="{{ URL::to('/employees-show/'.$employee->id) }}" class="btn btn-small btn-floating waves=effect waves-light teal lighten-2"><i class="material-icons">list</i></a>
                                    </td> --}}
                                </tr>
                             @endforeach
                      @endif
                           
                    </tbody>
                </table>
                <!-- employees Table END -->
                <div class="card-action">
                    <a href="{{ route('attendences') }}">Go Back</a>
                </div>
            </div>
            <!-- Show Pagination Links -->
            <div class="center">
                {{ $attendence->links('vendor.pagination.default',['paginator' => $attendence]) }}
            </div>
        </div>
    </div>
    <!-- Card END -->
</div>
<!-- This is the button that is located at the right bottom, that navigates us to employees.create view -->
{{-- <div class="fixed-action-btn">
    <a class="btn-floating btn-large waves=effect waves-light red" href="{{route('employees.create')}}">
        <i class="large material-icons">add</i>
    </a>
</div> --}} 
@endsection