@extends('layouts.poultry_layout')

@section('title')
    Family Summary
@endsection

@section('content')
    <div class="row">
        <div class="col s12 m12 12">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5>Family Summary</h5>
                </div>
            </div>
            <family-summary-general></family-summary-general>
        </div>
    </div>
@endsection

@section('customscripts')
@endsection
