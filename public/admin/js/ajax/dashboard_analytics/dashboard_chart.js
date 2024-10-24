// get yearly examinees using ajax
$.ajax({
    url: '/api/yearly-examinees',
    method: 'GET',
    success: function (examineesData) {
        const ctx = document.getElementById('yearlyExaminees').getContext('2d');
        const years = examineesData.map(e => e.year);
        const counts = examineesData.map(e => e.examinee_count);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: years,
                datasets: [{
                    label: '# of Examinees',
                    data: counts,
                    backgroundColor: '#461111',
                    borderColor: '#461111',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    }
                }
            }
        });
    },
    error: function (xhr, status, error) {
        console.error('AJAX Error: ' + status + error);
    }
});

function getRandomColor() {
    const letters = '0123456789ABCDEF';
    let color = '#';
    for (let i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

// GENDER CHART
document.addEventListener('DOMContentLoaded', function () {
    const yearSelect = document.getElementById('year-select-gender');
    function fetchAndRenderChart(year) {
        fetch(`/admin/examiners/data-gender?year=${year}`)
            .then(response => response.json())
            .then(data => {
                const labels = data.map(item => item.gender);
                const counts = data.map(item => item.count);

                const maleCount = counts[labels.indexOf("Male")] || 0;
                const femaleCount = counts[labels.indexOf("Female")] || 0;

                const ctx = document.getElementById('gender-chart').getContext('2d');

                if (window.genderChart) {
                    window.genderChart.destroy();
                }

                window.genderChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Female', 'Male'],
                        datasets: [{
                            label: 'Total',
                            data: [femaleCount, maleCount],
                            backgroundColor: ['rgba(255, 105, 180, 0.2)', 'rgba(75, 192, 192, 0.2)'],
                            borderColor: ['rgba(255, 105, 180, 1)', 'rgba(75, 192, 192, 1)'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
    }

    fetchAndRenderChart(yearSelect.value);

    yearSelect.addEventListener('change', function () {
        fetchAndRenderChart(this.value);
    });
});

// COURSE CHART
fetch('/admin/courses/offered')
    .then(response => response.json())
    .then(data => {
        const courseLabels = Object.keys(data.offered_courses);
        const courseCounts = Object.values(data.offered_courses);
        const backgroundColors = courseLabels.map(() => getRandomColor());
        const borderColors = courseLabels.map(() => getRandomColor());

        const ctx = document.getElementById('course-chart').getContext('2d');

        const courseChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: courseLabels,
                datasets: [{
                    label: 'Offered Courses',
                    data: courseCounts,
                    backgroundColor: backgroundColors,
                    borderColor: borderColors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function (tooltipItem) {
                                return tooltipItem.label || '';
                            }
                        }
                    }
                }
            }
        });
    })
    .catch(error => {
        console.error('Error fetching course data:', error);
    });

// PREFERRED COURSE
fetch('/admin/preferred-courses/counts')
    .then(response => response.json())
    .then(data => {
        const courseLabels = Object.keys(data);
        const courseCounts = Object.values(data);
        const colors = [
            'rgba(255, 99, 132, 0.5)',
            'rgba(54, 162, 235, 0.5)',
            'rgba(255, 206, 86, 0.5)',
            'rgba(75, 192, 192, 0.5)',
            'rgba(153, 102, 255, 0.5)',
            'rgba(255, 159, 64, 0.5)',
            'rgba(255, 99, 71, 0.5)',
            'rgba(60, 179, 113, 0.5)',
            'rgba(255, 20, 147, 0.5)',
            'rgba(255, 165, 0, 0.5)'
        ];

        const datasetColors = courseLabels.map((_, index) => colors[index % colors.length]);

        const ctx = document.getElementById('preferred-course-chart').getContext('2d');

        const preferredCourseChart = new Chart(ctx, {
            type: 'polarArea',
            data: {
                labels: courseLabels,
                datasets: [{
                    label: 'Number of Students',
                    data: courseCounts,
                    backgroundColor: datasetColors,
                    borderColor: datasetColors.map(color => color.replace('0.5', '1')),
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    r: {
                        beginAtZero: true
                    }
                }
            }
        });
    })
    .catch(error => {
        console.error('Error fetching preferred course data:', error);
    });

// RIASEC based on user scores analytics
let morrisBarChart;

function fetchRiasecData(year) {
    fetch(`/admin/riasec/scores?year=${year}`)
        .then(response => response.json())
        .then(data => {
            const riasecOrder = ['R', 'I', 'A', 'S', 'E', 'C'];
            const chartData = [];

            riasecOrder.forEach(riasec => {
                chartData.push({ riasec: riasec, points: 0, courses: '' });
            });

            data.chartData.forEach(item => {
                const index = riasecOrder.indexOf(item.riasec.charAt(0));
                if (index !== -1) {
                    chartData[index].points = item.points;
                    chartData[index].courses = item.courses;
                }
            });

            const sortedChartData = chartData.sort((a, b) => {
                return riasecOrder.indexOf(a.riasec) - riasecOrder.indexOf(b.riasec);
            });

            if (morrisBarChart) {
                morrisBarChart.setData(sortedChartData);
            } else {
                morrisBarChart = new Morris.Bar({
                    element: 'riasec-chart',
                    data: sortedChartData,
                    xkey: 'riasec',
                    ykeys: ['points'],
                    labels: ['Total Points'],
                    barColors: ['#752738'],
                    xLabelAngle: 60,
                    hideHover: 'auto',
                    barSizeRatio: 0.5,
                    hoverCallback: function (index, options, content, row) {
                        return `<div style="text-align: left;">
                                            <strong>${row.riasec}</strong><br>
                                            <strong>Total Points: (${row.points})</strong><br>
                                            <strong>Career / Related Courses:</strong><br>
                                            ${row.courses}
                                        </div>`;
                    }
                });
            }
        })
        .catch(error => {
            console.error('Error fetching RIASEC data:', error);
        });
}

document.addEventListener('DOMContentLoaded', () => {
    const currentYear = new Date().getFullYear();
    fetchRiasecData(currentYear);

    document.getElementById('year-select-riasec').addEventListener('change', function () {
        const selectedYear = this.value;
        fetchRiasecData(selectedYear);
    });
});