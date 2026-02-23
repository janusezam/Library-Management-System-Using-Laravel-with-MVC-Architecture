@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-10">
        <h1 class="text-4xl font-black text-slate-900 tracking-tighter">System <span class="text-indigo-600">Overview</span></h1>
        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mt-2 flex items-center gap-2">
            <span class="w-1.5 h-1.5 bg-indigo-500 rounded-full animate-pulse"></span>
            Quick view of library activity and status
        </p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
        <!-- Total Books -->
        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 group hover:bg-slate-900 transition-all duration-500">
            <div class="flex justify-between items-start mb-6">
                <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.168.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <span class="text-[10px] font-black text-emerald-500 uppercase tracking-widest bg-emerald-50 px-3 py-1 rounded-full group-hover:bg-emerald-500/10 transition-all duration-500">Active</span>
            </div>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest group-hover:text-slate-500 transition-all duration-500">Total Books</p>
            <p class="text-4xl font-black text-slate-900 tracking-tighter mt-1 group-hover:text-white transition-all duration-500">{{ $totalBooks }} <span class="text-sm font-bold text-slate-400">Items</span></p>
        </div>

        <!-- Available Books -->
        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 group hover:bg-slate-900 transition-all duration-500">
            <div class="flex justify-between items-start mb-6">
                <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="text-[10px] font-black text-indigo-500 uppercase tracking-widest bg-indigo-50 px-3 py-1 rounded-full group-hover:bg-indigo-500/10 transition-all duration-500">{{ round(($availableBooks / max($totalBooks, 1)) * 100) }}%</span>
            </div>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest group-hover:text-slate-500 transition-all duration-500">Available Books</p>
            <p class="text-4xl font-black text-slate-900 tracking-tighter mt-1 group-hover:text-white transition-all duration-500">{{ $availableBooks }} <span class="text-sm font-bold text-slate-400">Ready</span></p>
        </div>

        <!-- Overdue -->
        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 group hover:bg-rose-600 transition-all duration-500">
            <div class="flex justify-between items-start mb-6">
                <div class="w-12 h-12 bg-rose-50 rounded-2xl flex items-center justify-center text-rose-600 group-hover:bg-white group-hover:text-rose-600 transition-all duration-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                @if($overdueTransactions > 0)
                    <span class="text-[10px] font-black text-white uppercase tracking-widest bg-rose-500 px-3 py-1 rounded-full animate-pulse group-hover:bg-white group-hover:text-rose-600 transition-all duration-500">Notice</span>
                @endif
            </div>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest group-hover:text-rose-100 transition-all duration-500">Overdue Books</p>
            <p class="text-4xl font-black text-slate-900 tracking-tighter mt-1 group-hover:text-white transition-all duration-500">{{ $overdueTransactions }} <span class="text-sm font-bold text-slate-400 group-hover:text-rose-200 transition-all duration-500">Users</span></p>
        </div>
    </div>

    <!-- Secondary Stats -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-10">
        <div class="lg:col-span-3 bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
            <div class="px-10 py-8 border-b border-slate-50 flex justify-between items-center">
                <h3 class="text-xl font-black text-slate-900 tracking-tight">Recent Transactions</h3>
                <a href="{{ route('borrows.index') }}" class="text-[10px] font-black text-indigo-600 uppercase tracking-[0.2em] hover:text-indigo-800 transition-colors">View All</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-10 py-5 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Student</th>
                            <th class="px-10 py-5 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Due Date</th>
                            <th class="px-10 py-5 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse ($recentTransactions as $transaction)
                            <tr class="group hover:bg-slate-50 transition-colors duration-300">
                                <td class="px-10 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center font-black text-[10px] text-slate-500 border border-white shadow-sm overflow-hidden">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($transaction->student->name) }}&background=6366f1&color=fff" alt="">
                                        </div>
                                        <p class="text-sm font-black text-slate-900 tracking-tight group-hover:text-indigo-600 transition-colors">{{ $transaction->student->name }}</p>
                                    </div>
                                </td>
                                <td class="px-10 py-6">
                                    <div class="flex flex-col">
                                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-tight">Due: {{ $transaction->due_date->format('M d') }}</span>
                                        <span class="text-[9px] font-bold text-slate-500 uppercase tracking-tight">Borrowed {{ $transaction->borrow_date->diffForHumans() }}</span>
                                    </div>
                                </td>
                                <td class="px-10 py-6">
                                    @if ($transaction->status === 'active')
                                        <span class="inline-flex px-3 py-1 rounded-lg bg-indigo-50 text-indigo-600 text-[9px] font-black uppercase tracking-widest">Active</span>
                                    @elseif ($transaction->status === 'partially_returned')
                                        <span class="inline-flex px-3 py-1 rounded-lg bg-amber-50 text-amber-600 text-[9px] font-black uppercase tracking-widest">Partial</span>
                                    @else
                                        <span class="inline-flex px-3 py-1 rounded-lg bg-emerald-50 text-emerald-600 text-[9px] font-black uppercase tracking-widest">Returned</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-10 py-10 text-center text-slate-400 font-bold uppercase text-[10px] tracking-widest">Zero Session Activity</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-indigo-600 rounded-[2rem] p-8 text-white shadow-xl shadow-indigo-600/20">
                <p class="text-[10px] font-black text-indigo-200 uppercase tracking-widest mb-1">Total Users</p>
                <p class="text-4xl font-black tracking-tighter">{{ $totalStudents }}</p>
                <p class="text-[9px] font-bold text-indigo-300 uppercase tracking-widest mt-2">People who’ve signed up</p>
            </div>
            <div class="bg-slate-900 rounded-[2rem] p-8 text-white shadow-xl shadow-slate-900/20">
                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1">Creators</p>
                <p class="text-4xl font-black tracking-tighter">{{ $totalAuthors }}</p>
                <p class="text-[9px] font-bold text-slate-500 uppercase tracking-widest mt-2">Authors in our catalog</p>
            </div>
        </div>
    </div>

    <!-- Core Actions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="{{ route('borrows.create') }}" class="group bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 hover:bg-emerald-600 transition-all duration-500">
            <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 mb-6 group-hover:bg-white group-hover:text-emerald-600 transition-all duration-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                </svg>
            </div>
            <h4 class="text-lg font-black text-slate-900 tracking-tight group-hover:text-white transition-all duration-500">New Protocol</h4>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1 group-hover:text-emerald-100 transition-all duration-500">Initialize borrow session</p>
        </a>

        <a href="{{ route('books.create') }}" class="group bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 hover:bg-indigo-600 transition-all duration-500">
            <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 mb-6 group-hover:bg-white group-hover:text-indigo-600 transition-all duration-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <h4 class="text-lg font-black text-slate-900 tracking-tight group-hover:text-white transition-all duration-500">Catalog Entry</h4>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1 group-hover:text-indigo-100 transition-all duration-500">Register new library asset</p>
        </a>

        <a href="{{ route('students.create') }}" class="group bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 hover:bg-slate-900 transition-all duration-500">
            <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-600 mb-6 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
            </div>
            <h4 class="text-lg font-black text-slate-900 tracking-tight group-hover:text-white transition-all duration-500">Member Onboarding</h4>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1 group-hover:text-indigo-400 transition-all duration-500">Register identity record</p>
        </a>
    </div>
@endsection
