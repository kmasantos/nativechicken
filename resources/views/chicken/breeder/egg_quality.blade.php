@extends('layouts.poultry_layout')

@section('title')
    Egg Quality
@endsection

@section('content')
    <div class="row">
        <div class="col s12 m12 12">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5>Egg Quality</h5>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m12 l12">
                    <ul class="breadcrumb">
                        <li><a href={{route('farm.index')}}>Home</a></li>
                        <li>Egg Quality</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customscripts')
@endsection