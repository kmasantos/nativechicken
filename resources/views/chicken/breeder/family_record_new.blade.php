@extends('layouts.poultry_layout')

@section('title')
    Add Family Record
@endsection

@section('content')
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5>Add Family Record</h5>
                </div>
            </div>
            {{-- {!! Form::open(['route' => 'farm.poultry.submit_family_record', 'method' => 'post']) !!} --}}
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="input-field col s12 m6 l6">
                            <input placeholder="Enter Family ID" id="family_id" type="text">
                            <label for="family_id">Family ID</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="col s12 m6 l6">
                            <label>Generation</label>
                            <select class="browser-default">
                                <option value="" disabled selected>Choose generation</option>
                                <option value="1">0001</option>
                                <option value="2">0002</option>
                                <option value="3">0003</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="col s12 m6 l6">
                            <label>Line</label>
                            <select class="browser-default">
                                <option value="" disabled selected>Choose line</option>
                                <option value="1">0001</option>
                                <option value="2">0002</option>
                                <option value="3">0003</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="row">
                        <div class="col s12 m12 l12 center">
                        <button class="btn waves-effect waves-light blue-grey darken-1" type="submit">Submit
                            <i class="material-icons right">send</i>
                        </button>
                        </div>
                    </div>
                </div>
            {{-- {!!Form::close()!!} --}}
        </div>
    </div>
@endsection