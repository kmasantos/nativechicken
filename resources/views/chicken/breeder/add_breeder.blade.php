@extends('layouts.poultry_layout')

@section('title')
    Breeder Records
@endsection

@section('content')
    <div class="row">
        <div class="col s12 m12 12">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5>Breeder Records</h5>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m12 l12">
                    <ul class="breadcrumb">
                        <li><a href={{route('farm.index')}}>Home</a></li>
                        <li>Add Breeder</li>
                    </ul>
                </div>
            </div>
            <add-breeder></add-breeder>
        </div>
    </div>
@endsection

@section('customscripts')
@endsection