@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="card col s12 m12 l12 xl12 mt-20">
                <div>
                <h4 class="center grey-text text-darken-2 card-title">Create New User</h4>
                </div>
                <hr>
                <div class="card-content">
                    <form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="input-field col s12 m8 offset-m2 l8 offset-l2 xl8 offset-xl2">
                                <i class="material-icons prefix">person_outline</i>
                                <select name="Emp_id">
                                    <option value="" disabled {{ old('Emp_id') ? '' : 'selected' }}>Choose a Employee</option>
                                    @foreach($employees as $employee)
                                        <option value="{{$employee->id}}" {{ old('Emp_id') ? 'selected' : '' }}>{{$employee->first_name}} {{$employee->last_name}}</option>
                                    @endforeach
                                </select>
                                <label for="Emp_id">Employee Select</label>
                                <span class="{{$errors->has('Emp_id') ? 'helper-text red-text' : ''}}">{{$errors->first('Emp_id')}}</span>
                            </div>
                            <div class="input-field col s12 m8 offset-m2 l8 offset-l2 xl8 offset-xl2">
                                <i class="material-icons prefix">person</i>
                                <input type="text" name="username" id="username" value="{{Request::old('username') ? : ''}}">
                                <label for="username">Username</label>
                                <span class="{{$errors->has('username') ? 'helper-text red-text' : ''}}">{{$errors->first('username')}}</span>
                            </div>
                            <div class="input-field col s12 m8 offset-m2 l8 offset-l2 offset-l2 xl8 offset-xl2">
                                <i class="material-icons prefix">lock</i>
                                <input type="password" name="password" id="password" value="{{Request::old('password') ? : ''}}">
                                <label for="password">Password</label>
                                <span class="{{$errors->has('password') ? 'helper-text red-text' : ''}}">{{$errors->has('password') ? $errors->first('password') : ''}}</span>
                            </div>
                        </div>
                        @csrf()
                        <div class="row">
                            <button type="submit" class="btn waves-effect waves-light col s8 offset-s2 m4 offset-m4 l4 offset-l4 xl4 offset-xl4">Add</button>
                        </div>
                    </form>
                </div>
                <div class="card-action">
                    <a href="/admins">Go Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection