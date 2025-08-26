<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>{{ $subjectText }}</title>
</head>

<body
    style="font-family: Arial, sans-serif; background: linear-gradient(135deg, #f4f6fb, #e8ecf7); margin:0; padding:20px;">

    <table align="center" width="650" cellpadding="0" cellspacing="0"
        style="background:#ffffff; border-radius:12px; box-shadow:0 4px 20px rgba(55,114,255,0.15); overflow:hidden;">

        <!-- Header -->
    <tr>
            <td style="padding:25px 32px 10px 32px; text-align:left;">
                <img src="https://linkuss.com/assets/Linkuss_logo.png" alt="Linkuss Logo" style="height:48px;">
            </td>
        </tr>

        <!-- Main Content -->
        <tr>
            <td style="padding:20px 32px; color:#222222; font-size:16px; line-height:1.6;">
                {!! nl2br(e($contentText)) !!}
            </td>
        </tr>

        <!-- Divider -->
        <tr>
            <td style="padding:0 32px;">
                <hr style="border:0; border-top:1.5px solid #eaeaea; margin:30px 0;">
            </td>
        </tr>

   <!-- Social Links -->
        <tr>
            <td align="center" style="padding:0 20px 10px 20px;">
                <a href="https://www.instagram.com/_linkuss?igsh=Z3k5dzlvNWYzeXRq" style="display:inline-block;margin:0 6px;" target="_blank">
                    <img src="https://cdn-icons-png.flaticon.com/24/2111/2111463.png" alt="Instagram">
                </a>
                <a href="https://www.facebook.com/profile.php?id=61579859516381" style="display:inline-block;margin:0 6px;" target="_blank">
                    <img src="https://cdn-icons-png.flaticon.com/24/733/733547.png" alt="Facebook">
                </a>
                <a href="https://x.com/Linkuss?t=kPl0_8r4R6vYPkBK_JAKww&s=09" style="display:inline-block;margin:0 6px;" target="_blank">
                    <img src="https://cdn-icons-png.flaticon.com/24/5968/5968958.png" alt="X (Twitter)">
                </a>
                <a href="http://www.linkedin.com/in/linkuss-digital-solutions-8b014537b" style="display:inline-block;margin:0 6px;" target="_blank">
                    <img src="https://cdn-icons-png.flaticon.com/24/174/174857.png" alt="LinkedIn">
                </a>
            </td>
        </tr>
        <!-- Small Visit Link -->
        <tr>
            <td align="center" style="padding:0 20px 20px 20px;">
                <a href="https://linkuss.com" target="_blank"
                    style="font-size:12px; color:#3772FF; text-decoration:none; font-weight:500;">
                    Visit Linkuss.com
                </a>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td style="padding:10px 32px 25px 32px; text-align:center; font-size:14px; color:#777;">
                Sent from <strong>Linkuss Support Team</strong><br><br>
                <strong style="color:#3772FF;">Best Regards,</strong><br>
                <span style="font-weight:600; color:#222;">The Linkuss Team</span><br><br>
                <div style="font-size:12px; color:#aaa; margin-top:10px;">
                    © {{ date('Y') }} Linkuss. All rights reserved.<br>
                </div>
            </td>
        </tr>
    </table>

</body>

</html>
