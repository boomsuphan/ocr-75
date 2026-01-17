<!DOCTYPE html>

<html class="light" lang="th">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>หน้าเข้าสู่ระบบ - ระบบจองห้องเรียน</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&amp;family=Noto+Sans+Thai:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
	<link rel="shortcut icon" href="{{ asset('/theme/assets/img/logo/logo-cs-2.png') }}" type="image/x-icon" />

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
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark min-h-screen flex flex-col text-[#111418] dark:text-white">
    <!-- Top Navigation Bar -->
    <header class="w-full bg-white dark:bg-[#1a2632] border-b border-[#f0f2f4] dark:border-gray-800">
        <div class="max-w-[1280px] mx-auto px-4 sm:px-10 py-3 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined text-3xl">
                        <img src="{{ asset('/theme/assets/img/logo/logo-cs.png') }}" alt="" width="40">
                    </span>
                </div>
                <h2 class="text-[#111418] dark:text-white text-lg font-bold leading-tight tracking-[-0.015em]">ระบบจองห้องเรียน</h2>
            </div>

            <div class="flex flex-1 justify-end gap-4">
                @if(Auth::check())
                <!-- Desktop Menu -->
                <div class="hidden lg:flex items-center gap-9">
                    <a class="text-[#111418] dark:text-gray-200 text-sm font-medium leading-normal hover:text-primary transition-colors" href="#">หน้าแรก</a>
                    <a class="text-[#111418] dark:text-gray-200 text-sm font-medium leading-normal hover:text-primary transition-colors" href="#">จัดการห้องเรียน</a>
                    <a class="text-[#111418] dark:text-gray-200 text-sm font-medium leading-normal hover:text-primary transition-colors" href="#">จัดการสมาชิก</a>
                    <a class="text-[#111418] dark:text-gray-200 text-sm font-medium leading-normal hover:text-primary transition-colors" href="#">สแกน QR-Code</a>
                    <a class="text-[#111418] dark:text-gray-200 text-sm font-medium leading-normal hover:text-primary transition-colors" href="#">ประวัติการใช้งาน</a>

                </div>

                <!-- Desktop User Actions -->
                <div class="hidden lg:flex items-center gap-4">
                    <a class="flex items-center justify-center overflow-hidden rounded-lg h-10 w-10 rounded-lg bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/30 transition-colors dark:bg-zinc-800 text-[#db2d2e] dark:text-white transition-colors cursor-pointer" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <span class="material-symbols-outlined text-[20px]">logout</span>
                    </a>

                    <div class="bg-center bg-no-repeat bg-cover rounded-full size-10 border border-zinc-200 dark:border-zinc-700" data-alt="User profile avatar placeholder" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuD415xjaOfAqyrykMEdxulc1aDorL5SGM4aj6EQDqpD3aNxs_EWuCq9O-IK0m_kwg37yqb_vxOb4esQKgh5UL5cli9YgZN8w-G8c68-4zDXSYBC-NfwS6Ys2RUPHUkoRiAyUPdJ30V4eCjNGguqVqOHHBTndtZDyzRU-j6b911RGUjkXKGxz20xZVdbre7utVGTwENvwHDXflHCOHjAWu63Iay6iOAeSi5VBj6j7gB1EOyUchQz2sgm7O448ZWx0UDWpLI5ui2-0DM");'></div>
                </div>

                <!-- Mobile Hamburger Button -->
                <button id="mobileMenuBtn" class="lg:hidden flex items-center justify-center overflow-hidden rounded-lg h-10 w-10 bg-[#f0f2f4] dark:bg-zinc-800 text-[#111418] dark:text-white hover:bg-zinc-200 dark:hover:bg-zinc-700 transition-colors">
                    <span class="material-symbols-outlined text-[24px]">menu</span>
                </button>

                <div id="mobileMenuOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden transition-opacity"></div>

                <!-- Mobile Menu Sidebar -->
                <div id="mobileMenu" class="fixed top-0 right-0 h-full w-80 bg-white dark:bg-zinc-900 shadow-2xl z-50 transform translate-x-full transition-transform duration-300 ease-in-out lg:hidden">
                    <div class="flex flex-col h-full">
                        <!-- Menu Header -->
                        <div class="flex items-center justify-between p-4 border-b border-zinc-200 dark:border-zinc-800">
                            <h3 class="text-[#111418] dark:text-white text-lg font-bold">เมนู</h3>
                            <button id="closeMenuBtn" class="flex items-center justify-center rounded-lg h-10 w-10 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors">
                                <span class="material-symbols-outlined text-[24px] text-[#111418] dark:text-white">close</span>
                            </button>
                        </div>

                        <!-- User Profile Section -->
                        <div class="flex items-center gap-3 p-4 border-b border-zinc-200 dark:border-zinc-800">
                            <div class="bg-center bg-no-repeat bg-cover rounded-full size-12 border border-zinc-200 dark:border-zinc-700" data-alt="User profile avatar" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuD415xjaOfAqyrykMEdxulc1aDorL5SGM4aj6EQDqpD3aNxs_EWuCq9O-IK0m_kwg37yqb_vxOb4esQKgh5UL5cli9YgZN8w-G8c68-4zDXSYBC-NfwS6Ys2RUPHUkoRiAyUPdJ30V4eCjNGguqVqOHHBTndtZDyzRU-j6b911RGUjkXKGxz20xZVdbre7utVGTwENvwHDXflHCOHjAWu63Iay6iOAeSi5VBj6j7gB1EOyUchQz2sgm7O448ZWx0UDWpLI5ui2-0DM");'></div>
                            <div class="flex-1">
                                <p class="text-[#111418] dark:text-white text-sm font-semibold">ชื่อผู้ใช้</p>
                                <p class="text-zinc-500 dark:text-zinc-400 text-xs">user@example.com</p>
                            </div>
                        </div>

                        <!-- Menu Items -->
                        <nav class="flex-1 overflow-y-auto p-2">
                            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors group">
                                <span class="material-symbols-outlined text-[#111418] dark:text-white group-hover:text-primary text-[20px]">home</span>
                                <span class="text-[#111418] dark:text-white text-sm font-medium group-hover:text-primary">หน้าแรก</span>
                            </a>
                            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors group">
                                <span class="material-symbols-outlined text-[#111418] dark:text-white group-hover:text-primary text-[20px]">meeting_room</span>
                                <span class="text-[#111418] dark:text-white text-sm font-medium group-hover:text-primary">จัดการห้องเรียน</span>
                            </a>
                            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors group">
                                <span class="material-symbols-outlined text-[#111418] dark:text-white group-hover:text-primary text-[20px]">group</span>
                                <span class="text-[#111418] dark:text-white text-sm font-medium group-hover:text-primary">จัดการสมาชิก</span>
                            </a>
                            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors group">
                                <span class="material-symbols-outlined text-[#111418] dark:text-white group-hover:text-primary text-[20px]">qr_code_scanner</span>
                                <span class="text-[#111418] dark:text-white text-sm font-medium group-hover:text-primary">สแกน QR-Code</span>
                            </a>
                            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors group">
                                <span class="material-symbols-outlined text-[#111418] dark:text-white group-hover:text-primary text-[20px]">history</span>
                                <span class="text-[#111418] dark:text-white text-sm font-medium group-hover:text-primary">ประวัติการใช้งาน</span>
                            </a>

                        </nav>

                        <!-- Logout Button -->
                        <div class="p-4 border-t border-zinc-200 dark:border-zinc-800">
                            <a href="{{ route('logout') }}" class="flex items-center justify-center gap-2 w-full px-4 py-3 rounded-lg bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/30 transition-colors" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <span class="material-symbols-outlined text-red-600 dark:text-red-400 text-[20px]">logout</span>
                                <span class="text-red-600 dark:text-red-400 text-sm font-semibold">ออกจากระบบ</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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

                    if (mobileMenuBtn) {
                        mobileMenuBtn.addEventListener('click', openMenu);
                    }

                    if (closeMenuBtn) {
                        closeMenuBtn.addEventListener('click', closeMenu);
                    }

                    if (mobileMenuOverlay) {
                        mobileMenuOverlay.addEventListener('click', closeMenu);
                    }

                    // Close menu when clicking on menu links
                    const menuLinks = mobileMenu?.querySelectorAll('a');
                    menuLinks?.forEach(link => {
                        link.addEventListener('click', closeMenu);
                    });
                });
            </script>


        </div>


    </header>


    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center p-4 sm:p-6">
        @yield('content')

        <!-- Background Elements for Desktop (Subtle) -->
        <div class="fixed top-0 left-0 w-full h-full pointer-events-none -z-10 overflow-hidden">
            <!-- Abstract Blur Top Right -->
            <div class="absolute top-[-10%] right-[-5%] w-[500px] h-[500px] bg-blue-100/50 dark:bg-blue-900/10 rounded-full blur-3xl opacity-60"></div>
            <!-- Abstract Blur Bottom Left -->
            <div class="absolute bottom-[-10%] left-[-5%] w-[600px] h-[600px] bg-indigo-100/50 dark:bg-indigo-900/10 rounded-full blur-3xl opacity-60"></div>
        </div>
    </main>
    <!-- Footer (Simple) -->
    <footer class="py-6 text-center text-sm text-[#617589] dark:text-gray-500">
        ระบบจองห้องเรียน boomth.com
    </footer>
</body>

</html>