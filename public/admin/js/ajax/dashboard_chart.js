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