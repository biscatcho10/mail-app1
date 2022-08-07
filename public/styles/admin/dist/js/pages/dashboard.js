/*
 * Author: Abdullah A Almsaeed
 * Date: 4 Jan 2014
 * Description:
 *      This is a demo file used only for the main dashboard (index.html)
 **/

/* global moment:false, Chart:false, Sparkline:false */

$(function () {
    'use strict'

    // Make the dashboard widgets sortable Using jquery UI
    $('.connectedSortable').sortable({
        placeholder: 'sort-highlight',
        connectWith: '.connectedSortable',
        handle: '.card-header, .nav-tabs',
        forcePlaceholderSize: true,
        zIndex: 999999
    })
    $('.connectedSortable .card-header').css('cursor', 'move')

    // jQuery UI sortable for the todo list
    $('.todo-list').sortable({
        placeholder: 'sort-highlight',
        handle: '.handle',
        forcePlaceholderSize: true,
        zIndex: 999999
    })

    // bootstrap WYSIHTML5 - text editor
    $('.textarea').summernote()

    if ($('.daterange').length)
        $('.daterange').daterangepicker({
            ranges: {
                Today: [moment(), moment()],
                Yesterday: [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            startDate: moment().subtract(29, 'days'),
            endDate: moment()
        }, function (start, end) {
            // eslint-disable-next-line no-alert
            alert('You chose: ' + start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        })

    /* jQueryKnob */
    $('.knob').knob()


    // jvectormap data
    var visitorsData = {
        US: 398, // USA
        SA: 400, // Saudi Arabia
        CA: 1000, // Canada
        DE: 500, // Germany
        FR: 760, // France
        CN: 300, // China
        AU: 700, // Australia
        BR: 600, // Brazil
        IN: 800, // India
        GB: 320, // Great Britain
        RU: 3000 // Russia
    }

    $.ajax({
        url: $("#urltovisitors").data("target"),
        type: "GET",
        async: false,
        dataType: 'json',
        success: function (data) {
            // visitorsData = data
        },
    });

    // World map by jvectormap
    if ($('#world-map').length)
        $('#world-map').vectorMap({
            map: 'world_en',
            backgroundColor: "transparent",
            regionStyle: {
                initial: {
                    fill: "#e4e4e4",
                    "fill-opacity": 1,
                    stroke: "none",
                    "stroke-width": 0,
                    "stroke-opacity": 1,
                },
            },

            series: {
                regions: [{
                    values: visitorsData,
                    scale: ["#92c1dc", "#ebf4f9"],
                    normalizeFunction: "polynomial",
                },],
            },

            onRegionLabelShow: function (e, el, code) {
                if (typeof visitorsData[code] != "undefined")
                    el.html(el.html() + ": " + visitorsData[code] + " new visitors");
            },
        })

    if ($('#pieChart').length) {
        var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
        var donutData = {
            labels: [
                'Chrome',
                'IE',
                'FireFox',
                'Safari',
                'Opera',
                'Navigator',
            ],
            datasets: [
                {
                    data: [10, 10, 10, 10, 10, 10],
                    backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                }
            ]
        }
        $.ajax({
            url: $("#browserusage").data("target"),
            type: "GET",
            dataType: 'json',
            async: false,
            success: function (data) {
                var countries = data[0].countries.original
                data = data[1].countriesCode
                for (const [key, value] of Object.entries(data)) {
                    var be = false;
                    for (var [k, v] of Object.entries(donutData.labels)) {
                        if (v == key) {
                            donutData.datasets[0].data[k] = value + 10;
                            be = true;
                        }
                    }
                    if (be == false) {
                        donutData.datasets[0].data[5] += value;
                    }
                }
            },
        });


        var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        new Chart(pieChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
        });
    }

    $('#calendar').datetimepicker({
        format: 'L',
        inline: true
    })

    $('#chat-box').overlayScrollbars({
        height: '250px'
    })
    var salesChartCanvas = document.getElementById('revenue-chart-canvas')

    if (salesChartCanvas != null) {
        salesChartCanvas = salesChartCanvas.getContext('2d')
        var salesChartData = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [
                {
                    label: 'Digital Goods',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: [28, 48, 40, 19, 86, 27, 90]
                },
                {
                    label: 'Electronics',
                    backgroundColor: 'rgba(210, 214, 222, 1)',
                    borderColor: 'rgba(210, 214, 222, 1)',
                    pointRadius: false,
                    pointColor: 'rgba(210, 214, 222, 1)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data: [65, 59, 80, 81, 56, 55, 40]
                }
            ]
        }

        var salesChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display: false
                    }
                }]
            }
        }

        var salesChart = new Chart(salesChartCanvas, { // lgtm[js/unused-local-variable]
            type: 'line',
            data: salesChartData,
            options: salesChartOptions
        })
    }

    // Donut Chart
    if ($('#sales-chart-canvas').length) {
        var pieChartCanvas = $('#sales-chart-canvas').get(0).getContext('2d')
        var pieData = {
            labels: [
                'Instore Sales',
                'Download Sales',
                'Mail-Order Sales'
            ],
            datasets: [
                {
                    data: [30, 12, 20],
                    backgroundColor: ['#f56954', '#00a65a', '#f39c12']
                }
            ]
        }
        var pieOptions = {
            legend: {
                display: false
            },
            maintainAspectRatio: false,
            responsive: true
        }
        // Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        // eslint-disable-next-line no-unused-vars
        var pieChart = new Chart(pieChartCanvas, { // lgtm[js/unused-local-variable]
            type: 'doughnut',
            data: pieData,
            options: pieOptions
        })
    }

    // Sales graph chart
    // var salesGraphChartCanvas = $('#line-chart').get(0).getContext('2d')
    // // $('#revenue-chart').get(0).getContext('2d');
    //
    // var salesGraphChartData = {
    //     labels: ['2011 Q1', '2011 Q2', '2011 Q3', '2011 Q4', '2012 Q1', '2012 Q2', '2012 Q3', '2012 Q4', '2013 Q1', '2013 Q2'],
    //     datasets: [
    //         {
    //             label: 'Digital Goods',
    //             fill: false,
    //             borderWidth: 2,
    //             lineTension: 0,
    //             spanGaps: true,
    //             borderColor: '#efefef',
    //             pointRadius: 3,
    //             pointHoverRadius: 7,
    //             pointColor: '#efefef',
    //             pointBackgroundColor: '#efefef',
    //             data: [2666, 2778, 4912, 3767, 6810, 5670, 4820, 15073, 10687, 8432]
    //         }
    //     ]
    // }
    //
    // var salesGraphChartOptions = {
    //     maintainAspectRatio: false,
    //     responsive: true,
    //     legend: {
    //         display: false
    //     },
    //     scales: {
    //         xAxes: [{
    //             ticks: {
    //                 fontColor: '#efefef'
    //             },
    //             gridLines: {
    //                 display: false,
    //                 color: '#efefef',
    //                 drawBorder: false
    //             }
    //         }],
    //         yAxes: [{
    //             ticks: {
    //                 stepSize: 5000,
    //                 fontColor: '#efefef'
    //             },
    //             gridLines: {
    //                 display: true,
    //                 color: '#efefef',
    //                 drawBorder: false
    //             }
    //         }]
    //     }
    // }
    //
    // // This will get the first returned node in the jQuery collection.
    // // eslint-disable-next-line no-unused-vars
    // var salesGraphChart = new Chart(salesGraphChartCanvas, { // lgtm[js/unused-local-variable]
    //     type: 'line',
    //     data: salesGraphChartData,
    //     options: salesGraphChartOptions
    // })


    $.fn.datetimepicker.Constructor.Default = $.extend({},
        $.fn.datetimepicker.Constructor.Default,
        { icons:
                { time: 'fas fa-clock',
                    date: 'fas fa-calendar',
                    up: 'fas fa-arrow-up',
                    down: 'fas fa-arrow-down',
                    previous: 'fas fa-arrow-circle-left',
                    next: 'fas fa-arrow-circle-right',
                    today: 'far fa-calendar-check-o',
                    clear: 'fas fa-trash',
                    close: 'far fa-times' } });

        $('#reservationdate').datetimepicker({
            format: 'L'
        });
        //Date and time picker
        $('#reservationdatetime').datetimepicker({icons: {time: 'fa fa-clock'}});

        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            locale: {
                format: 'YYYY/DD/MM hh:mm A'
            }
        })

})
