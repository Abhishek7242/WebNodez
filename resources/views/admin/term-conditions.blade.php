@extends('admin/layouts/main')
@section('title', 'Linkuss - Admin Dashboard')
@section('home', 'active')
@section('main-section')

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

    <div class="terms-container">
        <div class="terms-header">
            <div class="header-content">
                <h2><i class="fas fa-file-contract"></i> Terms and Conditions</h2>
                <button class="add-btn" onclick="showAddForm()">
                    <i class="fas fa-plus"></i> Add New Terms
                </button>
            </div>
        </div>

        <!-- Add Form (Hidden by default) -->
        <div id="addForm" class="add-form-container" style="display: none;">
            <div class="form-card">
                <div class="form-header">
                    <h5><i class="fas fa-plus-circle"></i> Add New Terms</h5>
                    <button class="close-btn" onclick="hideAddForm()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form id="termsForm">
                    <div class="form-group">
                        <label for="title">
                            <i class="fas fa-heading"></i> Title
                        </label>
                        <input type="text" class="form-control" id="title" required>
                    </div>
                    <div class="form-group">
                        <label for="description">
                            <i class="fas fa-align-left"></i> Description
                        </label>
                        <textarea class="form-control" id="description" rows="4" required></textarea>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="save-btn">
                            <i class="fas fa-save"></i> Save
                        </button>
                        <button type="button" class="cancel-btn" onclick="hideAddForm()">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Terms Cards Container -->
        <div id="termsContainer" class="terms-grid">
            <!-- Cards will be dynamically added here -->
        </div>
    </div>

    <script>
        // Sample data (replace with actual data from backend)
        let terms = [{
                id: 1,
                title: "User Responsibilities",
                description: "Users must maintain the confidentiality of their account credentials and are responsible for all activities that occur under their account."
            },
            {
                id: 2,
                title: "Service Usage",
                description: "Our services are provided 'as is' and we make no warranties about the reliability or availability of our services."
            },
            {
                id: 3,
                title: "Privacy Policy",
                description: "We collect and process personal data in accordance with our privacy policy and applicable data protection laws."
            }
        ];

        // Function to show add form
        function showAddForm() {
            const form = document.getElementById('addForm');
            form.style.display = 'block';
            setTimeout(() => form.classList.add('show'), 10);
        }

        // Function to hide add form
        function hideAddForm() {
            const form = document.getElementById('addForm');
            form.classList.remove('show');
            setTimeout(() => {
                form.style.display = 'none';
                document.getElementById('termsForm').reset();
            }, 300);
        }

        // Function to render terms cards
        function renderTerms() {
            const container = document.getElementById('termsContainer');
            container.innerHTML = '';

            terms.forEach(term => {
                const card = `
                    <div class="term-card">
                        <div class="card-content">
                            <div class="card-header">
                                <h5><i class="fas fa-file-alt"></i> ${term.title}</h5>
                                <div class="card-actions">
                                    <button class="action-btn edit" onclick="editTerm(${term.id})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn delete" onclick="deleteTerm(${term.id})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <p class="card-description">${term.description}</p>
                        </div>
                    </div>
                `;
                container.innerHTML += card;
            });
        }

        // Function to handle form submission
        document.getElementById('termsForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const title = document.getElementById('title').value;
            const description = document.getElementById('description').value;

            // Add new term to array
            terms.push({
                id: terms.length + 1,
                title: title,
                description: description
            });

            // Re-render terms and hide form
            renderTerms();
            hideAddForm();
        });

        // Function to edit term
        function editTerm(id) {
            const term = terms.find(t => t.id === id);
            if (term) {
                document.getElementById('title').value = term.title;
                document.getElementById('description').value = term.description;
                showAddForm();
                // Remove the term being edited
                terms = terms.filter(t => t.id !== id);
            }
        }

        // Function to delete term
        function deleteTerm(id) {
            if (confirm('Are you sure you want to delete this term?')) {
                terms = terms.filter(t => t.id !== id);
                renderTerms();
            }
        }

        // Initial render
        renderTerms();
    </script>

    <style>
        .terms-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .terms-header {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-content h2 {
            color: white;
            margin: 0;
            font-size: 1.8rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .add-btn {
            background: white;
            color: #4f46e5;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .add-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .add-form-container {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 1000;
        }

        .add-form-container.show {
            opacity: 1;
        }

        .form-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            width: 90%;
            max-width: 600px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            transform: translateY(20px);
            transition: transform 0.3s ease;
        }

        .add-form-container.show .form-card {
            transform: translateY(0);
        }

        .form-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .form-header h5 {
            margin: 0;
            color: #1f2937;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .close-btn {
            background: none;
            border: none;
            color: #6b7280;
            cursor: pointer;
            font-size: 1.25rem;
            padding: 0.5rem;
            transition: color 0.3s ease;
        }

        .close-btn:hover {
            color: #1f2937;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #4b5563;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .save-btn,
        .cancel-btn {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .save-btn {
            background: #6366f1;
            color: white;
            border: none;
        }

        .save-btn:hover {
            background: #4f46e5;
        }

        .cancel-btn {
            background: #f3f4f6;
            color: #4b5563;
            border: none;
        }

        .cancel-btn:hover {
            background: #e5e7eb;
        }

        .terms-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            padding: 1rem 0;
        }

        .term-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .term-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .card-content {
            padding: 1.5rem;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .card-header h5 {
            margin: 0;
            color: #1f2937;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .card-actions {
            display: flex;
            gap: 0.5rem;
        }

        .action-btn {
            background: none;
            border: none;
            padding: 0.5rem;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .action-btn.edit {
            color: #6366f1;
        }

        .action-btn.delete {
            color: #ef4444;
        }

        .action-btn:hover {
            background: #f3f4f6;
        }

        .card-description {
            color: #6b7280;
            margin: 0;
            line-height: 1.5;
        }

        @media (max-width: 768px) {
            .terms-grid {
                grid-template-columns: 1fr;
            }

            .header-content {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .form-card {
                width: 95%;
                padding: 1.5rem;
            }
        }
    </style>

@endsection
