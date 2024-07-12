<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/invoice.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
        integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        @page {
            size: A4 landscape;
            margin: 0;
        }

        body {
            margin: 100;
        }

        #invoice {
            padding: 30px;
        }
    </style>
</head>

<body>
    <button id="download-button" class="btn btn-primary mt-3">Download as PDF</button>
    <div id="invoice">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <header class="clearfix">
                        <div id="logo">
                            <img src="{{ asset('assets/img/invoice_logo.png') }}">
                        </div>
                        <h1>INVOICE</h1>
                        <div id="company" class="clearfix">
                            <div>MountainMate</div>
                            <div>455 Foggy Heights,<br /> AZ 85004, US</div>
                            <div>(602) 519-0450</div>
                            <div><a href="mailto:company@example.com">company@example.com</a></div>
                        </div>
                        <div id="project">
                            <div><span>CLIENT</span> {{ $users->name }}</div>
                            <div><span>EMAIL</span> {{ $users->email }}</div>
                            <div><span>Group Code</span> MTN-00{{ $group->id }}</div>
                            @foreach ($payments as $payment)
                                <div><span>Payment ID</span> PAY-MTN-00{{ $payment->id }}</div>
                            @endforeach
                        </div>
                    </header>
                    <main>

                        <table>
                            <thead>
                                <tr>
                                    <th class="service">NO</th>
                                    <th class="desc">MOUNTAIN NAME</th>
                                    <th>PRICE</th>
                                    <th>QTY</th>
                                    <th>TOTAL</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td class="service">1</td>
                                    <td class="desc">{{ $mountainable->mountain->nm_mountain }}</td>
                                    @php
                                        $num = count($reservations);
                                        $price = $num * $mountainable->price;
                                    @endphp
                                    <td class="unit">RM {{ $mountainable->price }}</td> {{-- harga satu orang --}}
                                    <td class="qty">{{ $num }}</td>
                                    <td class="total">RM {{ $price }}</td> {{-- hasil kali QTY*PRICE --}}
                                </tr>

                                <tr>
                                    <td colspan="4">SUBTOTAL</td>
                                    <td class="total">RM {{ $price }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="grand total">GRAND TOTAL</td>
                                    <td class="grand total">RM {{ $price }}</td>
                                </tr>
                            </tbody>

                        </table>

                        <div id="notices">
                            <div>NOTICE:</div>
                            <div class="notice" style="color: #f50000">Make sure you bring this invoice and show it to
                                the officer
                            </div>
                        </div> <br>
                        <h2>Climbers Detail</h2>

                        <table>
                            <thead>
                                <tr>
                                    <th class="service">No</th>
                                    <th class="desc">Name</th>
                                    <th>Address</th>
                                    <th>Phone Number</th>
                                    <th>Nationality</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reservations as $reservation)
                                    <tr>
                                        <td class="service">{{ $loop->iteration }}</td>
                                        <td class="desc">{{ $reservation->name }}</td>
                                        <td class="unit">{{ $reservation->address }}</td>
                                        <td class="qty">{{ $reservation->no_tlp }}</td>
                                        <td class="total">{{ $reservation->nationality }}</td>
                                    </tr>
                                @endforeach

                                <tr>
                                    <td colspan="4" class="grand total">TOTAL</td>
                                    <td class="grand total">{{ $num }}</td>
                                </tr>

                            </tbody>
                        </table>
                        <div style="text-align: right;">
                            <img src="{{ asset('assets/img/paid.png') }}" style="max-height: 300px; max-widh: 550px">
                        </div>
                    </main>
                    <footer>
                    </footer>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script>
        const button = document.getElementById("download-button");

        function generatePDF() {
            // Choose the element that your content will be rendered to.
            const element = document.getElementById("invoice");
            // Choose the element and save the PDF for your user.
            html2pdf().from(element).save();
        }

        button.addEventListener("click", generatePDF);
    </script>
</body>

</html>
