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
                        <option selected="selected">Surveyors NIC</option>
                        @foreach($nics as $nic)
                        <option>{{$nic->nic}}</option>
                            @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group no-bottom-margin">
                    <select class="form-control select2" style="width: 100%;" id="route" name="route">
                        <option selected="selected">Route</option>
                        @foreach($routes as $route)
                            <option>{{$route->routeNo}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group no-bottom-margin">
                     <select class="form-control select2" style="width: 100%;" id="date" name="route">
                        <option selected="selected">Date</option>
                        @foreach($dates as $date)
                            <option>{{$date->date}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group no-bottom-margin">
                    <select class="form-control select2" style="width: 100%;" id="trip_id" name="trip_id">
                        <option selected="selected">Trip Id</option>
                        @foreach($trip_ids as $tripid)
                            <option>{{$tripid->journeyId}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group no-bottom-margin">
                    <button id="exportCSV" class="btn btn-info">Export CSV</button>
                </div>
            </div>
             <div class="col-md-1">
                <div class="form-group no-bottom-margin">
                    <button id="preview" class="btn btn-info">preview</button>
                </div>
            </div>
             <div class="col-md-2">
                <div class="form-group no-bottom-margin">
                    <button id="resetFilters" class="btn btn-info">Reset Filters</button>
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
   
@endsection


@section('additional-js')
    <script src="https://maps.googleapis.com/maps/api/js?key={{env('MAP_API_KEY')}}&callback=initMap"
            async defer></script>

    <script type="text/javascript">
        //Date picker
        {{--  $('#datepicker').datepicker({
            autoclose: true
        })  --}}
        $('.select2').select2()

    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script>
    
    //button reset filters
    $("#resetFilters").click(function(){
         resetFilters()
    });
    $("#exportCSV").click(function(){
         exportCSV()
    });
     $("#preview").click(function(){
         preview()
    });

        var map;
        var markers = []
        
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 6.930434, lng: 79.984619},
                zoom: 10
        });
      
    };
   

     // Adds a marker to the map and push to the array.
    function addToolTip(marker){
        var infowindow = new google.maps.InfoWindow({
        content: '<p>Marker Location:' + marker.getPosition() + '</p>'
        });
    }
           {{--  icon:"public/images/bus.png",  --}}
    function addMarker(loc) {
        var marker = new google.maps.Marker({
        position: {lat: parseFloat(loc["lat"]), lng: parseFloat(loc["lon"])},
        icon:"/images/sBus.ico",
        map: map
        });
        infowindow = new google.maps.InfoWindow({
            content: '<p><strong>busStopTypenone</strong>:'+loc["busStopTypenone"]+'<br/>'
                    +'<strong>busstopId</strong>:'+loc["busstopId"]+'<br/>'
                    +'<strong>femaleChildIn</strong>:'+loc["femaleChildIn"]+'<br/>'
                    +'<strong>femaleChildOut</strong>:'+loc["femaleChildOut"]+'<br/>'
                    +'<strong>femaleElderIn</strong>:'+loc["femaleElderIn"]+'<br/>'
                    +'<strong>femaleElderOut</strong>:'+loc["femaleElderOut"]+'<br/>'
                    +'<strong>femaleWomanIn</strong>:'+loc["femaleWomanIn"]+'<br/>'
                    +'<strong>femaleWomanOut</strong>:'+loc["femaleWomanOut"]+'<br/>'
                    +'<strong>femaleYoungIn</strong>:'+loc["femaleYoungIn"]+'<br/>'
                    +'<strong>femaleYoungOut</strong>:'+loc["femaleYoungOut"]+'<br/>'
                    +'<strong>inTotal</strong>:'+loc["inTotal"]+'<br/>'
                    +'<strong>journeyId</strong>:'+loc["journeyId"]+'<br/>'
                    +'<strong>lat</strong>:'+loc["lat"]+'<br/>'
                    +'<strong>lon</strong>:'+loc["lon"]+'<br/>'
                    +'<strong>maleChildIn</strong>:'+loc["maleChildIn"]+'<br/>'
                    +'<strong>maleChildOut</strong>:'+loc["maleChildOut"]+'<br/>'
                    +'<strong>maleElderIn</strong>:'+loc["maleElderIn"]+'<br/>'
                    +'<strong>maleElderOut</strong>:'+loc["maleElderOut"]+'<br/>'
                    +'<strong>maleManIn</strong>:'+loc["maleManIn"]+'<br/>'
                    +'<strong>maleManOut</strong>:'+loc["maleManOut"]+'<br/>'
                    +'<strong>maleYoungIn</strong>:'+loc["maleYoungIn"]+'<br/>'
                    +'<strong>maleYoungOut</strong>:'+loc["maleYoungOut"]+'<br/>'
                    +'<strong>name</strong>:'+loc["name"]+'<br/>'
                    +'<strong>outTotal</strong>:'+loc["outTotal"]+'<br/>'
                    +'<strong>timeStamp</strong>:'+loc["timeStamp"]+'<br/>'
                    +'<strong>updatedTime</strong>:'+loc["updatedTime"]+'<br/></p>'
        });
        marker.addListener('click', function() {
            infowindow.open(map, marker);
        });
        markers.push(marker);
    }
      function markMap(locations){
            console.log(locations)
            for(i=0;i<locations.length;i++){
              var loc=locations[i]
              {{--  var myLatLng=new LatLng(loc["lat"], loc["lon"]);  --}}
              console.log({lat: parseFloat(loc["lat"]), lng: parseFloat(loc["lon"])})
              addMarker(loc)
              
            }
        }
        function deleteMarkers() {
            clearMarkers();
            markers = [];
    }
    // Sets the map on all markers in the array.
      function setMapOnAll(map) {
        for (var i = 0; i < markers.length; i++) {
          markers[i].setMap(map);
        }
      }

      // Removes the markers from the map, but keeps them in the array.
      function clearMarkers() {
        setMapOnAll(null);
      }

      // Shows any markers currently in the array.
      function showMarkers() {
        setMapOnAll(map);
      }

 

    var nic="Surveyors NIC";
    var trip_id="Route";
    var date=null;
    var routeId="Trip Id";
    var journeyList=null
    var data=null

    $('#nic').change(function(e){
        nic=this.value
        refreshMap(nic,routeId,date)
    })
    $('#route').change(function(e){
        routeId=this.value
        refreshMap(nic,routeId,date)
    })
    $('#date').change(function(e){
        date=this.value
        refreshMap(nic,routeId,date)
    })
    $('#trip_id').change(function(e){
        trip_id=this.value
        refreshMap(nic,routeId,date)
    })
    function preview(){
        trip_id= $('#trip_id').val()
        deleteMarkers()
        console.log(trip_id)
        console.log(journeyList)
        for(j=0;j<journeyList.length;j++){
           if(journeyList[j]["journeyId"]===trip_id){
                console.log("Equal!!!!!!!!!!!!!!!1")
                var busstops=journeyList[j]["busstops"]
                {{--  for(i=0;i<busstops.length;i++){
                    console.log(busstops[i]["lat"]+" "+busstops[i]["lon"])
                }  --}}
                console.log(busstops)
                markMap(busstops)
           }
        }
    }
    function dataPreparation(){
        var header="nic,route,date,journeyId,busStopTypenone,busstopId,femaleChildIn,femaleChildOut,femaleElderIn,femaleElderOut,femaleWomanIn,femaleWomanOut,femaleYoungIn,femaleYoungOut,inTotal,journeyId,lat,lon,maleChildIn,maleChildOut,maleElderIn,maleElderOut,maleManIn,maleManOut,maleYoungIn,maleYoungOut,name,outTotal,timeStamp,updatedTimen\n"
        var bodySample=$('#nic').val()+","+$('#route').val()+","+$('#date').val()+","
        var options=[]
        var body=""
        var minisample=""
        $('#trip_id > option').each(function() {
            options.push($(this).val())
        });
        for(j=0;j<journeyList.length;j++){
           if(options.includes(journeyList[j]["journeyId"])){
                console.log("Equal!!!!!!!!!!!!!!!1")
                minisample=bodySample+journeyList[j]["journeyId"]+","
                var busstops=journeyList[j]["busstops"]
                for(i=0;i<busstops.length;i++){
                    body+=minisample+
                    busstops[i]["busStopTypenone"]+","
                    +busstops[i]["busstopId"]+","
                    +busstops[i]["femaleChildIn"]+","
                    +busstops[i]["femaleChildOut"]+","
                    +busstops[i]["femaleElderIn"]+","
                    +busstops[i]["femaleElderOut"]+","
                    +busstops[i]["femaleWomanIn"]+","
                    +busstops[i]["femaleWomanOut"]+","
                    +busstops[i]["femaleYoungIn"]+","
                    +busstops[i]["femaleYoungOut"]+","
                    +busstops[i]["inTotal"]+","
                    +busstops[i]["journeyId"]+","
                    +busstops[i]["lat"]+","
                    +busstops[i]["lon"]+","
                    +busstops[i]["maleChildIn"]+","
                    +busstops[i]["maleChildOut"]+","
                    +busstops[i]["maleElderIn"]+","
                    +busstops[i]["maleElderOut"]+","
                    +busstops[i]["maleManIn"]+","
                    +busstops[i]["maleManOut"]+","
                    +busstops[i]["maleYoungIn"]+","
                    +busstops[i]["maleYoungOut"]+","
                    +busstops[i]["name"]+","
                    +busstops[i]["outTotal"]+","
                    +busstops[i]["timeStamp"]+","
                    +busstops[i]["updatedTime"]+"\n"
                }
           }
        }
        return header+body
    }
    function exportCSV(){
        var link = document.createElement('a');
        link.download = 'data.csv';
        var blob = new Blob([dataPreparation()], {type: 'text/plain'});
        link.href = window.URL.createObjectURL(blob);
        link.click();
     }
    function refreshMap(nic,routeId,date){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            console.log({_token: CSRF_TOKEN,nic:nic,routeId:routeId,date:date,trip_id:trip_id})
            $.ajax({
                /* the route pointing to the post function */
                url: '/mobile/app',
                type: 'POST',
                /* send the csrf-token and the input to the controller ,trip_id:trip_id */
                data: {_token: CSRF_TOKEN,nic:nic,routeId:routeId,date:date},
                dataType: 'JSON',
                /* remind that 'data' is the response of the AjaxController */
                success: function (data) {
                    data=data
                    //console.log(data)
                    //empting the nic and append new data
                    {{--  $('#nic').children().remove();
                    for(j=0;j<data["nic"].length;j++){
                          var dataOp=data["nic"][j]["nic"]
                          var opt = document.createElement('option');
                          opt.appendChild( document.createTextNode(dataOp));
                          opt.value =dataOp; 
                          document.getElementById('nic').appendChild(opt); 
                    }  --}}
                    //empting the routes and append new data
                    $('#route').children().remove();
                    for(j=0;j<data["routes"].length;j++){
                          var dataOp=data["routes"][j]["routeNo"]
                          var opt = document.createElement('option');
                          opt.appendChild( document.createTextNode(dataOp));
                          opt.value =dataOp; 
                          document.getElementById('route').appendChild(opt); 
                    }
                    //empting the dates and append new data
                    $('#date').children().remove();
                    for(j=0;j<data["dates"].length;j++){
                          var dataOp=data["dates"][j]["date"]
                          var opt = document.createElement('option');
                          opt.appendChild( document.createTextNode(dataOp));
                          opt.value =dataOp; 
                          document.getElementById('date').appendChild(opt); 
                    }
                     //empting the trip Ids and append new data
                    $('#trip_id').children().remove();
                    journeyList=data["trips"]
                    for(j=0;j<data["trips"].length;j++){
                          var dataOp=data["trips"][j]["journeyId"]
                          var opt = document.createElement('option');
                          opt.appendChild( document.createTextNode(dataOp));
                          opt.value=data["trips"][j]["journeyId"]
                          document.getElementById('trip_id').appendChild(opt); 
                    }
                }
            });     
        }; 
        function resetFilters(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                /* the route pointing to the post function */
                url: '/mobile/freshData',
                type: 'get',
                /* send the csrf-token and the input to the controller ,trip_id:trip_id */
                data: {_token: CSRF_TOKEN},
                dataType: 'JSON',
                /* remind that 'data' is the response of the AjaxController */
                success: function (data) { 
                    console.log(data)
                    //empting the nic and append new data
                    $('#nic').children().remove();
                    for(j=0;j<data["nic"].length;j++){
                          var dataOp=data["nic"][j]["nic"]
                          var opt = document.createElement('option');
                          opt.appendChild( document.createTextNode(dataOp));
                          opt.value =dataOp; 
                          document.getElementById('nic').appendChild(opt); 
                    }
                    //empting the routes and append new data
                    $('#route').children().remove();
                    for(j=0;j<data["routes"].length;j++){
                          var dataOp=data["routes"][j]["routeNo"]
                          var opt = document.createElement('option');
                          opt.appendChild( document.createTextNode(dataOp));
                          opt.value =dataOp; 
                          document.getElementById('route').appendChild(opt); 
                    }
                    //empting the dates and append new data
                    $('#date').children().remove();
                    for(j=0;j<data["dates"].length;j++){
                          var dataOp=data["dates"][j]["date"]
                          var opt = document.createElement('option');
                          opt.appendChild( document.createTextNode(dataOp));
                          opt.value =dataOp; 
                          document.getElementById('date').appendChild(opt); 
                    }
                     //empting the trip Ids and append new data
                    $('#trip_id').children().remove();
                    journeyList=data["trips"]
                    for(j=0;j<data["trips"].length;j++){
                          var dataOp=data["trips"][j]["journeyId"]
                          var opt = document.createElement('option');
                          opt.appendChild( document.createTextNode(dataOp));
                          opt.value=data["trips"][j]["journeyId"]
                          document.getElementById('trip_id').appendChild(opt); 
                    }
                }
            });     
        };    
    </script>
    @endsection
