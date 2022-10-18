$(function () {

    // ==============================================================
    // Campaign
    // ==============================================================
    var p2muysatisfecho = $('#p2muysatisfecho').val();
    var p2satisfecho = $('#p2satisfecho').val();
    var p2indiferente = $('#p2indiferente').val();
    var p2insatisfecho = $('#p2insatisfecho').val();
    var p2nadasatisfecho = $('#p2nadasatisfecho').val();

    var p3muysatisfecho = $('#p3muysatisfecho').val();
    var p3satisfecho = $('#p3satisfecho').val();
    var p3indiferente = $('#p3indiferente').val();
    var p3insatisfecho = $('#p3insatisfecho').val();
    var p3nadasatisfecho = $('#p3nadasatisfecho').val();
    
    var chart1 = c3.generate({
        bindto: '#campaign-v2',
        data: {
            columns: [
                ['Muy Satisfecho', p2muysatisfecho],
                ['Satisfecho', p2satisfecho],
                ['Indiferente', p2indiferente],
                ['Insatisfecho', p2insatisfecho],
                ['Nada Satisfecho', p2nadasatisfecho]
            ],

            type: 'donut',
            tooltip: {
                show: true
            }
        },
        donut: {
            label: {
                show: false
            },
            title: 'S1',
            width: 18
        },

        legend: {
            hide: true
        },
        color: {
            pattern: [
                '#16C00E',
                '#92C00E',
                '#EDD611',
                '#D66E06',
                '#D60F06'
            ]
        }
    });

    var chart2 = c3.generate({
        bindto: '#campaign-v3',
        data: {
            columns: [
                ['Muy Satisfecho', p3muysatisfecho],
                ['Satisfecho', p3satisfecho],
                ['Indiferente', p3indiferente],
                ['Insatisfecho', p3insatisfecho],
                ['Nada Satisfecho', p3nadasatisfecho]
            ],

            type: 'donut',
            tooltip: {
                show: true
            }
        },
        donut: {
            label: {
                show: false
            },
            title: 'S1',
            width: 18
        },

        legend: {
            hide: true
        },
        color: {
            pattern: [
                '#16C00E',
                '#92C00E',
                '#EDD611',
                '#D66E06',
                '#D60F06'
            ]
        }
    });

    d3.select('#campaign-v2 .c3-chart-arcs-title').style('font-family', 'Rubik');

    // ============================================================== 
    // income
    // ============================================================== 
    var data = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        series: [
            [5, 4, 3, 7, 5, 10]
        ]
    };

    var options = {
        axisX: {
            showGrid: false
        },
        seriesBarDistance: 1,
        chartPadding: {
            top: 15,
            right: 15,
            bottom: 5,
            left: 0
        },
        plugins: [
            Chartist.plugins.tooltip()
        ],
        width: '100%'
    };

    var responsiveOptions = [
        ['screen and (max-width: 640px)', {
            seriesBarDistance: 5,
            axisX: {
                labelInterpolationFnc: function (value) {
                    return value[0];
                }
            }
        }]
    ];
    new Chartist.Bar('.net-income', data, options, responsiveOptions);

    // ============================================================== 
    // Visit By Location
    // ==============================================================
    jQuery('#visitbylocate').vectorMap({
        map: 'world_mill_en',
        backgroundColor: 'transparent',
        borderColor: '#000',
        borderOpacity: 0,
        borderWidth: 0,
        zoomOnScroll: false,
        color: '#d5dce5',
        regionStyle: {
            initial: {
                fill: '#d5dce5',
                'stroke-width': 1,
                'stroke': 'rgba(255, 255, 255, 0.5)'
            }
        },
        enableZoom: true,
        hoverColor: '#bdc9d7',
        hoverOpacity: null,
        normalizeFunction: 'linear',
        scaleColors: ['#d5dce5', '#d5dce5'],
        selectedColor: '#bdc9d7',
        selectedRegions: [],
        showTooltip: true,
        onRegionClick: function (element, code, region) {
            var message = 'You clicked "' + region + '" which has the code: ' + code.toUpperCase();
            alert(message);
        }
    });

    // ==============================================================
    // Earning Stastics Chart
    // ==============================================================
    var chart = new Chartist.Line('.stats', {
        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        series: [
            [11, 10, 15, 21, 14, 23, 12]
        ]
    }, {
        low: 0,
        high: 28,
        showArea: true,
        fullWidth: true,
        plugins: [
            Chartist.plugins.tooltip()
        ],
        axisY: {
            onlyInteger: true,
            scaleMinSpace: 40,
            offset: 20,
            labelInterpolationFnc: function (value) {
                return (value / 1) + 'k';
            }
        },
    });

    // Offset x1 a tiny amount so that the straight stroke gets a bounding box
    chart.on('draw', function (ctx) {
        if (ctx.type === 'area') {
            ctx.element.attr({
                x1: ctx.x1 + 0.001
            });
        }
    });

    // Create the gradient definition on created event (always after chart re-render)
    chart.on('created', function (ctx) {
        var defs = ctx.svg.elem('defs');
        defs.elem('linearGradient', {
            id: 'gradient',
            x1: 0,
            y1: 1,
            x2: 0,
            y2: 0
        }).elem('stop', {
            offset: 0,
            'stop-color': 'rgba(255, 255, 255, 1)'
        }).parent().elem('stop', {
            offset: 1,
            'stop-color': 'rgba(80, 153, 255, 1)'
        });
    });

    $(window).on('resize', function () {
        chart.update();
    });
})