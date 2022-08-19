<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Freeshopps.com</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- favicon -->
        <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
        <!-- Font -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700&display=swap" rel="stylesheet">
    </head>

    <body style="font-family: Nunito, sans-serif; font-size: 15px; font-weight: 400;">

        <!-- Hero Start -->
        <div style="margin-top: 50px;">
            <table cellpadding="0" cellspacing="0" style="font-family: Nunito, sans-serif; font-size: 15px; font-weight: 400; max-width: 600px; border: none; margin: 0 auto; border-radius: 6px; overflow: hidden; background-color: #fff; box-shadow: 0 0 3px rgba(60, 72, 88, 0.15);">
                <thead>
                    <tr style="background-color: #eee; padding: 3px 0; text-align: center; color: #fff; font-size: 24px; font-weight: 700; letter-spacing: 1px;">
                        <th scope="col"><img src="{{ asset('logo.png') }}" style="width:80px;" alt=""></th>
                    </tr>
                </thead>

                <tbody>
                    @yield('mail-content')

                    <tr>
                        <td style="padding: 16px 8px; color: #8492a6; background-color: #f8f9fc; text-align: center;">
                            © <script>document.write(new Date().getFullYear())</script> {{ config("app.name") }}.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Hero End -->
    </body>
</html>
