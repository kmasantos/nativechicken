@extends('layouts.poultry_layout')

@section('title')
    Farm Settings
@endsection

@section('content')
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5>Farm Settings</h5>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m12 l12">
                    <ul class="breadcrumb">
                        <li><a href={{route('farm.index')}}>Home</a></li>
                        <li>Farm Settings</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m12 l12">
                    <div class="card">
                        <div class="card-content">
                            <div class="row valign-wrapper">
                                <div class="col s12 m12 l12 center">
                                    <img class="responsive-img circle" src="/images/farmer.png" height="100px" width="200px">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <span class="card-title center">{{Auth::user()->name}}</span>
                                    <div class="center">{{$farm->name}}</div>
                                    <div class="center">{{$farm->address}}</div>
                                    <div class="center">Farm Code : {{$farm->code}}</div>
                                    <div class="center">Farm's Batching Week : Every {{$farm->batching_week}} weeks</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed-action-btn">
        <a href="#settings"; class="btn-floating btn-large blue-grey lighten-1 modal-trigger">
            <i class="large material-icons">edit</i>
        </a>
    </div>
    <div id="settings" class="modal modal-fixed-footer">
        {!! Form::open([ 'route' => 'farm.farm_settings_edit', 'method' => 'put']) !!}
            @csrf
            <div class="modal-content">
                <h4>Edit Farm Details</h4>
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="row">
                            <div class="input-field col s12 m12 l12">
                                <input placeholder="{{$farm->name}}" id="farm_name" type="text" name="farm_name">
                                <label for="farm_name">Farm Name</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 m12 l12">
                                <input placeholder="{{$farm->address}}" id="farm_address" type="text" name="farm_address">
                                <label for="farm_address">Address</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 m12 l12">
                                <input class="validate" placeholder="Every {{$farm->batching_week}} weeks" id="farm_batching_week" type="number" name="farm_batching_week" min=1 max=10>
                                <label for="farm_batching_week">Batching Week</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="modal-footer">
                <button type="submit" class="modal-action modal-close waves-effect waves-green btn-flat ">Submit</button>
            </div>
        {!! Form::close() !!}
    </div>
@endsection

@section('customscripts')
    @if(Session::has('success'))
        <script>
            Materialize.toast('Farm settings edit successful', 3000, 'rounded')
        </script>
    @elseif(Session::has('fail'))
        <script type="text/javascript">
            Materialize.toast('Farm settings edit failed', 3000, 'rounded');
        </script>
    @endif
@endsection