@extends('layouts.app')

@section('title')
    EMPLOYEE | CRUD
@endsection

@section('content')
    <div class="container mx-auto">
        <list-create-employee
        :data="{{ json_encode($data) }}"
        ></list-create-employee>
    </div>
@endsection