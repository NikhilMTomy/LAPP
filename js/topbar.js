function logout() {
	var data = {action: "logout"};
	var ajaxurl = "/template/ajax.php";
	$.post(ajaxurl, data, function (response) {
		window.location.reload();
	});
}