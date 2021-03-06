
$.request('onGetAppChartData', {
  success: function(data) {
    showAppChart(data);
  }
});

$.request('onGetMaChartData', {
  success: function(data) {
    showMaChart(data);
  }
});

$.request('onGetSalesChartData', {
  success: function(data) {
    showSalesChart(data);
  }
});


// 전체 일자별
function showEntireChart(date1, date2) {
  $.request('onGetEntireChartData', {
      success: function(data) {
        var chart = bb.generate({
        data: {
            columns: data.circle1,
            type: "donut",
            colors: {
              "무료": "#17b4dd",
              "유료": "#038db2",
              "관리": "#69bbd1"
            },
            onover: function(d) {
              //console.log("onover", d)
            }
        },
        tooltip: {
          format: {
            value: function(value) {
              return value;
            }
          }
        },
        donut: {
          title: "앱 통계",
          label: {
            format: function(value, ratio, id) {
              return value + "개\n" + (ratio * 100).toFixed(1) + "%";
            }
          }
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
      onover: function(d) {
        //console.log("onover", d)
      }
    },
    donut: {
      title: "MA 통계",
      label: {
        format: function(value, ratio, id) {
          return value + "개 \n" + (ratio * 100).toFixed(1) + "%";
        }
      }
    },
    bindto: "#ma_stats"
    });

    var chart = bb.generate({
      title: {
        text: "매출 통계"
      },
      data: {
          columns: data.bar,
          type: "bar",
          colors: {
            "전체": "#97215c",
            "신규": "#fca1b0",
            "연장": "#f9637c",
            "기타": "#d7215c"
          },
          labels: {
            centered: true,
            format: function(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
          }
      },
      bar: {
          width: {
            ratio: 0.8
          }
      },
      tooltip: {
        format: {
          title: function(d) {
             //console.log(d);
    		      return 'Data ' + d;
            },
          }
        },
      bindto: "#sale_stats"
      });
   }
 });
}


// 앱 일간
function app_stats_daily() {
  $.request('onGetAppDailyChartData', {
    success: function(data) {
      showAppChart(data);
    }
  });
}

// 앱 전체
function app_stats_total() {
  $.request('onGetAppChartData', {
    success: function(data) {
      showAppChart(data);
    }
  });
}

// MA 일간
function ma_stats_daily() {
  $.request('onGetMaDailyChartData', {
    success: function(data) {
      showMaChart(data);
    }
  });
}

// MA 전체
function ma_stats_total() {
  $.request('onGetMaChartData', {
    success: function(data) {
      showMaChart(data);
    }
  });
}

// 매출 일간
function sales_stats_daily() {
  $.request('onGetSalesDailyChartData', {
    success: function(data) {
      showSalesChart(data);
    }
  });
}

// 매출 전체
function sales_stats_total() {
  $.request('onGetSalesChartData', {
    success: function(data) {
      showSalesChart(data);
    }
  });
}

function showAppChart (data) {
    var chart = bb.generate({
    data: {
        columns: data.circle1,
        type: "donut",
        colors: {
          "무료": "#17b4dd",
          "유료": "#038db2",
          "관리": "#69bbd1"
        },
        onover: function(d) {
          //console.log("onover", d)
        }
    },
    tooltip: {
      format: {
        value: function(value) {
          return value;
        }
      }
    },
    donut: {
      title: "앱 통계",
      label: {
        format: function(value, ratio, id) {
          return value + "개\n" + (ratio * 100).toFixed(1) + "%";
        }
      }
    },
    bindto: "#app_stats"
  });
}

function showMaChart (data) {
  var chart = bb.generate({
    data: {
      columns: data.circle2,
      type: "donut",
      colors: {
          "무료": "#f6b300",
          "유료": "#e88d00",
          "관리": "#fcca8f"
      },
      onover: function(d) {
        //console.log("onover", d)
      }
    },
    donut: {
      title: "MA 통계",
      label: {
        format: function(value, ratio, id) {
          return value + "개 \n" + (ratio * 100).toFixed(1) + "%";
        }
      }
    },
    bindto: "#ma_stats"
    });
}

function showSalesChart (data) {
  var chart = bb.generate({
    title: {
      text: "매출 통계"
    },
    data: {
        columns: data.bar,
        type: "bar",
        colors: {
          "전체": "#97215c",
          "신규": "#fca1b0",
          "연장": "#f9637c",
          "기타": "#d7215c"
        },
        labels: {
          centered: true,
          format: function(x) {
              return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
          }
        }
    },
    bar: {
        width: {
          ratio: 0.8
        }
    },
    tooltip: {
      format: {
        title: function(d) {
           console.log(d);
  		      return 'Data ' + d;
          },
        }
      },
    bindto: "#sale_stats"
    });
}
