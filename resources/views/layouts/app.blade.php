<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LibraryMS') }} - @yield('title', 'Dashboard')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-[#f8fafc] text-slate-900">
    <div class="flex h-screen overflow-hidden">
        <!-- SIDEBAR -->
        <aside class="w-72 bg-slate-900 text-white flex flex-col fixed left-0 top-0 h-screen z-50 shadow-2xl">
            <!-- Top Branding -->
            <div class="px-8 py-10">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-indigo-500 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-500/20">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.168.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-black tracking-tighter leading-none">LMS <span class="text-indigo-400">EDU</span></h1>
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mt-1">Library Management System</p>
                    </div>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 px-4 py-2 space-y-1 overflow-y-auto custom-scrollbar">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3.5 rounded-2xl transition-all duration-300 group {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-slate-500 group-hover:text-indigo-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="text-sm font-bold tracking-tight">Dashboard</span>
                </a>

                <div class="pt-4 pb-2 px-4 whitespace-nowrap">
                    <span class="text-[10px] font-black text-slate-600 uppercase tracking-[0.2em]">Management</span>
                </div>

                <!-- Students -->
                <a href="{{ route('students.index') }}"
                   class="flex items-center gap-3 px-4 py-3.5 rounded-2xl transition-all duration-300 group {{ request()->routeIs('students.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('students.*') ? 'text-white' : 'text-slate-500 group-hover:text-indigo-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <span class="text-sm font-bold tracking-tight">Students</span>
                </a>

                <!-- Books -->
                <a href="{{ route('books.index') }}"
                   class="flex items-center gap-3 px-4 py-3.5 rounded-2xl transition-all duration-300 group {{ request()->routeIs('books.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('books.*') ? 'text-white' : 'text-slate-500 group-hover:text-indigo-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.168.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    <span class="text-sm font-bold tracking-tight">Books</span>
                </a>

                <!-- Authors -->
                <a href="{{ route('authors.index') }}"
                   class="flex items-center gap-3 px-4 py-3.5 rounded-2xl transition-all duration-300 group {{ request()->routeIs('authors.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('authors.*') ? 'text-white' : 'text-slate-500 group-hover:text-indigo-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    <span class="text-sm font-bold tracking-tight">Authors</span>
                </a>

                <div class="pt-4 pb-2 px-4 whitespace-nowrap">
                    <span class="text-[10px] font-black text-slate-600 uppercase tracking-[0.2em]">Circulation</span>
                </div>

                <!-- Borrow / Return -->
                <a href="{{ route('borrows.index') }}"
                   class="flex items-center gap-3 px-4 py-3.5 rounded-2xl transition-all duration-300 group {{ request()->routeIs('borrows.index', 'borrows.show', 'borrows.create') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('borrows.index', 'borrows.show', 'borrows.create') ? 'text-white' : 'text-slate-500 group-hover:text-indigo-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                    </svg>
                    <span class="text-sm font-bold tracking-tight">Transactions</span>
                </a>

                <!-- Overdue -->
                <a href="{{ route('borrows.overdue') }}"
                   class="flex items-center gap-3 px-4 py-3.5 rounded-2xl transition-all duration-300 group {{ request()->routeIs('borrows.overdue') ? 'bg-rose-600 text-white shadow-lg shadow-rose-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('borrows.overdue') ? 'text-white' : 'text-slate-500 group-hover:text-rose-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <span class="text-sm font-bold tracking-tight">Overdue</span>
                </a>
            </nav>

            <!-- Bottom User Section -->
            <div class="p-6">
                <div class="bg-slate-800/50 rounded-3xl p-4 border border-slate-700/50">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-tr from-indigo-600 to-violet-600 rounded-xl flex items-center justify-center font-black text-white shadow-lg uppercase">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <div class="flex-1 overflow-hidden">
                            <p class="font-black text-xs text-white truncate">{{ auth()->user()->name }}</p>
                            <p class="text-[9px] font-bold text-slate-500 tracking-wider">LIBRARIAN</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="block">
                        @csrf
                        <button type="submit"
                                class="w-full py-2 bg-slate-700 hover:bg-rose-600 text-white text-[10px] font-black uppercase tracking-widest rounded-xl transition-all duration-300">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- MAIN CONTENT AREA -->
        <div class="flex-1 ml-72 flex flex-col h-screen overflow-hidden">
            <!-- Header Bar -->
            <header class="bg-white/80 backdrop-blur-md border-b border-slate-100 sticky top-0 z-40">
                <div class="flex justify-between items-center px-10 py-6">
                    <div>
                        <h2 class="text-2xl font-black text-slate-900 tracking-tight">@yield('title', 'Dashboard')</h2>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">System Operational</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-6">
                        <div class="h-8 w-[1px] bg-slate-100"></div>
                        <a href="{{ route('profile.edit') }}"
                           class="group flex items-center gap-3 py-2 px-4 bg-slate-50 hover:bg-indigo-50 rounded-2xl transition-all duration-300">
                            <div class="w-8 h-8 rounded-xl bg-white border border-slate-100 flex items-center justify-center text-slate-400 group-hover:text-indigo-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <span class="text-xs font-black text-slate-600 group-hover:text-indigo-600 transition-colors uppercase tracking-widest">Settings</span>
                        </a>
                    </div>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto px-10 py-8 custom-scrollbar">
                <!-- Flash Messages -->
                <div class="mb-8 space-y-3">
                    @if (session('success'))
                        <div class="bg-emerald-50 border border-emerald-100 rounded-3xl p-5 flex items-center gap-4 shadow-sm shadow-emerald-100/50">
                            <div class="w-10 h-10 bg-emerald-500 rounded-2xl flex items-center justify-center text-white shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-black text-emerald-900 uppercase tracking-tight">Success Notification</h4>
                                <p class="text-xs font-bold text-emerald-600 mt-0.5">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="bg-rose-50 border border-rose-100 rounded-3xl p-5 flex items-center gap-4 shadow-sm shadow-rose-100/50">
                            <div class="w-10 h-10 bg-rose-500 rounded-2xl flex items-center justify-center text-white shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-black text-rose-900 uppercase tracking-tight">System Errors</h4>
                                <ul class="mt-0.5">
                                    @foreach ($errors->all() as $error)
                                        <li class="text-xs font-bold text-rose-600">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Main Content -->
                <main class="animate-in fade-in slide-in-from-bottom-4 duration-700 fill-mode-both">
                    @yield('content')
                </main>

                <!-- Simple Footer -->
                <footer class="mt-20 pb-10 border-t border-slate-100 pt-10">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] text-center">
                        &copy; {{ date('Y') }} LMS EDU &bull; TAGUD, REY, CASTRO, SAGAYOC, FRANCISCO
                    </p>
                </footer>
            </div>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.05); border-radius: 10px; }
        .custom-scrollbar:hover::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.1); }
    </style>
</body>
</html>
