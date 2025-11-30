<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <style>
        /* Base Styles */
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: none;
            width: 100% !important;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        /* Container */
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            margin-top: 20px;
            margin-bottom: 20px;
        }

        /* Header */
        .email-header {
            background-color: #084734;
            /* Primary Color */
            padding: 30px 20px;
            text-align: center;
        }

        .email-header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        /* Content */
        .email-content {
            padding: 40px 30px;
            color: #555555;
            font-size: 16px;
            line-height: 1.6;
        }

        h2 {
            color: #084734;
            font-size: 20px;
            margin-top: 0;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 20px;
        }

        /* Button */
        .btn {
            display: inline-block;
            background-color: #084734;
            color: #ffffff;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 50px;
            font-weight: bold;
            margin-top: 10px;
        }

        /* Footer */
        .email-footer {
            background-color: #f9f9f9;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #999999;
            border-top: 1px solid #eeeeee;
        }

        .email-footer a {
            color: #084734;
            text-decoration: none;
        }

        /* Responsive */
        @media only screen and (max-width: 600px) {
            .email-content {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td align="center" style="padding: 20px 0;">
                <div class="email-container">
                    <!-- Header -->
                    <div class="email-header">
                        <h1>Elegance.</h1>
                    </div>

                    <!-- Content -->
                    <div class="email-content">
                        @yield('content')
                    </div>

                    <!-- Footer -->
                    <div class="email-footer">
                        <p>&copy; {{ date('Y') }} Elegance Beauty Salon. All rights reserved.</p>
                        <p>
                            <a href="{{ route('web.index') }}">Visit Website</a> |
                            <a href="{{ route('web.contact') }}">Contact Us</a>
                        </p>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</body>

</html>