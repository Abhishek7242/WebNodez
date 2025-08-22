<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Form Submission - Linkuss</title>
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
                            <p style="color: #ffffff; margin: 10px 0 0 0; font-size: 16px;">New Contact Form Submission
                            </p>
                        </td>
                    </tr>
                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px 30px;">
                            <h2 style="color: #333333; margin-top: 0;">New Contact Form Submission</h2>
                            <p style="color: #555555; font-size: 16px; line-height: 1.6;">
                                A new contact form has been submitted on your website. Please review the details below
                                and respond accordingly.
                            </p>

                            <div style="background-color: #f8f9fa; padding: 20px; border-radius: 6px; margin: 20px 0;">
                                <h3
                                    style="color: #333333; margin-top: 0; border-bottom: 2px solid #dee2e6; padding-bottom: 10px;">
                                    Contact Details:
                                </h3>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td style="padding: 8px 0; font-size: 16px; color: #555555; width: 120px;">
                                            <strong>Name:</strong>
                                        </td>
                                        <td style="padding: 8px 0; font-size: 16px; color: #555555;">
                                            {{ $contactData['name'] }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 8px 0; font-size: 16px; color: #555555;">
                                            <strong>Email:</strong>
                                        </td>
                                        <td style="padding: 8px 0; font-size: 16px; color: #555555;">
                                            <a href="mailto:{{ $contactData['email'] }}"
                                                style="color: #007bff; text-decoration: none;">{{ $contactData['email'] }}</a>
                                        </td>
                                    </tr>
                                    @if (isset($contactData['phone']) && $contactData['phone'])
                                        <tr>
                                            <td style="padding: 8px 0; font-size: 16px; color: #555555;">
                                                <strong>Phone:</strong>
                                            </td>
                                            <td style="padding: 8px 0; font-size: 16px; color: #555555;">
                                                <a href="tel:{{ $contactData['phone'] }}"
                                                    style="color: #007bff; text-decoration: none;">{{ $contactData['phone'] }}</a>
                                            </td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td style="padding: 8px 0; font-size: 16px; color: #555555;">
                                            <strong>Date:</strong>
                                        </td>
                                        <td style="padding: 8px 0; font-size: 16px; color: #555555;">
                                            {{ $contactData['created_at'] }}</td>
                                    </tr>
                                </table>
                            </div>

                            @if (isset($contactData['message']) && $contactData['message'])
                                <div
                                    style="background-color: #fff3cd; padding: 20px; border-radius: 6px; margin: 20px 0; border-left: 4px solid #ffc107;">
                                    <h4 style="color: #856404; margin-top: 0;">Message:</h4>
                                    <p
                                        style="color: #856404; font-size: 16px; line-height: 1.6; margin: 0; white-space: pre-wrap;">
                                        {{ $contactData['message'] }}</p>
                                </div>
                            @endif

                            <div
                                style="background-color: #d1ecf1; color: #0c5460; padding: 15px; border-radius: 4px; font-size: 14px; margin-top: 20px;">
                                <strong>Action Required:</strong> Please log in to your admin panel to manage this
                                contact form submission and respond to the user.
                            </div>

                            <div style="text-align: center; margin-top: 30px;">
                                <a href="{{ url('/admin/dashboard') }}"
                                    style="background-color: #007bff; color: #ffffff; padding: 12px 30px; text-decoration: none; border-radius: 5px; display: inline-block; font-weight: bold;">
                                    Go to Admin Panel
                                </a>
                            </div>
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
