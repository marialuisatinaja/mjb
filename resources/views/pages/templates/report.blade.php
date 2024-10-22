<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 16px;
         
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: small;
        }

        th, td {
            border: 1px solid black; /* Black border */
            padding: 10px; /* Padding for table cells */
            text-align: left; /* Align text to the left */
        }

        th {
            background-color: #f2f2f2; /* Light gray background for headers */
        }

        tr:nth-child(even) {
            background-color: #f9f9f9; /* Light gray background for even rows */
        }

        tr:hover {
            background-color: #e2e2e2; /* Change background color on hover */
        }

        h2 {
            text-align: center; /* Center align the title */
        }
    </style>
</head>
<body>
    <center style="padding-right:60px;padding-left:50px">
                <img class="img-radius" src="{{ asset('assets/logo.jpg') }}" alt="User-Profile-Image" style="width: 110px; height:100px;">
    </center>
<br>
    <center>Masaje de Bohol Sauna & Spa</center>
    <center> {{ \Carbon\Carbon::parse($startDate)->format('F j,') }} -  {{ \Carbon\Carbon::parse($endDate)->format('j, Y') }}</center>
<br>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Service Name</th>
            <th>Type</th>
            <th>Status</th>
            <th>Payment</th>
        </tr>
    </thead>
    <tbody>
        @php
            $totalAmount = 0; // Initialize total amount
        @endphp

        @foreach($reservations as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td>{{ @$row->services->title }}</td>
                <td>{{ @$row->service_type }}</td>
                <td>{{ @$row->status }}</td>
                <td>
                    {{ $amount = number_format((@$row->services->amount * $row->total_person), 2, '.', ',') }}
                    @php
                        $totalAmount += $row->services->amount * $row->total_person; // Accumulate total amount
                    @endphp
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4" style="text-align: right;"><strong>Total:</strong></td>
            <td><strong>{{ number_format($totalAmount, 2, '.', ',') }}</strong></td>
        </tr>
    </tfoot>
</table>


</body>
</html>