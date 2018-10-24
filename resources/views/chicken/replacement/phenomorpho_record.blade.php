@extends('layouts.poultry_layout')

@section('title')
    Replacements Phenotypic and Morphometric Values
@endsection

@section('content')
    <phenomorpho-replacement v-bind:replacement-id={{$replacement_id}}></phenomorpho-replacement>
@endsection

@section('customscripts')
@endsection
