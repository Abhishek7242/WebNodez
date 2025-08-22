<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Linkuss Admin Panel</title>
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
                            style="background-color: #007bff; padding: 30px; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                            <h1 style="color: #ffffff; margin: 0; font-size: 28px;">Linkuss</h1>
                        </td>
                    </tr>
                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px 30px;">
                            <h2 style="color: #333333; margin-top: 0;">Welcome, {{ $adminData['name'] }}!</h2>
                            <p style="color: #555555; font-size: 16px; line-height: 1.6;">
                                Congratulations! You have been added as an admin to the Linkuss Admin Panel.
                            </p>

                            <h3
                                style="color: #333333; border-bottom: 2px solid #eeeeee; padding-bottom: 10px; margin-top: 30px;">
                                Your Login Details:</h3>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td style="padding: 10px 0; font-size: 16px; color: #555555;"><strong>Name:</strong>
                                    </td>
                                    <td style="padding: 10px 0; font-size: 16px; color: #555555;">
                                        {{ $adminData['name'] }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 0; font-size: 16px; color: #555555;">
                                        <strong>Email:</strong>
                                    </td>
                                    <td style="padding: 10px 0; font-size: 16px; color: #555555;">
                                        {{ $adminData['email'] }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 0; font-size: 16px; color: #555555;">
                                        <strong>Password:</strong>
                                    </td>
                                    <td style="padding: 10px 0; font-size: 16px; color: #555555;">
                                        <span
                                            style="font-family: monospace; background-color: #f8f9fa; padding: 2px 6px; border-radius: 3px; border: 1px solid #dee2e6;">{{ trim($adminData['password']) }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 0; font-size: 16px; color: #555555;"><strong>Role:</strong>
                                    </td>
                                    <td style="padding: 10px 0; font-size: 16px; color: #555555;">
                                        {{ ucfirst(str_replace('_', ' ', $adminData['role'])) }}</td>
                                </tr>
                            </table>

                            <p
                                style="background-color: #e9f7ef; color: #155724; padding: 15px; border-radius: 4px; font-size: 14px; margin-top: 20px;">
                                <strong>Note:</strong> You can change your password after logging in for security.
                            </p>

                            <div style="text-align: center; margin: 30px 0;">
                                <a href="{{ url('/admin/login?email=' . urlencode($adminData['email']) . '&password=' . urlencode(trim($adminData['password']))) }}"
                                    style="display: inline-block; background-color: #007bff; color: #ffffff; padding: 12px 30px; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 16px; transition: background-color 0.3s ease;">
                                    Access Admin Dashboard
                                </a>
                                <p style="color: #666666; font-size: 14px; margin-top: 10px; font-style: italic;">
                                    <i class="fas fa-info-circle"></i> Your login credentials will be automatically
                                    filled when you click the button above.
                                </p>
                            </div>

                            <p style="color: #555555; font-size: 16px; line-height: 1.6;">
                                You can now log in to the admin panel as a(n)
                                <strong>{{ ucfirst(str_replace('_', ' ', $adminData['role'])) }}</strong>. If you have
                                any issues, please contact the Super Admin.
                            </p>
                        </td>
                    </tr>
                    <!-- Footer -->
                    <tr>
                        <td align="center"
                            style="padding: 20px; font-size: 12px; color: #999999; background-color: #f1f1f1; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;">
                            <p style="margin: 0 0 10px 0; font-size: 12px; color: #999999;">
                                <strong>Please do not reply to this email.</strong> This is an automated notification
                                from our system.
                            </p>
                            &copy; {{ date('Y') }} Linkuss. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
