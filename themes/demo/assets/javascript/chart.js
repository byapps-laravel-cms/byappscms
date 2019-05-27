google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(app_stats);
      function app_stats() {
        var data = google.visualization.arrayToDataTable([
          ['index', 'value'],
          ['유료',     11],
          ['무료',      2],
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
          ['유료',     11],
          ['무료',      2],
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
          ['Year', 'Sales', 'Expenses', 'Profit'],//가로축 값 값 값
          ['2014', 1000, 400, 200], //
          ['2015', 1170, 460, 250],
          ['2016', 660, 1120, 300],
          ['2017', 1030, 540, 350]
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
      