@extends('layouts.poultry_layout')

@section('title')
    Brooders
@endsection

@section('content')
<div class="row">
    <div class="col s12 m12 12">
        <div class="row">
            <div class="col s12 m12 l12">
                <h5>Brooders</h5>
                <div style="line-height:1px;">
                        <p><i> • To add Brooder within system go to Hatchery Records</i></p>
                        <p><i> • If Brooder is not a direct offspring of any Family in the system, click the Add Brooder Outside System icon </i>(<i class="fas fa-plus-circle"></i>)</p>
                </div>
            </div>
        </div>
        <add-broodergrower></add-broodergrower>
    </div>
</div>

@endsection

@section('customscripts')
@endsection
