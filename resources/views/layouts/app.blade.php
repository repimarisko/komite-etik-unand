<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Komite Etik Universitas Andalas') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Summernote CSS & JS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
@php
    $hideNav = trim((string) $__env->yieldContent('layout_hide_nav')) === 'true';
    $fullWidth = trim((string) $__env->yieldContent('layout_full_width')) === 'true';
@endphp

<body class="font-sans antialiased bg-gray-50">
    @php
        $authUser = auth()->user();
        if ($authUser && !$authUser->relationLoaded('roles')) {
            $authUser->load('roles');
        }
        $roleMenuGroups = $authUser
            ? (collect(config('role_menus', []))
                ->filter(function ($item) use ($authUser) {
                    if ($authUser->hasRole('super_admin')) {
                        return true;
                    }
                    return empty($item['roles']) || $authUser->hasAnyRole($item['roles']);
                })
                ->groupBy('group'))
            : collect();
    @endphp
    @unless ($hideNav)
    <!-- Navigation -->
    <nav class="relative isolate bg-unand-primary shadow-lg top-0 left-0 right-0 z-[120]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <!-- Logo -->
                    <div class="flex-shrink-0">
                        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 text-black text-xl font-bold">
                            <img src="{{ asset('images/logo-unand.png') }}" alt="Logo UNAND" class="h-12 w-12">
                            <span>Komite Etik <br> Universitas Andalas</span>
                        </a>
                    </div>
                    
                    <!-- Navigation Links -->
                    <div class="hidden md:ml-10 md:flex md:space-x-8">
                        <a href="{{ route('dashboard') }}" 
                           class="{{ request()->routeIs('dashboard') ? 'border-white text-black' : 'border-transparent text-black hover:border-green-300 hover:text-green-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition duration-150 ease-in-out">
                            Dashboard
                        </a>
                        
                        <a href="{{ route('profil.index') }}" 
                           class="{{ request()->routeIs('profil.*') ? 'border-white text-black' : 'border-transparent text-black hover:border-green-300 hover:text-green-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition duration-150 ease-in-out">
                            Profil
                        </a>
                        
                        @if($authUser)
                        <!-- Dropdown Menu for Forms - Only for logged in admin -->
                        <div class="relative group">
                            <button class="border-transparent text-unand-100 hover:border-unand-200 hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition duration-150 ease-in-out">
                                Formulir Pengajuan
                                <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            
                            <div class="absolute left-0 mt-2 w-56 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                                <div class="py-1">
                                    <a href="{{ route('pengajuan-baru.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:text-black transition-colors duration-200">
                                        Pengajuan Baru
                                    </a>
                                    <a href="{{ route('perbaikan.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:text-black transition-colors duration-200">
                                        Pengajuan Perbaikan
                                    </a>
                                    <a href="{{ route('amandemen.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:text-black transition-colors duration-200">
                                        Pengajuan Amandemen
                                    </a>
                                    <a href="{{ route('perpanjangan.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:text-black transition-colors duration-200">
                                        Perpanjangan Penelitian
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <a href="{{ route('laporan-akhir.index') }}" 
                           class="{{ request()->routeIs('laporan-akhir.*') ? 'border-white text-black' : 'border-transparent text-black hover:border-green-300 hover:text-green-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition duration-150 ease-in-out">
                            Laporan Akhir
                        </a>
                        
                        <a href="{{ route('ktd-sae.index') }}" 
                           class="{{ request()->routeIs('ktd-sae.*') ? 'border-white text-black' : 'border-transparent text-black hover:border-green-300 hover:text-green-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition duration-150 ease-in-out">
                            Modul KTD-SAE
                        </a>
                        
                        <a href="{{ route('dosen.show') }}" 
                           class="{{ request()->routeIs('dosen.*') ? 'border-white text-black' : 'border-transparent text-black hover:border-green-300 hover:text-green-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition duration-150 ease-in-out">
                            Data Dosen
                        </a>
                        
                        @if($authUser && $authUser->hasRole('super_admin'))
                        <a href="{{ route('admin.news.index') }}" 
                           class="{{ request()->routeIs('admin.news.*') ? 'border-white text-black' : 'border-transparent text-black hover:border-green-300 hover:text-green-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition duration-150 ease-in-out">
                            Kelola Berita
                        </a>
                        @endif

                        @if($authUser && $roleMenuGroups->isNotEmpty())
                        <div class="relative group">
                            <button class="border-transparent text-unand-100 hover:border-unand-200 hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition duration-150 ease-in-out">
                                Menu Peran
                                <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <div class="absolute left-0 mt-2 w-72 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                                <div class="py-2 max-h-96 overflow-y-auto">
                                    @foreach($roleMenuGroups as $groupName => $menus)
                                        <div class="px-4 pt-3 pb-1 text-xs font-semibold text-gray-500 uppercase tracking-wide">
                                            {{ $groupName }}
                                        </div>
                                        @foreach($menus as $menu)
                                            @php
                                                $menuUrl = Route::has($menu['route']) ? route($menu['route']) : '#';
                                            @endphp
                                            <a href="{{ $menuUrl }}" class="block px-4 py-2 text-sm text-gray-700 hover:text-black hover:bg-gray-100 rounded-md transition-colors duration-150">
                                                <div class="font-semibold text-gray-800">{{ $menu['label'] }}</div>
                                                <div class="text-xs text-gray-500">{{ $menu['description'] }}</div>
                                            </a>
                                        @endforeach
                                        @if(!$loop->last)
                                            <div class="border-t border-gray-100 my-2"></div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                        @else
                        <!-- Auth links for guests -->
                        <a href="{{ route('login') }}" 
                           class="{{ request()->routeIs('login') ? 'border-white text-black' : 'border-transparent text-unand-100 hover:border-unand-200 hover:text-black' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition duration-150 ease-in-out">
                            Login
                        </a>
                        <a href="{{ route('register') }}" 
                           class="{{ request()->routeIs('register') ? 'border-white text-black' : 'border-transparent text-unand-100 hover:border-unand-200 hover:text-black' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition duration-150 ease-in-out">
                            Register
                        </a>
                        @endif
                    </div>
                </div>
                
                <!-- User Menu -->
                <div class="hidden md:flex items-center space-x-4">
                    @if($authUser)
                    <div class="relative group">
                        <button class="flex items-center text-unand-100 hover:text-black text-sm font-medium">
                            <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            {{ $authUser->name }}
                            <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                            <div class="py-1">
                                <div class="px-4 py-2 text-sm text-gray-700 border-b">
                                    <div class="font-medium">{{ $authUser->name }}</div>
                                    <div class="text-gray-500">{{ $authUser->email }}</div>
                                </div>
                                @if($authUser->hasAnyRole(['super_admin','verifikator','operator']))
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-unand-600 hover:text-black transition-colors duration-200">
                                    Admin Panel
                                </a>
                                @endif
                                @if($authUser->hasRole('super_admin'))
                                <a href="{{ route('admin.news.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-unand-600 hover:text-black transition-colors duration-200">
                                    Kelola Berita
                                </a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-red-600 hover:text-black transition-colors duration-200">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                
                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button type="button" class="mobile-menu-button inline-flex items-center justify-center p-2 rounded-md text-unand-100 hover:text-black hover:bg-unand-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile menu -->
        <div class="mobile-menu hidden md:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-unand-800">
                <a href="{{ route('dashboard') }}" class="block px-3 py-2 text-base font-medium text-unand-100 hover:text-black hover:bg-unand-700 rounded-md">
                    Dashboard
                </a>
                <a href="{{ route('profil.index') }}" class="block px-3 py-2 text-base font-medium text-unand-100 hover:text-black hover:bg-unand-700 rounded-md">
                    Profil
                </a>
                
                @if($authUser)
                <a href="{{ route('pengajuan-baru.index') }}" class="block px-3 py-2 text-base font-medium text-unand-100 hover:text-black hover:bg-unand-700 rounded-md">
                    Pengajuan Baru
                </a>
                <a href="{{ route('perbaikan.index') }}" class="block px-3 py-2 text-base font-medium text-unand-100 hover:text-black hover:bg-unand-700 rounded-md">
                    Pengajuan Perbaikan
                </a>
                <a href="{{ route('amandemen.index') }}" class="block px-3 py-2 text-base font-medium text-unand-100 hover:text-black hover:bg-unand-700 rounded-md">
                    Pengajuan Amandemen
                </a>
                <a href="{{ route('laporan-akhir.index') }}" class="block px-3 py-2 text-base font-medium text-unand-100 hover:text-black hover:bg-unand-700 rounded-md">
                    Laporan Akhir
                </a>
                <a href="{{ route('perpanjangan.index') }}" class="block px-3 py-2 text-base font-medium text-unand-100 hover:text-black hover:bg-unand-700 rounded-md">
                    Perpanjangan Penelitian
                </a>
                <a href="{{ route('ktd-sae.index') }}" class="block px-3 py-2 text-base font-medium text-unand-100 hover:text-black hover:bg-unand-700 rounded-md">
                    Modul KTD-SAE
                </a>
                <a href="{{ route('dosen.show') }}" class="block px-3 py-2 text-base font-medium text-unand-100 hover:text-black hover:bg-unand-700 rounded-md">
                    Data Dosen
                </a>
                @else
                <a href="{{ route('login') }}" class="block px-3 py-2 text-base font-medium text-unand-100 hover:text-black hover:bg-unand-700 rounded-md">
                    Login
                </a>
                <a href="{{ route('register') }}" class="block px-3 py-2 text-base font-medium text-unand-100 hover:text-black hover:bg-unand-700 rounded-md">
                    Register
                </a>
                @endif

                @if($authUser && $roleMenuGroups->isNotEmpty())
                <div class="border-t border-unand-700 pt-4 mt-4">
                    <div class="px-3 text-sm font-semibold text-unand-100 mb-2">Menu Peran</div>
                    @foreach($roleMenuGroups as $groupName => $menus)
                        <div class="px-3 text-xs uppercase tracking-widest text-unand-300 mt-3 mb-1">
                            {{ $groupName }}
                        </div>
                        @foreach($menus as $menu)
                            @php
                                $menuUrl = Route::has($menu['route']) ? route($menu['route']) : '#';
                            @endphp
                            <a href="{{ $menuUrl }}" class="block px-3 py-2 text-base font-medium text-unand-100 hover:text-black hover:bg-unand-700 rounded-md">
                                <div>{{ $menu['label'] }}</div>
                                <div class="text-xs text-unand-300">{{ $menu['description'] }}</div>
                            </a>
                        @endforeach
                    @endforeach
                </div>
                @endif
                
                <!-- User Info and Logout for Mobile -->
                @if($authUser)
                <div class="border-t border-unand-700 pt-4 pb-3">
                    <div class="px-3 mb-3">
                        <div class="text-base font-medium text-white">{{ $authUser->name }}</div>
                        <div class="text-sm text-unand-300">{{ $authUser->email }}</div>
                    </div>
                    @if($authUser->hasAnyRole(['super_admin','verifikator','operator']))
                    <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 text-base font-medium text-unand-100 hover:text-black hover:bg-unand-700 rounded-md">
                        Admin Panel
                    </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="px-3">
                        @csrf
                        <button type="submit" class="block w-full text-left py-2 text-base font-medium text-unand-100 hover:text-black hover:bg-red-600 rounded-md">
                            Logout
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </nav>
    @endunless
    
    <!-- Page Content -->
    @php
        $mainPaddingTop = $hideNav ? 'pt-0' : 'pt-16';
        $mainPaddingBottom = $fullWidth ? 'pb-0' : 'pb-8';
    @endphp
    <main class="{{ $mainPaddingTop }} {{ $mainPaddingBottom }}">
        @if ($fullWidth)
            @yield('content')
        @else
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @yield('content')
            </div>
        @endif
    </main>
    
    <!-- Mobile Menu Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.querySelector('.mobile-menu-button');
            const mobileMenu = document.querySelector('.mobile-menu');
            
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }
        });
    </script>
    
    <!-- SweetAlert Success Message -->
    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const successMessage = '{{ session('success') }}';
            
            // Extract submission number if present
            const numberMatch = successMessage.match(/dengan nomor: ([A-Z0-9-]+)/);
            const submissionNumber = numberMatch ? numberMatch[1] : '';
            
            let title = 'Berhasil!';
            let text = successMessage;
            
            if (submissionNumber) {
                title = 'Data Berhasil Disimpan!';
                text = 'Data Anda telah berhasil disimpan dengan nomor: ' + submissionNumber;
            }
            
            Swal.fire({
                icon: 'success',
                title: title,
                text: text,
                confirmButtonText: 'OK',
                confirmButtonColor: '#10B981',
                timer: 5000,
                timerProgressBar: true
            });
        });
    </script>
    @endif
    
    <!-- SweetAlert Error Message -->
    @if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan!',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK',
                confirmButtonColor: '#EF4444'
            });
        });
    </script>
    @endif
</body>
</html>
