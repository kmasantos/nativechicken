@extends('layouts.poultry_layout')

@section('title')
    Family Records
@endsection

@section('content')
    <div class="row">
        <div class="col s12 m12 12">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5>Family Records</h5>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m12 l12">
                    <ul class="breadcrumb">
                        <li><a href={{route('farm.index')}}>Home</a></li>
                        <li>Family Records</li>
                    </ul>
                </div>
            </div>
            <family-record></family-record>
        </div>
    </div>
@endsection

@section('customscripts')
@endsection