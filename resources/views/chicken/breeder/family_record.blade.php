@extends('layouts.poultry_layout')

@section('title')
    Family Record
@endsection

@section('content')
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5>Family Record List</h5>
                </div>
            </div>
            {!! Form::open([ 'route' => 'farm.chicken.breeder.family_record_search', 'method' => 'post']) !!}
                @csrf
                <div class="row valign-wrapper">
                    <div class="col s12 m9 l9 valign">
                        <label for="search">Search</label>
                        <input placeholder="Type family number" id="search" type="text" name="search">
                    </div>
                    <div class="col s12 m3 l3 valign">
                        <button class="btn waves-effect waves-light blue-grey darken-1" type="submit" name="action">Search<i class="material-icons right">search</i></button>
                    </div>
                </div>
            {!! Form::close() !!}
            <div class="row">
                <div class="col s12 m12 112">
                    @if(!$families->isEmpty())
                    <table class="bordered highlight centered responsive-table">
                        <thead>
                            <tr>
                                <th>Number</th>
                                <th>Female Family</th>
                                <th>Pen Number</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($families as $family)
                            <tr>
                                <td>0001</td>
                                <td>0002</td>
                                <td>L03</td>
                            </tr>
                            @empty
                                <tr>
                                    <td></td>
                                    <td>No Generation</td>
                                    <td></td>
                                </tr>
                            @endforelse 
                        </tbody>
                    </table>
                    @else
                    <div class="row">
                        <div class="col s12 m12 l12 center">
                                <h5>No Families Available</h5>
                        </div>    
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="fixed-action-btn horizontal click-to-toggle">
        <a href="#add_modal" class="btn-floating btn-large blue-grey darken-1 modal-trigger">
            <i class="material-icons">add</i>
        </a>
    </div>
    <add-family-record></add-family-record>
@endsection

@section('customscripts')
@endsection