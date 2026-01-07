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
            <!-- <div class="flex items-center gap-4 text-[#111418] dark:text-white">
                <div class="flex items-center justify-center size-10 rounded-lg bg-primary/10 text-primary">
                    <span class="material-symbols-outlined text-2xl">school</span>
                </div>
                <h2 class="text-lg font-bold leading-tight tracking-[-0.015em]">ระบบจองห้องเรียน</h2>
            </div>
            <div class="hidden sm:flex gap-2">
                <button class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-9 px-4 bg-transparent border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 text-[#111418] dark:text-white text-sm font-bold leading-normal transition-colors">
                    <span class="truncate">ช่วยเหลือ</span>
                </button>
                <button class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-9 px-4 bg-primary text-white text-sm font-bold leading-normal hover:bg-primary-hover transition-colors shadow-sm">
                    <span class="truncate">สมัครสมาชิก</span>
                </button>
            </div> -->


            <div class="flex items-center gap-4">
                <div class="flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined text-3xl">domain</span>
                </div>
                <h2 class="text-[#111418] dark:text-white text-lg font-bold leading-tight tracking-[-0.015em]">ระบบจองห้องเรียน</h2>
            </div>
            <div class="flex flex-1 justify-end gap-8">
                <!-- Desktop Menu -->
                @if(Auth::check()) 
                <div class="hidden md:flex items-center gap-9">
                    <a class="text-[#111418] dark:text-gray-200 text-sm font-medium leading-normal hover:text-primary transition-colors" href="#">หน้าแรก</a>
                    <a class="text-[#111418] dark:text-gray-200 text-sm font-medium leading-normal hover:text-primary transition-colors" href="#">จัดการห้องเรียน</a>
                    <a class="text-[#111418] dark:text-gray-200 text-sm font-medium leading-normal hover:text-primary transition-colors" href="#">จัดการสมาชิก</a>
                    <a class="text-[#111418] dark:text-gray-200 text-sm font-medium leading-normal hover:text-primary transition-colors" href="#">สแกน QR-Code</a>
                    <a class="text-[#111418] dark:text-gray-200 text-sm font-medium leading-normal hover:text-primary transition-colors" href="#">ประวัติการใช้งาน</a>
                </div>

                  <div class="flex items-center gap-4">
                    <button class="flex items-center justify-center overflow-hidden rounded-lg h-10 w-10 bg-[#f0f2f4] dark:bg-zinc-800 text-[#111418] dark:text-white hover:bg-zinc-200 dark:hover:bg-zinc-700 transition-colors">
                        <span class="material-symbols-outlined text-[20px]">notifications</span>
                    </button>
                    <div class="bg-center bg-no-repeat bg-cover rounded-full size-10 border border-zinc-200 dark:border-zinc-700" data-alt="User profile avatar placeholder" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuD415xjaOfAqyrykMEdxulc1aDorL5SGM4aj6EQDqpD3aNxs_EWuCq9O-IK0m_kwg37yqb_vxOb4esQKgh5UL5cli9YgZN8w-G8c68-4zDXSYBC-NfwS6Ys2RUPHUkoRiAyUPdJ30V4eCjNGguqVqOHHBTndtZDyzRU-j6b911RGUjkXKGxz20xZVdbre7utVGTwENvwHDXflHCOHjAWu63Iay6iOAeSi5VBj6j7gB1EOyUchQz2sgm7O448ZWx0UDWpLI5ui2-0DM");'>
                    </div>
                </div>
                @else
                  <!-- <a href="{{url('register')}}" class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-9 px-4 bg-transparent border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 text-[#111418] dark:text-white text-sm font-bold leading-normal transition-colors">
                    <span class="truncate">สมัครสมาชิก</span>
                </a> -->
                <a href="{{url('login')}}" class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-9 px-4 bg-primary text-white text-sm font-bold leading-normal hover:bg-primary-hover transition-colors shadow-sm">
                    <span class="truncate">เข้าสู่ระบบ</span>
                </a>
                @endif
                
              
            </div>
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
        © 2024 ระบบจองห้องเรียน มหาวิทยาลัย. สงวนลิขสิทธิ์.
    </footer>
</body>

</html>