@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        {{$company->name}}
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header">

                                <label for="email">Email</label>
                            </div>
                            <div class="card-body">
                                <p id="email">{{$company->email}}</p>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <label for="website">Website</label>
                            </div>
                            <div class="card-body">
                                <p id="website">{{$company->website}}</p>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <label for="website">Logo</label>
                            </div>
                            <div class="card-body">
                                <img src="{{asset('storage').'/'.$company->logo}}" width="100px" height="100px" alt="">
                            </div>
                        </div>


{{--                        <table class="table table-striped">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th scope="col">#</th>--}}
{{--                                <th scope="col">Full Name</th>--}}
{{--                                <th scope="col">Email</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @foreach($employees as $employee)--}}
{{--                                <tr>--}}
{{--                                    <th scope="row">{{$employee->id}}</th>--}}
{{--                                    <td>{{$employee->first_name . $employee->last_name}}</td>--}}
{{--                                    <td>{{$company->email}}</td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}
{{--                        </table>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop