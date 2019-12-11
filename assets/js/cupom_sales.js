function openPopup(obj){
	var data = $(obj).serialize();

	var url =BASE_URL+"/sales/cupom_pdf?"+data;
	window.open(url, "sales", "width=700, height=500");
	


	return false;
}