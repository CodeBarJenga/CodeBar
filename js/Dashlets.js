$(document).ready(function() {
	$("#dashBoardTab").click(function() {
		var dashBoardDataObject = jQuery.parseJSON($("#dashBoardTab").attr("value"));
		var contestNames = [];
        var solvedProblems = [];
        var unsolvedProblems = [];
		for (var key in dashBoardDataObject) {
			contestNames.push(key);
			solvedProblems.push(dashBoardDataObject[key]['solvedProblems']);
			unsolvedProblems.push(dashBoardDataObject[key]['unsolvedProblems']);
		}
 
		Highcharts.chart('container', {
			exporting : {
				enabled : false
			},
			chart : {
				renderTo : 'container',
				type : 'column'
			},

			title : {
				text : 'Problems Solved in each contest'
			},

			xAxis : {
				categories : contestNames,
				title : {
					text : "Contest Names"
				}

			},

			yAxis : {
				allowDecimals : false,
				min : 0,
				title : {
					text : 'Number of Problems'
				}
			},
			tooltip : {
				formatter : function() {
					return '<b>' + this.x + '</b><br/>' + this.series.name + ': ' + this.y + '<br/>' + 'Total: ' + this.point.stackTotal;
				}
			},

			plotOptions : {
				column : {
					stacking : 'normal'
				}
			},

			series : [{
				name : 'Unsolved',
				data : unsolvedProblems,
			}, {
				name : 'Solved',
				data : solvedProblems,
			}]
		});
	});
});
