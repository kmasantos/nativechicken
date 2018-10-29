@extends('layouts.poultry_layout')

@section('title')
    Settings
@endsection

@section('content')
    <div class="row">
        <div class="col s12 m12 l12">
            <h4>Farm Settings</h4>
        </div>
    </div>
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="card-panel">
                <div class="row c">
                    <div class="col s12 m12 l12">
                        {!! Form::open([ 'route' => 'farm.set_batching', 'method' => 'patch']) !!}
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="row">
                                <div class="input-field col s12 m12 l12">
                                    <i class="far fa-calendar-alt prefix"></i>
                                    <input id="icon_prefix" name="batching_week" type="number" class="validate" placeholder="Input 0 if batching is not practiced" oninput="this.value = Math.abs(this.value)">
                                    <label for="icon_prefix">How many weeks do you consider 1 batch?</label>
                                </div>
                            </div>
                            <div class="row center">
                                <div class="col s12 m12 l12">
                                    <button class="btn waves-effect waves-light blue-grey" type="submit" name="action">Submit
                                        <i class="material-icons right">send</i>
                                    </button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('customscripts')

@endsection
