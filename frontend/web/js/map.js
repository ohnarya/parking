var myLatLng;
var map;
var marker;
var infowindow;

function initialize()
{
  myLatLng =  {lat: 30.61954954005045, lng: -96.3371479511261};
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
  marker.setMap(map);  
  
  if($("#googleMap").attr("clickable") =="1"){
    // add click listener
    google.maps.event.addListener(map, 'click', function(event) {
      placeMarker(event.latLng);
    });  
  }else{
    google.maps.event.clearListeners(map, 'click');
  }
}

function placeMarker(location) {
  marker.position = location;
  marker.setMap(map);

  $("div#lat-input").find("input").val(location.lat);
  $("div#lng-input").find("input").val(location.lng);
  window.setTimeout(function() {
    map.panTo(marker.getPosition());
  },500);
  
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

window.onload = loadScript;

$('.show-map').on('click',function(event){
  myLatLng =  {lat: parseFloat($(this).attr('lat')), lng: parseFloat($(this).attr('lng'))};
  info = $(this).parent().siblings(':first').next().text();
  setMaker(myLatLng,info);

});

$('#parkinglotsearchform-time').on('dblclick',function(event){
  var d = new Date();
  var time = d.getHours() + ":" + d.getMinutes();
  $(this).val(time);
});