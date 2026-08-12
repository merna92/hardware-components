@props([
    'title' => 'Silica - Hardware Components'
])

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- Bootstrap 5 CSS & Icons -->
    @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
    @else
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    @endif
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Google Fonts: Orbitron (Logo) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Custom CSS (Mirna, Ali, Kholoud styles) -->
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ali-layout.css') }}">
    
    @if(file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <title>{{ $title }}</title>

    <script>
        // Init Dark Mode from Local Storage
        const savedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-bs-theme', savedTheme);
    </script>
    
    <style>
        /* Dark Mode Overrides */
        [data-bs-theme="dark"] body { background-color: #121212 !important; }
        [data-bs-theme="dark"] .bg-white { background-color: #1e1e1e !important; }
        [data-bs-theme="dark"] .bg-light { background-color: #2d2d2d !important; }
        [data-bs-theme="dark"] .text-dark { color: #f8f9fa !important; }
        [data-bs-theme="dark"] .border { border-color: #333 !important; }
        [data-bs-theme="dark"] .border-bottom { border-color: #333 !important; }
        [data-bs-theme="dark"] .border-top { border-color: #333 !important; }
        [data-bs-theme="dark"] .card, [data-bs-theme="dark"] .custom-navbar { background-color: #1e1e1e !important; border: 1px solid #333 !important; }
        [data-bs-theme="dark"] .text-muted { color: #adb5bd !important; }
        [data-bs-theme="dark"] input.bg-light { background-color: #333 !important; color: white !important; border: 1px solid #444 !important;}
        [data-bs-theme="dark"] .navbar-icon-btn { color: #f8f9fa !important; }
        [data-bs-theme="dark"] .navbar-icon-btn:hover { background-color: #333 !important; color: #db4444 !important; }
    </style>
</head>
<body class="bg-light d-flex flex-column min-vh-100">
    <x-layout.nav />
    
    <div class="flex-grow-1">
        {{ $slot }}
    </div>

    <x-layout.footer />

    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Toast Notifications -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1055;">
        @if(session('success'))
        <div class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body fw-semibold">
                    <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="toast align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body fw-semibold">
                    <i class="bi bi-exclamation-circle me-2"></i> {{ session('error') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
        @endif
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var toastElList = [].slice.call(document.querySelectorAll('.toast'))
            var toastList = toastElList.map(function(toastEl) {
                return new bootstrap.Toast(toastEl, { delay: 3000 })
            });
            toastList.forEach(toast => toast.show());
            
            // Dark Mode Toggle Logic
            const themeToggleBtn = document.getElementById('themeToggleBtn');
            if(themeToggleBtn) {
                const icon = themeToggleBtn.querySelector('i');
                const currentTheme = document.documentElement.getAttribute('data-bs-theme');
                if (currentTheme === 'dark') { icon.classList.replace('bi-moon', 'bi-sun'); }

                themeToggleBtn.addEventListener('click', function() {
                    let theme = document.documentElement.getAttribute('data-bs-theme');
                    if (theme === 'dark') {
                        theme = 'light';
                        icon.classList.replace('bi-sun', 'bi-moon');
                    } else {
                        theme = 'dark';
                        icon.classList.replace('bi-moon', 'bi-sun');
                    }
                    document.documentElement.setAttribute('data-bs-theme', theme);
                    localStorage.setItem('theme', theme);
                });
            }

            document.querySelectorAll('form[data-confirm]').forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();

                    Swal.fire({
                        title: form.dataset.confirm || 'Are you sure?',
                        text: form.dataset.confirmText || 'This action can be changed later when restore is available.',
                        icon: form.dataset.confirmIcon || 'warning',
                        showCancelButton: true,
                        confirmButtonColor: form.dataset.confirmButtonColor || '#dc3545',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: form.dataset.confirmButton || 'Yes, continue',
                    }).then(function(result) {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>
