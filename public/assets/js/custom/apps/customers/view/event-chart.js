
"use strict";

// Class definition
var KTChartsEvents = function () {
    // Private methods
    var initChart = function(tabSelector, chartSelector, data, initByDefault) {

        var element = document.querySelector(chartSelector);        

        if (!element) {
            return;
        }  
          
        var height = parseInt(KTUtil.css(element, 'height'));
        
        var options = {
            series: data,                 
            chart: {           
                fontFamily: 'inherit', 
                type: 'donut',
                width: 450,
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '50%',
                        labels: {
                            value: {
                                fontSize: '10px'
                            }
                        }                        
                    }
                }
            },
            colors: [
                KTUtil.getCssVariableValue('--bs-info'), 
                KTUtil.getCssVariableValue('--bs-success'), 
                KTUtil.getCssVariableValue('--bs-primary'), 
                KTUtil.getCssVariableValue('--bs-danger') 
            ],           
            stroke: {
              width: 0
            },
            labels: ['Short Term', 'Mid Term', 'Long Term', 'Legacy'],
            legend: {
                show: false,
            },
            fill: {
                type: 'false',          
            }     
        };                     

        var chart = new ApexCharts(element, options);

        var init = false;

        var tab = document.querySelector(tabSelector);
        
        if (initByDefault === true) {
            chart.render();
            init = true;
        }        

        tab.addEventListener('shown.bs.tab', function (event) {
            if (init == false) {
                chart.render();
                init = true;
            }
        })
    }

    // Public methods
    return {
        init: function () {
            var eventsChartData = JSON.parse($(".events_chart_data").val());

            var sta = (eventsChartData.short_term_allocation != '') ? eventsChartData.short_term_allocation : 0;
            var mta = (eventsChartData.mid_term_allocation != '') ? eventsChartData.mid_term_allocation : 0;
            var lta = (eventsChartData.long_term_allocation != '') ? eventsChartData.long_term_allocation : 0;
            var lagacy = (eventsChartData.lagacy_allocation != '') ? eventsChartData.lagacy_allocation : 0;

            var eventsChart = [];            

            eventsChart.push(parseFloat(sta).toFixed(2));
            eventsChart.push(parseFloat(mta).toFixed(2));
            eventsChart.push(parseFloat(lta).toFixed(2));
            eventsChart.push(parseFloat(lagacy).toFixed(2));
            
            var arrayOfNumbers = eventsChart.map(parseFloat);

            initChart('#kt_table_clients_events', '#kt_chart_events', arrayOfNumbers, true);
        }   
    }
}();

// Webpack support
if (typeof module !== 'undefined') {
    module.exports = KTChartsEvents;
}

// On document ready
KTUtil.onDOMContentLoaded(function() {
    KTChartsEvents.init();
});