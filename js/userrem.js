function remove() {
	var username=$("#idUserSelect option:selected").text();
	var userid=$("#idUserSelect option:selected").val();
	var data = {
		action: "removeUser",
		userid: userid,
		username: username,
	};
	var ajaxurl = "/template/ajax.php";
	$.post(ajaxurl, data, function(response) {
		if (response=="true") {
			$("#idAlert").remove();
			$(".card").append("<div id=\"idSuccess\">Successfully deleted '" + username + "'</div>");
		} else {
			$("#idSuccess").remove();
			$(".card").append("<div id=\"idAlert\">Could not remove '" + username + "'</div>");
		}
	});
}