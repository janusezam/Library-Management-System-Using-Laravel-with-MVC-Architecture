@extends('layouts.app')

@section('title', 'Author Profile')

@section('content')
    <div class="max-w-5xl mx-auto">
        <!-- Header & Nav -->
        <div class="flex items-center justify-between mb-12">
            <div class="flex items-center gap-6">
                <a href="{{ route('authors.index') }}" 
                   class="w-12 h-12 bg-white rounded-2xl shadow-sm border border-slate-100 flex items-center justify-center text-slate-400 hover:text-amber-600 hover:border-amber-100 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 tracking-tight">Author Overview</h1>
                    <p class="text-slate-500 font-bold text-[10px] uppercase tracking-[0.2em] mt-1">Creative profile & repository</p>
                </div>
            </div>
            <a href="{{ route('authors.edit', $author) }}" 
               class="bg-amber-50 text-amber-600 font-black px-6 py-3 rounded-xl hover:bg-amber-100 transition-all uppercase text-[10px] tracking-widest border border-amber-100">
                Update Profile
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            <!-- Left: Bio & Stats -->
            <div class="lg:col-span-4 space-y-8 text-center sm:text-left">
                <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden p-10">
                    <div class="w-32 h-32 bg-amber-500 rounded-[2rem] mx-auto sm:mx-0 flex items-center justify-center text-white text-5xl font-black mb-6 shadow-lg shadow-amber-100">
                        {{ substr($author->name, 0, 1) }}
                    </div>
                    <h2 class="text-2xl font-black text-slate-900 leading-tight mb-2">{{ $author->name }}</h2>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-8">Registered Contributor</p>
                    
                    <div class="pt-8 border-t border-slate-50">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Bibliographical Record</p>
                        <p class="text-sm font-bold text-slate-600 leading-relaxed italic">
                            {{ $author->bio ?? 'No narrative dossier has been established for this creative profile.' }}
                        </p>
                    </div>
                </div>

                <div class="bg-slate-900 rounded-[2.5rem] p-10 text-white shadow-xl shadow-slate-200">
                    <h4 class="text-[10px] font-black uppercase tracking-widest mb-6 opacity-60">Impact Data</h4>
                    <div class="space-y-6">
                        <div class="flex items-center justify-between">
                            <p class="text-[11px] font-bold opacity-70">Catalog Breadth</p>
                            <p class="text-xl font-black">{{ $author->books_count }} Volumes</p>
                        </div>
                        <div class="w-full h-1 bg-white/10 rounded-full">
                            <div class="h-full bg-amber-500 rounded-full" style="width: 60%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Published Works Grid -->
            <div class="lg:col-span-8">
                <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-10 h-full">
                    <div class="flex items-center justify-between mb-10">
                        <div>
                            <h3 class="text-2xl font-black text-slate-900 tracking-tight">Repository Items</h3>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Volumes authored by {{ $author->name }}</p>
                        </div>
                        <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-amber-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.168.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @forelse ($author->books as $book)
                            <div class="group bg-slate-50/50 rounded-3xl p-6 hover:bg-white hover:shadow-xl hover:shadow-slate-100 transition-all duration-300 border border-transparent hover:border-slate-50">
                                <div class="flex flex-col h-full justify-between">
                                    <div>
                                        <div class="flex items-center justify-between mb-4">
                                            <span class="px-2 py-1 bg-white text-[9px] font-black text-slate-400 uppercase rounded-lg border border-slate-100">{{ $book->genre ?? 'General' }}</span>
                                            <span class="text-[9px] font-bold text-slate-400 tracking-tighter">{{ $book->published_year ?? 'Undated' }}</span>
                                        </div>
                                        <h4 class="text-sm font-black text-slate-900 leading-tight mb-4">{{ $book->title }}</h4>
                                    </div>
                                    
                                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                                        <div class="flex flex-col gap-1">
                                            @if($book->available_copies > 0)
                                                <span class="text-[9px] font-black text-emerald-500 uppercase">Available</span>
                                                <p class="text-[8px] font-bold text-slate-400">{{ $book->available_copies }} in hub</p>
                                            @else
                                                <span class="text-[9px] font-black text-rose-500 uppercase">Deployed</span>
                                            @endif
                                        </div>
                                        <a href="{{ route('books.show', $book) }}" class="p-2 bg-white rounded-xl shadow-sm hover:text-indigo-600 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full py-20 text-center">
                                <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.3em]">No associated volumes</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
