google.charts.load("current", {packages:["corechart"]});
//       google.charts.setOnLoadCallback(app_stats);
//       function app_stats() {
//         var data = google.visualization.arrayToDataTable([
//           ['index', 'value'],
//           [$('.chart_box_l .chart_title').eq(0).text(),$('.chart_box_l .chart_value').eq(0).text()*1],
//           [$('.chart_box_l .chart_title').eq(1).text(),$('.chart_box_l .chart_value').eq(1).text()*1],
//         ]);

//         var options = {
//           title: 'app 통계', // 차트제목
//           pieHole: 0.74,
//           tooltip: { isHtml: true },
//           chartArea: {width: "75%", height: "75%"},
//           titleTextStyle: {
//             fontSize: 17
//           },
//           pieSliceText: 'none',
//           titlePosition: 'none',
//           fontSize: 12,
//           colors: ['#ffca51', '#ffd67a'],
//           legend: { position: 'top', alignment: 'center' },
//         };

//         var chart = new google.visualization.PieChart(document.getElementById('app_stats'));
//         chart.draw(data, options);
        
//       }
//       //ma 차트
//       google.charts.load("current", {packages:["corechart"]});
//       google.charts.setOnLoadCallback(ma_stats);
//       function ma_stats() {
//         var data = google.visualization.arrayToDataTable([
//           ['index', 'value'],
//           [$('.chart_box_l .chart_title').eq(2).text(),$('.chart_box_l .chart_value').eq(2).text()*1],
//           [$('.chart_box_l .chart_title').eq(3).text(),$('.chart_box_l .chart_value').eq(3).text()*1],
//         ]);

//         var options = {
//           title: 'ma 통계', // 차트제목
//           pieHole: 0.74,
//           chartArea: {width: "75%", height: "75%"},
//           titleTextStyle: {
//             fontSize: 17
//           },
//           pieSliceText: 'none',
//           titlePosition: 'none',
//           fontSize: 12,
//           colors: ['#ff472b', '#ff6f59'],
//           legend: { position: 'top', alignment: 'center' },
//         };

//         var chart = new google.visualization.PieChart(document.getElementById('ma_stats'));
//         chart.draw(data, options);
//       }
      //막대그래프
    //   google.charts.load('current', {'packages':['bar']});
    //   google.charts.setOnLoadCallback(sale_stats);//()안에 function 실행

    //   function sale_stats() {
    //     var data = google.visualization.arrayToDataTable([
    //       ['','전체매출', '신규', '연장', '기타'],//가로축 값 값 값
    //       ['저번달', $('.chart_box_r .chart_value').eq(0).text()*1, $('.chart_box_r .chart_value').eq(1).text()*1, $('.chart_box_r .chart_value').eq(2).text()*1,$('.chart_box_r .chart_value').eq(3).text()*1],
    //       ['이번달', $('.chart_box_r .chart_value').eq(4).text()*1, $('.chart_box_r .chart_value').eq(5).text()*1, $('.chart_box_r .chart_value').eq(6).text()*1,$('.chart_box_r .chart_value').eq(7).text()*1],
    //     ]);

    //     var options = {
    //       title: '매출통계현황',
    //       chartArea: {width: "100%", height: "100%"},
    //       titleTextStyle: {
    //         fontSize: 17
    //       },
    //       fontSize: 12,
    //     };

    //     var chart = new google.charts.Bar(document.getElementById('sale_stats'));//id 안으로 차트저장
    //     chart.draw(data, google.charts.Bar.convertOptions(options));
        
    //     $(window).resize(function(){ 
    //         app_stats(); 
    //         ma_stats(); 
    //         sale_stats();
    //     }); 
    //  }
am4core.ready(function() {
am4core.useTheme(am4themes_animated);
var chart = am4core.create("app_stats", am4charts.PieChart);
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "litres";
pieSeries.dataFields.category = "country";

// Let's cut a hole in our Pie chart the size of 30% the radius
chart.innerRadius = am4core.percent(40);

// Put a thick white border around each Slice
pieSeries.slices.template.stroke = am4core.color("#fff");
pieSeries.slices.template.strokeWidth = 2;
pieSeries.slices.template.strokeOpacity = 1;
pieSeries.slices.template
  .cursorOverStyle = [
    {
      "property": "cursor",
      "value": "pointer",
    }
  ];

pieSeries.alignLabels = false;
pieSeries.labels.template.bent = true;
pieSeries.labels.template.radius = 3;
pieSeries.labels.template.padding(0,0,0,0);

pieSeries.ticks.template.disabled = true;

// Create a base filter effect (as if it's not there) for the hover to return to
var shadow = pieSeries.slices.template.filters.push(new am4core.DropShadowFilter);
shadow.opacity = 0;

// Create hover state
var hoverState = pieSeries.slices.template.states.getKey("hover"); // normally we have to create the hover state, in this case it already exists

// Slightly shift the shadow and make it more prominent on hover
var hoverShadow = hoverState.filters.push(new am4core.DropShadowFilter);
hoverShadow.opacity = 0.7;
hoverShadow.blur = 5;

// Add a legend

chart.data = [{
  "country": $('.chart_box_l .chart_title').eq(0).text(),
  "litres": $('.chart_box_l .chart_value').eq(0).text()*1
},{ 
  "country": $('.chart_box_l .chart_title').eq(1).text(),
  "litres": $('.chart_box_l .chart_value').eq(1).text()*1
}];
var label = pieSeries.createChild(am4core.Label);
label.text = "APP 통계";
label.horizontalCenter = "middle";
label.verticalCenter = "middle";
label.fontSize = 20;

//--------------------------------------------------------------------------------------------    
am4core.useTheme(am4themes_animated);
var chart = am4core.create("ma_stats", am4charts.PieChart);
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "litres";
pieSeries.dataFields.category = "country";

// Let's cut a hole in our Pie chart the size of 30% the radius
chart.innerRadius = am4core.percent(40);

// Put a thick white border around each Slice
pieSeries.slices.template.stroke = am4core.color("#fff");
pieSeries.slices.template.strokeWidth = 2;
pieSeries.slices.template.strokeOpacity = 1;
pieSeries.slices.template
  .cursorOverStyle = [
    {
      "property": "cursor",
      "value": "pointer",
    }
  ];

pieSeries.alignLabels = false;
pieSeries.labels.template.bent = true;
pieSeries.labels.template.radius = 3;
pieSeries.labels.template.padding(0,0,0,0);

pieSeries.ticks.template.disabled = true;

// Create a base filter effect (as if it's not there) for the hover to return to
var shadow = pieSeries.slices.template.filters.push(new am4core.DropShadowFilter);
shadow.opacity = 0;

// Create hover state
var hoverState = pieSeries.slices.template.states.getKey("hover"); // normally we have to create the hover state, in this case it already exists

// Slightly shift the shadow and make it more prominent on hover
var hoverShadow = hoverState.filters.push(new am4core.DropShadowFilter);
hoverShadow.opacity = 0.7;
hoverShadow.blur = 5;

// Add a legend

chart.data = [{
  "country": $('.chart_box_l .chart_title').eq(2).text(),
  "litres": $('.chart_box_l .chart_value').eq(2).text()*1
},{ 
  "country": $('.chart_box_l .chart_title').eq(3).text(),
  "litres": $('.chart_box_l .chart_value').eq(3).text()*1
}];
var label = pieSeries.createChild(am4core.Label);
label.text = "MA 통계";
label.horizontalCenter = "middle";
label.verticalCenter = "middle";
label.fontSize = 20;

//------------------------------------------------------------------------------------------------
// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

var chart = am4core.create("sale_stats", am4charts.XYChart);
chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

chart.data = [
  {
    category: "저번달",
    value1: $('.chart_box_r .chart_value').eq(1).text()*1,
    value2: $('.chart_box_r .chart_value').eq(2).text()*1,
    value3: $('.chart_box_r .chart_value').eq(3).text()*1
  },
  {
    category: "이번달",
    value1: $('.chart_box_r .chart_value').eq(5).text()*1,
    value2: $('.chart_box_r .chart_value').eq(6).text()*1,
    value3: $('.chart_box_r .chart_value').eq(7).text()*1
  }
];

chart.colors.step = 2;
chart.padding(30, 30, 10, 30);
chart.legend = new am4charts.Legend();

var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "category";
categoryAxis.renderer.grid.template.location = 0;

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.min = 0;
valueAxis.max = 100;
valueAxis.strictMinMax = true;
valueAxis.calculateTotals = true;
valueAxis.renderer.minWidth = 50;


var series1 = chart.series.push(new am4charts.ColumnSeries());
series1.columns.template.width = am4core.percent(80);
series1.columns.template.tooltipText =
  "{name}: {value1}";
series1.name = "신규";
series1.dataFields.categoryX = "category";
series1.dataFields.valueY = "value1";
series1.dataFields.valueYShow = "totalPercent";
series1.dataItems.template.locations.categoryX = 0.5;
series1.stacked = true;
series1.tooltip.pointerOrientation = "vertical";

var bullet1 = series1.bullets.push(new am4charts.LabelBullet());
bullet1.interactionsEnabled = false;
bullet1.label.text = "{valueY.totalPercent.formatNumber('#.00')}%";
bullet1.label.fill = am4core.color("#ffffff");
bullet1.locationY = 0.5;

var series2 = chart.series.push(new am4charts.ColumnSeries());
series2.columns.template.width = am4core.percent(80);
series2.columns.template.tooltipText =
  "{name}: {value2}";
series2.name = "연장";
series2.dataFields.categoryX = "category";
series2.dataFields.valueY = "value2";
series2.dataFields.valueYShow = "totalPercent";
series2.dataItems.template.locations.categoryX = 0.5;
series2.stacked = true;
series2.tooltip.pointerOrientation = "vertical";

var bullet2 = series2.bullets.push(new am4charts.LabelBullet());
bullet2.interactionsEnabled = false;
bullet2.label.text = "{valueY.totalPercent.formatNumber('#.00')}%";
bullet2.locationY = 0.5;
bullet2.label.fill = am4core.color("#ffffff");

var series3 = chart.series.push(new am4charts.ColumnSeries());
series3.columns.template.width = am4core.percent(80);
series3.columns.template.tooltipText =
  "{name}: {value3}";
series3.name = "기타";
series3.dataFields.categoryX = "category";
series3.dataFields.valueY = "value3";
series3.dataFields.valueYShow = "totalPercent";
series3.dataItems.template.locations.categoryX = 0.5;
series3.stacked = true;
series3.tooltip.pointerOrientation = "vertical";

var bullet3 = series3.bullets.push(new am4charts.LabelBullet());
bullet3.interactionsEnabled = false;
bullet3.label.text = "{valueY.totalPercent.formatNumber('#.00')}%";
bullet3.locationY = 0.5;
bullet3.label.fill = am4core.color("#ffffff");

chart.scrollbarX = new am4core.Scrollbar();

}); // end am4core.ready()      
      
