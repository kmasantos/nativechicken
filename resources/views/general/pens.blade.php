@extends('layouts.poultry_layout')

@section('title')
    Pens
@endsection

@section('content')
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5>Pens</h5>
                </div>
            </div>
            {!! Form::open([ 'route' => 'farm.pens_search', 'method' => 'post']) !!}
                <div class="row valign-wrapper">
                    <div class="col s12 m9 l9 valign">
                        <label for="search">Search</label>
                        <input placeholder="Type pen number" id="search" type="text" name="search">
                    </div>
                    <div class="col s12 m3 l3 valign">
                        <button class="btn waves-effect waves-light blue-grey darken-1" type="submit" name="action">Search<i class="material-icons right">search</i></button>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m4 l4">
                        <input type="checkbox" class="filled-in" id="brooder_search" value="brooder" name="search_checkbox[]"/>
                        <label for="brooder_search">Brooder</label>
                    </div>
                    <div class="col s12 m4 l4">
                        <input type="checkbox" class="filled-in" id="grower_search" value="grower" name="search_checkbox[]"/>
                        <label for="grower_search">Grower</label>
                    </div>
                    <div class="col s12 m4 l4">
                        <input type="checkbox" class="filled-in" id="layer_search" value="layer" name="search_checkbox[]"/>
                        <label for="layer_search">Layer</label>
                    </div>
                </div>
            {!! Form::close() !!}
            <div class="row">
                <div class="col s12 m12 112">
                    @if(!$pens->isEmpty())
                        <table class="bordered highlight responsive-table">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Pen Number</th>
                                    <th>Inventory</th>
                                    <th>Capacity</th>
                                </tr>
                            </thead>
    
                            <tbody>
                                @forelse ($pens as $pen)
                                    <tr>
                                        <td>{{ucfirst($pen->type)}}</td>
                                        <td>{{$pen->number}}</td>
                                        <td>{{$pen->current_capacity}}</td>
                                        <td>{{$pen->total_capacity}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td></td>
                                        <td>No</td>
                                        <td>Pens</td>
                                        <td></td>
                                    </tr>
                                @endforelse 
                            </tbody>
                        </table>
                        {{ $pens->links() }}
                    @else
                    <div class="row">
                        <div class="col s12 m12 l12 center">
                                <h5>No Pens Available</h5>
                        </div>    
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="fixed-action-btn horizontal click-to-toggle">
        <a class="btn-floating btn-large blue-grey darken-1 modal-trigger" href="#pen_modal">
            <i class="material-icons">add</i>
        </a>
    </div>
    <!-- Modal Structure -->
    <div id="pen_modal" class="modal modal-fixed-footer">
        {!! Form::open([ 'route' => 'farm.pens_add', 'method' => 'post']) !!}
            @csrf
            <div class="modal-content">
                <h4>Add Pen</h4>
                <div class="divider"></div>
                <div class="row valign-wrapper">
                    <div class="col s12 m12 l12">
                        <div class="row">
                            <div class="input-field col s12 m12 l12">
                                <input placeholder="Input Pen Number" id="pen_number" type="text" name="pen_number">
                                <label for="pen_number">Pen Number</label>
                            </div>
                        </div>
                        <label for="pen_type">Pen Type</label>
                        <div id="pen_type" class="row">
                            
                            <div class="col s12 m4 l4">
                                <input class="with-gap" name="type" type="radio" id="brooder" value="brooder"/>
                                <label for="brooder">Brooder</label>
                            </div>
                            <div class="col s12 m4 l4">
                                <input class="with-gap" name="type" type="radio" id="grower" value="grower"/>
                                <label for="grower">Grower</label>
                            </div>
                            <div class="col s12 m4 l4">
                                <input class="with-gap" name="type" type="radio" id="layer" value="layer"/>
                                <label for="layer">Layer</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 m12 l12">
                                <input placeholder="Total Pen Capacity" id="pen_capacity" type="number" min=0 name="pen_capacity">
                                <label for="pen_capacity">Pen Capacity</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-grey btn-flat">Close</a>
                <button class="modal-close waves-effect waves-grey btn-flat" type="submit">Add</button>
            </div>
        {!! Form::close() !!}
    </div>
    
@endsection

@section('customscripts')
    @if(Session::has('pen-create'))
        <script>
            Materialize.toast('Pen successfully created', 3000, 'rounded')
        </script>
    @elseif($errors->any())
        <script type="text/javascript">
            Materialize.toast('Pen creation failed', 3000, 'rounded');
        </script>
    @endif
@endsection