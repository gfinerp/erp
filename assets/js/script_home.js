
var rel1 = new Chart(document.getElementById("rel1"), {
	type:'bar',
	data:{
		labels:days_list,
		datasets:[{
			label:'Receita',
			data:revenue_list,
			fill:false,
			backgroundColor:'#0000FF',
			borderColor:'#0000FF'
		},
		{
	
			label:'Despesas',
			data:accounts_list,
			fill:false,
			backgroundColor:'#FF0000',
			borderColor:'#FF0000'
		}]
	}
});


var rel2 = new Chart(document.getElementById("rel2"), {
	type:'pie',
	data:{
		labels:forma_name_list,
		datasets: [{
			data:forma_list,
			backgroundColor:['#007770', '#0000FF', '#FFA500','#FF0000','#778899', '#008990', '#00AAFF', '#FFA5AA','#FF0123','#770099', '#778989' ]
		}]
	}
});

