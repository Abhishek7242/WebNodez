<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Started - {{ $project->project_name }}</title>
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
                            <h1 style="color: #ffffff; margin: 0; font-size: 28px;">Project Started!</h1>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px 30px;">
                            <h2 style="color: #333333; margin-top: 0; margin-bottom: 20px;">Hello!</h2>

                            <p style="color: #555555; font-size: 16px; line-height: 1.6; margin-bottom: 20px;">
                                Great news! Your project <strong>{{ $project->project_name }}</strong> has officially
                                started and is now in progress.
                            </p>

                            <div style="background-color: #f8f9fa; padding: 20px; border-radius: 6px; margin: 20px 0;">
                                <h3
                                    style="color: #333333; margin-top: 0; border-bottom: 2px solid #dee2e6; padding-bottom: 10px;">
                                    Project Details:
                                </h3>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td style="padding: 8px 0; font-size: 16px; color: #555555; width: 120px;">
                                            <strong>Project:</strong>
                                        </td>
                                        <td style="padding: 8px 0; font-size: 16px; color: #555555;">
                                            {{ $project->project_name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 8px 0; font-size: 16px; color: #555555;">
                                            <strong>Status:</strong>
                                        </td>
                                        <td style="padding: 8px 0; font-size: 16px; color: #555555;">
                                            <span
                                                style="background-color: #007bff; color: white; padding: 4px 8px; border-radius: 4px; font-size: 14px;">
                                                {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 8px 0; font-size: 16px; color: #555555;">
                                            <strong>Progress:</strong>
                                        </td>
                                        <td style="padding: 8px 0; font-size: 16px; color: #555555;">
                                            {{ $project->progress_percentage }}%
                                        </td>
                                    </tr>
                                    @if ($project->start_date)
                                        <tr>
                                            <td style="padding: 8px 0; font-size: 16px; color: #555555;">
                                                <strong>Start Date:</strong>
                                            </td>
                                            <td style="padding: 8px 0; font-size: 16px; color: #555555;">
                                                {{ $project->start_date->format('F j, Y') }}
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($project->expected_completion_date)
                                        <tr>
                                            <td style="padding: 8px 0; font-size: 16px; color: #555555;">
                                                <strong>Expected Completion:</strong>
                                            </td>
                                            <td style="padding: 8px 0; font-size: 16px; color: #555555;">
                                                {{ $project->expected_completion_date->format('F j, Y') }}
                                            </td>
                                        </tr>
                                    @endif
                                </table>
                            </div>

                            <p style="color: #555555; font-size: 16px; line-height: 1.6; margin-bottom: 30px;">
                                You can track the progress of your project in real-time by clicking the button below:
                            </p>

                            <!-- CTA Button -->
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="center">
                                        <a href="{{ route('client.progress', $project->uuid) }}"
                                            style="background-color: #007bff; color: #ffffff; padding: 15px 30px; text-decoration: none; border-radius: 6px; font-size: 16px; font-weight: bold; display: inline-block;">
                                            View Project Progress
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <p
                                style="color: #777777; font-size: 14px; line-height: 1.6; margin-top: 30px; margin-bottom: 0;">
                                If you have any questions or need to discuss any aspect of your project, please don't
                                hesitate to reach out to us. We're here to help ensure your project is completed to your
                                satisfaction.
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td
                            style="background-color: #f8f9fa; padding: 20px; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px; text-align: center;">
                            <p style="color: #777777; font-size: 14px; margin: 0;">
                                © {{ date('Y') }} {{ config('app.name', 'Linkuss') }}. All rights reserved.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
