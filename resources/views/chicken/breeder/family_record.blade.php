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
            <form>
                <div class="row valign-wrapper">
                    <div class="col s12 m9 l9 valign">
                        <label for="search">Search</label>
                        <input placeholder="Type family number" id="search" type="text">
                    </div>
                    <div class="col s12 m3 l3 valign">
                        <button class="btn waves-effect waves-light blue-grey darken-1" type="submit" name="action">Search<i class="material-icons right">search</i></button>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col s12 m12 112">
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
                            <tr>
                                <td>0001</td>
                                <td>0002</td>
                                <td>L03</td>
                                <td><a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Add animals to family" href="#!"><i class="material-icons">add</i></a></td>
                            </tr>
                            <tr>
                                <td>0002</td>
                                <td>0003</td>
                                <td>L02</td>
                                <td><a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Add animals to family" href="#!"><i class="material-icons">add</i></a></td>
                            </tr>
                            <tr>
                                <td>0003</td>
                                <td>0001</td>
                                <td>L01</td>
                                <td><a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Add animals to family" href="#!"><i class="material-icons">add</i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed-action-btn horizontal click-to-toggle">
        <a href="{{route('farm.chicken.breeder.family_record_new')}}" class="btn-floating btn-large blue-grey darken-1">
            <i class="material-icons">add</i>
        </a>
    </div>
@endsection