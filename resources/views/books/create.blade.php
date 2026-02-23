@extends('layouts.app')

@section('title', 'Add Book')

@section('content')
    <div class="max-w-3xl mx-auto">
        <!-- Header -->
        <div class="flex items-center gap-6 mb-10">
            <a href="{{ route('books.index') }}" 
               class="w-12 h-12 bg-white rounded-2xl shadow-sm border border-slate-100 flex items-center justify-center text-slate-400 hover:text-indigo-600 hover:border-indigo-100 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tight">Register Book</h1>
                <p class="text-slate-500 font-bold text-[10px] uppercase tracking-[0.2em] mt-1">Append new asset to collection</p>
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
            <form action="{{ route('books.store') }}" method="POST" class="p-10">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- ISBN -->
                    <div class="md:col-span-1">
                        <label for="isbn" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Book ISBN</label>
                        <input type="text" id="isbn" name="isbn" value="{{ old('isbn') }}" required
                               class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 font-bold text-slate-700 placeholder-slate-300 transition-all @error('isbn') ring-2 ring-rose-500 @enderror"
                               placeholder="e.g. 978-3-16-148410-0">
                        @error('isbn') <p class="text-rose-500 text-[10px] font-black mt-2 px-1 uppercase tracking-tight">{{ $message }}</p> @enderror
                    </div>

                    <!-- Genre -->
                    <div class="md:col-span-1">
                        <label for="genre" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Category / Genre</label>
                        <input type="text" id="genre" name="genre" value="{{ old('genre') }}"
                               class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 font-bold text-slate-700 placeholder-slate-300 transition-all @error('genre') ring-2 ring-rose-500 @enderror"
                               placeholder="e.g. Science Fiction">
                        @error('genre') <p class="text-rose-500 text-[10px] font-black mt-2 px-1 uppercase tracking-tight">{{ $message }}</p> @enderror
                    </div>

                    <!-- Title -->
                    <div class="md:col-span-2">
                        <label for="title" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Book Title</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" required
                               class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 font-bold text-slate-700 placeholder-slate-300 transition-all @error('title') ring-2 ring-rose-500 @enderror"
                               placeholder="The Full Literary Name">
                        @error('title') <p class="text-rose-500 text-[10px] font-black mt-2 px-1 uppercase tracking-tight">{{ $message }}</p> @enderror
                    </div>

                    <!-- Published Year -->
                    <div class="md:col-span-1">
                        <label for="published_year" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Publish Year</label>
                        <input type="number" id="published_year" name="published_year" value="{{ old('published_year') }}" min="1000" max="9999"
                               class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 font-bold text-slate-700 placeholder-slate-300 transition-all @error('published_year') ring-2 ring-rose-500 @enderror"
                               placeholder="YYYY">
                        @error('published_year') <p class="text-rose-500 text-[10px] font-black mt-2 px-1 uppercase tracking-tight">{{ $message }}</p> @enderror
                    </div>

                    <!-- Total Copies -->
                    <div class="md:col-span-1">
                        <label for="total_copies" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Inventory Quantity</label>
                        <input type="number" id="total_copies" name="total_copies" value="{{ old('total_copies', 1) }}" min="1" required
                               class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 font-bold text-slate-700 placeholder-slate-300 transition-all @error('total_copies') ring-2 ring-rose-500 @enderror">
                        @error('total_copies') <p class="text-rose-500 text-[10px] font-black mt-2 px-1 uppercase tracking-tight">{{ $message }}</p> @enderror
                    </div>

                    <!-- Authors Selection -->
                    <div class="md:col-span-2 space-y-4">
                        <div class="flex items-center justify-between px-1">
                            <label for="authors" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest">Select Authors</label>
                            <a href="{{ route('authors.create') }}" class="text-[10px] font-black text-indigo-600 uppercase tracking-widest hover:underline">+ Add New Author</a>
                        </div>
                        <select id="authors" name="authors[]" multiple required
                                class="w-full h-40 px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 font-bold text-slate-700 transition-all @error('authors') ring-2 ring-rose-500 @enderror">
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}" @selected(in_array($author->id, old('authors', []))) class="py-2">{{ $author->name }}</option>
                            @endforeach
                        </select>
                        <p class="text-[9px] font-bold text-slate-400 italic px-1">Hold Ctrl/Cmd to select multiple contributors.</p>
                        @error('authors') <p class="text-rose-500 text-[10px] font-black mt-2 px-1 uppercase tracking-tight">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mt-12 flex gap-4">
                    <a href="{{ route('books.index') }}" 
                       class="flex-1 text-center py-4 bg-slate-100 hover:bg-slate-200 text-slate-600 font-black uppercase tracking-widest text-[10px] rounded-2xl transition-all">
                        Abort
                    </a>
                    <button type="submit" 
                            class="flex-[2] py-4 bg-slate-900 hover:bg-indigo-600 text-white font-black uppercase tracking-widest text-[10px] rounded-2xl shadow-xl shadow-slate-200 transition-all duration-300">
                        Commit Registration
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
