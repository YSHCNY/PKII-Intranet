  $(document).ready(function () {

    var projectName = $('#projacro').text();
    var disbursementDebitAmt = [];
    var disbursementDebitYear = [];
    var disbursementDebitMonth = [];
    var disbursementDebitDay = [];
    var disbursementCreditAmt = [];
    var disbursementCreditYear = [];
    var disbursementCreditMonth = [];
    var disbursementCreditDay = [];


    $('.disbursementDebitAmount').each(function(i, obj) {
      disbursementDebitAmt.push($(this).val());
    });
    $('.disbursementDebitYear').each(function(i, obj) {
      disbursementDebitYear.push($(this).val());
    });
    $('.disbursementDebitMonth').each(function(i, obj) {
      disbursementDebitMonth.push(parseInt($(this).val()) - 1);
    });
    $('.disbursementDebitDay').each(function(i, obj) {
      disbursementDebitDay.push($(this).val());
    });

    $('.disbursementCreditAmount').each(function(i, obj) {
      disbursementCreditAmt.push($(this).val());
    });
    $('.disbursementCreditYear').each(function(i, obj) {
      disbursementCreditYear.push($(this).val());
    });
    $('.disbursementCreditMonth').each(function(i, obj) {
      disbursementCreditMonth.push(parseInt($(this).val()) - 1);
    });
    $('.disbursementCreditDay').each(function(i, obj) {
      disbursementCreditDay.push($(this).val());
    });

    var mySeries = [];
    for (var i = 0; i < disbursementDebitAmt.length; i++) {
        mySeries.push([Date.UTC(disbursementDebitYear[i], disbursementDebitMonth[i], disbursementDebitDay[i]), parseInt(disbursementDebitAmt[i])]);
    }

    var mySeriesDisbursementCredit = [];
    for (var i = 0; i < disbursementCreditAmt.length; i++) {
        mySeriesDisbursementCredit.push([Date.UTC(disbursementCreditYear[i], disbursementCreditMonth[i], disbursementCreditDay[i]), parseInt(disbursementCreditAmt[i])]);
    }


    //Journal Chart

    var JournalDebitAmt = [];
    var JournalDebitYear = [];
    var JournalDebitMonth = [];
    var JournalDebitDay = [];
    var JournalCreditAmt = [];
    var JournalCreditYear = [];
    var JournalCreditMonth = [];
    var JournalCreditDay = [];


    $('.JournalDebitAmount').each(function(i, obj) {
      JournalDebitAmt.push($(this).val());
    });
    $('.JournalDebitYear').each(function(i, obj) {
      JournalDebitYear.push($(this).val());
    });
    $('.JournalDebitMonth').each(function(i, obj) {
      JournalDebitMonth.push(parseInt($(this).val()) - 1);
    });
    $('.JournalDebitDay').each(function(i, obj) {
      JournalDebitDay.push($(this).val());
    });

    $('.JournalCreditAmount').each(function(i, obj) {
      JournalCreditAmt.push($(this).val());
    });
    $('.JournalCreditYear').each(function(i, obj) {
      JournalCreditYear.push($(this).val());
    });
    $('.JournalCreditMonth').each(function(i, obj) {
      JournalCreditMonth.push(parseInt($(this).val()) - 1);
    });
    $('.JournalCreditDay').each(function(i, obj) {
      JournalCreditDay.push($(this).val());
    });

    var mySeriesJournalDebit = [];
    for (var i = 0; i < JournalDebitAmt.length; i++) {
        mySeriesJournalDebit.push([Date.UTC(JournalDebitYear[i], JournalDebitMonth[i], JournalDebitDay[i]), parseInt(JournalDebitAmt[i])]);
    }

    var mySeriesJournalCredit = [];
    for (var i = 0; i < JournalCreditAmt.length; i++) {
        mySeriesJournalCredit.push([Date.UTC(JournalCreditYear[i], JournalCreditMonth[i], JournalCreditDay[i]), parseInt(JournalCreditAmt[i])]);
    }


    //CashReceipt Chart

    var CashReceiptDebitAmt = [];
    var CashReceiptDebitYear = [];
    var CashReceiptDebitMonth = [];
    var CashReceiptDebitDay = [];
    var CashReceiptCreditAmt = [];
    var CashReceiptCreditYear = [];
    var CashReceiptCreditMonth = [];
    var CashReceiptCreditDay = [];


    $('.CashReceiptDebitAmount').each(function(i, obj) {
      CashReceiptDebitAmt.push($(this).val());
    });
    $('.CashReceiptDebitYear').each(function(i, obj) {
      CashReceiptDebitYear.push($(this).val());
    });
    $('.CashReceiptDebitMonth').each(function(i, obj) {
      CashReceiptDebitMonth.push(parseInt($(this).val()) - 1);
    });
    $('.CashReceiptDebitDay').each(function(i, obj) {
      CashReceiptDebitDay.push($(this).val());
    });

    $('.CashReceiptCreditAmount').each(function(i, obj) {
      CashReceiptCreditAmt.push($(this).val());
    });
    $('.CashReceiptCreditYear').each(function(i, obj) {
      CashReceiptCreditYear.push($(this).val());
    });
    $('.CashReceiptCreditMonth').each(function(i, obj) {
      CashReceiptCreditMonth.push(parseInt($(this).val()) - 1);
    });
    $('.CashReceiptCreditDay').each(function(i, obj) {
      CashReceiptCreditDay.push($(this).val());
    });

    var mySeriesCashReceiptDebit = [];
    for (var i = 0; i < CashReceiptDebitAmt.length; i++) {
        mySeriesCashReceiptDebit.push([Date.UTC(CashReceiptDebitYear[i], CashReceiptDebitMonth[i], CashReceiptDebitDay[i]), parseInt(CashReceiptDebitAmt[i])]);
    }

    var mySeriesCashReceiptCredit = [];
    for (var i = 0; i < CashReceiptCreditAmt.length; i++) {
        mySeriesCashReceiptCredit.push([Date.UTC(CashReceiptCreditYear[i], CashReceiptCreditMonth[i], CashReceiptCreditDay[i]), parseInt(CashReceiptCreditAmt[i])]);
    }


    initializeChart('graphContainer',projectName,mySeries,mySeriesDisbursementCredit);
    initializeChart('graphContainerJournal',projectName,mySeriesJournalDebit,mySeriesJournalCredit);
    initializeChart('graphContainerCashReceipt',projectName,mySeriesCashReceiptDebit,mySeriesCashReceiptCredit);
    


});


function initializeChart(containerName, projectName, data1, data2){
  var chart = new Highcharts.Chart({
        chart : {
          renderTo : containerName,
          type : 'spline',
          backgroundColor : '#ffffff'
        },
        title : {
          text : 'Transactions'
        },
        subtitle : {
          text : projectName
        },
        xAxis : {
          type : 'datetime',
          dateTimeLabelFormats : { 
            month : '%e. %b, %Y',
            year : '%Y'
          }
        },
        yAxis : {
          title : {
            text : 'Amount'
          },
          min : 0
        },
        tooltip : {
          formatter : function () {
            return '<b>' + this.series.name + '</b><br/>' +
            Highcharts.dateFormat('%e. %b, %Y', this.x) + ': ' + this.y + ' PHP';
          }
        },
        plotOptions : {
          
        },
        
        series : [{
            name : 'Disbursement Debit',
            data : data1
          },{
            name: 'Disbursement Credit',
            data : data2
          }
        ]
  });
}
