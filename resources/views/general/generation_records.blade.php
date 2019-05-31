@extends('layouts.poultry_layout')

@section('title')
    Farm Records
@endsection

@section('content')
    <div class="row">
        <div class="col s12 m12 12">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5>Generation Summary</h5>
                </div>
            </div>
            {{-- <generation-record></generation-record> --}}
            <generation-summary-general></generation-summary-general>
        </div>
    </div>
@endsection

@section('customscripts')
@endsection
