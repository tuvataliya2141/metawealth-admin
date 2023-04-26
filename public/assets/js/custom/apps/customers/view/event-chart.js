
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
            var eventsChart = [];            

            eventsChart.push(parseFloat(eventsChartData.short_term_allocation).toFixed(2));
            eventsChart.push(parseFloat(eventsChartData.mid_term_allocation).toFixed(2));
            eventsChart.push(parseFloat(eventsChartData.long_term_allocation).toFixed(2));
            eventsChart.push(parseFloat(eventsChartData.lagacy_allocation).toFixed(2));
            
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