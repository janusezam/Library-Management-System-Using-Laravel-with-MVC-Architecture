@extends('layouts.app')

@section('title', 'Transactions')

@section('content')
    <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-4xl font-black text-slate-900 tracking-tighter">Library <span class="text-indigo-600">Transactions</span></h1>
            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mt-2 flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-indigo-500 rounded-full animate-pulse"></span>
                Monitoring all book borrows and returns
            </p>
        </div>
        <a href="{{ route('borrows.create') }}" class="group bg-slate-900 hover:bg-indigo-600 text-white font-black uppercase tracking-widest text-[10px] py-4 px-8 rounded-2xl shadow-xl transition-all duration-300 flex items-center gap-3">
            <svg class="w-4 h-4 transition-transform group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path>
            </svg>
            New Borrow
        </a>
    </div>

    <!-- Stats Row -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Active Borrows</p>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-black text-slate-900 tracking-tighter">{{ $transactions->where('status', 'active')->count() }}</span>
                <span class="text-[10px] font-bold text-indigo-500">Live</span>
            </div>
        </div>
        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Overdue</p>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-black text-rose-600 tracking-tighter">{{ $transactions->where('status', 'active')->filter(fn($t) => $t->due_date->isPast())->count() }}</span>
                <span class="text-[10px] font-bold text-rose-400">Alert</span>
            </div>
        </div>
        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Fines</p>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-black text-emerald-600 tracking-tighter">
                    ₱{{ number_format($transactions->sum('total_fine'), 2) }}
                </span>
                <span class="text-[10px] font-bold text-emerald-500">Fixed</span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="border-b border-slate-100">
                        <th class="px-8 py-6 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Transaction ID</th>
                        <th class="px-8 py-6 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Member Identity</th>
                        <th class="px-8 py-6 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Timeline</th>
                        <th class="px-8 py-6 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Details</th>
                        <th class="px-8 py-6 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Status</th>
                        <th class="px-8 py-6 text-right text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse ($transactions as $transaction)
                        <tr class="group hover:bg-slate-50/50 transition-colors duration-300">
                            <td class="px-8 py-6">
                                <span class="text-xs font-black text-slate-400 font-mono tracking-tighter bg-slate-50 px-3 py-1.5 rounded-lg">#{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}</span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center font-black text-slate-400 text-xs border border-white shadow-sm overflow-hidden">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($transaction->student->name) }}&background=6366f1&color=fff" alt="">
                                    </div>
                                    <div>
                                        <p class="text-sm font-black text-slate-900 tracking-tight leading-none mb-1">{{ $transaction->student->name }}</p>
                                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ $transaction->student->student_number }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex flex-col">
                                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Due Date</span>
                                    <span class="text-xs font-bold {{ $transaction->due_date->isPast() && $transaction->status !== 'completed' ? 'text-rose-600' : 'text-slate-600' }}">
                                        {{ $transaction->due_date->format('M d, Y') }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-baseline gap-1">
                                    <span class="text-lg font-black text-slate-900 tracking-tighter">{{ $transaction->borrowItems->count() }}</span>
                                    <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Units</span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                @if ($transaction->status === 'active')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-indigo-50 text-indigo-600 text-[10px] font-black uppercase tracking-widest border border-indigo-100 shadow-sm">
                                        <span class="w-1 h-1 bg-indigo-500 rounded-full animate-pulse"></span>
                                        Active
                                    </span>
                                @elseif ($transaction->status === 'partially_returned')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-amber-50 text-amber-600 text-[10px] font-black uppercase tracking-widest border border-amber-100 shadow-sm">
                                        Partial
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-widest border border-emerald-100 shadow-sm">
                                        Returned
                                    </span>
                                @endif
                            </td>
                            <td class="px-8 py-6 text-right">
                                <a href="{{ route('borrows.show', $transaction) }}" 
                                   class="inline-flex items-center justify-center p-3 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all duration-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-8 py-20 text-center">
                                <div class="max-w-xs mx-auto">
                                    <div class="w-16 h-16 bg-slate-50 rounded-[1.5rem] flex items-center justify-center mx-auto mb-4 border border-slate-100">
                                        <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-black text-slate-900 tracking-tight">No Active Transactions</p>
                                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mt-1 leading-relaxed">The circulation ledger is currently empty. Initialize a new session to begin tracking.</p>
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
