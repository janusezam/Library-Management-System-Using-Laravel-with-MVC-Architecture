@extends('layouts.app')

@section('title', 'Transaction Audit')

@section('content')
    <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-4xl font-black text-slate-900 tracking-tighter">Transaction <span class="text-indigo-600">Audit</span></h1>
            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mt-2 flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-indigo-500 rounded-full animate-pulse"></span>
                Detailed session logging and inventory reconciliation
            </p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('borrows.index') }}" class="bg-white border border-slate-200 text-slate-600 font-black uppercase tracking-widest text-[10px] py-4 px-8 rounded-2xl shadow-sm hover:bg-slate-50 transition-all duration-300">
                Back to Ledger
            </a>
        </div>
    </div>

    <!-- Transaction Summary Card -->
    <div class="bg-slate-900 rounded-[2.5rem] p-10 mb-10 text-white shadow-2xl shadow-slate-900/20 relative overflow-hidden">
        <!-- Decoration -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-500/10 rounded-full blur-3xl -mr-32 -mt-32"></div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 relative z-10">
            <div>
                <p class="text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-4">Member Identity</p>
                <div class="flex items-center gap-6">
                    <div class="w-16 h-16 rounded-[1.5rem] bg-indigo-600 flex items-center justify-center font-black text-2xl shadow-xl shadow-indigo-600/30 overflow-hidden">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($borrow->student->name) }}&background=6366f1&color=fff" alt="">
                    </div>
                    <div>
                        <h2 class="text-3xl font-black tracking-tight leading-none mb-2">{{ $borrow->student->name }}</h2>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-[0.2em] font-mono">{{ $borrow->student->student_number }}</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-8 divide-x divide-slate-800">
                <div class="pl-0 md:pl-0">
                    <div class="mb-6">
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Cycle Window</p>
                        <div class="flex flex-col gap-1">
                            <span class="text-xs font-bold">Start: <span class="text-slate-300">{{ $borrow->borrow_date->format('M d, Y') }}</span></span>
                            <span class="text-xs font-bold">Limit: <span class="{{ $borrow->due_date->isPast() && $borrow->status !== 'completed' ? 'text-rose-400' : 'text-indigo-400' }}">{{ $borrow->due_date->format('M d, Y') }}</span></span>
                        </div>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Protocol Status</p>
                        @if ($borrow->status === 'active')
                            <span class="inline-flex px-3 py-1.5 rounded-lg bg-indigo-500/10 text-indigo-400 text-[10px] font-black uppercase tracking-widest border border-indigo-500/20">
                                Active In-Field
                            </span>
                        @elseif ($borrow->status === 'partially_returned')
                            <span class="inline-flex px-3 py-1.5 rounded-lg bg-amber-500/10 text-amber-400 text-[10px] font-black uppercase tracking-widest border border-amber-500/20">
                                Partial Return
                            </span>
                        @else
                            <span class="inline-flex px-3 py-1.5 rounded-lg bg-emerald-500/10 text-emerald-400 text-[10px] font-black uppercase tracking-widest border border-emerald-500/20">
                                Session Terminated
                            </span>
                        @endif
                    </div>
                </div>
                <div class="pl-8">
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Total Liability</p>
                    <p class="text-4xl font-black {{ $totalFine > 0 ? 'text-rose-500' : 'text-emerald-400' }} tracking-tighter">
                        ₱{{ number_format($totalFine, 2) }}
                    </p>
                    <p class="text-[9px] font-bold text-slate-500 uppercase tracking-widest mt-2 leading-relaxed">
                        {{ $totalFine > 0 ? 'Protocol violation fines accumulated' : 'Account in standing order' }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Transaction Body -->
    <form action="{{ route('borrows.return', $borrow) }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            <!-- Left Side: Book Selection -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
                    <div class="px-10 py-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/30">
                        <div>
                            <h3 class="text-xl font-black text-slate-900 tracking-tight">Inventory Validation</h3>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Select items for return processing</p>
                        </div>
                        <span class="px-4 py-2 bg-indigo-600 text-white text-[10px] font-black uppercase tracking-widest rounded-xl">Step 01</span>
                    </div>

                    <div class="p-0">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-slate-50/50">
                                    <th class="px-10 py-5 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest w-16">
                                        @if($borrow->status !== 'completed')
                                            <input type="checkbox" id="select-all" class="w-6 h-6 rounded-lg border-slate-200 text-indigo-600 focus:ring-indigo-500/20 transition-all cursor-pointer">
                                        @else
                                            #
                                        @endif
                                    </th>
                                    <th class="px-10 py-5 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Asset Details</th>
                                    <th class="px-10 py-5 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Status</th>
                                    <th class="px-10 py-5 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Fine</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @foreach ($borrow->borrowItems as $item)
                                    <tr class="group transition-colors duration-300 {{ $item->status === 'returned' ? 'bg-slate-50/50 opacity-60' : 'hover:bg-indigo-50/30' }}">
                                        <td class="px-10 py-6">
                                            @if ($item->status === 'borrowed')
                                                <input type="checkbox" name="items[]" value="{{ $item->id }}" 
                                                    class="w-6 h-6 rounded-lg border-slate-200 text-indigo-600 focus:ring-indigo-500/20 transition-all cursor-pointer">
                                            @else
                                                <div class="w-6 h-6 rounded-lg bg-emerald-500 flex items-center justify-center text-white shadow-lg shadow-emerald-500/20">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-10 py-6">
                                            <div class="flex flex-col">
                                                <span class="text-sm font-black text-slate-900 tracking-tight group-hover:text-indigo-600 transition-colors">{{ $item->book->title }}</span>
                                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">ISBN: {{ $item->book->isbn }}</span>
                                            </div>
                                        </td>
                                        <td class="px-10 py-6">
                                            @if ($item->status === 'borrowed')
                                                <span class="inline-flex px-3 py-1 rounded-lg bg-amber-50 text-amber-600 text-[9px] font-black uppercase tracking-widest">In Field</span>
                                            @else
                                                <div class="flex flex-col">
                                                    <span class="text-[9px] font-black text-emerald-600 uppercase tracking-widest">Secured</span>
                                                    <span class="text-[8px] font-bold text-slate-400 uppercase mt-0.5">On {{ $item->returned_date?->format('M d, Y') ?? 'N/A' }}</span>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-10 py-6 text-right">
                                            @php
                                                $itemFine = $item->status === 'borrowed' ? $item->computeFine() : $item->fine;
                                            @endphp
                                            <span class="text-sm font-black {{ $itemFine > 0 ? 'text-rose-600' : 'text-slate-400' }}">
                                                ₱{{ number_format($itemFine, 2) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                @if ($borrow->status !== 'completed')
                    <div class="bg-indigo-600 rounded-[2rem] p-8 text-white shadow-xl shadow-indigo-600/20 flex flex-col md:flex-row items-center justify-between gap-6">
                        <div class="flex items-center gap-6">
                            <div class="w-14 h-14 bg-white/10 rounded-2xl flex items-center justify-center backdrop-blur-md">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-black tracking-tight">Protocol Finalization</h4>
                                <p class="text-[10px] font-bold text-indigo-200 uppercase tracking-widest">Verify and close checked assets</p>
                            </div>
                        </div>
                        <button type="submit" class="w-full md:w-auto px-8 py-4 bg-white text-indigo-600 text-[10px] font-black uppercase tracking-widest rounded-2xl hover:bg-slate-900 hover:text-white transition-all duration-500 shadow-lg active:scale-95">
                            Process Return
                        </button>
                    </div>
                @endif
            </div>

            <!-- Right Side: Session Summary -->
            <div class="space-y-6">
                <!-- Status & Identification -->
                <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 p-8">
                    <h5 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6 border-b border-slate-50 pb-4">Audit Metadata</h5>
                    
                    <div class="space-y-6">
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Entry ID</span>
                            <span class="text-[10px] font-black text-slate-900 uppercase font-mono tracking-widest bg-slate-50 px-3 py-1 rounded-lg">#{{ str_pad($borrow->id, 6, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Asset Count</span>
                            <span class="text-sm font-black text-slate-900 tracking-tighter">{{ $borrow->borrowItems->count() }} Items</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">In-Field</span>
                            <span class="text-sm font-black text-amber-600 tracking-tighter">{{ $borrow->borrowItems->where('status', 'borrowed')->count() }} Active</span>
                        </div>
                    </div>
                </div>

                <!-- Transaction Log -->
                <div class="bg-slate-900 rounded-[2.5rem] p-8 text-white shadow-xl shadow-slate-900/20">
                    <h5 class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-6">Timeline Log</h5>
                    <div class="space-y-6 relative before:absolute before:left-[19px] before:top-2 before:bottom-2 before:w-0.5 before:bg-slate-800">
                        <div class="flex gap-6 relative">
                            <div class="w-10 h-10 rounded-xl bg-indigo-600 flex items-center justify-center text-white z-10 shadow-lg shadow-indigo-600/20">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Issued</p>
                                <p class="text-xs font-bold text-slate-200 uppercase">{{ $borrow->borrow_date->format('M d, Y') }}</p>
                            </div>
                        </div>
                        <div class="flex gap-6 relative">
                            <div class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center text-slate-400 z-10">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Deadline</p>
                                <p class="text-xs font-bold text-slate-200 uppercase">{{ $borrow->due_date->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        const selectAll = document.getElementById('select-all');
        if (selectAll) {
            selectAll.addEventListener('change', function() {
                const checkboxes = document.querySelectorAll('input[name="items[]"]');
                checkboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
            });
        }
    </script>
@endsection