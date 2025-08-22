@extends('admin/layouts/main')
@section('title', 'Linkuss - Admin Dashboard')
@section('home', 'active')
@section('main-section')
    <style>
        body {
            background: #181A20;
            color: #F1F1F1;
        }

        .email-box {
            background: linear-gradient(135deg, #23262F 80%, #2d3340 100%);
            border-radius: 22px;
            box-shadow: 0 8px 40px rgba(55, 114, 255, 0.10), 0 1.5px 8px rgba(0, 0, 0, 0.18);
            padding: 2.8rem 2.5rem 2.2rem 2.5rem;
            max-width: 1050px;
            margin: 48px auto;
            border: 1.5px solid #353945;
            position: relative;
            overflow: hidden;
        }

        .email-box:before {
            content: "";
            position: absolute;
            top: -60px;
            right: -60px;
            width: 180px;
            height: 180px;
            background: radial-gradient(circle, #3772FF33 0%, transparent 70%);
            z-index: 0;
        }

        .email-box h2 {
            color: #fff;
            margin-bottom: 2.2rem;
            text-align: center;
            font-size: 2.2rem;
            font-weight: 700;
            letter-spacing: 1px;
            position: relative;
            z-index: 1;
        }

        .form-label {
            color: #B1B5C3;
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: block;
            font-size: 1.04rem;
            letter-spacing: 0.2px;
        }

        .form-row {
            display: flex;
            gap: 1.2rem;
            margin-bottom: 1.7rem;
        }

        .form-group {
            flex: 1;
            position: relative;
        }

        .form-control,
        .form-select,
        textarea {
            background: #23262F;
            color: #F1F1F1;
            border: 1.5px solid #353945;
            border-radius: 12px;
            padding: 1.1rem 1.2rem 1.1rem 2.8rem;
            font-size: 1.08rem;
            width: 100%;
            box-sizing: border-box;
            transition: border 0.2s, box-shadow 0.2s;
            outline: none;
            font-family: inherit;
            font-weight: 500;
        }

        .form-control:focus,
        .form-select:focus,
        textarea:focus {
            border-color: #3772FF;
            box-shadow: 0 0 0 2px rgba(55, 114, 255, 0.13);
        }

        .form-group .input-icon {
            position: absolute;
            left: 1.1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #3772FF;
            font-size: 1.18rem;
            pointer-events: none;
            z-index: 2;
        }

        .form-group textarea.form-control {
            padding-left: 2.8rem;
            min-height: 120px;
            resize: vertical;
        }

        .btn-primary {
            background: linear-gradient(90deg, #3772FF 0%, #9757D7 100%);
            border: none;
            color: #fff;
            font-weight: 700;
            border-radius: 12px;
            padding: 1rem 2rem;
            width: 100%;
            font-size: 1.15rem;
            transition: background 0.2s, box-shadow 0.2s, transform 0.1s;
            box-shadow: 0 2px 12px rgba(55, 114, 255, 0.10);
            letter-spacing: 0.5px;
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background: linear-gradient(90deg, #9757D7 0%, #3772FF 100%);
            box-shadow: 0 4px 24px rgba(151, 87, 215, 0.13);
            transform: translateY(-2px) scale(1.01);
        }

        .alert-success {
            background: linear-gradient(90deg, #29A56C 60%, #43e97b 100%);
            color: #fff;
            border-radius: 10px;
            padding: 0.9rem 1.2rem;
            margin-bottom: 1.7rem;
            text-align: center;
            font-weight: 600;
            font-size: 1.08rem;
            letter-spacing: 0.2px;
        }

        /* Placeholder color */
        .form-control::placeholder,
        textarea::placeholder {
            color: #B1B5C3;
            opacity: 1;
            font-weight: 400;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .email-box {
                max-width: 98vw;
            }
        }

        @media (max-width: 900px) {
            .form-row {
                flex-direction: column;
                gap: 0;
            }

            .email-box {
                padding: 2rem 0.7rem 1.5rem 0.7rem;
            }
        }
    </style>
    <div class="email-box">
        <h2>
            <i class="fa fa-paper-plane" style="color:#3772FF;margin-right:10px;"></i>
            Send Email
        </h2>
        @if (session('success'))
            <div class="alert alert-success" id="success-alert">{{ session('success') }}</div>
            <script>
                setTimeout(function() {
                    var alert = document.getElementById('success-alert');
                    if (alert) {
                        alert.style.display = 'none';
                    }
                }, 2000);
            </script>
        @endif
        <form action="{{ route('admin.sendEmail') }}" method="POST" autocomplete="off">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label for="from" class="form-label">From</label>
                    <span class="input-icon"><i class="fa fa-user-circle"></i></span>
                    <select name="from" id="from" class="form-select" required>
                        <option value="support@linkuss.com">support@linkuss.com</option>
                        <option value="info@linkuss.com">info@linkuss.com</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="to" class="form-label">To (Recipient Email)</label>
                    <span class="input-icon"><i class="fa fa-envelope"></i></span>
                    <input type="email" name="to" id="to" class="form-control"
                        placeholder="recipient@email.com" required>
                </div>
                <div class="form-group">
                    <label for="subject" class="form-label">Subject</label>
                    <span class="input-icon"><i class="fa fa-heading"></i></span>
                    <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject" required>
                </div>
            </div>
            <div class="form-group">
                <label for="content" class="form-label">Content</label>
                <span class="input-icon" style="top:1.7rem;"><i class="fa fa-align-left"></i></span>
                <textarea name="content" id="content" rows="6" class="form-control" placeholder="Type your message here..."
                    required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-paper-plane" style="margin-right:7px;"></i>Send Email
            </button>
        </form>
    </div>
    <!-- Font Awesome CDN for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection
