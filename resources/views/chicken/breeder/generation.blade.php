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
           <form>
                <div class="row valign-wrapper">
                    <div class="col s12 m9 l9 valign">
                        <label for="search">Search</label>
                        <input placeholder="Type generation number" id="search" type="text">
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
                                <th>Number</th>
                                <th>Edit</th>
                                <th>Cull</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>0001</td>
                                <td><a><i class="material-icons">edit</i></a></td>
                                <td><a><i class="material-icons">close</i></a></td>
                            </tr>
                            <tr>
                                <td>0002</td>
                                <td><a><i class="material-icons">edit</i></a></td>
                                <td><a><i class="material-icons">close</i></a></td>
                            </tr>
                            <tr>
                                <td>0003</td>
                                <td><a><i class="material-icons">edit</i></a></td>
                                <td><a><i class="material-icons">close</i></a></td>
                            </tr>
                        </tbody>
                    </table>
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
        <form>
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
                        <input placeholder="Enter generation number" id="generation" type="text" name="generation">
                    </div>
                </div>
                <div id="line_div" class="row">
                    <div class="col s12 m12 l12">
                        <label for="line">Lines</label>
                        <input placeholder="Enter line number" id="line" type="text" name="line[]">
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
                <button href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Submit</button>
            </div>
        </form>
    </div>
@endsection

@section('customscripts')
    <script type="text/javascript" src="/js/breeder/generation.js"></script>
@endsection