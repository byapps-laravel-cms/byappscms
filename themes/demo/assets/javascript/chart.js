google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(app_stats);
      function app_stats() {
        var data = google.visualization.arrayToDataTable([
          ['index', 'value'],
          [$('.chart_box_l .chart_title').eq(0).text(),$('.chart_box_l .chart_value').eq(0).text()*1],
          [$('.chart_box_l .chart_title').eq(1).text(),$('.chart_box_l .chart_value').eq(1).text()*1],
        ]);

        var options = {
          title: 'app 통계', // 차트제목
          pieHole: 0.74,
          tooltip: { isHtml: true },
          chartArea: {width: "75%", height: "75%"},
          titleTextStyle: {
            fontSize: 17
          },
          pieSliceText: 'none',
          titlePosition: 'none',
          fontSize: 12,
          colors: ['#ffca51', '#ffd67a'],
          legend: { position: 'top', alignment: 'center' },
        };

        var chart = new google.visualization.PieChart(document.getElementById('app_stats'));
        chart.draw(data, options);
        
      }
      //ma 차트
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(ma_stats);
      function ma_stats() {
        var data = google.visualization.arrayToDataTable([
          ['index', 'value'],
          [$('.chart_box_l .chart_title').eq(2).text(),$('.chart_box_l .chart_value').eq(2).text()*1],
          [$('.chart_box_l .chart_title').eq(3).text(),$('.chart_box_l .chart_value').eq(3).text()*1],
        ]);

        var options = {
          title: 'ma 통계', // 차트제목
          pieHole: 0.74,
          chartArea: {width: "75%", height: "75%"},
          titleTextStyle: {
            fontSize: 17
          },
          pieSliceText: 'none',
          titlePosition: 'none',
          fontSize: 12,
          colors: ['#ff472b', '#ff6f59'],
          legend: { position: 'top', alignment: 'center' },
        };

        var chart = new google.visualization.PieChart(document.getElementById('ma_stats'));
        chart.draw(data, options);
      }
      //막대그래프
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(sale_stats);//()안에 function 실행

      function sale_stats() {
        var data = google.visualization.arrayToDataTable([
          ['','전체매출', '신규', '연장', '기타'],//가로축 값 값 값
          ['이번', $('.chart_box_r .chart_value').eq(0).text()*1, $('.chart_box_r .chart_value').eq(1).text()*1, $('.chart_box_r .chart_value').eq(2).text()*1,$('.chart_box_r .chart_value').eq(3).text()*1], //
          ['2015', $('.chart_box_r .chart_value').eq(4).text()*1, $('.chart_box_r .chart_value').eq(5).text()*1, $('.chart_box_r .chart_value').eq(6).text()*1,$('.chart_box_r .chart_value').eq(7).text()*1],
        ]);

        var options = {
          title: '매출통계현황',
          chartArea: {width: "100%", height: "100%"},
          titleTextStyle: {
            fontSize: 17
          },
          fontSize: 12,
        };

        var chart = new google.charts.Bar(document.getElementById('sale_stats'));//id 안으로 차트저장
        chart.draw(data, google.charts.Bar.convertOptions(options));
        
        $(window).resize(function(){ 
            app_stats(); 
            ma_stats(); 
            sale_stats();
        }); 
     }
      