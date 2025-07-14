<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Password Change OTP</title>
</head>

<body style="margin: 0; padding: 0; background-color: #f4f7f6; font-family: Arial, sans-serif;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #f4f7f6;">
        <tr>
            <td align="center">
                <table width="600" border="0" cellspacing="0" cellpadding="0"
                    style="background-color: #ffffff; margin: 20px auto; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                    <!-- Header -->
                    <tr>
                        <td align="center"
                            style="background-color: #ff9800; padding: 30px; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                            <h1 style="color: #ffffff; margin: 0; font-size: 28px;">Security Alert</h1>
                        </td>
                    </tr>
                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px 30px;">
                            <h2 style="color: #333333; margin-top: 0;">Your One-Time Password</h2>
                            <p style="color: #555555; font-size: 16px; line-height: 1.6;">
                                A request has been made to change the password for your Linkuss admin account. Please
                                use the following One-Time Password (OTP) to proceed.
                            </p>

                            <div style="text-align: center; margin: 30px 0;">
                                <span
                                    style="display: inline-block; background-color: #e0e0e0; color: #333; font-size: 24px; font-weight: bold; padding: 15px 30px; border-radius: 4px; letter-spacing: 5px;">
                                    {{ $otp }}
                                </span>
                            </div>

                            <p style="color: #555555; font-size: 14px; text-align: center;">
                                This OTP is valid for 10 minutes.
                            </p>

                            <p style="color: #555555; font-size: 16px; line-height: 1.6; margin-top: 30px;">
                                If you did not request this password change, please ignore this email or contact support
                                immediately.
                            </p>
                        </td>
                    </tr>
                    <!-- Footer -->
                    <tr>
                        <td align="center"
                            style="padding: 20px; font-size: 12px; color: #999999; background-color: #f1f1f1; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;">
                            &copy; {{ date('Y') }} Linkuss. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
