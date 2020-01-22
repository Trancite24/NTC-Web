@extends('layouts.admin-lite')
@section('title')
    Track GPS data
@endsection
@section('page-header')
    Track GPS data
@endsection
@section('optional-header')
@endsection
@section('level')
    <br />
    <div class="row" style="border-color: black; border-top-style: solid; border-bottom-style: solid; border-width: 1px">
        <div class="col-md-2" style="padding-right:0px">
            <div class="form-group text-center">
                <label>NIC</label>
                <div class="form-group no-bottom-margin"  onclick="showResetMessage('nic','Surveyors NIC')">
                    <select class="form-control select2" style="width: 100%;" id="nic" name="nic">
                        <option selected="selected" value="Surveyors NIC">Surveyors NIC</option>
                        @foreach($nics as $nic)
                            <option>{{$nic->nic}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-2" style="padding-right:0px">
            <div class="form-group text-center">
                <label>Route Id</label>
                <div class="form-group no-bottom-margin" onclick="showResetMessage('route','Route')">
                    <select class="form-control select2" style="width: 100%;" id="route" name="route">
                        <option selected="selected" value="Route">Route</option>
                        @foreach($routes as $route)
                            <option value="{{$route->routeNo}}">{{$route->routeNo}} - {{$route->fromName}} to {{$route->toName}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-2" style="padding-right:0px">
            <div class="form-group text-center">
                <label>Journey Id</label>
                <div class="form-group no-bottom-margin" onclick="showResetMessage('journey_id','Journey Id')">
                    <select class="form-control select2" style="width: 100%;" id="journey_id" name="journey_id">
                        <option selected="selected" value="Journey Id">Journey Id</option>
                        @foreach($journeyIDs as $journeyID)
                            <option value={{$journeyID->journeyId}}>{{$journeyID->journeyId}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-2" style="padding-right:0px">
            <div class="form-group text-center">
                <label>Date Range</label>
                <div class="input-group">
                    <button type="button" class="btn btn-default pull-right" id="daterange-btn">
                    <span>
                      <i class="fa fa-calendar"></i> Date range picker
                    </span>
                        <i class="fa fa-caret-down"></i>
                    </button>
                </div>
            </div>
            </div>
        {{--<div class="col-md-1">--}}
            {{--<div class="form-group no-bottom-margin">--}}
                {{--<button  style="width: 80px; height: 50px; margin-left: 5px; margin-top: 6px" id="preview" class="btn btn-info">Visualize</button>--}}
            {{--</div>--}}
            <a class="btn btn-app btn-app-2" id="preview">
                <i class="fa fa-eye"></i> Visualize
            </a>
        {{--</div>--}}
        {{--<div class="col-md-1">--}}
            {{--<div class="form-group no-bottom-margin">--}}
                {{--<button style="width: 80px; height: 50px; margin-left: 5px; margin-top: 6px" id="exportCSV" class="btn btn-info">Download</button>--}}
            {{--</div>--}}
            <a class="btn btn-app btn-app-2" id="exportCSV">
                <i class="fa fa-download"></i> Download
            </a>
        {{--</div>--}}
        {{--<div class="col-md-1">--}}
            {{--<div class="form-group no-bottom-margin">--}}
                {{--<button style="width: 80px; height: 50px; margin-left: 5px; margin-top: 6px" id="resetFilters" class="btn btn-info">Reset</button>--}}
                <a class="btn btn-app btn-app-2" id="resetFilters">
                    <i class="fa fa-repeat"></i> Reset
                </a>
            {{--</div>--}}
        {{--</div>--}}
        <div class="col-md-1">
            <div class="checkbox">
                <label>
                    <input type="checkbox" data-toggle="toggle" id="busstops">
                    Busstops
                </label>
            </div>
        </div>
    </div>
    <br />
@endsection
@section('content')
    {{--<div class="container">--}}
    <div class="row justify-content-center" style="padding:10px; margin-left: 0px;margin-right: 0px;" id="map" onload="myFunction()">
    </div>
    {{--</div>--}}
    <div class="modal fade" id="reset-error-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center">Press Reset</h4>
                </div>
                <div class="modal-body">
                    <img src="/images/error.png" class="center-block" style="width: 100px">
                    <h4 class="modal-title text-center">Please Click On <label>Reset</label> Button To Change the Values</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="parameters-error-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center">Error In input Parameters</h4>
                </div>
                <div class="modal-body">
                    <img src="/images/error.png" class="center-block" style="width: 100px">
                    <h4 class="modal-title text-center">Check Input Parameters and try again</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <div class="modal fade" id="no-journey-error-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center">No journey to preview</h4>
                </div>
                <div class="modal-body">
                    <img src="/images/error.png" class="center-block" style="width: 100px">
                    <h4 class="modal-title text-center">Check Input Parameters and try again</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 800px;
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
        .btn-app-2{
            border-radius: 3px;
            position: relative;
            padding: 10px 10px;
            margin: 0 0 5px 5px;
            margin-top: 5px;
            min-width: 70px;
            height: 50px;
            text-align: center;
            color: #666;
            border: 1px solid #ddd;
            background-color: #00c0ef;
            font-size: 12px;
        }
    </style>

@endsection

@section('additional-js')
    <script src="https://maps.googleapis.com/maps/api/js?key={{env('MAP_API_KEY')}}&callback=initMap"
            async defer>
    </script>

    <script type="text/javascript">
        //Date picker
        {{--  $('#datepicker').datepicker({
            autoclose: true
        })  --}}
        var nic,route,journey_id,startDate,endDate = null;
        var busstops = false;
        $('.select2').select2();

        $('#daterange-btn').daterangepicker(
            {
                ranges   : {
                    'Today'       : [moment(), moment()],
                    'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                    'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate  : moment()
            },
            function (start, end) {
                // $('#daterange-btn span').html(start.format('D/MM/YYYY') + ' - ' + end.format('D/MM/YYYY'))
                // startDate = start._d;
                // endDate = end._d;
                // console.log(startDate,endDate);
                // $("#daterange-btn").prop("disabled", true);
                // refreshParameters();
            }
        );
        var map;
        var markers = [];

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 6.930434, lng: 79.984619},
                zoom: 13
            });

        };

        function showResetMessage(id,def){
            {{--  alert("IN show reset message")  --}}
            if($('#'+id).val()!=def){
                $('#reset-error-modal').modal('show');

            }
        }
        $('#route').change(function(e){
            if($('#route').val()!='Route'){
                $("#route").prop("disabled", true);
            }

            refreshParameters(clear=false);
        });
        $('#nic').change(function(e){
            if($('#nic').val()!='Surveyors NIC'){
                $("#nic").prop("disabled", true);
            }

            refreshParameters(clear=false);
        });
        $('#journey_id').change(function(e){
            if($('#journey_id').val()!='Journey Id'){
                $("#journey_id").prop("disabled", true);
            }

            refreshParameters(clear=false);
        });

        $('#resetFilters').click(function () {
           refreshParameters(clear=true);
        });
        $('#daterange-btn').on('apply.daterangepicker', function(ev, picker) {

            startDate = picker.startDate._d;
            endDate = picker.endDate._d;
            $('#daterange-btn span').html(picker.startDate.format('D/MM/YYYY') + ' - ' + picker.endDate.format('D/MM/YYYY'))
            console.log(startDate,endDate);
            $("#daterange-btn").prop("disabled", true);
            refreshParameters();
        });
        $('#busstops').change(function() {
            console.log('Toggle: ' + $(this).prop('checked'))
            busstops = $(this).prop('checked');
        })


        function refreshParameters(clear){

            if($('#route').val()!='Route'){
                route = $('#route').val();
            }
            if($('#nic').val()!='Surveyors NIC'){
                nic = $('#nic').val();
            }
            if($('#journey_id').val()!='Journey Id'){
                journey_id = $('#journey_id').val();
            }
            if(clear){
                route = null;
                nic = null;
                journey_id = null;
                startDate = null;
                endDate = null;
                $("#nic").prop("disabled", false);
                $("#route").prop("disabled", false);
                $("#journey_id").prop("disabled", false);
                $("#daterange-btn").prop("disabled", false);
                $("#daterange-btn").html( "<span>\n" +
                    "                      <i class=\"fa fa-calendar\"></i> Date range picker\n" +
                    "                    </span>\n" +
                    "                        <i class=\"fa fa-caret-down\"></i>")

            }

            document.getElementById("loader").style.display = "block";
            {{--  alert(startedChk+" "+routeDropChk+" "+dateDropChk+" "+tripDropChk+" "+nicDropChk)  --}}
            myFunction();
                {{--  alert(nic+" "+routeId+" "+date)  --}}
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            console.log({_token: CSRF_TOKEN,nic:nic,route:route,journey_id:journey_id,start_date:startDate,end_date:endDate,busstops:busstops});
            $.ajax({
                /* the route pointing to the post function */
                url: '/device/refresh',
                type: 'POST',
                /* send the csrf-token and the input to the controller ,trip_id:trip_id */
                data: {_token: CSRF_TOKEN,nic:nic,route:route,journey_id:journey_id,start_date:startDate,end_date:endDate,busstops:busstops},
                dataType: 'JSON',
                /* remind that 'data' is the response of the AjaxController */
                success: function (data) {
                    var data=data
                    console.log("data");
                    console.log(data);

                    var nics = [{id:'Surveyors NIC',text:'Surveyors NIC'}];
                    var routes = [{id:'Route',text:'Route'}];
                    var journeys = [{id:'Journey Id',text:'Journey Id'}];
                    for (var i = 0; i < data.nics.length; i++) {
                        // console.log(data.nics[i]);
                        var nic = data.nics[i];
                        nics.push({id:nic.nic,text:nic.nic})
                    }
                    for (var i = 0; i < data.journeyIDs.length; i++) {
                        // console.log(data.journeyIDs[i]);
                        var journeyID = data.journeyIDs[i];
                        journeys.push({id:journeyID.journeyId,text:journeyID.journeyId})
                    }
                    for (var i = 0; i < data.routes.length; i++) {
                        // console.log(data.routes[i]);
                        var route = data.routes[i];
                        routes.push({id:route.routeNo,text:route.routeNo +" - " + route.fromName + " to " + route.toName})
                    }
                    console.log(nics);
                    console.log(routes);
                    console.log(journeys);

                    if(!$('#nic').is(':disabled')){
                        $('#nic').empty()
                        $('#nic').select2({
                            data: nics
                        })
                    }
                    if(!$('#route').is(':disabled')){
                        $('#route').empty()
                        $('#route').select2({
                            data: routes
                        })
                    }
                    if(!$('#journey_id').is(':disabled')){
                        $('#journey_id').empty()
                        $('#journey_id').select2({
                            data : journeys
                        })
                    }

                },
                error:function (jqXHR, textStatus, errorThrown) {
                    alert("We got an error processing the request")
                    console.log(jqXHR);
                }
            });
        };

        $('#preview').click(function () {
            //deleteMarkers()
            if(nic==null && route==null && journey_id && null ){
                $('#parameters-error-modal').modal('show');
            }
            else{
                console.log("loading preview")
                preview()
            }
        });

        function preview() {
            document.getElementById("loader").style.display = "block";
            {{--  myVar = setTimeout(showMap, 1200);  --}}
            myFunction();

                {{--  alert(nic+" "+routeId+" "+date)  --}}
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            console.log({_token: CSRF_TOKEN,nic:nic,route:route,journey_id:journey_id,start_date:startDate,end_date:endDate,busstops:busstops})
            $.ajax({
                /* the route pointing to the post function */
                url: '/device/gps',
                type: 'POST',
                /* send the csrf-token and the input to the controller ,trip_id:trip_id */
                data: {_token: CSRF_TOKEN,nic:nic,route:route,journey_id:journey_id,start_date:startDate,end_date:endDate,busstops:busstops},
                dataType: 'JSON',
                /* remind that 'data' is the response of the AjaxController */
                success: function (data) {
                    var data=data;
                    console.log(data);

                },
                error:function (jqXHR, textStatus, errorThrown) {
                    alert("We got an error processing the request");
                    console.log(jqXHR);
                },
            });

        }

        function addMarker(loc) {
            var marker = new google.maps.Marker({
                position: {lat: parseFloat(loc["lat"]), lng: parseFloat(loc["lon"])},
                icon:"/images/marker.ico",
                map: map
            });
            if( typeof loc["busStopTypenone"]==='undefined'){
                var busstoptype="-"
            }
            var timeStamp= new Date(parseInt(loc["timeStamp"]))
            var updatedTime=new Date(parseInt(loc["updatedTime"]))
            infowindow = new google.maps.InfoWindow({
                content: '<p><strong>Bus Stop Type</strong>: '+busstoptype+'<br/>'
                +'<strong>bus stop Id</strong>: '+loc["busstopId"]+'<br/>'
                +'<strong>female Child In</strong>: '+loc["femaleChildIn"]+'<br/>'
                +'<strong>female Child Out</strong> :'+loc["femaleChildOut"]+'<br/>'
                +'<strong>female Elder In</strong>: '+loc["femaleElderIn"]+'<br/>'
                +'<strong>female Elder Out</strong>: '+loc["femaleElderOut"]+'<br/>'
                +'<strong>female Woman In</strong>: '+loc["femaleWomanIn"]+'<br/>'
                +'<strong>female Woman Out</strong>: '+loc["femaleWomanOut"]+'<br/>'
                +'<strong>female Young In</strong>: '+loc["femaleYoungIn"]+'<br/>'
                +'<strong>female Young Out</strong>: '+loc["femaleYoungOut"]+'<br/>'
                +'<strong>in Total</strong>: '+loc["inTotal"]+'<br/>'
                +'<strong>journey Id</strong>: '+loc["journeyId"]+'<br/>'
                +'<strong>lat</strong>: '+loc["lat"]+'<br/>'
                +'<strong>lon</strong>: '+loc["lon"]+'<br/>'+'</p>'
            });
            marker.addListener('click', function() {
                infowindow.open(map, marker);
            });
            markers.push(marker);
        }
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
        @endsection
