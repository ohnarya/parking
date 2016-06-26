var myLatLng;
var map;
var marker;
function initialize()
{
  myLatLng =  {lat: 30.6189387, lng: -96.338738};
  var mapProp = {
    center:myLatLng,
    zoom:17,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
  marker=new google.maps.Marker({
    position:myLatLng,
    });
    
  // set a marker on a map
  marker.setMap(map);  
  
  // add click listener
  google.maps.event.addListener(map, 'click', function(event) {
    console.log(event.latLng);
    placeMarker(event.latLng);
  });  
}

function placeMarker(location) {
  marker.position = location;
  marker.setMap(map);
  window.setTimeout(function() {
    map.panTo(marker.getPosition());
  },500);
  
}

function resetMaker(position){
  marker.setMap(null);
  marker= new google.maps.Marker({
    position:myLatLng,
    });
  marker.setMap(map);
  window.setTimeout(function() {
    map.panTo(marker.getPosition());
  },500);  
}


function loadScript()
{
  var script = document.createElement("script");
  script.type = "text/javascript";
  script.src = "https://maps.googleapis.com/maps/api/js?key=&sensor=false&callback=initialize";
  document.body.appendChild(script);
}

window.onload = loadScript;

$('.show-map').on('click',function(event){
  myLatLng =  {lat: parseFloat($(this).attr('lat')), lng: parseFloat($(this).attr('lng'))};
  resetMaker(myLatLng);

});