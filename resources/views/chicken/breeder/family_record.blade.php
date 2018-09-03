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
                                <th>Add Animals</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($families as $family)
                            <tr>
                                <td>0001</td>
                                <td>0002</td>
                                <td>L03</td>
                                <td><a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Add animals to family" href="#!"><i class="material-icons">add</i></a></td>
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
                                <line-select></line-select>
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
    <div id="add_modal" class="modal modal-fixed-footer">
        <div class="modal-content">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h4>Add Family Record</h4>
                </div>
            </div>
            <div class="divider"></div>
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
                        <select id="generation_choice" class="browser-default">
                            <option value="" disabled selected>Choose generation</option>
                            @forelse ($generations as $generation)
                                <option value="{{$generation->id}}" data-genid="{{$generation->id}}">{{$generation->number}}</option>
                            @empty
                                <option value="" disabled selected>No Available Generations</option>
                            @endforelse
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m12 l12">
                    <div class="col s12 m6 l6">
                        <label>Line</label>
                        <select id="line_choice" class="browser-default">
                            <option value="" disabled selected>Choose line</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
            <button type="submit" class="modal-action modal-close waves-effect waves-green btn-flat">Submit</button>
        </div>
    </div>
@endsection

@section('customscripts')
    <script>
        $(document).ready(function(){
            $("#generation_choice").change(function (event) {
                var generation_id = $(this).find(':selected').data("genid");
                console.log(window.location.hostname+"/farm/family_record_get_lines");
                $.ajax({
                    url: window.location.hostname+"/farm/family_record_get_lines",
                    type: 'GET',
                    cache: false,
                    data: {generation_id},
                    success: function(data)
                    {
                        if(data.length > 0){
                            data.forEach(function(data){
                                $("#line_choice").append('\
                                    <option data-lineid="'+data.id+'" value="'+data.id+'">'+data.number+'</option>\
                                ');
                            });
                        }else{
                            $("#line_choice").append('\
                                <option disabled selected>No Lines in this Generation</option>\
                            ');
                        }
                    }
                });
            });
            
        });
    </script>

@endsection