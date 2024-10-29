<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOTSTRAP AND FONTS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- WAVES -->
    <link href="{{ asset('examinees/plugins/node-waves/waves.css') }}" rel="stylesheet" />
    <!-- ANIMATION -->
    <link href="{{ asset('examinees/plugins/animate-css/animate.css') }}" rel="stylesheet" />
    <!-- CUSTOM AND STYLE -->
    <link href="{{ asset('examinees/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('examinees/css/custom.css') }}" rel="stylesheet">
    <!-- FAVICON -->
    <link rel="shortcut icon" href="{{ asset('auth/images/ub-logo.png') }}" type="image/x-icon">
    <title>UB - Assistments</title>
    <style>
        .info-container {

            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .info-item {
            font-weight: 600;
            flex: 1;
            margin-right: 10px;
        }
        .info-item:last-child {
            margin-right: 0;
        }

        .instructions {
            font-size: 15px;
            font-weight: bold;
            text-align: left;
        }
    </style>
</head>

<body>

    <div id="nav-bar" class="d-flex justify-content-center align-items-center">
        <div>
            <img class="ub-logo" src="{{ asset('auth/images/ub-logo.png') }}" alt="UB Logo" />
        </div>
        <div style="padding:10px;">
            <div>
                <div id="school-name">
                    UNIVERSITY OF BATANGAS LIPA CITY CAMPUS
                </div>
                <div class="sub-details">
                    Sample Address
                </div>
                <div class="sub-details">
                    www.ub.edu.ph / sample email
                </div>
                <div class="sub-details">
                    telefax: sample-number
                </div>
            </div>
        </div>
    </div>

    <div id="nav-body" class="d-flex justify-content-center" style="margin-bottom:50px;">
        <div id="form-container" class="row">

            <div class="info-container" style="margin-top: 50px">
                <div class="info-item">Default ID: <span style="color: brown">{{ $user->default_id }}</span></div>
                <div class="info-item">Age: {{ $user->age }}</div>
            </div>
            <div class="info-container">
                <div class="info-item">Name: {{ $user->fullname }}</div>
                <div class="info-item">Strand: {{ $user->strand }}</div>
            </div>

            <h2 style="text-align: center" class="mt-5">RIASEC EXAMINATION</h2>
            <div class="instructions">Direction: This is a riasec examination please select "True" or "False" for each statement.</div>
            <form action="{{ route('users.submit.responses') }}" method="POST">
                @csrf
                <table class="table table-bordered" style="border: 2px solid black;">
                    <thead class="table-light">
                        <tr>
                            <th style="border: 2px solid black;">Question</th>
                            <th style="border: 2px solid black;">True</th>
                            <th style="border: 2px solid black;">False</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($questions as $question)
                        <tr style="border: 2px solid black;">
                            <td style="border: 2px solid black;">{{ $question->question_text }}</td>
                            <td style="border: 2px solid black;">
                                @if (in_array($question->riasec_id, ['R', 'I', 'A', 'S', 'E', 'C']))
                                    <label class="radio-label">
                                        <input type="radio" name="answer[{{ $question->id }}]" value="true"> True
                                    </label>
                                @endif
                            </td>
                            <td style="border: 2px solid black;">
                                @if (in_array($question->riasec_id, ['R', 'I', 'A', 'S', 'E', 'C']))
                                    <label class="radio-label">
                                        <input type="radio" name="answer[{{ $question->id }}]" value="false"> False
                                    </label>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <button type="submit" class="btn btn-primary waves-effect mb-5">
                    NEXT
                </button>
            </form>
        </div>
    </div>




    <!-- JQUERY JS -->
    <script src="{{ asset('examinees/plugins/jquery/jquery.min.js') }}"></script>
    <!-- BOOTSTRAP JS -->
    <script src="{{ asset('examinees/plugins/bootstrap/js/bootstrap.js') }}"></script>
    <!-- SLIMSCROLL JS -->
    <script src="{{ asset('examinees/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
    <!-- JQUERY VALIDATION JS -->
    <script src="{{ asset('examinees/plugins/jquery-validation/jquery.validate.js') }}"></script>
    <!-- JQUERY STEPS JS -->
    <script src="{{ asset('examinees/plugins/jquery-steps/jquery.steps.js') }}"></script>
    <!-- SWEETALERT JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- WAVES EFFECTS JS -->
    <script src="{{ asset('examinees/plugins/node-waves/waves.js') }}"></script>

</body>
</html>
