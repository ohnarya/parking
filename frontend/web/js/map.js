var myLatLng;
var map;
var geocoder;
var marker;
var infowindow;
var directionsService;
var directionsDisplay;

function initialize()
{
  myLatLng =  {lat: parseFloat(30.61954954005045), lng: parseFloat(-96.3371479511261)};
  geocoder = new google.maps.Geocoder;
  
  var mapProp = {
    center:myLatLng,
    zoom:17,
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
      if (results[1]) {
        
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





$('.show-map').on('click',function(event){
  myLatLng =  formatLatlng($(this).attr('place'));
  info = $(this).parent().siblings(':first').next().text();
  setMaker(myLatLng,info);

});



$('.lot-sugesstion').on('click', function(event){
  console.log("test");
  console.log($(this).attr("lat"));
  
  directionsService = new google.maps.DirectionsService();
  calcRoute();
});
function formatLatlng(latlng)  
{
    var latlngStr = latlng.split(',', 2);
    var latStr = latlngStr[0].split(':',2);
    var lngStr = latlngStr[1].split(':',2);
    return {lat: parseFloat(latStr[1]), lng: parseFloat(lngStr[1])};
}
function calcRoute() {

  var request = {
    origin:{lat: 30.621571523179576, lng: -96.33728206157684},
    destination:{lat: 30.618930934035166, lng: -96.33888065814972},
    travelMode: google.maps.TravelMode.WALKING
  };
  directionsService.route(request, function(result, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(result);
    }
  });
}

