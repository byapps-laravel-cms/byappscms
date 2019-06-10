var chart_data;

formData = new FormData();
formData.append('test','test');

// $.ajax({
//   url:`./${location.href}`,
//   data:formData,
//   type:'GET',
//   processData:false,
//   contentType:false,
//   dataType:'text',
//   cache:false,
//   success : function (data) {
//     console.log(data);
//     chart_data = data;
//     //테스트용 데이터
//     chart_data = new Object();
//     chart_data.circle1 = [["무료", 156],["유료", 120],["관리", 100]];
//     chart_data.circle2 = [["무료", 134],["유료", 152],["관리", 100]];
//     chart_data.bar = [["신규", 223,100],["연장", 524,200],["기타", 85,300]];
//     showChart(chart_data);
//   },
//   error: function (jqXHR, textStatus, errorThrown) {
//     chart_data = jqXHR.responseText;
//   }
// });

function asdf(){
    temp = $('form').request('onTest', {
        success: function(data) {
            console.log(data.result);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR.responseText)
        }
    })
    return null;
}

function showChart (data){
  var chart = bb.generate({
    data: {
      columns: data.circle1,
      type: "donut",
      colors: {
          "무료": "#17b4dd",
          "유료": "#038db2",
          "관리": "69bbd1"
        },
      onover: function (d, i) {
        
    },
      onout: function (d, i) {
    }
  },
    donut: {
      title: "0000"
    },
      bindto: "#app_stats"
    });
    
  var chart = bb.generate({
    data: {
      columns: data.circle2,
      type: "donut",
      colors: {
          "무료": "#f6b300",
          "유료": "#e88d00",
          "관리": "#fcca8f"
        },
      onover: function (d, i) {},
      onout: function (d, i) {}
    },
    donut: {
      title: "0000"
    },
      bindto: "#ma_stats"
    }
  );
    
  var chart = bb.generate({
    data: {
      columns: data.bar,
      type: "bar",
      colors: {
          "신규": "#fca1b0",
          "연장": "#f9637c",
          "기타": "#d7215c"
        }
    },
    bar: {
      width: {
        ratio: 0.8
      }
    },
      bindto: "#sale_stats"
    }
  );
}