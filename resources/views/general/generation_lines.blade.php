@extends('layouts.poultry_layout')

@section('title')
    Generations & Lines
@endsection

@section('content')
    <div class="row">
        <div class="col s12 m12 12">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5>Generations & Lines</h5>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m12 l12">
                    <ul class="breadcrumb">
                        <li><a href={{route('farm.index')}}>Home</a></li>
                        <li>Generations & Lines</li>
                    </ul>
                </div>
            </div>
            <generation-line></generation-line>
        </div>
    </div>
@endsection

@section('customscripts')
@endsection