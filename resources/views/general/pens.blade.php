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
           <form>
                <div class="row valign-wrapper">
                    <div class="col s12 m9 l9 valign">
                        <label for="search">Search</label>
                        <input placeholder="Type pen number" id="search" type="text">
                    </div>
                    <div class="col s12 m3 l3 valign">
                        <button class="btn waves-effect waves-light blue-grey darken-1" type="submit" name="action">Search<i class="material-icons right">search</i></button>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col s12 m12 112">
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
                            <tr>
                                <td>Layer</td>
                                <td>L01</td>
                                <td>12</td>
                                <td>20</td>
                            </tr>
                            <tr>
                                <td>Grower</td>
                                <td>G01</td>
                                <td>50</td>
                                <td>37</td>
                            </tr>
                            <tr>
                                <td>Brooder</td>
                                <td>B01</td>
                                <td>60</td>
                                <td>100</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed-action-btn horizontal click-to-toggle">
        <a class="btn-floating btn-large blue-grey darken-1">
            <i class="material-icons">add</i>
        </a>
    </div>
@endsection