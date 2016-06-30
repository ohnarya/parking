function storeHistory($permit){
    console.log("storeHistory");
    console.log($("#destination").val());
}


$('#parkinglotsearchform-time').on('dblclick',function(event){
  var d = new Date();
  var time = d.getHours() + ":" + d.getMinutes();
  $(this).val(time);
});