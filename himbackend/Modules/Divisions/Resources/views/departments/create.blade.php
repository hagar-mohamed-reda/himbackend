@extends('layouts.admin')
@section('title') {{ __('departments') }} @endsection
@section('content')
@php
$links = [
['name' => __('home'), 'url' => url('/')],
['name' => __('departments'), 'url' => url('/departments')],
['name' => __('add').' '.__('departments'), 'active' => true],
];
@endphp
@include('layouts.breadcrumb', ['links' => $links])
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3> {{ __('add') }} </h3>
                </div>
                <div class="card-body">
                    {!! Form::open(['method'=>'post','route'=>'departments.store'])!!}
                    @include('divisions::departments.form')
                    <button type="submit" class="btn btn-primary waves-effect waves-light">{{ __('save') }}</button>
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection
