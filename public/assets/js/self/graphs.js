const chartData = [
            { date: "2024-04-01", otc: 222, pm: 150 },
            { date: "2024-04-02", otc: 97, pm: 180 },
            { date: "2024-04-03", otc: 167, pm: 120 },
            { date: "2024-04-04", otc: 242, pm: 260 },
            { date: "2024-04-05", otc: 373, pm: 290 },
            { date: "2024-04-06", otc: 301, pm: 340 },
            { date: "2024-04-07", otc: 245, pm: 180 },
            { date: "2024-04-08", otc: 409, pm: 320 },
            { date: "2024-04-09", otc: 59, pm: 110 },
            { date: "2024-04-10", otc: 261, pm: 190 },
            { date: "2024-04-11", otc: 327, pm: 350 },
            { date: "2024-04-12", otc: 292, pm: 210 },
            { date: "2024-04-13", otc: 342, pm: 380 },
            { date: "2024-04-14", otc: 137, pm: 220 },
            { date: "2024-04-15", otc: 120, pm: 170 },
            { date: "2024-04-16", otc: 138, pm: 190 },
            { date: "2024-04-17", otc: 446, pm: 360 },
            { date: "2024-04-18", otc: 364, pm: 410 },
            { date: "2024-04-19", otc: 243, pm: 180 },
            { date: "2024-04-20", otc: 89, pm: 150 },
            { date: "2024-04-21", otc: 137, pm: 200 },
            { date: "2024-04-22", otc: 224, pm: 170 },
            { date: "2024-04-23", otc: 138, pm: 230 },
            { date: "2024-04-24", otc: 387, pm: 290 },
            { date: "2024-04-25", otc: 215, pm: 250 },
            { date: "2024-04-26", otc: 75, pm: 130 },
            { date: "2024-04-27", otc: 383, pm: 420 },
            { date: "2024-04-28", otc: 122, pm: 180 },
            { date: "2024-04-29", otc: 315, pm: 240 },
            { date: "2024-04-30", otc: 454, pm: 380 },
            { date: "2024-05-01", otc: 165, pm: 220 },
            { date: "2024-05-02", otc: 293, pm: 310 },
            { date: "2024-05-03", otc: 247, pm: 190 },
            { date: "2024-05-04", otc: 385, pm: 420 },
            { date: "2024-05-05", otc: 481, pm: 390 },
            { date: "2024-05-06", otc: 498, pm: 520 },
            { date: "2024-05-07", otc: 388, pm: 300 },
            { date: "2024-05-08", otc: 149, pm: 210 },
            { date: "2024-05-09", otc: 227, pm: 180 },
            { date: "2024-05-10", otc: 293, pm: 330 },
            { date: "2024-05-11", otc: 335, pm: 270 },
            { date: "2024-05-12", otc: 197, pm: 240 },
            { date: "2024-05-13", otc: 197, pm: 160 },
            { date: "2024-05-14", otc: 448, pm: 490 },
            { date: "2024-05-15", otc: 473, pm: 380 },
            { date: "2024-05-16", otc: 338, pm: 400 },
            { date: "2024-05-17", otc: 499, pm: 420 },
            { date: "2024-05-18", otc: 315, pm: 350 },
            { date: "2024-05-19", otc: 235, pm: 180 },
            { date: "2024-05-20", otc: 177, pm: 230 },
            { date: "2024-05-21", otc: 82, pm: 140 },
            { date: "2024-05-22", otc: 81, pm: 120 },
            { date: "2024-05-23", otc: 252, pm: 290 },
            { date: "2024-05-24", otc: 294, pm: 220 },
            { date: "2024-05-25", otc: 201, pm: 250 },
            { date: "2024-05-26", otc: 213, pm: 170 },
            { date: "2024-05-27", otc: 420, pm: 460 },
            { date: "2024-05-28", otc: 233, pm: 190 },
            { date: "2024-05-29", otc: 78, pm: 130 },
            { date: "2024-05-30", otc: 340, pm: 280 },
            { date: "2024-05-31", otc: 178, pm: 230 },
            { date: "2024-06-01", otc: 178, pm: 200 },
            { date: "2024-06-02", otc: 470, pm: 410 },
            { date: "2024-06-03", otc: 103, pm: 160 },
            { date: "2024-06-04", otc: 439, pm: 380 },
            { date: "2024-06-05", otc: 88, pm: 140 },
            { date: "2024-06-06", otc: 294, pm: 250 },
            { date: "2024-06-07", otc: 323, pm: 370 },
            { date: "2024-06-08", otc: 385, pm: 320 },
            { date: "2024-06-09", otc: 438, pm: 480 },
            { date: "2024-06-10", otc: 155, pm: 200 },
            { date: "2024-06-11", otc: 92, pm: 150 },
            { date: "2024-06-12", otc: 492, pm: 420 },
            { date: "2024-06-13", otc: 81, pm: 130 },
            { date: "2024-06-14", otc: 426, pm: 380 },
            { date: "2024-06-15", otc: 307, pm: 350 },
            { date: "2024-06-16", otc: 371, pm: 310 },
            { date: "2024-06-17", otc: 475, pm: 520 },
            { date: "2024-06-18", otc: 107, pm: 170 },
            { date: "2024-06-19", otc: 341, pm: 290 },
            { date: "2024-06-20", otc: 408, pm: 450 },
            { date: "2024-06-21", otc: 169, pm: 210 },
            { date: "2024-06-22", otc: 317, pm: 270 },
            { date: "2024-06-23", otc: 480, pm: 530 },
            { date: "2024-06-24", otc: 132, pm: 180 },
            { date: "2024-06-25", otc: 141, pm: 190 },
            { date: "2024-06-26", otc: 434, pm: 380 },
            { date: "2024-06-27", otc: 448, pm: 490 },
            { date: "2024-06-28", otc: 149, pm: 200 },
            { date: "2024-06-29", otc: 103, pm: 160 },
            { date: "2024-06-30", otc: 446, pm: 400 }
        ];

        let lineChart;
        let activeChart = 'otc';
        const totals = {
            otc: 0,
            pm: 0
        };

        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString("en-US", {
                month: "short",
                day: "numeric"
            });
        }

        function calculateTotals() {
            totals.otc = chartData.reduce((acc, curr) => acc + curr.otc, 0);
            totals.pm = chartData.reduce((acc, curr) => acc + curr.pm, 0);
            updateTotalDisplay();
            updatePieStats();
        }

        function updateTotalDisplay() {
            $('#total-value').text(totals[activeChart].toLocaleString());
        }

        function updatePieStats() {
            const grandTotal = totals.otc + totals.pm;
            const otcPercentage = ((totals.otc / grandTotal) * 100).toFixed(1);
            const pmPercentage = ((totals.pm / grandTotal) * 100).toFixed(1);
            
            $('#otc-pie-value').text(totals.otc.toLocaleString());
            $('#pm-pie-value').text(totals.pm.toLocaleString());
            $('#otc-pie-percentage').text(otcPercentage + '% of total');
            $('#pm-pie-percentage').text(pmPercentage + '% of total');
        }

        function createLineChart(type) {
            const ctx = document.getElementById('lineChart').getContext('2d');
            
            if (lineChart) {
                lineChart.destroy();
            }

            const color = type === 'otc' ? '#3b82f6' : '#f59e0b';
            
            lineChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: chartData.map(item => formatDate(item.date)),
                    datasets: [{
                        label: type.charAt(0).toUpperCase() + type.slice(1),
                        data: chartData.map(item => item[type]),
                        borderColor: color,
                        backgroundColor: 'transparent',
                        borderWidth: 2,
                        tension: 0.4,
                        pointRadius: 0,
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: color,
                        pointHoverBorderColor: '#fff',
                        pointHoverBorderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            titleFont: {
                                size: 13
                            },
                            bodyFont: {
                                size: 12
                            },
                            callbacks: {
                                title: function(context) {
                                    const index = context[0].dataIndex;
                                    const date = new Date(chartData[index].date);
                                    return date.toLocaleDateString("en-US", {
                                        month: "short",
                                        day: "numeric",
                                        year: "numeric"
                                    });
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                maxTicksLimit: 8,
                                font: {
                                    size: 11
                                }
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            },
                            ticks: {
                                font: {
                                    size: 11
                                }
                            }
                        }
                    }
                }
            });
        }

        function createPieChart() {
            const ctx = document.getElementById('pieChart').getContext('2d');
            
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['otc', 'pm'],
                    datasets: [{
                        data: [totals.otc, totals.pm],
                        backgroundColor: [
                            '#3b82f6',
                            '#f59e0b'
                        ],
                        borderColor: '#ffffff',
                        borderWidth: 3,
                        hoverOffset: 10
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom',
                            labels: {
                                padding: 15,
                                font: {
                                    size: 12,
                                    weight: '500'
                                },
                                usePointStyle: true,
                                pointStyle: 'circle'
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            titleFont: {
                                size: 13,
                                weight: '600'
                            },
                            bodyFont: {
                                size: 12
                            },
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.parsed || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = ((value / total) * 100).toFixed(1);
                                    return label + ': ' + value.toLocaleString() + ' (' + percentage + '%)';
                                }
                            }
                        }
                    },
                    cutout: '65%',
                    animation: {
                        animateRotate: true,
                        animateScale: true
                    }
                }
            });
        }

        $(document).ready(function() {
            calculateTotals();
            createLineChart('otc');
            createPieChart();
            
            $('#chartType').on('change', function() {
                const chartType = $(this).val();
                activeChart = chartType;
                updateTotalDisplay();
                createLineChart(chartType);
            });
        });