@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <a class="btn btn-primary" style="margin-bottom: 1rem" role="button" aria-disabled="true" href="{{route('companies.create')}}">Create Company</a>
                <table class="table table-striped" id="company-table" style="text-align: center"></table>
            </div>
            @if (session()->has('ErrorMassage'))
                <div class="alert alert-danger" id="sessionMassage" role="alert">{{session('ErrorMassage')}}</div>
            @elseif(session()->has('SuccessMassage'))
                <div class="alert alert-success" id="sessionMassage" role="alert"> {{session('SuccessMassage')}}</div>
            @endif
        </div>
    </div>
@stop
