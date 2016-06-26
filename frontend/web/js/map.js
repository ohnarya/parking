var myLatLng;
var map;
var marker;
var infowindow;

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
  
  if($("#googleMap").attr("clickable")=="1"){
    console.log("add");
    // add click listener
    google.maps.event.addListener(map, 'click', function(event) {
      placeMarker(event.latLng);
    });  
  }else{
    console.log("remove");
    google.maps.event.clearListeners(map, 'click');
  }
}

function placeMarker(location) {
  marker.position = location;
  marker.setMap(map);
  window.setTimeout(function() {
    map.panTo(marker.getPosition());
  },500);
  
}

function setMaker(position, info){
  marker.setMap(null);
  marker= new google.maps.Marker({
    position:myLatLng,
    });
  marker.setMap(map);
  window.setTimeout(function() {
    map.panTo(marker.getPosition());
  },500);  
  
  if(typeof info != 'undefined')
    writeInfo(info);
}


function writeInfo(info){
  infowindow = new google.maps.InfoWindow({
    content:info
    });
  infowindow.open(map,marker);  
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
  info = $(this).parent().siblings(':first').next().text();
  setMaker(myLatLng,info);

});