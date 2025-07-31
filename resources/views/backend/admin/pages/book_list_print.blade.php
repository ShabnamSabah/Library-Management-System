<?php

$total = 0;
?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Book List </title>



    <style>
        p,
        h2,
        h3,
        h4 {

            margin: 0;

            padding: 0;

        }

        body {

            width: 1000px;

            margin: auto;

            font-size: 16px;

        }

        .header {

            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 15px;

        }

        .logo img {

            width: 200px;

        }

        .salesReport h3 {

            font-size: 24px;

            font-weight: bold;

        }

        .address p {

            line-height: 20px;

            text-align: right;

        }

        .oparatorMain {

            display: flex;

            justify-content: space-between;

            align-items: end;

            margin-bottom: 8px;

        }

        .oparator p {

            line-height: 20px;

        }

        table {

            border-collapse: collapse;

            width: 100%;

        }

        table tr th,
        table tr td {

            border: 1px solid #000;

            border-collapse: collapse;

            text-align: left;

            padding: 3px;

        }

        .print_button {

            text-align: center;

            margin-top: 20px;

        }

        .print_button button {

            background: #E7A35D;

            color: #fff;

            padding: 10px 30px;

            font-size: 18px;

            border: none;

            border-radius: 5px;

        }

        .textLeft {

            text-align: left;

        }

        .textCenter {

            text-align: center;

        }

        .textRight {

            text-align: right;

        }

        .memberImg {

            text-align: center;

        }

        .memberImg img {

            width: 30px;

            height: 30px;

        }

        .printDate {

            text-align: right;

            font-size: 14px;

        }

        @media print {

            body {

                width: 100%;

            }

            .print_button {

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

            <h3>Book List</h3>

        </div>

        <div class="address">

            <p>113 Green Road,Dhaka, Bangladesh.</p>

            <p>tarannum.cse@gmail.com</p>

            <p>01761158112</p>

        </div>

    </div>


    <div class="oparatorMain">



        <div class="printDate">

            <p>Print Date: <?php echo date("d/m/Y") ?></p>

        </div>

    </div>



    <div class="main_div">

        <table>

            <thead>

                <tr>

                    <th class="textLeft">SL</th>
                    <th>Category</th>
                    <th class="">Rack</th>
                    <th style="">Name</th>
                    <th style="">Author Name </th>
                    <th style="">Volume </th>
                    <th style="">Total Volume </th>
                    <th style="">Total Copy </th>
                </tr>

            </thead>

            <tbody>

                @foreach ($data['book_list'] as $key => $single_book)
                 <?php  $total += $single_book->total_copy ;?>
                <tr>

                    <td>{{ $key + 1 }}</td>
                    <td>{{ $single_book->category}}</td>
                    <td>{{ $single_book->rack_name }}</td>
                    <td>{{ $single_book->name }} </td>
                    <td>{{ $single_book->author }}</td>
                    <td>{{ $single_book->volume_no }}</td>
                    <td>{{ $single_book->total_volume }}</td>
                    <td>{{ $single_book->total_copy }} </td>
                </tr>

                @endforeach
                <tr>
                    <td colspan="7" style="text-align:right">Total</td>
                    <td>{{ $total }}</td>
                </tr>

            </tbody>

        </table>

    </div>



    <div class="print_button">

        <button type="submit" onClick="window.print();">Print</button>

    </div>



</body>

</html>