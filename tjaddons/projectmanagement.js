$(function () {
  var chart;
  $(document).ready(function () {

  	var projectName = $('#projacro').text();
    chart = new Highcharts.Chart({
        chart : {
          renderTo : 'graphContainer',
          type : 'spline',
          backgroundColor : '#ffffff'
        },
        title : {
          text : 'Invoices'
        },
        subtitle : {
          text : projectName
        },
        xAxis : {
          type : 'datetime',
          dateTimeLabelFormats : { // don't display the dummy year
            month : '%e. %b',
            year : '%b'
          }
        },
        yAxis : {
          title : {
            text : 'Payments Received'
          },
          min : 0
        },
        tooltip : {
          formatter : function () {
            return '<b>' + this.series.name + '</b><br/>' +
            Highcharts.dateFormat('%e. %b', this.x) + ': ' + this.y + ' PHP';
          }
        },
        plotOptions : {
          area : {
            lineWidth : 1,
            marker : {
              enabled : false,
              states : {
                hover : {
                  enabled : true,
                  radius : 5
                }
              }
            },
            shadow : false,
            states : {
              hover : {
                lineWidth : 1
              }
            }
          }
        },
        
        series : [{
            name : 'PHP',
            data : [
              [Date.UTC(1970, 9, 27), 19000],
              [Date.UTC(1970, 10, 10), 21123],
              [Date.UTC(1970, 10, 18), 43123],
              [Date.UTC(1970, 11, 2), 12346],
              [Date.UTC(1970, 11, 9), 12312],
              [Date.UTC(1970, 11, 16), 41245],
              [Date.UTC(1970, 11, 28), 12341],
              [Date.UTC(1971, 0, 1), 51324],
              [Date.UTC(1971, 0, 8), 61234],
              [Date.UTC(1971, 0, 12), 81234],
              [Date.UTC(1971, 0, 27), 12341],
              [Date.UTC(1971, 1, 10), 12345],
              [Date.UTC(1971, 1, 18), 43215],
              [Date.UTC(1971, 1, 24), 11492],
              [Date.UTC(1971, 2, 4), 21249],
              [Date.UTC(1971, 2, 11), 23479],
              [Date.UTC(1971, 2, 15), 29173],
            ]
          }
        ]
      });
  });



  $('#btnSubmit').on('click',function(){
      var messageDivHtml = $('#messageDiv').html();
      var newMessageDivHtml = '<div class="messageItem">';
      newMessageDivHtml += '<div class="messageFirstRow">';
      newMessageDivHtml += '<div class="col-md-8">';
      newMessageDivHtml += '<h6>Brian Fuertes</h6>';
      newMessageDivHtml += '</div>';
      newMessageDivHtml += '<div class="col-md-4">';
      newMessageDivHtml += '<span>Just Now</span>';
      newMessageDivHtml += '</div>';
      newMessageDivHtml += '</div>';
      newMessageDivHtml += '<div class="messageSecondRow">';
      newMessageDivHtml += '<div class="col-md-12">';
      newMessageDivHtml += '<p>'+$('#commentTextArea').val()+'</p>';
      newMessageDivHtml += '</div>';
      newMessageDivHtml += '<div style="clear:both;"></div>';
      newMessageDivHtml += '</div>';
      newMessageDivHtml += '</div>';
      
      $('#messageDiv').html(newMessageDivHtml + messageDivHtml);
      $('#commentTextArea').val('');





  });
});
