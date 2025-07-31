<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Returned List </title>



    <style>

        p, h2,h3,h4{

            margin:0;

            padding:0;

        }

        body{

            width: 1000px;

            margin:auto;

            font-size: 16px;

        }

        .header{

            display:flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 15px;

        }

        .logo img{

            width: 200px;

        }

        .salesReport h3{

            font-size: 24px;

            font-weight: bold;

        }

        .address p{

            line-height: 20px;

            text-align: right;

        }

        .oparatorMain{

            display: flex;

            justify-content: space-between;

            align-items: end;

            margin-bottom: 8px;

        }

        .oparator p{

            line-height: 20px;

        }

        table {

            border-collapse: collapse;

            width: 100%;

        }

        table tr th,table tr td{

            border:1px solid #000;

            border-collapse: collapse;

            text-align: left;

            padding:3px;

        }

        .print_button{

            text-align: center;

            margin-top: 20px;

        }

        .print_button button{

            background: #E7A35D;

            color:#fff;

            padding: 10px 30px;

            font-size: 18px;

            border: none;

            border-radius: 5px;

        }

        .textLeft{

            text-align: left;

        }

        .textCenter{

            text-align: center;

        }

        .textRight{

            text-align: right;

        }

        .memberImg{

            text-align: center;

        }

        .memberImg img{

            width: 30px;

            height: 30px;

        }

        .printDate{

            text-align: right;

            font-size: 14px;

        }

        @media print{

            body{

                width: 100%;

            }

            .print_button{

                display: none;

            }

        }

    </style>

</head>

<body>

    <div class="header">

        <div class="logo">

                 <img src="<?php echo asset('backend_assets/images/logo.png'); ?>" alt="">

        </div>

        <div class="salesReport">

            <h3>Returned List</h3>

        </div>

        <div class="address">

            <p>113 Green Road,Dhaka, Bangladesh.</p>

            <p>tarannum.cse@gmail.com</p>

            <p>01761158112</p>

        </div>

    </div>



    <div class="oparatorMain">



        <div class="printDate">

            <p>Print Date: <?php  echo date("d/m/Y")?></p>

        </div>

    </div>



   <div class="main_div">

        <table>

            <thead>

                <tr>

                    <th class="textLeft">SL</th>

                    <th>Photo</th>

                    <th>Book Info</th>

                    <th class="">Member Info</th>

                    <th style="">Dates </th>

                    <th style="">Return Date </th>



                </tr>

            </thead>

            <tbody>

                @foreach ($data['report'] as $key => $single_report)

                <tr>

                    <td>{{ $key + 1 }}</td>



                    <td>

                        <div class="memberImg">

                            <img src="{{ asset($single_report->book_photo  )}}" alt="">

                        </div>

                    </td>

                    <td>{{ $single_report->book_name }} <br>

                        {{ $single_report->category}}

                    </td>
                 <td>
                    {{ $single_report->name }} <br>
                    {{ 'Member Id:' . $single_report->membership_number }}
                </td>

                    <td>

                        {{ date('d/m/Y', strtotime($single_report->issue_date ))}} to <br>

                        {{ date('d/m/Y', strtotime($single_report->return_date ))}}

                    </td>

                    <td>



                        @if($single_report->status == 0)

                        <span class="badge bg-info">Issue</span> <br>

                        @if($single_report->actual_return_date)

                        {{ date('d/m/Y', strtotime($single_report->actual_return_date ))}}

                        @endif

                        @elseif($single_report->status == 1)

                        <span class="badge bg-success">Good</span> <br>

                        @if($single_report->actual_return_date)

                        {{ date('d/m/Y', strtotime($single_report->actual_return_date ))}}

                        @endif

                        @elseif($single_report->status == 2)

                        <span class="badge bg-danger">Defaulter</span> <br>

                        @if($single_report->actual_return_date)

                        {{ date('d/m/Y', strtotime($single_report->actual_return_date ))}}

                        @endif

                        @endif





                    </td>

                </tr>

               @endforeach

            </tbody>

        </table>

   </div>



   <div class="print_button">

       <button type="submit" onClick="window.print();">Print</button>

   </div>



</body>

</html>