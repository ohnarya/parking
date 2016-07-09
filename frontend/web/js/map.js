var myLatLng;
var map;
var geocoder;
var marker;
var infowindow;
var directionsService;
var directionsDisplay;
/*
1. Initialize Google Map
2. register necessary elements to manage Map, such as LatLng, geocoder, marker, infowindow, directionDisplay, directionService
*/
function initialize(place)
{
  myLatLng =  {lat: parseFloat(30.61954954005045), lng: parseFloat(-96.3371479511261)};
  geocoder = new google.maps.Geocoder;
  
  var mapProp = {
    center:myLatLng,
    zoom:16,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
  marker=new google.maps.Marker({
    position:myLatLng
    });
    
  // set a marker on a map
  // marker.setMap(map);  
  
  
  directionsDisplay = new google.maps.DirectionsRenderer();
  directionsDisplay.setMap(map);
  
  if($("#googleMap").attr("clickable") =="1"){
    // add click listener
    google.maps.event.addListener(map, 'click', function(event) {
      placeMarker(event.latLng);
    });  
  }else{
    google.maps.event.clearListeners(map, 'click');
  }
}

window.onload = loadScript;

function loadScript()
{

  $.post({url:'/parkinglot/frontend/web/index.php?r=common%2Findex', 
          data:{'id':'GOOGLE_KEY'},
          dataType: 'json'
    
  }).done(function(data){
    // no Key
    if(!data['result']) 
      $("#googleMap").html("API KEY is not valid!");
    else{
      var script = document.createElement("script");
      script.type = "text/javascript";
      script.src = "https://maps.googleapis.com/maps/api/js?key="+ data['result'] + "&callback=initialize";
      document.body.appendChild(script); 
    }  
     
  }).fail(function(data){
     $("#googleMap").html("Server Error occured!");
  });
}

function placeMarker(location) {
  marker.position = location;
  marker.setMap(map);

  // find an address from place(lat,lng)
  geocodeLatLng(location);

  window.setTimeout(function() {
    map.panTo(marker.getPosition());
  },300);
  
}

function geocodeLatLng(location) {

  geocoder.geocode({'location': location}, function(results, status) {
    if (status === google.maps.GeocoderStatus.OK) {
      if (results[1]){
        
        var addr = results[0].formatted_address.split(",");
        addr.pop();addr.pop();
        $("div#address").find("input").val(addr.join(','));
        $("div#place").find("input").val(JSON.stringify(location));
      } else {
        window.alert('No results found');
      }
    } else {
      window.alert('Geocoder failed due to: ' + status);
    }
  });
}


function setMaker(position, info){
  marker.setMap(null);
  
  marker= new google.maps.Marker({
    position:myLatLng
    });
  marker.setMap(map);
  window.setTimeout(function() {
    map.panTo(marker.getPosition());
  },500);  
  
  if(typeof info != 'undefined'){
    writeInfo(info);
  }
}


function writeInfo(info){
  infowindow = new google.maps.InfoWindow({
    content:info
    });
  infowindow.open(map,marker);  
}

