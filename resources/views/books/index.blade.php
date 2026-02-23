@extends('layouts.app')

@section('title', 'Books')

@section('content')
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
        <div>
            <h1 class="text-4xl font-black text-slate-900 tracking-tight">Main Catalog</h1>
            <p class="text-slate-500 font-bold text-[10px] uppercase tracking-[0.2em] mt-2 flex items-center gap-2">
                <span class="w-8 h-[2px] bg-indigo-600"></span>
                Official Book Inventory
            </p>
        </div>
        <div>
            <a href="{{ route('books.create') }}" 
               class="inline-flex items-center gap-3 bg-slate-900 hover:bg-indigo-600 text-white font-black px-8 py-4 rounded-2xl transition-all duration-300 shadow-xl shadow-slate-200 hover:-translate-y-1 uppercase text-[10px] tracking-widest">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path>
                </svg>
                Register New Book
            </a>
        </div>
    </div>

    <!-- Collection Grid -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-50">
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Book Identity</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Authorship</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Classification</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Circulation Status</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse ($books as $book)
                        <tr class="group hover:bg-slate-50/50 transition-all duration-300">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-16 bg-slate-100 rounded-lg flex-shrink-0 flex items-center justify-center text-slate-400 group-hover:bg-indigo-50 group-hover:text-indigo-600 transition-colors">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.168.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-black text-slate-900 leading-tight">{{ $book->title }}</p>
                                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mt-1">ISBN: {{ $book->isbn }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <p class="text-[11px] font-bold text-slate-600">
                                    {{ $book->authors->pluck('name')->join(', ') ?: 'Unassigned' }}
                                </p>
                            </td>
                            <td class="px-8 py-6">
                                <span class="px-3 py-1 bg-slate-100 text-slate-500 text-[10px] font-black uppercase rounded-full tracking-tighter">
                                    {{ $book->genre ?? 'General' }}
                                </span>
                            </td>
                            <td class="px-8 py-6">
                                @if ($book->available_copies > 0)
                                    <div class="flex flex-col gap-1">
                                        <span class="text-[10px] font-black text-emerald-600 uppercase">Available</span>
                                        <div class="w-24 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                            <div class="h-full bg-emerald-500 rounded-full" style="width: {{ ($book->available_copies / $book->total_copies) * 100 }}%"></div>
                                        </div>
                                        <p class="text-[9px] font-bold text-slate-400">{{ $book->available_copies }} of {{ $book->total_copies }} in hub</p>
                                    </div>
                                @else
                                    <div class="flex flex-col gap-1">
                                        <span class="text-[10px] font-black text-rose-500 uppercase">Out of Stock</span>
                                        <div class="w-24 h-1.5 bg-rose-100 rounded-full"></div>
                                        <p class="text-[9px] font-bold text-slate-400">All copies borrowed</p>
                                    </div>
                                @endif
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('books.show', $book) }}" 
                                       class="p-2 text-slate-400 hover:text-indigo-600 transition-colors" title="View details">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                    <a href="{{ route('books.edit', $book) }}" 
                                       class="p-2 text-slate-400 hover:text-amber-500 transition-colors" title="Edit book">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('books.destroy', $book) }}" method="POST" onsubmit="return confirm('Archive this record?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-slate-400 hover:text-rose-500 transition-colors" title="Delete record">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-20 text-center">
                                <div class="flex flex-col items-center gap-4">
                                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center text-slate-300">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.168.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                        </svg>
                                    </div>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">No records found in catalog</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($books->hasPages())
        <div class="mt-10 px-8">
            {{ $books->links() }}
        </div>
    @endif
@endsection
