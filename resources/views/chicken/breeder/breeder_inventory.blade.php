@extends('layouts.poultry_layout')

@section('title')
    Breeder Inventory
@endsection

@section('content')
    <div class="row">
        <div class="col s12 m12 12">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5>Breeder Inventory</h5>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m12 l12">
                    <ul class="breadcrumb">
                        <li><a href={{route('farm.index')}}>Home</a></li>
                        <li>Breeder Inventory</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customscripts')
@endsection