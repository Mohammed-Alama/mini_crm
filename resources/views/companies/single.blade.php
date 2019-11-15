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

                        <div class="card">
                            <div class="card-header">
                                <label for="website">Employees</label>
                                <a class="btn btn-sm btn-info" role="button" aria-disabled="true" href="{{route('employees.create',$company)}}">Add Employee</a>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($employees as $employee)
                                        <tr id="employee-{{$employee->id}}">
                                            <td>{{$employee->name}}</td>
                                            <td>{{$employee->email}}</td>
                                            <td>{{$employee->phone}}</td>
                                            <td>
                                                <a class="btn btn-sm btn-warning" role="button" aria-disabled="true" href="{{route('employees.edit',['employee'=>$employee->id,'company'=>$company->id])}}">Edit</a>
                                                <a class="btn btn-sm btn-danger" id="destroyEmployee" role="button" aria-disabled="true" href="javascript:void(0);" data-employeeId="{{$employee->id}}" data-companyId="{{$company->id}}">Delete</a>
                                            </td>
                                    @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@stop