@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Company ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($employees as $employee)
                        <tr id="employee-{{$employee->id}}">
                            <td><a href="{{route('companies.show',$company->id)}}">{{$company->id}}</a></td>
                            <td>{{$employee->name}}</td>
                            <td>{{$employee->email}}</td>
                            <td>{{$employee->phone}}</td>
                        <td></td>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@stop