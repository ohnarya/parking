function storeHistory($permit){
    console.log("storeHistory");
    console.log($("#destination").val());
}


$('#parkinglotsearchform-time').on('dblclick',function(event){
  var d = new Date();
  var time = d.getHours() + ":" + d.getMinutes();
  $(this).val(time);
});

$('.show-map').on('click',function(event){
  myLatLng =  formatLatlng($(this).attr('place'));
  info = $(this).parent().siblings(':first').next().text();
  setMaker(myLatLng,info);

});



$('.lot-sugesstion').on('click', function(event){
  console.log("test");
  console.log($(this).attr("lat"));
  
});

$('.lot-suggestion').on('click',function(){
  if($(".direction_container").is(":visible")){
    $("#directionsPanel").html("");
    
    directionsDisplay.setMap(null);
    directionsDisplay.setPanel(null);
    marker.setMap(null);
    
  }else{
    directionsService = new google.maps.DirectionsService();
    
    var request = {
      origin: formatLatlng($(this).attr('place')),
      destination:formatLatlng($(this).attr('dest')),
      travelMode: google.maps.TravelMode.WALKING
    };
    directionsService.route(request, function(result, status) {
      if (status == google.maps.DirectionsStatus.OK) {
        directionsDisplay.setDirections(result);
        // directionsDisplay.setMap(map);
        directionsDisplay.setPanel(document.getElementById("directionsPanel"));
      }
    });
    directionsDisplay.setMap(map);
  }

  $(".direction_container").toggle();
});