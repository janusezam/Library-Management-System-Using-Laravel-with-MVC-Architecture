@extends('layouts.app')

@section('title', 'Overdue Books')

@section('content')
    <div class="mb-10">
        <h1 class="text-4xl font-black text-slate-900 tracking-tighter">Overdue <span class="text-rose-600">Books</span></h1>
        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mt-2 flex items-center gap-2">
            <span class="w-1.5 h-1.5 bg-rose-500 rounded-full animate-pulse"></span>
            List of students with late returns and fines
        </p>
    </div>

    <!-- Warning Banner -->
    <div class="bg-rose-50 border border-rose-100 rounded-[2rem] p-8 mb-10 flex flex-col md:flex-row items-center gap-6 shadow-xl shadow-rose-100/50">
        <div class="w-14 h-14 bg-rose-600 rounded-2xl flex items-center justify-center shrink-0 shadow-lg shadow-rose-600/20">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
        </div>
        <div>
            <h3 class="text-lg font-black text-rose-900 tracking-tight leading-none mb-2">Late Returns</h3>
            <p class="text-[10px] font-bold text-rose-700 uppercase tracking-widest opacity-80 leading-relaxed">
                The students below have overdue books. Fines are <span class="text-rose-600 font-black">₱10.00</span> per day per book.
            </p>
        </div>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="border-b border-slate-100">
                        <th class="px-8 py-6 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">ID</th>
                        <th class="px-8 py-6 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Student</th>
                        <th class="px-8 py-6 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Days Overdue</th>
                        <th class="px-8 py-6 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Books</th>
                        <th class="px-8 py-6 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Fine</th>
                        <th class="px-8 py-6 text-right text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse ($transactions as $transaction)
                        @php
                            $daysOverdue = (int) abs(now()->diffInDays($transaction->due_date));
                        @endphp
                        <tr class="group hover:bg-rose-50/30 transition-colors duration-300">
                            <td class="px-8 py-6">
                                <span class="text-xs font-black text-slate-400 font-mono tracking-tighter bg-slate-50 px-3 py-1.5 rounded-lg group-hover:bg-rose-100 group-hover:text-rose-600 transition-colors">#{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}</span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center font-black text-slate-400 text-xs border border-white shadow-sm overflow-hidden group-hover:border-rose-200 transition-colors">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($transaction->student->name) }}&background=e11d48&color=fff" alt="">
                                    </div>
                                    <div>
                                        <p class="text-sm font-black text-slate-900 tracking-tight leading-none mb-1 group-hover:text-rose-600 transition-colors">{{ $transaction->student->name }}</p>
                                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ $transaction->student->student_id }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="inline-flex items-center px-4 py-2 rounded-xl bg-rose-100 text-rose-700 text-[10px] font-black uppercase tracking-widest border border-rose-200 shadow-sm">
                                    {{ $daysOverdue }} Days Late
                                </span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-baseline gap-1">
                                    <span class="text-lg font-black text-slate-900 tracking-tighter">{{ $transaction->borrowItems->count() }}</span>
                                    <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Units</span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex flex-col">
                                    <span class="text-xs font-black text-rose-600 tracking-tight leading-none mb-1">
                                        ₱{{ number_format($transaction->borrowItems->where('status', 'borrowed')->count() * $daysOverdue * 10, 2) }}
                                    </span>
                                    <span class="text-[8px] font-black text-slate-400 uppercase tracking-widest">Accrued Fine</span>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <a href="{{ route('borrows.show', $transaction) }}" 
                                   class="inline-flex items-center justify-center p-3 text-slate-400 hover:text-rose-600 hover:bg-rose-100 rounded-xl transition-all duration-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-8 py-20 text-center">
                                <div class="max-w-xs mx-auto">
                                    <div class="w-16 h-16 bg-emerald-50 rounded-[1.5rem] flex items-center justify-center mx-auto mb-4 border border-emerald-100">
                                        <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-black text-emerald-600 tracking-tight">All Clear</p>
                                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mt-1 leading-relaxed">All active transactions are within their allowed timelines.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $transactions->links() }}
    </div>
@endsection
