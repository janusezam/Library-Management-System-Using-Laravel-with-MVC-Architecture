@extends('layouts.app')

@section('title', 'Student Profile')

@section('content')
    <div class="max-w-5xl mx-auto">
        <!-- Header -->
        <div class="flex items-center gap-6 mb-10">
            <a href="{{ route('students.index') }}" 
               class="w-12 h-12 bg-white rounded-2xl shadow-sm border border-slate-100 flex items-center justify-center text-slate-400 hover:text-indigo-600 hover:border-indigo-100 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tight">Student Profile</h1>
                <p class="text-slate-500 font-bold text-[10px] uppercase tracking-[0.2em] mt-1">Detailed membership dossier</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left: ID Card -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden sticky top-8">
                    <div class="h-32 bg-indigo-600 relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-500 to-violet-600 opacity-90"></div>
                        <div class="absolute -bottom-12 left-1/2 -translate-x-1/2 w-24 h-24 bg-white rounded-3xl shadow-lg border-4 border-white flex items-center justify-center font-black text-3xl text-indigo-600 uppercase">
                            {{ substr($student->name, 0, 1) }}
                        </div>
                    </div>
                    <div class="pt-16 pb-10 px-8 text-center">
                        <h2 class="text-xl font-black text-slate-900 tracking-tight">{{ $student->name }}</h2>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">{{ $student->student_id }}</p>
                        
                        <div class="mt-8 flex flex-wrap justify-center gap-2">
                            <span class="px-3 py-1 bg-indigo-50 text-indigo-600 text-[10px] font-black uppercase rounded-full">
                                {{ $student->course }}
                            </span>
                            <span class="px-3 py-1 bg-slate-50 text-slate-500 text-[10px] font-black uppercase rounded-full">
                                Year {{ $student->year_level }}
                            </span>
                        </div>

                        <div class="mt-10 pt-8 border-t border-slate-50 grid grid-cols-1 gap-6 text-left">
                            <div>
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1 px-1">Email Address</p>
                                <p class="text-sm font-bold text-slate-700 px-1">{{ $student->email }}</p>
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1 px-1">Mobile Contact</p>
                                <p class="text-sm font-bold text-slate-700 px-1">{{ $student->contact_number ?? 'Not registered' }}</p>
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1 px-1">Joined Core</p>
                                <p class="text-sm font-bold text-slate-700 px-1">{{ $student->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>

                        <div class="mt-10">
                            <a href="{{ route('students.edit', $student) }}" 
                               class="block w-full py-4 bg-slate-900 hover:bg-indigo-600 text-white font-black uppercase tracking-widest text-[10px] rounded-2xl transition-all duration-300">
                                Modify profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Activity History -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-10">
                    <div class="flex items-center justify-between mb-10">
                        <div>
                            <h3 class="text-2xl font-black text-slate-900 tracking-tight">Circulation History</h3>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Recent borrow & return logs</p>
                        </div>
                        <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-indigo-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>

                    <div class="space-y-6">
                        @forelse ($student->borrowTransactions as $transaction)
                            <div class="group border border-slate-100 rounded-3xl p-6 hover:bg-slate-50/50 transition-all duration-300">
                                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-white rounded-2xl shadow-sm border border-slate-100 flex items-center justify-center">
                                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.168.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Transaction #{{ $transaction->id }}</p>
                                            <h4 class="text-sm font-black text-slate-900 leading-tight">Borrowed on {{ $transaction->borrow_date->format('M d, Y') }}</h4>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-end gap-1">
                                        @if ($transaction->status === 'active')
                                            <span class="px-3 py-1 bg-blue-50 text-blue-600 text-[9px] font-black uppercase rounded-full">In Possession</span>
                                        @elseif ($transaction->status === 'partially_returned')
                                            <span class="px-3 py-1 bg-amber-50 text-amber-600 text-[9px] font-black uppercase rounded-full">Incomplete</span>
                                        @else
                                            <span class="px-3 py-1 bg-emerald-50 text-emerald-600 text-[9px] font-black uppercase rounded-full">Closed</span>
                                        @endif
                                        <p class="text-[10px] font-bold text-slate-400">Due: {{ $transaction->due_date->format('M d, Y') }}</p>
                                    </div>
                                </div>

                                <div class="bg-white rounded-2xl p-4 border border-slate-50 mb-6">
                                    <ul class="space-y-3">
                                        @foreach ($transaction->borrowItems as $item)
                                            <li class="flex items-center justify-between text-xs font-bold text-slate-600">
                                                <div class="flex items-center gap-2">
                                                    <div class="w-1.5 h-1.5 rounded-full bg-slate-300"></div>
                                                    {{ $item->book->title }}
                                                </div>
                                                @if ($item->returned_date)
                                                    <span class="text-[9px] font-black text-emerald-500 uppercase">Returned {{ $item->returned_date->format('M d') }}</span>
                                                @else
                                                    <span class="animate-pulse text-[9px] font-black text-rose-500 uppercase">Pending</span>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="flex items-center justify-between pt-4 border-t border-slate-50">
                                    <p class="text-[10px] font-black text-rose-600 uppercase tracking-tight">Fine: ₱{{ number_format($transaction->total_fine, 2) }}</p>
                                    <a href="{{ route('borrows.show', $transaction) }}" 
                                       class="text-[10px] font-black text-indigo-600 uppercase tracking-widest hover:underline">
                                        Inspect Audit
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="py-20 text-center">
                                <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.3em]">No Historical Data</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
