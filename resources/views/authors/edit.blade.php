@extends('layouts.app')

@section('title', 'Edit Author')

@section('content')
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="flex items-center gap-6 mb-10">
            <a href="{{ route('authors.index') }}" 
               class="w-12 h-12 bg-white rounded-2xl shadow-sm border border-slate-100 flex items-center justify-center text-slate-400 hover:text-amber-600 hover:border-amber-100 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tight">Edit Profile</h1>
                <p class="text-slate-500 font-bold text-[10px] uppercase tracking-[0.2em] mt-1">Modify contributor specifications</p>
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
            <form action="{{ route('authors.update', $author) }}" method="POST" class="p-10">
                @csrf
                @method('PUT')

                <div class="space-y-8">
                    <!-- Full Name -->
                    <div>
                        <label for="name" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Legal / Pen Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $author->name) }}" required
                               class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-amber-500 font-bold text-slate-700 placeholder-slate-300 transition-all @error('name') ring-2 ring-rose-500 @enderror"
                               placeholder="e.g. Gabriel García Márquez">
                        @error('name') <p class="text-rose-500 text-[10px] font-black mt-2 px-1 uppercase tracking-tight">{{ $message }}</p> @enderror
                    </div>

                    <!-- Bio -->
                    <div>
                        <label for="bio" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Professional Narrative</label>
                        <textarea id="bio" name="bio" rows="6"
                                  class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-amber-500 font-bold text-slate-700 placeholder-slate-300 transition-all resize-none @error('bio') ring-2 ring-rose-500 @enderror"
                                  placeholder="Provide a brief summary of the author's background and achievements.">{{ old('bio', $author->bio) }}</textarea>
                        @error('bio') <p class="text-rose-500 text-[10px] font-black mt-2 px-1 uppercase tracking-tight">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mt-12 flex gap-4">
                    <a href="{{ route('authors.index') }}" 
                       class="flex-1 text-center py-4 bg-slate-100 hover:bg-slate-200 text-slate-600 font-black uppercase tracking-widest text-[10px] rounded-2xl transition-all">
                        Abort
                    </a>
                    <button type="submit" 
                            class="flex-[2] py-4 bg-slate-900 hover:bg-amber-600 text-white font-black uppercase tracking-widest text-[10px] rounded-2xl shadow-xl shadow-slate-200 transition-all duration-300">
                        Update Repository Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
