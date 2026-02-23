@extends('layouts.app')

@section('title', 'Book Details')

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Header & Actions -->
        <div class="flex items-center justify-between mb-10">
            <div class="flex items-center gap-6">
                <a href="{{ route('books.index') }}" 
                   class="w-12 h-12 bg-white rounded-2xl shadow-sm border border-slate-100 flex items-center justify-center text-slate-400 hover:text-indigo-600 hover:border-indigo-100 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 tracking-tight">Book Dossier</h1>
                    <p class="text-slate-500 font-bold text-[10px] uppercase tracking-[0.2em] mt-1">Classification & Inventory details</p>
                </div>
            </div>
            <a href="{{ route('books.edit', $book) }}" 
               class="bg-amber-50 text-amber-600 font-black px-6 py-3 rounded-xl hover:bg-amber-100 transition-all uppercase text-[10px] tracking-widest border border-amber-100">
                Modify Record
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-10">
            <!-- Left: Book Cover & Main Info -->
            <div class="md:col-span-8">
                <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden p-10">
                    <div class="flex flex-col sm:flex-row gap-8">
                        <!-- Cover Placeholder -->
                        <div class="w-full sm:w-48 h-64 bg-slate-900 rounded-2xl flex flex-col items-center justify-center p-6 text-center shrink-0">
                            <div class="w-12 h-1 bg-indigo-500 mb-4 rounded-full"></div>
                            <h3 class="text-white text-xs font-black uppercase tracking-widest line-clamp-3 mb-2">{{ $book->title }}</h3>
                            <svg class="w-10 h-10 text-indigo-500/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.168.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>

                        <!-- Main Content -->
                        <div class="flex-1">
                            <h2 class="text-2xl font-black text-slate-900 leading-tight mb-4">{{ $book->title }}</h2>
                            
                            <div class="space-y-6">
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Assigned Authors</p>
                                    <div class="flex flex-wrap gap-2">
                                        @forelse ($book->authors as $author)
                                            <span class="px-3 py-1 bg-indigo-50 text-indigo-600 text-[10px] font-black uppercase rounded-full">
                                                {{ $author->name }}
                                            </span>
                                        @empty
                                            <p class="text-[11px] font-bold text-slate-400 italic">No authors established</p>
                                        @endforelse
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-6 pt-6 border-t border-slate-50">
                                    <div>
                                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Standard ISBN</p>
                                        <p class="text-sm font-bold text-slate-700 font-mono">{{ $book->isbn }}</p>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Genre/Category</p>
                                        <p class="text-sm font-bold text-slate-700">{{ $book->genre ?? 'General' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Publish Year</p>
                                        <p class="text-sm font-bold text-slate-700">{{ $book->published_year ?? 'Not specified' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Added to hub</p>
                                        <p class="text-sm font-bold text-slate-700">{{ $book->created_at->format('M d, Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Circulation Overview -->
            <div class="md:col-span-4">
                <div class="bg-indigo-600 rounded-[2.5rem] shadow-xl shadow-indigo-200/50 p-8 text-white relative overflow-hidden">
                    <!-- Decor -->
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                    
                    <h4 class="text-[10px] font-black uppercase tracking-widest mb-8 opacity-80">Circulation Logistics</h4>
                    
                    <div class="space-y-8 relative z-10">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-3xl font-black">{{ $book->available_copies }}</p>
                                <p class="text-[10px] font-black uppercase tracking-widest opacity-70">Available Now</p>
                            </div>
                            <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-3xl font-black text-white/50">{{ $book->total_copies }}</p>
                                <p class="text-[10px] font-black uppercase tracking-widest opacity-70">Total Stock</p>
                            </div>
                            <div class="w-12 h-12 bg-white/5 rounded-2xl flex items-center justify-center text-white/40">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                        </div>

                        <div class="pt-8 border-t border-white/10">
                            @php 
                                $status_pct = ($book->total_copies > 0) ? ($book->available_copies / $book->total_copies) * 100 : 0;
                            @endphp
                            <div class="flex justify-between text-[10px] font-black uppercase tracking-widest mb-3">
                                <span>Health Status</span>
                                <span>{{ round($status_pct) }}%</span>
                            </div>
                            <div class="w-full h-2 bg-white/10 rounded-full overflow-hidden">
                                <div class="h-full bg-white rounded-full transition-all duration-1000" style="width: {{ $status_pct }}%"></div>
                            </div>
                            <p class="text-[9px] font-bold mt-4 opacity-60 leading-relaxed">
                                @if($book->available_copies > 0)
                                    This asset is currently eligible for student allocation.
                                @else
                                    All units are currently deployed in the field.
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
