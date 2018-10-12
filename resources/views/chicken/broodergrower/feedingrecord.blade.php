@extends('layouts.poultry_layout')

@section('title')
    Brooder & Grower
@endsection

@section('content')
<div class="row">
    <div class="col s12 m12 12">
        <div class="row">
            <div class="col s12 m12 l12">
                <h5>Brooders & Growers Feeding Records</h5>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m12 l12">
                <ul class="breadcrumb">
                    <li><a href={{route('farm.index')}}>Home</a></li>
                    <li>Feeding Records</li>
                </ul>
            </div>
        </div>
        <feedingrecord-broodergrower></feedingrecord-broodergrower>
    </div>
</div>
@endsection

@section('customscripts')
@endsection