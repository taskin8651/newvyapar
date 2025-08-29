{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ trans('panel.site_title') }}</title>

    <!-- Fontawesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<!-- Buttons CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- Buttons JS -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>


    <!-- Tailwind + AlpineJS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f5f3ff',
                            100: '#ede9fe',
                            200: '#ddd6fe',
                            300: '#c4b5fd',
                            400: '#a78bfa',
                            500: '#8b5cf6',
                            600: '#7c3aed',
                            700: '#6d28d9',
                            800: '#5b21b6',
                            900: '#4c1d95',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .sidebar-item { position: relative; }
        .sidebar-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            height: 60%;
            width: 4px;
            background: linear-gradient(to bottom, #8b5cf6, #6d28d9);
            border-radius: 0 4px 4px 0;
        }
    </style>
    @yield('styles')
</head>

<body class="bg-gray-50 min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-72 bg-gradient-to-b from-white to-primary-50 shadow-xl border-r border-gray-100 min-h-screen hidden md:block">
        <div class="p-5 border-b border-gray-200 flex items-center">
            <div class="bg-primary-600 p-2 rounded-lg mr-3">
                <i class="fas fa-rocket text-white text-sm"></i>
            </div>
            <h1 class="text-xl font-bold text-primary-800">{{ trans('panel.site_title') }}</h1>
        </div>

        <nav class="p-4 space-y-1 mt-2">
            <!-- Example Dashboard -->
            <a href="{{ route('admin.home') }}"
               class="sidebar-item flex items-center px-4 py-3 rounded-xl transition-all duration-200 hover:bg-primary-100 hover:shadow-sm hover:pl-5
                {{ request()->is('admin') ? 'bg-primary-100 text-primary-700 font-medium' : 'text-gray-700' }}">
                <div class="bg-primary-100 p-2 rounded-lg">
                    <i class="fas fa-tachometer-alt text-primary-600 w-5"></i>
                </div>
                <span class="ml-3">{{ trans('global.dashboard') }}</span>
                <i class="fas fa-chevron-right text-primary-400 text-xs ml-auto"></i>
            </a>

            {{-- 🔽 Yahan pe apna pura sidebar menu (user management, stock, reports, etc.) Tailwind version daalna hai --}}
            @include('partials.menu')

        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Navbar -->
        <!-- Navbar -->
<header class="flex items-center justify-between bg-white shadow px-6 py-3">
    <div>
        <button class="md:hidden text-gray-600"><i class="fas fa-bars"></i></button>
    </div>

    {{-- 🔹 USER DROPDOWN MENU --}}
    <div class="relative" x-data="{ open: false }">
        <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}"
                 class="w-9 h-9 rounded-full border border-gray-300" alt="User Avatar">
            <span class="hidden md:inline text-gray-700 font-medium">
                {{ Auth::user()->name }}
            </span>
            <i class="fas fa-chevron-down text-gray-500 text-sm"></i>
        </button>

        <!-- Dropdown -->
        <div x-show="open" @click.away="open = false"
             x-transition
             class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden z-50">
            @php
                $role = Auth::user()->roles->pluck('title')->first();
                $company = Auth::user()->select_companies->first();
            @endphp

            <div class="bg-gradient-to-r from-indigo-600 to-indigo-500 px-4 py-3 text-white">
                <div class="flex items-center space-x-3">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}"
                         class="w-12 h-12 rounded-full border-2 border-white" alt="User">
                    <div>
                        <p class="font-semibold">{{ Auth::user()->name }}</p>
                        <p class="text-sm opacity-90">Role: <b>{{ $role ?? 'N/A' }}</b></p>
                        <p class="text-sm opacity-90">Company: <b>{{ $company->company_name ?? 'Not Assigned' }}</b></p>
                    </div>
                </div>
            </div>

            <div class="divide-y divide-gray-100">
                <a href="{{ route('profile.password.edit') }}" 
                   class="flex items-center px-4 py-2 hover:bg-gray-50 text-gray-700">
                    <i class="fas fa-user-cog mr-2 text-indigo-600"></i> Profile
                </a>
                <form id="logoutform" action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" 
                            class="w-full flex items-center px-4 py-2 hover:bg-gray-50 text-red-600">
                        <i class="fas fa-sign-out-alt mr-2"></i> Sign out
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>

        <!-- Page Content -->
        <main class="flex-1 p-6">
            @if(session('message'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
                    {{ session('message') }}
                </div>
            @endif
            @if($errors->count() > 0)
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t text-center py-3 text-gray-500 text-sm">
            <strong>{{ trans('panel.site_title') }}</strong> &copy; {{ trans('global.allRightsReserved') }}
        </footer>
    </div>

    @yield('scripts')
</body>
</html>
