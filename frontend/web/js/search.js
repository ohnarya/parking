
$(document).ready(function(){

	$("#search-button").click(function(event){
		$("#search-loading").show();
		var query = $("#search-input").val();
		if(query.length == 0){
			document.getElementById("search-result").innerHTML="<Strong>Insert keywords in Search box.</strong>";
    		return;
		}
	});
});
