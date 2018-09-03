@extends('layouts.poultry_layout')

@section('title')
    Generation
@endsection

@section('content')
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5>Generation</h5>
                </div>
            </div>
            <div class="row">
                    <div class="col s12 m12 l12">
                        <ul class="breadcrumb">
                            <li><a href={{route('farm.index')}}>Home</a></li>
                            <li>Generation</li>
                        </ul>
                    </div>
                </div>
            {!! Form::open([ 'route' => 'farm.chicken.breeder.generation_search', 'method' => 'post']) !!}
                <div class="row valign-wrapper">
                    <div class="col s12 m9 l9 valign">
                        <label for="search">Search</label>
                        <input placeholder="Type generation number" id="search" type="text" name="search">
                    </div>
                    <div class="col s12 m3 l3 valign">
                        <button class="btn waves-effect waves-light blue-grey darken-1" type="submit" name="action">Search<i class="material-icons right">search</i></button>
                    </div>
                </div>
            {!! Form::close() !!}
            <div class="row">
                <div class="col s12 m12 112">
                    @if(!$generations->isEmpty())
                    <table class="bordered highlight responsive-table">
                        <thead>
                            <tr>
                                <th>Number</th>
                                <th>Edit</th>
                                <th>Cull</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($generations as $generation)
                            <tr>
                                <td>{{$generation->number}}</td>
                                <td><a class="modal-trigger" onclick="getGenerationID({{$generation->id}})" href="#gen_modal" data-gen="{{$generation->id}}"><i class="material-icons">edit</i></a></td>
                                <td><a><i class="material-icons">close</i></a></td>
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
                                <h5>No Generation Available</h5>
                        </div>    
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="fixed-action-btn horizontal click-to-toggle">
        <a class="btn-floating btn-large blue-grey darken-1 modal-trigger" href="#modal"> 
            <i class="material-icons">add</i>
        </a>
    </div>
    <div id="modal" class="modal bottom-sheet generation_modal">
        {!! Form::open([ 'route' => 'farm.chicken.breeder.generation_add', 'method' => 'post']) !!}
            @csrf
            <div class="modal-content">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <h4>Add Generation</h4>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="row">
                    <div class="col s12 m12 l12">
                        <label for="generation">Generation</label>
                        <input placeholder="Enter generation number" id="generation" type="number" min=0 name="generation_number">
                    </div>
                </div>
                <div id="line_div" class="row">
                    <div class="col s12 m12 l12">
                        <label for="line">Lines</label>
                        <input placeholder="Enter line code" id="line" type="text" name="line[]">
                    </div>
                </div>
                <div class="row center">
                    <div class="col s12 m12 l12">
                        <a id="add_line_button" class="waves-effect waves-teal btn-flat"><i class="material-icons right">add</i>Add Lines</a>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
                <button type="submit" href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Submit</button>
            </div>
        {!! Form::close() !!}
    </div>

    <div id="gen_modal" class="modal modal-fixed-footer">
        {!! Form::open([ 'route' => 'farm.chicken.breeder.generation_add_line', 'method' => 'post']) !!}
        @csrf
        <div class="modal-content">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h4>Add Line</h4>
                </div>
            </div>
            <div class="divider"></div>
            <div id="line_div" class="row">
                <div class="col s12 m12 l12">
                    <input type="hidden" name="add_line_gen_id" id="gen_modal_genid" value="">
                    <label for="gen_modal_line">Lines</label>
                    <input placeholder="Enter line code" id="gen_modal_line" type="text" name="add_line[]">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
            <button type="submit" class="modal-action modal-close waves-effect waves-green btn-flat">Submit</button>
        </div>
        {!! Form::close() !!}
    </div>
@endsection

@section('customscripts')
    <script type="text/javascript" src="/js/breeder/generation.js"></script>
    <script>
        function getGenerationID(generation_id)
        {
            const field = document.getElementById("gen_modal_genid");
            field.setAttribute("value", generation_id);
        }
    </script>
@endsection