@extends('admin/layouts/main')
@section('title', 'Linkuss - Manage Achievements')
@section('home', 'active')
@section('main-section')

    <!-- Add CSRF Token Meta Tag -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

  <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/canvas-background.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home/intro.css') }}" rel="stylesheet">
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Three.js and other required scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="{{ asset('js/canvas-background.js') }}"></script>

    <!-- Canvas background container -->
    <div id="canvas-background" class="canvas-background"></div>

    <script>
        const el = document.querySelector('#header');
        el.style.setProperty('--intro-bg', 'white');
        el.style.setProperty('--dark-bg', 'white');
    </script>


    <style>
        .achievements-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .achievements-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .achievements-title {
            font-size: 2rem;
            font-weight: 600;
            color: white;
            margin: 0;
        }

        .achievements-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .achievement-card {
            background: rgba(17, 24, 39, 0.7);
            backdrop-filter: blur(10px);
            border-radius: 1rem;
            padding: 1.5rem;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .achievement-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            border-color: rgba(99, 102, 241, 0.3);
        }

        .achievement-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(145deg, #6366f1, #8b5cf6);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .achievement-icon i {
            font-size: 1.5rem;
            color: white;
        }

        .achievement-content {
            display: flex;
            align-items: baseline;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .achievement-number {
            font-size: 2rem;
            font-weight: 600;
            color: #6366f1;
        }

        .achievement-plus {
            font-size: 1.5rem;
            color: #8b5cf6;
        }

        .achievement-label {
            font-size: 1rem;
            color: #e5e7eb;
            margin-bottom: 0.25rem;
        }

        .achievement-desc {
            font-size: 0.875rem;
            color: #9ca3af;
        }

        .achievement-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 1rem;
            gap: 0.5rem;
        }

        .achievement-edit-btn {
            background: rgba(99, 102, 241, 0.1);
            color: #6366f1;
            border: none;
            padding: 0.5rem;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .achievement-edit-btn:hover {
            background: rgba(99, 102, 241, 0.2);
            color: #818cf8;
        }

        /* Form Modal Styles */
        .achievement-form-modal {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(8px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 50;
        }

        .achievement-form-modal.active {
            display: flex !important;
        }

        .achievement-form-container {
            background: linear-gradient(145deg, #1f2937, #111827);
            border-radius: 1.5rem;
            padding: 2rem;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(99, 102, 241, 0.2);
        }

        .achievement-form-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(99, 102, 241, 0.2);
        }

        .achievement-form-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #6366f1;
        }

        .achievement-form-close {
            background: none;
            border: none;
            color: #9ca3af;
            cursor: pointer;
            font-size: 1.25rem;
            transition: color 0.2s;
        }

        .achievement-form-close:hover {
            color: #6366f1;
        }

        .achievement-form-group {
            margin-bottom: 1rem;
        }

        .achievement-form-label {
            display: block;
            color: #e5e7eb;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }

        .achievement-form-input {
            width: 100%;
            background: rgba(17, 24, 39, 0.7);
            border: 1px solid rgba(99, 102, 241, 0.2);
            border-radius: 0.5rem;
            padding: 0.75rem;
            color: white;
            font-size: 0.875rem;
            transition: all 0.2s;
        }

        .achievement-form-input:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.2);
        }

        .achievement-form-button {
            background: linear-gradient(145deg, #6366f1, #8b5cf6);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            width: 100%;
            margin-top: 1rem;
        }

        .achievement-form-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
            background: linear-gradient(145deg, #4f46e5, #7c3aed);
        }
    </style>

    <div class="achievements-container">
        <div class="achievements-header">
            <h1 class="achievements-title">Manage Achievements</h1>
        </div>

        <div class="achievements-grid">
            @foreach ($achievements as $achievement)
                <div class="achievement-card">
                    <div class="achievement-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="achievement-content">
                        <span class="achievement-number">{{ $achievement->number }}</span>
                        <span class="achievement-plus">+</span>
                    </div>
                    <h3 class="achievement-label">{{ $achievement->label }}</h3>
                    <p class="achievement-desc">{{ $achievement->description }}</p>
                    <div class="achievement-actions">
                        <button class="achievement-edit-btn"
                            onclick="editAchievement({{ $achievement->id }}, '{{ $achievement->number }}', '{{ $achievement->label }}', '{{ $achievement->description }}')">
                            <i class="fas fa-edit"></i>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Edit Achievement Form Modal -->
    <div id="achievementFormModal" class="achievement-form-modal">
        <div class="achievement-form-container">
            <div class="achievement-form-header">
                <h2 class="achievement-form-title">Edit Achievement</h2>
                <button class="achievement-form-close" onclick="closeAchievementForm()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="achievementForm">
                <input type="hidden" id="achievementId">
                <div class="achievement-form-group">
                    <label class="achievement-form-label">Number</label>
                    <input type="number" id="achievementNumber" class="achievement-form-input" required>
                </div>
                <div class="achievement-form-group">
                    <label class="achievement-form-label">Label</label>
                    <input type="text" id="achievementLabel" class="achievement-form-input" required>
                </div>
                <div class="achievement-form-group">
                    <label class="achievement-form-label">Description</label>
                    <input type="text" id="achievementDescription" class="achievement-form-input" required>
                </div>
                <button type="submit" class="achievement-form-button">Save Changes</button>
            </form>
        </div>
    </div>
</header>
    <script>
        function editAchievement(id, number, label, description) {
            const modal = document.getElementById('achievementFormModal');
            if (modal) {
                modal.style.display = 'flex';
                modal.classList.add('active');

                // Set form values
                document.getElementById('achievementId').value = id;
                document.getElementById('achievementNumber').value = number;
                document.getElementById('achievementLabel').value = label;
                document.getElementById('achievementDescription').value = description;
            } else {
                console.error('Modal element not found');
            }
        }

        function closeAchievementForm() {
            const modal = document.getElementById('achievementFormModal');
            if (modal) {
                modal.style.display = 'none';
                modal.classList.remove('active');
            }
        }

        document.getElementById('achievementForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const id = document.getElementById('achievementId').value;
            const number = document.getElementById('achievementNumber').value;
            const label = document.getElementById('achievementLabel').value;
            const description = document.getElementById('achievementDescription').value;

            // Send to server
            fetch(`/admin/manage-portfolio/achievements/update/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        number,
                        label,
                        description
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification('Achievement updated successfully', 'success');
                        setTimeout(() => window.location.reload(), 1000);
                    } else {
                        showNotification(data.message || 'Error updating achievement', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Error updating achievement', 'error');
                });

            closeAchievementForm();
        });

        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = `fixed bottom-4 right-4 px-6 py-3 rounded-lg shadow-lg transform transition-all duration-300 translate-y-0 opacity-100 z-50 ${
                type === 'success' ? 'bg-green-500' : 'bg-red-500'
            } text-white`;
            notification.innerHTML = message;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.transform = 'translateY(100%)';
                notification.style.opacity = '0';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }
    </script>

@endsection
