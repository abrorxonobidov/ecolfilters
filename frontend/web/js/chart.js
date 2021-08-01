// Build the chart
Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: '<i>Qabul qilingan</i> buyurtmalar'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.y}</b>'
    },
    accessibility: {
        point: {
            valueSuffix: ''
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        innerSize: '80%',
        data: [{
            name: 'test 1',
            color: 'rgba(0, 160, 227, 0.39)',
            y: 61,
            sliced: false,
            selected: false
        }, {
            name: 'test 2',
            color: 'rgba(0, 152, 70, 0.39)',
            y: 35
        }, {
            name: 'test 3',
            color: 'rgba(57, 49, 133, 0.39)',
            y: 40
        }, {
            name: 'test 4',
            color: 'rgba(239, 127, 26, 0.39)',
            y: 24
        }]
    }]
});

// Build the chart
Highcharts.chart('container2', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: '<i>Bajarilgan</i> buyurtmalar'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.y}</b>'
    },
    accessibility: {
        point: {
            valueSuffix: ''
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        innerSize: '80%',
        data: [{
            name: 'test 1',
            color: 'rgba(0, 160, 227, 0.39)',
            y: 61,
            sliced: false,
            selected: false
        }, {
            name: 'test 2',
            color: 'rgba(0, 152, 70, 0.39)',
            y: 35
        }, {
            name: 'test 3',
            color: 'rgba(57, 49, 133, 0.39)',
            y: 40
        }, {
            name: 'test 4',
            color: 'rgba(239, 127, 26, 0.39)',
            y: 24
        }]
    }]
});

// Build the chart
Highcharts.chart('container3', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Eng xaridorgir mahsulotlar'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.y}</b>'
    },
    accessibility: {
        point: {
            valueSuffix: ''
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },
    series: [{
        name: '',
        colorByPoint: true,
        innerSize: '60%',
        data: [{
            name: 'Mahsulot 1',
            color: 'rgba(0, 160, 227, 0.39)',
            y: 61,
            sliced: false,
            selected: false
        }, {
            name: 'Mahsulot 2',
            color: 'rgba(239, 127, 26, 0.5)',
            y: 57
        }, {
            name: 'Mahsulot 3',
            color: 'rgba(0, 141, 110, 0.5)',
            y: 10
        }, {
            name: 'Mahsulot 4',
            color: 'rgba(182, 206, 201, 0.5)',
            y: 15
        }, {
            name: 'Mahsulot 5',
            color: 'rgba(150, 213, 179, 0.5)',
            y: 24
        }, {
            name: 'Mahsulot 6',
            color: 'rgba(243, 162, 165, 0.5)',
            y: 33
        }, {
            name: 'Mahsulot 7',
            color: 'rgba(244, 154, 202, 0.5)',
            y: 15
        }, {
            name: 'Mahsulot 8',
            color: 'rgba(188, 218, 211)',
            y: 24
        }]
    }]
});