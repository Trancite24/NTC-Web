@extends('layouts.admin-lite')
@section('title')
    Home
@endsection
@section('page-header')
    Home
@endsection
@section('optional-header')
@endsection
@section('level')
        <div class="row">
            <div class="col-md-2">
                <div class="form-group no-bottom-margin">
                    <select class="form-control select2" style="width: 100%;" id="nic" name="nic">
                        <option selected="selected">Surveyor's NIC</option>
                        @foreach($nics as $nic)
                        <option>{{$nic}}</option>
                            @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group no-bottom-margin">
                    <select class="form-control select2" style="width: 100%;" id="route" name="route">
                        <option selected="selected">Route</option>
                        @foreach($routes as $route)
                            <option>{{$route}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group no-bottom-margin">
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker" name="datepicker" placeholder="date">
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group no-bottom-margin">
                    <select class="form-control select2" style="width: 100%;" id="trip_id" name="trip_id">
                        <option selected="selected">Trip Id</option>
                        @foreach($tripids as $tripid)
                            <option>{{$tripid}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group no-bottom-margin">
                    <button id="exportCSV" class="btn btn-info">Export CSV</button>
                </div>
            </div>
        </div>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center" id="map">
        </div>
    </div>
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 500px;
        }
        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        .no-bottom-margin{
            margin-bottom: 0px;
        }
        .content{
            padding-top: 0px;
        }
    </style>
    <script>
        var map;
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 7.296, lng: 80.6337},
                zoom: 8
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{env('MAP_API_KEY')}}&callback=initMap"
            async defer></script>

@endsection


@section('additional-js')
    <script type="text/javascript">
        //Date picker
        $('#datepicker').datepicker({
            autoclose: true
        })
        $('.select2').select2()

    </script>
    @endsection
