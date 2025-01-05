function validateData(data) {
    return data.every(value => value >= 0);
}

function createBarChart(ctx, labels, data) {
    return new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: '# of Examinees',
                data: data,
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
}

function createGenderChart(ctx, femaleCount, maleCount) {
    return new Chart(ctx, {
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
}


function createDoughnutChart(ctx, labels, data, backgroundColors, borderColors) {
    return new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                label: 'Offered Courses',
                data: data,
                backgroundColor: backgroundColors,
                borderColor: borderColors,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
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
}


function fetchYearlyExaminees() {
    $.ajax({
        url: '/api/yearly-examinees',
        method: 'GET',
        success: function (examineesData) {
            const years = examineesData.map(e => e.year);
            const counts = examineesData.map(e => e.examinee_count);

            if (validateData(counts)) {
                const ctx = document.getElementById('yearlyExaminees').getContext('2d');
                createBarChart(ctx, years, counts);
            } else {
                console.error('Yearly examinee counts contain negative values:', counts);
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error: ' + status + error);
        }
    });
}


function fetchGenderChart(year) {
    fetch(`/admin/examiners/data-gender?year=${year}`)
        .then(response => response.json())
        .then(data => {
            const labels = data.map(item => item.gender);
            const counts = data.map(item => item.count);

            const maleCount = counts[labels.indexOf("male")] || 0;
            const femaleCount = counts[labels.indexOf("female")] || 0;

            const ctx = document.getElementById('gender-chart').getContext('2d');
            createGenderChart(ctx, femaleCount, maleCount);
        })
        .catch(error => console.error('Error fetching gender data:', error));
}


// function fetchCourseChart() {
//     fetch('/admin/courses/offered')
//         .then(response => response.json())
//         .then(data => {
//             const offeredCourses = data.offered_courses;

//             if (Object.keys(offeredCourses).length === 0) {
//                 const ctx = document.getElementById('course-chart').getContext('2d');
//                 const courseLabels = ['No displayed offered course'];
//                 const courseCounts = [1];
//                 const backgroundColors = ['brown'];
//                 const borderColors = ['brown'];

//                 createDoughnutChart(ctx, courseLabels, courseCounts, backgroundColors, borderColors);
//                 return;
//             }

//             const courseLabels = Object.keys(offeredCourses);
//             const courseCounts = Object.values(offeredCourses);
//             const backgroundColors = courseLabels.map(getRandomColor);
//             const borderColors = courseLabels.map(getRandomColor);

//             if (validateData(courseCounts)) {
//                 const ctx = document.getElementById('course-chart').getContext('2d');
//                 createDoughnutChart(ctx, courseLabels, courseCounts, backgroundColors, borderColors);
//             } else {
//                 console.error('Course counts contain negative values:', courseCounts);
//             }
//         })
//         .catch(error => {
//             console.error('Error fetching course data:', error);
//             const ctx = document.getElementById('course-chart').getContext('2d');
//             const courseLabels = ['Error fetching data'];
//             const courseCounts = [1];
//             const backgroundColors = ['brown'];
//             const borderColors = ['brown'];

//             createDoughnutChart(ctx, courseLabels, courseCounts, backgroundColors, borderColors);
//         });
// }


function fetchPreferredCourses() {
    fetch('/admin/preferred-courses/counts')
        .then(response => response.json())
        .then(data => {
            const courseLabels = Object.keys(data);
            const courseCounts = Object.values(data);

            if (courseLabels.length === 0) {
                const ctx = document.getElementById('preferred-course-chart').getContext('2d');
                const courseLabels = ['No displayed preferred courses'];
                const courseCounts = [1];
                const backgroundColors = ['brown'];
                const borderColors = ['brown'];

                createDoughnutChart(ctx, courseLabels, courseCounts, backgroundColors, borderColors);
                return;
            }

            const colors = ['rgba(255, 99, 132, 0.5)', 'rgba(54, 162, 235, 0.5)', 'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)', 'rgba(153, 102, 255, 0.5)', 'rgba(255, 159, 64, 0.5)'];
            const datasetColors = courseLabels.map((_, index) => colors[index % colors.length]);

            if (validateData(courseCounts)) {
                const ctx = document.getElementById('preferred-course-chart').getContext('2d');
                createDoughnutChart(ctx, courseLabels, courseCounts, datasetColors, datasetColors.map(color => color.replace('0.5', '1')));
            } else {
                console.error('Preferred course counts contain negative values:', courseCounts);
            }
        })
        .catch(error => {
            console.error('Error fetching preferred course data:', error);
            const ctx = document.getElementById('preferred-course-chart').getContext('2d');
            const courseLabels = ['Error fetching data'];
            const courseCounts = [1];
            const backgroundColors = ['brown'];
            const borderColors = ['brown'];

            createDoughnutChart(ctx, courseLabels, courseCounts, backgroundColors, borderColors);
        });
}


let morrisBarChart;

function fetchRiasecData(year) {
    fetch(`/admin/riasec/scores?year=${year}`)
        .then(response => response.json())
        .then(data => {
            const riasecOrder = [
                { label: 'Realistic (R)', key: 'R' },
                { label: 'Investigative (I)', key: 'I' },
                { label: 'Artistic (A)', key: 'A' },
                { label: 'Social (S)', key: 'S' },
                { label: 'Enterprising (E)', key: 'E' },
                { label: 'Conventional (C)', key: 'C' }
            ];

            const chartData = riasecOrder.map(item => ({
                riasec: item.label,
                points: data.chartData.find(chartItem => chartItem.riasec.charAt(0) === item.key)?.points || 0,
                courses: data.chartData.find(chartItem => chartItem.riasec.charAt(0) === item.key)?.courses || ''
            }));

            if (validateData(chartData.map(item => item.points))) {
                if (morrisBarChart) {
                    morrisBarChart.setData(chartData);
                } else {
                    morrisBarChart = new Morris.Bar({
                        element: 'riasec-chart',
                        data: chartData,
                        xkey: 'riasec',
                        ykeys: ['points'],
                        labels: ['Total Points'],
                        barColors: ['#752738'],
                        xLabelAngle: 20,
                        hideHover: 'auto',
                        barSizeRatio: 0.5,
                        hoverCallback: function (index, options, content, row) {
                            return `<div style="text-align: left;">
                                        <strong>${row.riasec}</strong><br>
                                        <strong>Total Points: (${row.points})</strong><br>
                                        <strong style="color: green;">Career / Related Courses:</strong><br>
                                        <span style="color: green;">${row.courses}</span>
                                    </div>`;
                        }
                    });
                }
            } else {
                console.error('RIASEC points contain negative values:', chartData);
            }
        })
        .catch(error => console.error('Error fetching RIASEC data:', error));
}



document.addEventListener('DOMContentLoaded', function () {
    fetchYearlyExaminees();

    const yearSelect = document.getElementById('year-select-gender');
    fetchGenderChart(yearSelect.value);
    yearSelect.addEventListener('change', function () {
        fetchGenderChart(this.value);
    });

    // fetchCourseChart();
    fetchPreferredCourses();

    const currentYear = new Date().getFullYear();
    fetchRiasecData(currentYear);
    document.getElementById('year-select-riasec').addEventListener('change', function () {
        fetchRiasecData(this.value);
    });
});

function getRandomColor() {
    const letters = '0123456789ABCDEF';
    let color = '#';
    for (let i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}
