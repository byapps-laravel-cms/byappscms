var chart_data;
  $.ajax({
    url:'./',
    data:'chart_data',
    type:'GET',
    processData:false,
    contentType:false,
    dataType:'text',
    cache:false,
    success : function (data) {
      chart_data = data;
      //테스트용 데이터
      chart_data = new Object();
      chart_data.circle1 = [["무료", 156],["유료", 120]];
      chart_data.circle2 = [["무료", 134],["유료", 152]];
      chart_data.bar = [["신규", 223],["연장", 524],["기타", 85],];
      showChart(chart_data);
    },
    error: function (jqXHR, textStatus, errorThrown) {
      chart_data = jqXHR.responseText;
    }
});

function showChart (data){
  var chart = bb.generate({
    data: {
      columns: data.circle1,
      type: "donut",
      onover: function (d, i) {
      console.log("onover", d, i);
    },
      onout: function (d, i) {
      console.log("onout", d, i);
    }
  },
    donut: {
      title: "Iris Petal Width"
    },
      bindto: "#app_stats"
    });
    
  var chart = bb.generate({
    data: {
      columns: data.circle2,
      type: "donut",
      onover: function (d, i) {
      console.log("onover", d, i);
    },
      onout: function (d, i) {
      console.log("onout", d, i);
    }
  },
    donut: {
      title: "Iris Petal Width"
    },
      bindto: "#ma_stats"
    });
    
  var chart = bb.generate({
    data: {
      columns: data.bar,
      type: "bar"
    },
    bar: {
      width: {
        ratio: 0.8
      }
    },
      bindto: "#sale_stats"
  });
}