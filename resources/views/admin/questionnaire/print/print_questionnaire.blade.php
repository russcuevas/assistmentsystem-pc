@php
    $css = file_get_contents(public_path('admin/css/print-questionnaire.css'));
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Examinees</title>
    <style>
        {{ $css }}
                .info-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .info-item {
            flex: 1;
            margin-right: 10px;
        }
        .info-item:last-child {
            margin-right: 0;
        }
    </style>
</head>
<body>
    <div id="nav-bar">
        <div>
            <img class="ub-logo" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('auth/images/ub-logo.png'))) }}" alt="UB Logo" />
        </div>
        <div style="padding:10px;">
            <div id="school-name">UNIVERSITY OF BATANGAS LIPA CITY CAMPUS</div>
            <div class="sub-details">Sample Address</div>
            <div class="sub-details">www.ub.edu.ph / sample email</div>
            <div class="sub-details">telefax: sample-number</div>
        </div>
    </div>

    <div class="container">
        <div class="info-container">
            <div class="info-item">Name:</div>
            <div class="info-item">Date:</div>
        </div>
        <div class="info-container">
            <div class="info-item">Age:</div>
            <div class="info-item">Strand:</div>
        </div>

        <h2 style="text-align: center">RIASEC EXAMINATION</h2>
        <div class="instructions">Direction: This is a riasec examination please check "True" or "False" for each statement.</div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Question</th>
                    <th>True</th>
                    <th>False</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($questions as $question)
                    <tr>
                        <td> {{ $loop->iteration }}.) {{ $question->question_text }}</td>
                        <td class="blank-cell"></td>
                        <td class="blank-cell"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
