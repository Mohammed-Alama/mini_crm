@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <a class="btn btn-primary" style="margin-bottom: 1rem" role="button" aria-disabled="true" href="{{route('companies.create')}}">Create Company</a>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Website</th>
                        <th scope="col">Logo</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($companies as $company)
                        <tr id="company-{{$company->id}}">
                            <td><a href="{{route('companies.show',$company->id)}}">{{$company->name}}</a></td>
                            <td>{{$company->email}}</td>
                            <td>{{$company->website}}</td>
                            <td>
                                <div class="logo">
                                    <button class="btn btn-info">Show Logo</button>
                                    <figure>
                                        <img src="{{asset('storage').'/'.$company->logo}}" width="400" height="300" alt="logo of {{$company->name}}">
                                    </figure>
                                </div>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-warning" role="button" aria-disabled="true" href="{{route('companies.edit',$company->id)}}">Edit</a>
                                <a class="btn btn-sm btn-danger" id="destroyCompany" role="button" aria-disabled="true" href="javascript:void(0);" data-id="{{$company->id}}">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $companies->render() !!}
            </div>
            @if (session()->has('ErrorMassage'))
                <div class="alert alert-danger" id="sessionMassage" role="alert">{{session('ErrorMassage')}}</div>
            @elseif(session()->has('SuccessMassage'))
                <div class="alert alert-success" id="sessionMassage" role="alert"> {{session('SuccessMassage')}}</div>
            @endif
        </div>
    </div>
@stop
