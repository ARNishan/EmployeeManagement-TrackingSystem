@extends('layouts.app')
@section('content')
<div class="container">
    <h4 class="grey-text text-darken-1 center">Manage Attendence</h4>
    {{-- Search --}} 
    <div class="row mb-0">
        <ul class="collapsible">
            <li>
                <div class="collapsible-header">
                    <i class="material-icons">search</i>
                    Search Attendence
                </div>
                <div class="collapsible-body">
                    <div class="row mb-0">
                        <form action="{{route('attendence.search')}}" method="POST">
                            @csrf()
                            <div class="input-field col s12 m6 l5 xl6">
                                <input type="text" name="att_date" id="att_date" class="datepicker">
                                <label for="att_date">Search : </label>
                            </div>
                            {{-- <div class="input-field col s12 m6 l4 xl4">
                                <input type="text" name="att_date" id="att_date" class="datepicker" value="{{old('att_date') ? : ''}}">
                                <label for="att_date">Search : </label>
                            </div> --}}
                            <br>
                            <div class="col l2">
                                <button type="submit" class="btn waves-effect waves-light">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    {{-- Search END --}}
        <!-- Show All Employee List as a Card -->
    <div class="card">
        <div class="card-content">
            <div class="row">
                <h5 class="pl-15 grey-text text-darken-2">Attendence List</h5>
                <!-- Table that shows Employee List -->
                <table class="responsive-table col s12 m12 l12 xl12">
                    <thead class="grey-text text-darken-1">
                        <tr>
                            <th>Serial No</th>
                            <th>Attendence Date</th>
                            <th>Options</th>
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
                                    {{ $row->att_date }}
                                    </td>
                                    <td>
                                    <a href="{{ URL::to('/attendences-show/'.$row->att_date) }}" class="btn btn-small btn-floating waves=effect waves-light teal lighten-2"><i class="material-icons">list</i></a>
                                    </td>
                                </tr>
                            @endforeach
                            @if(isset($search))
                                <tr>
                                    <td colspan="4">
                                        <a href="{{-- {{ route('employees') }} --}}" class="right">Show All</a>
                                    </td>
                                </tr>
                            @endif
                        @else
                            {{-- if there are no employees then show this message --}}
                            <tr>
                                <td colspan="5"><h6 class="grey-text text-darken-2 center">No Employees Found!</h6></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <!-- employees Table END -->
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
<div class="fixed-action-btn">
    <a class="btn-floating btn-large waves=effect waves-light red" href="{{-- {{route('employees.create')}} --}}">
        <i class="large material-icons">add</i>
    </a>
</div> 
@endsection