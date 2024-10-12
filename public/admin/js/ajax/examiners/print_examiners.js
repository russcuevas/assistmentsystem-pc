document.addEventListener('DOMContentLoaded', function () {
    const monthInput = document.getElementById('month');
    const yearInput = document.getElementById('year');
    const downloadButton = document.getElementById('download-button');

    function fetchAndUpdateTable() {
        const month = monthInput.value === '--' ? null : monthInput.value;
        const year = yearInput.value === '--' ? null : yearInput.value;
        navigateLoading();

        let url = `/get-examinees-month-year?`;
        if (month && year) {
            url += `month=${month}&year=${year}`;
        } else if (year) {
            url += `year=${year}`;
        } else if (month) {
            url += `month=${month}`;
        }

        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                const tbody = document.querySelector('#printable-area tbody');
                tbody.innerHTML = '';

                if (data.length > 0) {
                    data.forEach(examiner => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${examiner.default_id}</td>
                            <td>${examiner.fullname}</td>
                            <td>${examiner.gender}</td>
                            <td>${examiner.age}</td>
                            <td>${examiner.birthday}</td>
                            <td>${examiner.strand}</td>
                            <td>
                                1.) ${examiner.course_1_name ?? 'N/A'} <br>
                                2.) ${examiner.course_2_name ?? 'N/A'} <br>
                                3.) ${examiner.course_3_name ?? 'N/A'}
                            </td>
                            <td>${examiner.created_at}</td>
                            <td>${examiner.updated_at}</td>
                            <td>
                                <button class="btn btn-danger waves-effect btn-sm delete-button" 
                                        data-id="${examiner.id}" 
                                        data-name="${examiner.fullname}">
                                    DELETE
                                </button>
                            </td>
                        `;
                        tbody.appendChild(row);
                    });
                } else {
                    const row = document.createElement('tr');
                    row.innerHTML = `<td style="text-align: center" colspan="10">No examinees available</td>`;
                    tbody.appendChild(row);
                }
            })
            .catch(error => console.error('Error fetching data:', error))
            .finally(() => {
                HoldOn.close();
            });
    }


    function navigateLoading() {
        HoldOn.open({
            theme: 'sk-circle',
            message: '<div class="loading-message">Please wait...</div>',
            backgroundColor: 'rgba(0, 0, 0, 0.7)',
            textColor: '#fff'
        });
    }

    function deleteShowLoading() {
        HoldOn.open({
            theme: 'sk-circle',
            message: '<div class="loading-message">Please wait, deleting Examiners...</div>',
            backgroundColor: 'rgba(0, 0, 0, 0.7)',
            textColor: '#fff'
        });
    }


    document.querySelector('#printable-area').addEventListener('click', function (event) {
        if (event.target.classList.contains('delete-button')) {
            const examinerId = event.target.getAttribute('data-id');
            const examinerName = event.target.getAttribute('data-name');

            const modalHTML = `
                    <div class="modal fade" id="deleteExamineesModal${examinerId}" tabindex="-1" role="dialog" aria-labelledby="deleteExamineesModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteExamineesModalLabel">Confirm Deletion</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this examiner "${examinerName}"?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn bg-red waves-effect delete-examiners-id" 
                                            data-url="/admin/examiners_list/delete/${examinerId}">DELETE</button>
                                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

            document.body.insertAdjacentHTML('beforeend', modalHTML);

            $('#deleteExamineesModal' + examinerId).modal('show');
            $('#deleteExamineesModal' + examinerId).on('hidden.bs.modal', function () {
                $(this).remove();
            });

            document.querySelector(`#deleteExamineesModal${examinerId} .delete-examiners-id`).addEventListener('click', function () {
                const deleteUrl = this.getAttribute('data-url');
                deleteShowLoading();

                fetch(deleteUrl, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                    .then(response => {
                        if (response.ok) {
                            swal({
                                title: "Deleted!",
                                text: "Examiner deleted successfully",
                                icon: "success",
                            }).then(() => {
                                $(`#deleteExamineesModal${examinerId}`).modal('hide');
                                location.reload();
                            });
                        } else {
                            console.error('Error deleting examiner:', response);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    })
                    .finally(() => {
                        HoldOn.close();
                    });
            });
        }
    });

    monthInput.addEventListener('change', fetchAndUpdateTable);
    yearInput.addEventListener('change', fetchAndUpdateTable);

    function getMonthName(monthNumber) {
        const months = [
            "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];
        return months[monthNumber - 1];
    }

    downloadButton.addEventListener('click', function () {
        navigateLoading();

        const month = monthInput.value === '--' ? null : monthInput.value;
        const year = yearInput.value === '--' ? null : yearInput.value;

        fetch(`/get-examinees-month-year?month=${month}&year=${year}`)
            .then(response => response.json())
            .then(data => {
                if (data.length === 0) {
                    HoldOn.close();
                    swal({
                        title: "No Data Available",
                        text: "There are no examinees for the selected month and year.",
                        icon: "warning",
                    });
                    return;
                }

                const { jsPDF } = window.jspdf;
                const pdf = new jsPDF();

                const monthName = month ? getMonthName(month) : '';
                const headerText = month && year ? `Examinees for ${monthName} ${year}` :
                    year ? `Examinees for Year ${year} and All months` :
                        month ? `Examinees for ${monthName} and All years` :
                            'Examinees for All Time';

                pdf.setFontSize(12);
                pdf.text(headerText, 14, 20);

                const columns = ["ID", "Fullname", "Gender", "Age", "Birthday", "Strand", "Preferred Course"];
                const rows = [];

                data.forEach(examiner => {
                    const courses = [
                        `1.) ${examiner.course_1_name || 'N/A'}`,
                        `2.) ${examiner.course_2_name || 'N/A'}`,
                        `3.) ${examiner.course_3_name || 'N/A'}`
                    ];

                    const preferredCourses = courses.join('\n');

                    rows.push([
                        examiner.default_id,
                        examiner.fullname,
                        examiner.gender,
                        examiner.age,
                        examiner.birthday,
                        examiner.strand,
                        preferredCourses,
                        examiner.created_at,
                        examiner.updated_at
                    ]);
                });

                pdf.autoTable({
                    head: [columns],
                    body: rows,
                    startY: 30,
                    styles: {
                        overflow: 'linebreak',
                        cellWidth: 'wrap',
                    },
                    columnStyles: {
                        6: {
                            cellWidth: 'auto'
                        }
                    },
                });

                pdf.save('Examinees-List.pdf');
            })
            .catch(error => console.error('Error fetching data:', error))
            .finally(() => {
                HoldOn.close();
            });
    });
});