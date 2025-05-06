<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Bukti Pembayaran DP</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .email-container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .header {
            text-align: center;
            border-bottom: 1px solid #eee;
            padding-bottom: 20px;
        }

        .header img {
            max-height: 60px;
            margin-bottom: 10px;
        }

        .content {
            padding: 20px 0;
        }

        .panel {
            background-color: #f3f6fa;
            border-left: 4px solid #4b9cd3;
            padding: 15px 20px;
            margin: 20px 0;
            border-radius: 6px;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #999;
            margin-top: 30px;
        }

        .btn {
            display: inline-block;
            background-color: #4b9cd3;
            color: #fff;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 6px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <h1>Haromain Travel</h1>
            <!-- <img src="{{ asset('images/logo.png') }}" alt="Haromain Travel Logo"> -->
            <h2>Bukti Pembayaran DP Umrah</h2>
        </div>
        <div class="content">
            <p>Halo <strong>{{ $booking->name }}</strong>,</p>
            <p>Terima kasih telah melakukan pembayaran DP untuk paket umrah berikut:</p>

            <div class="panel">
                <p><strong>Paket:</strong> {{ $booking->travel_package->type ?? '-' }}</p>
                <p><strong>Nomor Telepon:</strong> {{ $booking->number_phone }}</p>
                <p><strong>Email:</strong> {{ $booking->email }}</p>
                <p><strong>Jumlah DP:</strong> Rp1.000.000</p>
                <p><strong>Status Pembayaran:</strong> <span style="color: green;"><strong>LUNAS</strong></span></p>
            </div>

            <p>Kami akan segera memproses pemesanan Anda dan menghubungi Anda untuk informasi lebih lanjut.</p>

            <p>Terima kasih atas kepercayaan Anda kepada Haromain Travel!</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Haromain Travel. All rights reserved.
        </div>
    </div>
</body>

</html>