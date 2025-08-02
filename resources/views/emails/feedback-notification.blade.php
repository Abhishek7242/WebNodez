<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Feedback Received - Linkuss</title>
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
                            <p style="color: #ffffff; margin: 10px 0 0 0; font-size: 16px;">New User Feedback</p>
                        </td>
                    </tr>
                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px 30px;">
                            <h2 style="color: #333333; margin-top: 0;">New Feedback Received</h2>
                            <p style="color: #555555; font-size: 16px; line-height: 1.6;">
                                A new feedback has been submitted by a user on your website.
                            </p>

                            <div style="background-color: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0;">
                                <h3 style="color: #333333; margin-top: 0; margin-bottom: 15px;">Feedback Details:</h3>

                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td style="padding: 8px 0; font-size: 16px; color: #555555;">
                                            <strong>Rating:</strong>
                                        </td>
                                        <td style="padding: 8px 0; font-size: 16px; color: #555555;">
                                            <span
                                                style="color: #fbbf24; font-weight: bold;">{{ $feedbackData['rating'] }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 8px 0; font-size: 16px; color: #555555;">
                                            <strong>Message:</strong>
                                        </td>
                                        <td style="padding: 8px 0; font-size: 16px; color: #555555;">
                                            {{ $feedbackData['message'] }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 8px 0; font-size: 16px; color: #555555;">
                                            <strong>Submitted:</strong>
                                        </td>
                                        <td style="padding: 8px 0; font-size: 16px; color: #555555;">
                                            {{ $feedbackData['submitted_at'] }}
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div style="text-align: center; margin: 30px 0;">
                                <a href="{{ url('/admin/manage-feedback') }}"
                                    style="display: inline-block; background-color: #007bff; color: #ffffff; padding: 12px 30px; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 16px; transition: background-color 0.3s ease;">
                                    View All Feedback
                                </a>
                            </div>

                            <p style="color: #555555; font-size: 14px; line-height: 1.6;">
                                You can view and manage all feedback from the admin dashboard. This helps you understand
                                user satisfaction and improve your services.
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
