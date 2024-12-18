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
            <th>Customer Name</th>
            <th>Phone</th>
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
                <td>{{ ucwords($row->first_name.' '.$row->middle_name.' '.$row->last_name) }}</td>
                <td>{{ $row->phone }}</td>
                <td>{{ @$row->offers_type }}</td>
                <td>{{ @$row->status }}</td>
                <td>
                    {{ $amount = number_format((@$row->payment_total), 2, '.', ',') }}
                    @php
                        // Only accumulate total if the status is "paid"
                        if (@$row->status === 'Paid') {
                            $totalAmount += $row->payment_total; // Accumulate total amount
                        }
                    @endphp
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5" style="text-align: right;"><strong>Total:</strong></td>
            <td><strong>{{ number_format($totalAmount, 2, '.', ',') }}</strong></td>
        </tr>
    </tfoot>
</table>

<div style="margin-top: 100px;">
    <hr style="width: 200px; border: 1px solid black; margin: 0 auto;">
    <p style="text-align: center; font-weight: bold; margin-top: 5px;">{{ Auth::user()->first_name.' '.Auth::user()->middle_name.' '.Auth::user()->last_name }}</p>
</div>



</body>
</html>