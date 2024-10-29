<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 0%;
         
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: small;
        }

        th, td {
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

<table >
    <tr>
    <td><label for="" style="text-decoration: underline;font-size:large"># {{ $certificate->id }}</label></td>
        <td><h1 style="color:#691421"><center>GIFT CERTIFICATE</center></h1></td>
        <td><img class="img-radius" src="{{ asset('assets/logo.jpg') }}" alt="User-Profile-Image" style="width: 110px; height:100px;"></td>
    </tr>
</table>

    <div style="margin-left:15%;margin-right:20%;">
        <h1 style="border-bottom:solid 1px;"><small style="font-weight: 100;">To :</small> Hecel Angelo</h1>
        <label>This certificate entitles you to</label>
    </div>
    <center>
    <div style="background-color:#691421;padding-left:1%;">
        <h1 style="color:white;">{{ $certificate->duration}} HR {{ $certificate->services->title }}  <small style="font-size:medium;"><br>BOOKING IS REQUIRED. PLEASE CALL FOR YOUR  APPOINTMENT</small></h1>
    </div>
    </center>
    <div style="margin-left:15%;margin-right:20%;">
        <span style="border-bottom:solid 1px;font-size:25px;"><small style="font-weight: 100;">COURTESY OF:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
        <center><small>For more information, message our Facebook page or contact</small></center>
    </div>

    <center>
    <div style="background-color:#691421;padding:5px;color:white;margin-top:10px;margin-left:15%;margin-right:15%;">
        <span style="font-size: 11px;">PLAZA BRANCH (0917)1473130/DAO(0917)CALCETA(0949)9691072/PORT(0966)1544772</span>
    </div>
    </center>

</body>
</html>