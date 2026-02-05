<!DOCTYPE html>
<html class="light" lang="th">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>ระบบจองห้องเรียน</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&family=Noto+Sans+Thai:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" href="{{ asset('/theme/assets/img/logo/logo-cs.png') }}" type="image/x-icon" />

    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#137fec",
                        "primary-hover": "#1068c2",
                        "background-light": "#f6f7f8",
                        "background-dark": "#101922",
                        "text-dark": "#111418",
                        "text-light": "#617589",
                        "surface-light": "#ffffff",
                        "surface-dark": "#2a2d35",
                        "border-light": "#e2e8f0",
                        "border-dark": "#3f424a",
                        "text-main": "#0f172a",
                        "text-muted": "#64748b",
                    },
                    fontFamily: {
                        "display": ["Lexend", "Noto Sans Thai", "sans-serif"],
                        "body": ["Lexend", "Noto Sans Thai", "sans-serif"],
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Lexend', 'Noto Sans Thai', sans-serif;
        }

        .invalid-feedback {
            font-size: .875em;
            color: #dc3545;
        }
        
        /* Dropdown Animation */
        #userDropdownMenu, #adminDropdownMenu {
            transition: all 0.2s ease-in-out;
            transform-origin: top right;
        }
        #userDropdownMenu.hidden, #adminDropdownMenu.hidden {
            opacity: 0;
            transform: scale(0.95);
            pointer-events: none;
        }
        #userDropdownMenu:not(.hidden), #adminDropdownMenu:not(.hidden) {
            opacity: 1;
            transform: scale(1);
            pointer-events: auto;
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark min-h-screen flex flex-col text-[#111418] dark:text-white">
    <header class="w-full bg-white dark:bg-[#1a2632] border-b border-[#f0f2f4] dark:border-gray-800 sticky top-0 z-30">
        <div class="max-w-[1280px] mx-auto px-4 sm:px-10 py-3 flex items-center justify-between">
            <a href="{{ url('/') }}">
                <div class="flex items-center gap-4">
                    <div class="flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined text-3xl">
                            <img src="{{ asset('/theme/assets/img/logo/logo-cs.png') }}" alt="Logo" width="40" onerror="this.style.display='none';this.nextElementSibling.style.display='block'">
                            <span class="material-symbols-outlined text-4xl text-primary hidden">school</span>
                        </span>
                    </div>
                    <h2 class="text-[#111418] dark:text-white text-lg font-bold leading-tight tracking-[-0.015em]">ระบบจองห้องเรียน</h2>
                </div>
            </a>

            <div class="flex flex-1 justify-end gap-4 items-center">
                @if(Auth::check())
                
                @php
                    $role = Auth::user()->role;
                @endphp

                <div class="hidden lg:flex items-center gap-6 mr-4">
                    @if(in_array($role, ['admin', 'officer']))
                        <a class="text-[#111418] dark:text-gray-200 text-sm font-medium leading-normal hover:text-primary transition-colors" href="{{ url('/admin/manage_room') }}">ห้องเรียน</a>
                        <a class="text-[#111418] dark:text-gray-200 text-sm font-medium leading-normal hover:text-primary transition-colors" href="{{ url('/manage_user') }}">จัดการสมาชิก</a>
                        <a class="text-[#111418] dark:text-gray-200 text-sm font-medium leading-normal hover:text-primary transition-colors" href="{{ url('/history') }}">การจองของฉัน</a>
                        
                        <div class="relative">
                            <button id="adminDropdownBtn" class="flex items-center gap-1 text-[#111418] dark:text-gray-200 text-sm font-medium leading-normal hover:text-primary transition-colors focus:outline-none">
                                อื่นๆ
                                <span class="material-symbols-outlined text-[20px]">expand_more</span>
                            </button>
                            
                            <div id="adminDropdownMenu" class="hidden absolute top-full right-0 mt-2 w-48 bg-white dark:bg-[#1a2632] rounded-xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden z-50">
                                <ul class="py-1">
                                    <li>
                                        <a href="{{ url('/create_semesters') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-primary transition-colors">
                                            <span class="material-symbols-outlined text-[18px]">calendar_month</span>
                                            ภาคการศึกษา
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/create_room') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-primary transition-colors">
                                            <span class="material-symbols-outlined text-[18px]">add_location_alt</span>
                                            จัดการห้องเรียน
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/admin/report') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-primary transition-colors">
                                            <span class="material-symbols-outlined text-[#111418] dark:text-white group-hover:text-primary text-[20px]">table_view</span>
                                            Export Excel
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                        <a href="{{ url('/scan_qr') }}" class="flex items-center justify-center size-10 rounded-full bg-gray-100 dark:bg-gray-800 hover:bg-primary hover:text-white text-[#111418] dark:text-gray-200 transition-all" title="สแกน QR-Code">
                            <span class="material-symbols-outlined text-[24px]">qr_code_scanner</span>
                        </a>
                    @endif

                    @if(in_array($role, ['professor', 'students']))
                        <a class="text-[#111418] dark:text-gray-200 text-sm font-medium leading-normal hover:text-primary transition-colors" href="{{ url('/history') }}">การจองของฉัน</a>
                    @endif
                </div>

                <div class="hidden lg:relative lg:block">
                    <button id="userDropdownBtn" class="flex items-center gap-2 focus:outline-none">
                        <div class="bg-center bg-no-repeat bg-cover rounded-full size-10 border border-zinc-200 dark:border-zinc-700 hover:ring-2 hover:ring-primary transition-all" 
                             style='background-image: url("{{ url('/storage')  }}/{{ Auth::user()->photo ?? 'https://lh3.googleusercontent.com/aida-public/AB6AXuD415xjaOfAqyrykMEdxulc1aDorL5SGM4aj6EQDqpD3aNxs_EWuCq9O-IK0m_kwg37yqb_vxOb4esQKgh5UL5cli9YgZN8w-G8c68-4zDXSYBC-NfwS6Ys2RUPHUkoRiAyUPdJ30V4eCjNGguqVqOHHBTndtZDyzRU-j6b911RGUjkXKGxz20xZVdbre7utVGTwENvwHDXflHCOHjAWu63Iay6iOAeSi5VBj6j7gB1EOyUchQz2sgm7O448ZWx0UDWpLI5ui2-0DM' }}");'>
                        </div>
                    </button>

                    <div id="userDropdownMenu" class="hidden absolute right-0 mt-3 w-48 bg-white dark:bg-[#1a2632] rounded-xl shadow-xl border border-gray-100 dark:border-gray-700 z-50 overflow-hidden">
                        <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700">
                            <p class="text-sm font-bold text-gray-900 dark:text-white truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ Auth::user()->email }}</p>
                        </div>
                        <ul class="py-1">
                            <li>
                                <a href="{{ url('/profile') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-[20px]">person</span>
                                    โปรไฟล์
                                </a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center gap-2 px-4 py-2.5 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors" onclick="event.preventDefault();document.getElementById('logout-form-desktop').submit();">
                                    <span class="material-symbols-outlined text-[20px]">logout</span>
                                    ออกจากระบบ
                                </a>
                                <form id="logout-form-desktop" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>

                <button id="mobileMenuBtn" class="lg:hidden flex items-center justify-center overflow-hidden rounded-lg h-10 w-10 bg-[#f0f2f4] dark:bg-zinc-800 text-[#111418] dark:text-white hover:bg-zinc-200 dark:hover:bg-zinc-700 transition-colors">
                    <span class="material-symbols-outlined text-[24px]">menu</span>
                </button>

                <div id="mobileMenuOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden transition-opacity"></div>

                <div id="mobileMenu" class="fixed top-0 right-0 h-full w-80 bg-white dark:bg-zinc-900 shadow-2xl z-50 transform translate-x-full transition-transform duration-300 ease-in-out lg:hidden">
                    <div class="flex flex-col h-full">
                        <div class="flex items-center justify-between p-4 border-b border-zinc-200 dark:border-zinc-800">
                            <h3 class="text-[#111418] dark:text-white text-lg font-bold">เมนู</h3>
                            <button id="closeMenuBtn" class="flex items-center justify-center rounded-lg h-10 w-10 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors">
                                <span class="material-symbols-outlined text-[24px] text-[#111418] dark:text-white">close</span>
                            </button>
                        </div>

                        <div class="flex items-center gap-3 p-4 border-b border-zinc-200 dark:border-zinc-800">
                            <div class="bg-center bg-no-repeat bg-cover rounded-full size-12 border border-zinc-200 dark:border-zinc-700" style='background-image: url("{{ url('/storage')  }}/{{ Auth::user()->photo ?? 'https://lh3.googleusercontent.com/aida-public/AB6AXuD415xjaOfAqyrykMEdxulc1aDorL5SGM4aj6EQDqpD3aNxs_EWuCq9O-IK0m_kwg37yqb_vxOb4esQKgh5UL5cli9YgZN8w-G8c68-4zDXSYBC-NfwS6Ys2RUPHUkoRiAyUPdJ30V4eCjNGguqVqOHHBTndtZDyzRU-j6b911RGUjkXKGxz20xZVdbre7utVGTwENvwHDXflHCOHjAWu63Iay6iOAeSi5VBj6j7gB1EOyUchQz2sgm7O448ZWx0UDWpLI5ui2-0DM' }}");'></div>
                            <div class="flex-1 overflow-hidden">
                                <p class="text-[#111418] dark:text-white text-sm font-semibold truncate">{{ Auth::user()->name }}</p>
                                <p class="text-zinc-500 dark:text-zinc-400 text-xs truncate">{{ Auth::user()->email }}</p>
                                <span class="inline-block mt-1 px-2 py-0.5 rounded text-[10px] font-bold bg-primary/10 text-primary border border-primary/20 uppercase">
                                    {{ $role }}
                                </span>
                            </div>
                        </div>

                        <nav class="flex-1 overflow-y-auto p-2">
                            <a href="{{ url('/') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors group">
                                <span class="material-symbols-outlined text-[#111418] dark:text-white group-hover:text-primary text-[20px]">home</span>
                                <span class="text-[#111418] dark:text-white text-sm font-medium group-hover:text-primary">หน้าแรก</span>
                            </a>

                            @if(in_array($role, ['admin', 'officer']))
                                <a href="{{ url('/admin/manage_room') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors group">
                                    <span class="material-symbols-outlined text-[#111418] dark:text-white group-hover:text-primary text-[20px]">meeting_room</span>
                                    <span class="text-[#111418] dark:text-white text-sm font-medium group-hover:text-primary">ห้องเรียน</span>
                                </a>
                                <a href="{{ url('/manage_user') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors group">
                                    <span class="material-symbols-outlined text-[#111418] dark:text-white group-hover:text-primary text-[20px]">group</span>
                                    <span class="text-[#111418] dark:text-white text-sm font-medium group-hover:text-primary">จัดการสมาชิก</span>
                                </a>
                                
                                <a href="{{ url('/create_semesters') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors group">
                                    <span class="material-symbols-outlined text-[#111418] dark:text-white group-hover:text-primary text-[20px]">calendar_month</span>
                                    <span class="text-[#111418] dark:text-white text-sm font-medium group-hover:text-primary">ภาคการศึกษา</span>
                                </a>
                                <a href="{{ url('/create_room') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors group">
                                    <span class="material-symbols-outlined text-[#111418] dark:text-white group-hover:text-primary text-[20px]">add_location_alt</span>
                                    <span class="text-[#111418] dark:text-white text-sm font-medium group-hover:text-primary">จัดการห้องเรียน</span>
                                </a>
                                <a href="{{ url('/admin/report') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors group">
                                    <span class="material-symbols-outlined text-[#111418] dark:text-white group-hover:text-primary text-[20px]">table_view</span>
                                    <span class="text-[#111418] dark:text-white text-sm font-medium group-hover:text-primary">Export Excel</span>
                                </a>

                                <a href="{{ url('/history') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors group">
                                    <span class="material-symbols-outlined text-[#111418] dark:text-white group-hover:text-primary text-[20px]">history</span>
                                    <span class="text-[#111418] dark:text-white text-sm font-medium group-hover:text-primary">การจองของฉัน</span>
                                </a>
                                <a href="{{ url('/scan_qr') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors group">
                                    <span class="material-symbols-outlined text-[#111418] dark:text-white group-hover:text-primary text-[20px]">qr_code_scanner</span>
                                    <span class="text-[#111418] dark:text-white text-sm font-medium group-hover:text-primary">สแกน QR-Code</span>
                                </a>
                            @endif

                            @if(in_array($role, ['professor', 'students']))
                                <a href="{{ url('/history') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors group">
                                    <span class="material-symbols-outlined text-[#111418] dark:text-white group-hover:text-primary text-[20px]">calendar_month</span>
                                    <span class="text-[#111418] dark:text-white text-sm font-medium group-hover:text-primary">การจองของฉัน</span>
                                </a>
                            @endif
                            
                            <a href="{{ url('/profile') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors group">
                                <span class="material-symbols-outlined text-[#111418] dark:text-white group-hover:text-primary text-[20px]">person</span>
                                <span class="text-[#111418] dark:text-white text-sm font-medium group-hover:text-primary">โปรไฟล์</span>
                            </a>

                        </nav>

                        <div class="p-4 border-t border-zinc-200 dark:border-zinc-800">
                            <a href="{{ route('logout') }}" class="flex items-center justify-center gap-2 w-full px-4 py-3 rounded-lg bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/30 transition-colors" onclick="event.preventDefault();document.getElementById('logout-form-mobile').submit();">
                                <span class="material-symbols-outlined text-red-600 dark:text-red-400 text-[20px]">logout</span>
                                <span class="text-red-600 dark:text-red-400 text-sm font-semibold">ออกจากระบบ</span>
                            </a>
                            <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>

                @else
                <a href="{{url('login')}}" class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-9 px-4 bg-primary text-white text-sm font-bold leading-normal hover:bg-primary-hover transition-colors shadow-sm">
                    <span class="truncate">เข้าสู่ระบบ</span>
                </a>
                @endif
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Mobile Menu Logic
                    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
                    const closeMenuBtn = document.getElementById('closeMenuBtn');
                    const mobileMenu = document.getElementById('mobileMenu');
                    const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');

                    function openMenu() {
                        mobileMenu.classList.remove('translate-x-full');
                        mobileMenuOverlay.classList.remove('hidden');
                        document.body.style.overflow = 'hidden';
                    }

                    function closeMenu() {
                        mobileMenu.classList.add('translate-x-full');
                        mobileMenuOverlay.classList.add('hidden');
                        document.body.style.overflow = '';
                    }

                    if (mobileMenuBtn) mobileMenuBtn.addEventListener('click', openMenu);
                    if (closeMenuBtn) closeMenuBtn.addEventListener('click', closeMenu);
                    if (mobileMenuOverlay) mobileMenuOverlay.addEventListener('click', closeMenu);

                    const menuLinks = mobileMenu?.querySelectorAll('a');
                    menuLinks?.forEach(link => {
                        link.addEventListener('click', closeMenu);
                    });

                    // Desktop Dropdown Logic (User Profile)
                    const userDropdownBtn = document.getElementById('userDropdownBtn');
                    const userDropdownMenu = document.getElementById('userDropdownMenu');

                    if(userDropdownBtn && userDropdownMenu) {
                        userDropdownBtn.addEventListener('click', function(e) {
                            e.stopPropagation();
                            userDropdownMenu.classList.toggle('hidden');
                            // ปิดเมนู admin ถ้าเปิดอยู่
                            if(adminDropdownMenu) adminDropdownMenu.classList.add('hidden');
                        });
                    }

                    // Desktop Dropdown Logic (Admin Menu)
                    const adminDropdownBtn = document.getElementById('adminDropdownBtn');
                    const adminDropdownMenu = document.getElementById('adminDropdownMenu');

                    if(adminDropdownBtn && adminDropdownMenu) {
                        adminDropdownBtn.addEventListener('click', function(e) {
                            e.stopPropagation();
                            adminDropdownMenu.classList.toggle('hidden');
                            // ปิดเมนู user ถ้าเปิดอยู่
                            if(userDropdownMenu) userDropdownMenu.classList.add('hidden');
                        });
                    }

                    // Close dropdowns when clicking outside
                    document.addEventListener('click', function(e) {
                        // Close User Dropdown
                        if (userDropdownBtn && userDropdownMenu && !userDropdownBtn.contains(e.target) && !userDropdownMenu.contains(e.target)) {
                            userDropdownMenu.classList.add('hidden');
                        }
                        // Close Admin Dropdown
                        if (adminDropdownBtn && adminDropdownMenu && !adminDropdownBtn.contains(e.target) && !adminDropdownMenu.contains(e.target)) {
                            adminDropdownMenu.classList.add('hidden');
                        }
                    });
                });
            </script>
        </div>
    </header>

    <main class="flex-grow flex items-center justify-center p-4 sm:p-6">
        @yield('content')

        <div class="fixed top-0 left-0 w-full h-full pointer-events-none -z-10 overflow-hidden">
            <div class="absolute top-[-10%] right-[-5%] w-[500px] h-[500px] bg-blue-100/50 dark:bg-blue-900/10 rounded-full blur-3xl opacity-60"></div>
            <div class="absolute bottom-[-10%] left-[-5%] w-[600px] h-[600px] bg-indigo-100/50 dark:bg-indigo-900/10 rounded-full blur-3xl opacity-60"></div>
        </div>
    </main>

    <footer class="py-6 text-center text-sm text-[#617589] dark:text-gray-500">
        ระบบจองห้องเรียน boomth.com
    </footer>
</body>

</html>