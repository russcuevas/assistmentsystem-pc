<!DOCTYPE html>
<html>
<head>
    <title>Results Copy</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        .blank-cell { background-color: red; }
        .footer { font-weight: bold; }
    </style>
</head>
<body>
    <h1>Thankyou for taking the exam</h1>
    <p>Name: {{ $user->fullname }}</p>
    <p>Default ID: {{ $user->default_id }}</p>
    <p>Age: {{ $user->age }}</p>
    <p>Strand: {{ $user->strand }}</p>

    <table>
        <thead>
            <tr>
                <th>Question</th>
                <th>R</th>
                <th>I</th>
                <th>A</th>
                <th>S</th>
                <th>E</th>
                <th>C</th>
            </tr>
        </thead>
        <tbody>
            @php
                $count = [
                    'R' => 0,
                    'I' => 0,
                    'A' => 0,
                    'S' => 0,
                    'E' => 0,
                    'C' => 0,
                ];
            @endphp

            @foreach ($responses as $response)
                <tr>
                    <td>{{ $response['question'] }}</td>
                    @php
                        $isAllBlank = true; 
                        $cells = [
                            'R' => '',
                            'I' => '',
                            'A' => '',
                            'S' => '',
                            'E' => '',
                            'C' => ''
                        ];

                        if ($response['riasec_id'] === 'R' && $response['answer'] === '✓') {
                            $cells['R'] = 'True';
                            $count['R']++;
                            $isAllBlank = false;
                        }
                        if ($response['riasec_id'] === 'I' && $response['answer'] === '✓') {
                            $cells['I'] = 'True';
                            $count['I']++;
                            $isAllBlank = false;
                        }
                        if ($response['riasec_id'] === 'A' && $response['answer'] === '✓') {
                            $cells['A'] = 'True';
                            $count['A']++;
                            $isAllBlank = false;
                        }
                        if ($response['riasec_id'] === 'S' && $response['answer'] === '✓') {
                            $cells['S'] = 'True';
                            $count['S']++;
                            $isAllBlank = false;
                        }
                        if ($response['riasec_id'] === 'E' && $response['answer'] === '✓') {
                            $cells['E'] = 'True';
                            $count['E']++;
                            $isAllBlank = false;
                        }
                        if ($response['riasec_id'] === 'C' && $response['answer'] === '✓') {
                            $cells['C'] = 'True';
                            $count['C']++;
                            $isAllBlank = false;
                        }
                    @endphp
                    <td class="{{ $isAllBlank ? 'blank-cell' : '' }}">{{ $cells['R'] }}</td>
                    <td class="{{ $isAllBlank ? 'blank-cell' : '' }}">{{ $cells['I'] }}</td>
                    <td class="{{ $isAllBlank ? 'blank-cell' : '' }}">{{ $cells['A'] }}</td>
                    <td class="{{ $isAllBlank ? 'blank-cell' : '' }}">{{ $cells['S'] }}</td>
                    <td class="{{ $isAllBlank ? 'blank-cell' : '' }}">{{ $cells['E'] }}</td>
                    <td class="{{ $isAllBlank ? 'blank-cell' : '' }}">{{ $cells['C'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table>
        <tfoot>
            <tr class="footer">
                <td>Total</td>
                <td>{{ $count['R'] }}</td>
                <td>{{ $count['I'] }}</td>
                <td>{{ $count['A'] }}</td>
                <td>{{ $count['S'] }}</td>
                <td>{{ $count['E'] }}</td>
                <td>{{ $count['C'] }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
