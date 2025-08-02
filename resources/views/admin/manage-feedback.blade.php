@extends('admin/layouts/main')
@section('title', 'Linkuss - Manage Feedback')
@section('main-section')

    <style>
        body {
            background: #1a1a1a;
            color: #e5e7eb;
        }

        .feedback-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: #2d2d2d;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            text-align: center;
            border: 1px solid #404040;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #3b82f6;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #9ca3af;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .rating-distribution {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .rating-bar {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .rating-stars {
            display: flex;
            gap: 2px;
            color: #fbbf24;
        }

        .rating-count {
            min-width: 60px;
            text-align: right;
            font-weight: 600;
            color: #e5e7eb;
        }

        .rating-progress {
            flex: 1;
            height: 8px;
            background: #404040;
            border-radius: 4px;
            overflow: hidden;
        }

        .rating-fill {
            height: 100%;
            background: linear-gradient(90deg, #fbbf24, #f59e0b);
            transition: width 0.3s ease;
        }

        .feedback-table {
            background: #2d2d2d;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            border: 1px solid #404040;
        }

        .feedback-table th {
            background: #1f1f1f;
            padding: 1rem;
            font-weight: 600;
            color: #e5e7eb;
            text-align: left;
            border-bottom: 1px solid #404040;
        }

        .feedback-table td {
            padding: 1rem;
            border-bottom: 1px solid #404040;
            vertical-align: top;
            color: #d1d5db;
        }

        .feedback-table tr:hover {
            background: #3a3a3a;
        }

        .rating-display {
            display: flex;
            gap: 2px;
            color: #fbbf24;
        }

        .rating-display .empty {
            color: #4b5563;
        }

        .message-preview {
            max-width: 300px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: #d1d5db;
        }

        .message-full {
            max-width: 400px;
            word-wrap: break-word;
        }

        .page-url {
            color: #60a5fa;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .page-url:hover {
            text-decoration: underline;
            color: #93c5fd;
        }

        .feedback-date {
            color: #9ca3af;
            font-size: 0.9rem;
        }

        .no-feedback {
            text-align: center;
            padding: 3rem;
            color: #9ca3af;
        }

        .no-feedback i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #4b5563;
        }

        .container {
            background: #1a1a1a;
        }

        .page-title {
            color: #e5e7eb;
        }

        .page-description {
            color: #9ca3af;
        }

        .rating-distribution-container {
            background: #2d2d2d;
            border: 1px solid #404040;
        }

        .distribution-title {
            color: #e5e7eb;
        }

        .btn-view-message {
            color: #60a5fa;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.2s ease;
        }

        .btn-view-message:hover {
            color: #93c5fd;
            text-decoration: underline;
        }

        .text-gray-400 {
            color: #9ca3af;
        }

        .text-gray-600 {
            color: #9ca3af;
        }

        .text-sm {
            color: #d1d5db;
        }

        .text-xs {
            color: #9ca3af;
        }
    </style>

    <div class="container mx-auto px-4 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-100 mb-2 page-title">Feedback Management</h1>
            <p class="text-gray-400 page-description">Monitor and analyze user feedback</p>
        </div>

        <!-- Statistics Cards -->
        <div class="feedback-stats">
            <div class="stat-card">
                <div class="stat-number">{{ $stats['total'] }}</div>
                <div class="stat-label">Total Feedback</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ number_format($stats['average_rating'], 1) }}</div>
                <div class="stat-label">Average Rating</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $stats['recent_feedback'] }}</div>
                <div class="stat-label">This Week</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $stats['rating_distribution'][5] + $stats['rating_distribution'][4] }}</div>
                <div class="stat-label">Positive (4-5 Stars)</div>
            </div>
        </div>

        <!-- Rating Distribution -->
        <div class="bg-gray-800 rounded-lg shadow-sm p-6 mb-8 rating-distribution-container">
            <h3 class="text-lg font-semibold mb-4 distribution-title">Rating Distribution</h3>
            <div class="rating-distribution">
                @for ($i = 5; $i >= 1; $i--)
                    @php
                        $percentage =
                            $stats['total'] > 0 ? ($stats['rating_distribution'][$i] / $stats['total']) * 100 : 0;
                    @endphp
                    <div class="rating-bar">
                        <div class="rating-stars">
                            @for ($star = 1; $star <= 5; $star++)
                                <i class="fas fa-star {{ $star <= $i ? '' : 'empty' }}"></i>
                            @endfor
                        </div>
                        <div class="rating-count">{{ $stats['rating_distribution'][$i] }}</div>
                        <div class="rating-progress">
                            <div class="rating-fill" style="width: {{ $percentage }}%"></div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>

        <!-- Feedback Table -->
        <div class="feedback-table">
            @if ($feedback->count() > 0)
                <table class="w-full">
                    <thead>
                        <tr>
                            <th>Rating</th>
                            <th>Message</th>
                            <th>Page</th>
                            <th>IP Address</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($feedback as $item)
                            <tr>
                                <td>
                                    <div class="rating-display">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $item->rating ? '' : 'empty' }}"></i>
                                        @endfor
                                        <span class="ml-2 text-sm text-gray-400">({{ $item->rating_text }})</span>
                                    </div>
                                </td>
                                <td>
                                    @if ($item->message)
                                        <div class="message-preview" title="{{ $item->message }}">
                                            {{ Str::limit($item->message, 50) }}
                                        </div>
                                        <button onclick="showFullMessage(this.getAttribute('data-message'))"
                                            data-message="{{ htmlspecialchars($item->message, ENT_QUOTES, 'UTF-8') }}"
                                            class="btn-view-message text-sm">
                                            View full message
                                        </button>
                                    @else
                                        <span class="text-gray-500 italic">No message</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->page_url)
                                        <a href="{{ $item->page_url }}" target="_blank" class="page-url">
                                            {{ Str::limit(parse_url($item->page_url, PHP_URL_PATH) ?: $item->page_url, 30) }}
                                        </a>
                                    @else
                                        <span class="text-gray-500">Unknown</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="text-sm text-gray-400">{{ $item->ip_address }}</span>
                                </td>
                                <td>
                                    <div class="feedback-date">
                                        {{ $item->created_at->format('M j, Y') }}
                                        <br>
                                        <span class="text-xs">{{ $item->created_at->format('g:i A') }}</span>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="p-4 border-t border-gray-700">
                    {{ $feedback->links() }}
                </div>
            @else
                <div class="no-feedback">
                    <i class="fas fa-comment-slash"></i>
                    <h3 class="text-lg font-semibold mb-2">No Feedback Yet</h3>
                    <p>User feedback will appear here once submitted.</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        function showFullMessage(message) {
            // Decode HTML entities and handle special characters
            const decodedMessage = message
                .replace(/&amp;/g, '&')
                .replace(/&lt;/g, '<')
                .replace(/&gt;/g, '>')
                .replace(/&quot;/g, '"')
                .replace(/&#039;/g, "'");

            Swal.fire({
                title: 'Full Message',
                text: decodedMessage,
                icon: 'info',
                confirmButtonText: 'Close',
                width: '600px',
                background: '#2d2d2d',
                color: '#e5e7eb',
                customClass: {
                    popup: 'swal-wide',
                    title: 'text-gray-100',
                    content: 'text-gray-300'
                }
            });
        }
    </script>

@endsection
