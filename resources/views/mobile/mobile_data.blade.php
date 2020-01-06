@extends('layouts.admin-lite')
@section('title')
    Track Survey data
@endsection
@section('page-header')
    Track Survey data
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
                        <option selected="selected">Surveyors NIC</option>
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
                        <option selected="selected">Route</option>
                        @foreach($routes as $route)
                            <option>{{$route->routeNo}}</option>
                        @endforeach
                    </select>
                </div>
              </div>
            </div>
            <div class="col-md-2" style="padding-right:0px">
              <div class="form-group text-center">
                <label>Journey Date</label>
                <div class="form-group no-bottom-margin" onclick="showResetMessage('date','Date')">
                     <select class="form-control select2" style="width: 100%;" id="date" name="route">
                        <option selected="selected">Date</option>
                        @foreach($dates as $date)
                            <option>{{$date->date}}</option>
                        @endforeach
                    </select>
                </div>
              </div>
            </div>
            <div class="col-md-2" style="padding-right:0px">
              <div class="form-group text-center">
                <label>Trip Id</label>
                <div class="form-group no-bottom-margin" onclick="showResetMessage('trip_id','Trip Id')">
                    <select class="form-control select2" style="width: 100%;" id="trip_id" name="trip_id">
                        <option selected="selected">Trip Id</option>
                        @foreach($trip_ids as $tripid)
                            <option value={{$tripid->journeyId}}>{{$tripid->fromName}} - {{$tripid->toName}}</option>
                        @endforeach
                    </select>
                </div>
              </div>
            </div>

             <div class="col-md-1">
                <div class="form-group no-bottom-margin">
                    <button  style="width: 80px; height: 50px; margin-left: 5px; margin-top: 6px" id="preview" class="btn btn-info">Visualize</button>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group no-bottom-margin">
                    <button style="width: 80px; height: 50px; margin-left: 5px; margin-top: 6px" id="exportCSV" class="btn btn-info">Download</button>
                </div>
            </div>
             <div class="col-md-1">
                <div class="form-group no-bottom-margin">
                    <button style="width: 80px; height: 50px; margin-left: 5px; margin-top: 6px" id="resetFilters" class="btn btn-info">Reset</button>
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
                        <h4 class="modal-title text-center">Please Click On Reset Button To Change the Values</h4>
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

        $("#nic").val("Surveyors NIC")
        $("#trip_id").val("Trip Id")
       $("#date").val("Date")
        $("#route").val("Route")

        nic="Surveyors NIC";
        trip_id="Trip Id";
        date="Date";
        routeId="Route";

         deleteMarkers()
         addDefaults()
         resetFilters()


    });
    $("#exportCSV").click(function(){
        nic=$("#nic").val();
        trip_id=$("#trip_id").val();
        date=$("#date").val();
        routeId=$("#route").val();
          if(
             nic==="Surveyors NIC" ||
             trip_id==="Trip Id"||
             date==="Date"||
             routeId==="Route"

         ){
             console.log(nic+ " "+ trip_id+" "+date+" "+routeId )
             $('#parameters-error-modal').modal('show');
         }
         else{
             exportCSV()
         }
    });
     $("#preview").click(function(){
        deleteMarkers()
        nic=$("#nic").val();
        trip_id=$("#trip_id").val();
        date=$("#date").val();
        routeId=$("#route").val();
         if(
             nic==="Surveyors NIC" ||
             trip_id==="Trip Id"||
             date==="Date"||
             routeId==="Route"

         ){
            {{--  console.log(nic+ " "+ trip_id+" "+date+" "+routeId )  --}}
             $('#parameters-error-modal').modal('show');
         }
         else{
              console.log("loading preview")
              preview()
         }
    });

        var map;
        var markers = []

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 6.930434, lng: 79.984619},
                zoom: 13
        });

    };

    function addDefaults(){
          $('#date').children().remove();
          $('#route').children().remove();
          $('#nic').children().remove();
          $('#trip_id').children().remove();

            var x = document.getElementById("nic");
            x.options[x.options.length]= new Option('Surveyors NIC', 'Surveyors NIC');
             $("#nic option[value='Surveyors NIC']").prop('selected', true);

            var y = document.getElementById("date");
            y.options[y.options.length]= new Option('Date', 'Date');
             $("#nic option[value='Date']").prop('selected', true);

            var z = document.getElementById("route");
            z.options[z.options.length]= new Option('Route', 'Route');
             $("#nic option[value='Route']").prop('selected', true);

            var a = document.getElementById("trip_id");
            a.options[a.options.length]= new Option('Trip Id', 'Trip Id');
             $("#nic option[value='Trip Id']").prop('selected', true);
    }
     // Adds a marker to the map and push to the array.
    function addToolTip(marker){
        var infowindow = new google.maps.InfoWindow({
        content: '<p>Marker Location:' + marker.getPosition() + '</p>'
        });
    }
    function timeConverter(UNIX_timestamp){
        alert("Unix date " + UNIX_timestamp)
        var a = new Date(UNIX_timestamp * 1000);
        var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        var year = a.getFullYear();
        var month = months[a.getMonth()];
        var date = a.getDate();
        var hour = a.getHours();
        var min = a.getMinutes();
        var sec = a.getSeconds();
        var time = date + ' ' + month + ' ' + year + ' ' + hour + ':' + min + ':' + sec ;
        return time;
    }
           {{--  icon:"public/images/bus.png",  --}}
    function addMarker(loc) {
        var marker = new google.maps.Marker({
        position: {lat: parseFloat(loc["lat"]), lng: parseFloat(loc["lon"])},
        icon:"/images/marker.png",
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
                    +'<strong>lon</strong>: '+loc["lon"]+'<br/>'
                    +'<strong>male Child In</strong>: '+loc["maleChildIn"]+'<br/>'
                    +'<strong>male Child Out</strong>: '+loc["maleChildOut"]+'<br/>'
                    +'<strong>male Elder In</strong>: '+loc["maleElderIn"]+'<br/>'
                    +'<strong>male Elder Out</strong>: '+loc["maleElderOut"]+'<br/>'
                    +'<strong>male Man In</strong>: '+loc["maleManIn"]+'<br/>'
                    +'<strong>male Man Out</strong>: '+loc["maleManOut"]+'<br/>'
                    +'<strong>male Young In</strong>: '+loc["maleYoungIn"]+'<br/>'
                    +'<strong>male Young Out</strong>: '+loc["maleYoungOut"]+'<br/>'
                    +'<strong>name</strong>: '+loc["name"]+'<br/>'
                    +'<strong>out Total</strong>: '+loc["outTotal"]+'<br/>'
                    +'<strong>time Stamp</strong>: '+timeStamp+'<br/>'
                    +'<strong>updated Time</strong>: '+updatedTime+'<br/></p>'
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
    var trip_id="Trip Id";
    var date="Date";
    var routeId="Route";
    var journeyList=null
    var data=null
    var currentDropDown=""
    var nicDropChk=0
    var routeDropChk=0
    var dateDropChk=0
    var tripDropChk=0
    var startedChk=""

    function showMap() {
        document.getElementById("loader").style.display = "none";
        document.getElementById("map").style.display = "block";
    }
    $('#nic').change(function(e){
        if($('#nic').val()!='Surveyors NIC'){
             $("#nic").prop("disabled", true);
        }
        if(startedChk===""){
            startedChk="nic"
        }
        nic=this.value
        nicDropChk=1
        document.getElementById("loader").style.display = "block";
        refreshMap('nic')
    })
    function showResetMessage(id,def){
        {{--  alert("IN show reset message")  --}}
        if($('#'+id).val()!=def){
            $('#reset-error-modal').modal('show');

        }
    }
    $('#route').change(function(e){
        routeId=this.value
         if($('#route').val()!='Route'){
             $("#route").prop("disabled", true);
        }
        if(startedChk===""){
            startedChk="route"
        }
        routeDropChk=1
        document.getElementById("loader").style.display = "block";

        refreshMap('route')
    })
    $('#date').change(function(e){
        date=this.value
        if($('#date').val()!='Date'){
             $("#date").prop("disabled", true);
        }
        if(startedChk===""){
            startedChk="date"
        }
        dateDropChk=1
        document.getElementById("loader").style.display = "block";
        refreshMap('date')
    })
    $('#trip_id').change(function(e){
        trip_id=this.value
        if($('#trip_id').val()!='Trip Id'){
             $("#trip_id").prop("disabled", true);
        }
        if(startedChk===""){
            startedChk="trip_id"
        }
        tripDropChk=1
        document.getElementById("loader").style.display = "block";

        refreshMap('trip_id')
    })
    function preview(){
        document.getElementById("loader").style.display = "block";
        {{--  myVar = setTimeout(showMap, 1200);  --}}
        myFunction()
        trip_id= $('#trip_id').val()
        if(trip_id===null || typeof trip_id==='undefined'){
            $('#no-journey-error-modal').modal.show()
            resetFilters()
        }
        else{
            console.log(trip_id)
            console.log(journeyList)
            var cLat= parseFloat(journeyList[0]["busstops"][0]["lat"])
            var cLon=parseFloat(journeyList[0]["busstops"][0]["lon"])
            map.panTo({lat:cLat, lng: cLon })
            for(j=0;j<journeyList.length;j++){
            if(journeyList[j]["journeyId"]===trip_id){
                    console.log("Equal!!!!!!!!!!!!!!!1")
                    var busstops=journeyList[j]["busstops"]
                    //  for(i=0;i<busstops.length;i++){
                    //     console.log(busstops[i]["lat"]+" "+busstops[i]["lon"])
                    // }
                    console.log(busstops)
                    markMap(busstops)
            }
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
        console.log("this is options")
        console.log(options)
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
                    +new Date(busstops[i]["timeStamp"]*1000)+","
                    +new Date(busstops[i]["updatedTime"]*1000)+"\n"
                }
           }
        }
        return header+body
    }
    function exportCSV(){
        document.getElementById("loader").style.display = "block";
        myVar = setTimeout(showMap, 1000);

        if (navigator.msSaveBlob) { // IE 10+
            var blob = new Blob([dataPreparation()], {type: 'text/plain'});
            console.log("Internet Explorer detected");
            navigator.msSaveBlob(blob, 'data.csv');
        }
        else {
            var link = document.createElement('a');
            link.download = 'data.csv';
            var blob = new Blob([dataPreparation()], {type: 'text/plain'});
            link.href = window.URL.createObjectURL(blob);
            link.click();
        }


     }
    function refreshMap(dropId){
             {{--  alert(startedChk+" "+routeDropChk+" "+dateDropChk+" "+tripDropChk+" "+nicDropChk)  --}}
            myFunction()
            {{--  alert(nic+" "+routeId+" "+date)  --}}
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            console.log({_token: CSRF_TOKEN,nic:nic,routeId:routeId,date:date,trip_id:trip_id})
            $.ajax({
                /* the route pointing to the post function */
                url: '/mobile/app',
                type: 'POST',
                /* send the csrf-token and the input to the controller ,trip_id:trip_id */
                data: {_token: CSRF_TOKEN,nic:nic,routeId:routeId,date:date,tripId:trip_id},
                dataType: 'JSON',
                /* remind that 'data' is the response of the AjaxController */
                success: function (data) {

                    showMap()
                    data=data
                    console.log(data)
                    journeyList=data["trips"]
                    console.log("This is journey list")
                    console.log(journeyList)
                    if(!$('#nic').is(':disabled')){
                            changeNic(data)
                    }
                    if(!$('#route').is(':disabled')){
                            changeRoute(data)
                    }
                    if(!$('#date').is(':disabled')){
                            changeDate(data)
                    }
                    if(!$('#trip_id').is(':disabled')){
                            changeTrip(data)
                    }


                },
                error:function (jqXHR, textStatus, errorThrown) {
                   alert("We got an error processing the request")
                }
            });
        };
        function changeRoute(data){
            $('#route').children().remove();
            var y = document.getElementById("route");
            y.options[y.options.length]= new Option('Route', 'Route');
            $("#route option[value='Date']").prop('selected', true);

            for(j=0;j<data["routes"].length;j++){
                var dataOp=data["routes"][j]["routeNo"]
                var opt = document.createElement('option');
                opt.appendChild( document.createTextNode(dataOp));
                opt.value =dataOp;
                document.getElementById('route').appendChild(opt);
            }
        }
        function changeDate(data){
             $('#date').children().remove();
            var y = document.getElementById("date");
            y.options[y.options.length]= new Option('Date', 'Date');
            $("#date option[value='Date']").prop('selected', true);

            for(j=0;j<data["dates"].length;j++){
                var dataOp=data["dates"][j]["date"]
                var opt = document.createElement('option');
                opt.appendChild( document.createTextNode(dataOp));
                opt.value =dataOp;
                document.getElementById('date').appendChild(opt);
            }
        }
        function changeTrip(data){
             $('#trip_id').children().remove();
            var a = document.getElementById("trip_id");
            a.options[a.options.length]= new Option('Trip Id', 'Trip Id');
            $("#trip_id option[value='Trip Id']").prop('selected', true);

            for(j=0;j<data["trips"].length;j++){
                var dataOp=data["trips"][j]["fromName"]+"-"+ data["trips"][j]["toName"]
                var opt = document.createElement('option');
                opt.appendChild( document.createTextNode(dataOp));
                opt.text=data["trips"][j]["fromName"]+"-"+data["trips"][j]["toName"]
                opt.value=data["trips"][j]["journeyId"]
                document.getElementById('trip_id').appendChild(opt);
            }

        }
        function changeNic(data){
             $('#nic').children().remove();
            var x = document.getElementById("nic");
            x.options[x.options.length]= new Option('Surveyors NIC', 'Surveyors NIC');
             $("#nic option[value='Surveyors NIC']").prop('selected', true);

            for(j=0;j<data["nic"].length;j++){
                var dataOp=data["nic"][j]["nic"]
                var opt = document.createElement('option');
                opt.appendChild( document.createTextNode(dataOp));
                opt.value =dataOp;
                document.getElementById('nic').appendChild(opt);
            }
        }
        function resetFilters(){
             document.getElementById("loader").style.display = "block";
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $("#date").prop("disabled", false);
            $("#trip_id").prop("disabled", false);
            $("#route").prop("disabled", false);
            $("#nic").prop("disabled", false);
            $.ajax({
                /* the route pointing to the post function */
                url: '/mobile/refresh',
                type: 'post',
                /* send the csrf-token and the input to the controller ,trip_id:trip_id */
                data: {_token: CSRF_TOKEN},
                dataType: 'JSON',
                /* remind that 'data' is the response of the AjaxController */
                success: function (data) {
                    console.log(data)
                    showMap()
                    startedChk=""
                    nicDropChk=0
                    routeDropChk=0
                    dateDropChk=0
                    tripDropChk=0

                    //empting the nic and append new data
                    {{--  $('#nic').children().remove();  --}}
                    for(j=0;j<data["nic"].length;j++){
                          var dataOp=data["nic"][j]["nic"]
                          var opt = document.createElement('option');
                          opt.appendChild( document.createTextNode(dataOp));
                          opt.value =dataOp;
                          document.getElementById('nic').appendChild(opt);
                    }
                    //empting the routes and append new data
                    {{--  $('#route').children().remove();  --}}
                    for(j=0;j<data["routes"].length;j++){
                          var dataOp=data["routes"][j]["routeNo"]
                          var opt = document.createElement('option');
                          opt.appendChild( document.createTextNode(dataOp));
                          opt.value =dataOp;
                          document.getElementById('route').appendChild(opt);
                    }
                    //empting the dates and append new data
                    {{--  $('#date').children().remove();  --}}
                    for(j=0;j<data["dates"].length;j++){
                          var dataOp=data["dates"][j]["date"]
                          var opt = document.createElement('option');
                          opt.appendChild( document.createTextNode(dataOp));
                          opt.value =dataOp;
                          document.getElementById('date').appendChild(opt);
                    }
                     //empting the trip Ids and append new data
                    {{--  $('#trip_id').children().remove();  --}}
                    journeyList=data["trips"]
                    for(j=0;j<data["trips"].length;j++){
                          var dataOp=data["trips"][j]["journeyId"]
                          var opt = document.createElement('option');
                          opt.appendChild( document.createTextNode(dataOp));
                          opt.text=data["trips"][j]["fromName"]+"-"+data["trips"][j]["toName"]
                          opt.value=data["trips"][j]["journeyId"]
                          document.getElementById('trip_id').appendChild(opt);
                    }
                    {{--  callback;  --}}
                }
            });
        };
    </script>
    @endsection
