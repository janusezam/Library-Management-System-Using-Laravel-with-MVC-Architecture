@extends('layouts.app')

@section('title', 'Add Student')

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="flex items-center gap-6 mb-10">
            <a href="{{ route('students.index') }}" 
               class="w-12 h-12 bg-white rounded-2xl shadow-sm border border-slate-100 flex items-center justify-center text-slate-400 hover:text-indigo-600 hover:border-indigo-100 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tight">Register Student</h1>
                <p class="text-slate-500 font-bold text-[10px] uppercase tracking-[0.2em] mt-1">Create new membership entry</p>
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
            <div class="p-10">
                <form action="{{ route('students.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                        <!-- Student ID -->
                        <div>
                            <label for="student_id" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 px-1">
                                Identification Number <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" id="student_id" name="student_id" value="{{ old('student_id') }}"
                                   placeholder="e.g. 2024-0001"
                                   class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all font-bold text-slate-900 placeholder:text-slate-300 @error('student_id') ring-2 ring-rose-500 @enderror"
                                   required>
                            @error('student_id')
                                <p class="text-rose-600 text-[10px] font-bold mt-2 px-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Full Name -->
                        <div>
                            <label for="name" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 px-1">
                                Legal Full Name <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                   placeholder="e.g. Jane Doe"
                                   class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all font-bold text-slate-900 placeholder:text-slate-300 @error('name') ring-2 ring-rose-500 @enderror"
                                   required>
                            @error('name')
                                <p class="text-rose-600 text-[10px] font-bold mt-2 px-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 px-1">
                                Professional Email <span class="text-rose-500">*</span>
                            </label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                   placeholder="jane@example.com"
                                   class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all font-bold text-slate-900 placeholder:text-slate-300 @error('email') ring-2 ring-rose-500 @enderror"
                                   required>
                            @error('email')
                                <p class="text-rose-600 text-[10px] font-bold mt-2 px-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Contact Number -->
                        <div>
                            <label for="contact_number" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 px-1">
                                Mobile Contact <span class="text-slate-300">(Optional)</span>
                            </label>
                            <input type="text" id="contact_number" name="contact_number" value="{{ old('contact_number') }}"
                                   placeholder="+63 9xx xxx xxxx"
                                   class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all font-bold text-slate-900 placeholder:text-slate-300 @error('contact_number') ring-2 ring-rose-500 @enderror">
                            @error('contact_number')
                                <p class="text-rose-600 text-[10px] font-bold mt-2 px-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Course -->
                        <div>
                            <label for="course" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 px-1">
                                Degree Course <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" id="course" name="course" value="{{ old('course') }}"
                                   placeholder="e.g. BSIT"
                                   class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all font-bold text-slate-900 placeholder:text-slate-300 @error('course') ring-2 ring-rose-500 @enderror"
                                   required>
                            @error('course')
                                <p class="text-rose-600 text-[10px] font-bold mt-2 px-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Year Level -->
                        <div>
                            <label for="year_level" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 px-1">
                                Current Academic Level <span class="text-rose-500">*</span>
                            </label>
                            <select id="year_level" name="year_level"
                                    class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all font-bold text-slate-900 appearance-none @error('year_level') ring-2 ring-rose-500 @enderror"
                                    required>
                                <option value="">Select Level</option>
                                <option value="1" @selected(old('year_level') == 1)>1st Year (Freshman)</option>
                                <option value="2" @selected(old('year_level') == 2)>2nd Year (Sophomore)</option>
                                <option value="3" @selected(old('year_level') == 3)>3rd Year (Junior)</option>
                                <option value="4" @selected(old('year_level') == 4)>4th Year (Senior)</option>
                            </select>
                            @error('year_level')
                                <p class="text-rose-600 text-[10px] font-bold mt-2 px-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-col md:flex-row gap-4 pt-6 border-t border-slate-50">
                        <button type="submit" 
                                class="flex-1 bg-slate-900 hover:bg-emerald-600 text-white font-black uppercase tracking-[0.2em] text-xs py-5 rounded-2xl transition-all duration-300 shadow-xl shadow-slate-200 hover:shadow-emerald-200 hover:-translate-y-1">
                            Confirm Registration
                        </button>
                        <a href="{{ route('students.index') }}" 
                           class="flex-1 bg-slate-50 hover:bg-slate-100 text-slate-400 font-black uppercase tracking-[0.2em] text-xs py-5 rounded-2xl transition-all duration-300 text-center">
                            Cancel Changes
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
