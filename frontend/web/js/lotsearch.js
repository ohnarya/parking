function storeHistory(lot){
  console.log("storehistory");
  var dest = $("#destination").val();
  // var lot  = $("#parkinglotsearchform-permit").val(); 
  
  $.post({url:'/index.php?r=parkinglot%2Fstore', 
          data:{'dest': dest, 'lot':lot},
          dataType: 'json'
  }).done(function(data){
    
    if(!data) 
      window.status = "History was not stored properly.";
    else{
      window.status = "History was stored successfully.";
    }  
     
  }).fail(function(data){
    window.status = "Server Error.";
  });  
}
  

$('#parkinglotsearchform-time').on('dblclick',function(event){
  var d = new Date();
  var time = d.getHours() + ":" + d.getMinutes();
  $(this).val(time);
});

$('.show-map').on('click',function(event){
  myLatLng = JSON.parse($(this).attr('place'));

  info = $(this).parent().siblings(':first').next().text();
  
  setMaker(myLatLng,info);

});

$('.lot-suggestion').on('click',function(){

  var panel = $(this).find(".direction_container").find("#directionsPanel")[0];
  
  if($(this).find(".direction_container").is(":visible") ){
    $(this).find("#directionsPanel").html("");
    
    directionsDisplay.setMap(null);
    directionsDisplay.setPanel(null);
    marker.setMap(null);
    
  }else{

    directionsService = new google.maps.DirectionsService();

    var request = {
      origin:JSON.parse($(this).attr('place')),
      destination:JSON.parse( $(this).attr('dest')),
      travelMode: google.maps.TravelMode.WALKING
    };
    
    directionsService.route(request, function(result, status) {
      
      if (status == google.maps.DirectionsStatus.OK) {

        directionsDisplay.setDirections(result);
        directionsDisplay.setMap(map);
        directionsDisplay.setPanel(panel);
      }else{
        console.log(status); 
      }
    });
    directionsDisplay.setMap(map);
  }

  $(this).find(".direction_container").toggle();
});