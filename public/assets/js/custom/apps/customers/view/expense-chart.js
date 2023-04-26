"use strict";
// Class definition
var KTChartsExpense = function () {
    var chart = {
        self: null,
        rendered: false
    };

    // Private methods
    var initChart = function(chart) {
        var element = document.getElementById("kt_charts_events");
        var ExpenseChartData = JSON.parse($('.expense_chart_data').val());

        var chartXaxis = [];
        var chartYaxis = [];
        ExpenseChartData.event_line_data.forEach(function(item){
            chartXaxis.push(item.x);
            chartYaxis.push(parseInt(item.y));
        });
        var maxIncome = Math.max(...chartYaxis);
        var minIncome = Math.min(...chartYaxis);

        if (maxIncome == minIncome) {
            minIncome = 0;
        }

        const YtickAmount = Math.ceil((maxIncome - minIncome) / 200000);
        const XcategoriesCount = chartXaxis.length;
        const XtickAmount = Math.ceil(XcategoriesCount / 12);

        if (!element) {
            return;
        }
        
        var height = parseInt(KTUtil.css(element, 'height'));
        var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
        var borderColor = KTUtil.getCssVariableValue('--bs-border-dashed-color');
        var baseprimaryColor = KTUtil.getCssVariableValue('--bs-primary');
        var lightprimaryColor = KTUtil.getCssVariableValue('--bs-primary');
        var basesuccessColor = KTUtil.getCssVariableValue('--bs-success');
        var lightsuccessColor = KTUtil.getCssVariableValue('--bs-success');

        var options = {
            series: [{
                name: 'Total Income',
                data: chartYaxis
            }],
            chart: {
                fontFamily: 'inherit',
                type: 'area',
                height: height,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {

            },
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.4,
                    opacityTo: 0.2,
                    stops: [15, 120, 100]
                }
            },
            stroke: {
                curve: 'smooth',
                show: true,
                width: 3,
                colors: [baseprimaryColor, basesuccessColor]
            },
            xaxis: {
                categories:  ['0', ...chartXaxis],
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false
                },
                tickAmount: XtickAmount,
                labels: {
                    rotate: 0,
                    rotateAlways: true,
                    style: {
                        colors: labelColor,
                        fontSize: '12px'
                    }
                },
                crosshairs: {
                    position: 'front',
                    stroke: {
                        color: [baseprimaryColor, basesuccessColor],
                        width: 1,
                        dashArray: 3
                    }
                },
                tooltip: {
                    enabled: true,
                    formatter: undefined,
                    offsetY: 0,
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            yaxis: {
                max: maxIncome,
                min: minIncome,
                tickAmount: YtickAmount,
                labels: {
                    style: {
                        colors: labelColor,
                        fontSize: '12px'
                    } 
                }
            },
            states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: false,
                    filter: {
                        type: 'none',
                        value: 0
                    }
                }
            },
            tooltip: {
                style: {
                    fontSize: '12px'
                } 
            },
            colors: [lightprimaryColor, lightsuccessColor],
            grid: {
                borderColor: borderColor,
                strokeDashArray: 4,
                yaxis: {
                    lines: {
                        show: true
                    }
                }
            },
            markers: {
                strokeColor: [baseprimaryColor, basesuccessColor],
                strokeWidth: 3
            }
        };

        chart.self = new ApexCharts(element, options);

        // Set timeout to properly get the parent elements width
        setTimeout(function() {
            chart.self.render();
            chart.rendered = true;
        }, 200);      
    }

    // Public methods
    return {
        init: function () {
            initChart(chart);

            // Update chart on theme mode change
            KTThemeMode.on("kt.thememode.change", function() {                
                if (chart.rendered) {
                    chart.self.destroy();
                }

                initChart(chart);
            });
        }   
    }
}();


// On document ready
KTUtil.onDOMContentLoaded(function() {
    KTChartsExpense.init();
});
