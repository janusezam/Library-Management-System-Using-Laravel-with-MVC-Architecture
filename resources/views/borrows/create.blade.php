@extends('layouts.app')

@section('title', 'New Borrow')

@section('content')
    <div class="mb-10">
        <h1 class="text-4xl font-black text-slate-900 tracking-tighter">New <span class="text-indigo-600">Borrow</span></h1>
        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mt-2 flex items-center gap-2">
            <span class="w-1.5 h-1.5 bg-indigo-500 rounded-full animate-pulse"></span>
            Registering a new library borrow session
        </p>
    </div>

    <form action="{{ route('borrows.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            <!-- Left Side: Asset Allocation -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
                    <div class="px-10 py-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/30">
                        <div>
                            <h3 class="text-xl font-black text-slate-900 tracking-tight">Select Books</h3>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Choose books to be borrowed</p>
                        </div>
                        <span class="px-4 py-2 bg-indigo-600 text-white text-[10px] font-black uppercase tracking-widest rounded-xl">Books</span>
                    </div>

                    <div class="p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @forelse ($books as $book)
                                <label class="group relative cursor-pointer">
                                    <input type="checkbox" name="books[]" value="{{ $book->id }}" class="peer hidden">
                                    <div class="p-6 rounded-3xl border border-slate-100 bg-white shadow-sm transition-all duration-300 peer-checked:border-indigo-600 peer-checked:bg-indigo-50 peer-checked:ring-4 peer-checked:ring-indigo-500/10 group-hover:border-slate-200">
                                        <div class="flex justify-between items-start mb-3">
                                            <div class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-500">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.168.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                            </div>
                                            <span class="text-[9px] font-black {{ $book->available_copies > 0 ? 'text-emerald-500 bg-emerald-50' : 'text-rose-500 bg-rose-50' }} px-2 py-1 rounded-lg uppercase tracking-widest">
                                                {{ $book->available_copies }} {{ $book->available_copies == 1 ? 'Copy' : 'Copies' }}
                                            </span>
                                        </div>
                                        <h3 class="text-sm font-black text-slate-900 tracking-tight line-clamp-1 peer-checked:text-indigo-700">{{ $book->title }}</h3>
                                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1 line-clamp-1">
                                            @forelse($book->authors as $author)
                                                {{ $author->name }}{{ !$loop->last ? ', ' : '' }}
                                            @empty
                                                No Author
                                            @endforelse
                                        </p>
                                        
                                        <!-- Overlay Checkmark -->
                                        <div class="absolute top-4 right-4 opacity-0 scale-50 peer-checked:opacity-100 peer-checked:scale-100 transition-all duration-300">
                                            <div class="w-6 h-6 bg-indigo-600 rounded-full flex items-center justify-center text-white shadow-lg">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            @empty
                                <div class="col-span-full py-20 text-center bg-slate-50 rounded-[2rem] border-2 border-dashed border-slate-200">
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">No Books Available</p>
                                </div>
                            @endforelse
                        </div>
                        @error('books')
                            <p class="text-rose-600 text-[10px] font-black uppercase tracking-widest mt-4">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="bg-indigo-600 rounded-[2rem] p-8 text-white shadow-xl shadow-indigo-600/20 flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="flex items-center gap-6">
                        <div class="w-14 h-14 bg-white/10 rounded-2xl flex items-center justify-center backdrop-blur-md">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-black tracking-tight">Confirm Borrow</h4>
                            <p class="text-[10px] font-bold text-indigo-200 uppercase tracking-widest">Verify and start borrow cycle</p>
                        </div>
                    </div>
                    <button type="submit" class="w-full md:w-auto px-10 py-5 bg-white text-indigo-600 text-[10px] font-black uppercase tracking-widest rounded-2xl hover:bg-slate-900 hover:text-white transition-all duration-500 shadow-lg active:scale-95 leading-none">
                        Confirm Borrow
                    </button>
                </div>
            </div>

            <!-- Right Side: Protocol Credentials -->
            <div class="space-y-6">
                <!-- Member Association -->
                <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 p-10">
                    <h5 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-8 flex items-center gap-3">
                        <span class="w-4 h-0.5 bg-indigo-600"></span>
                        Student Details
                    </h5>

                    <div class="space-y-8">
                        <div>
                            <label for="student_id" class="text-[10px] font-black text-slate-900 uppercase tracking-widest mb-3 block">Select Student</label>
                            <select id="student_id" name="student_id" class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl text-sm font-bold text-slate-900 focus:ring-4 focus:ring-indigo-600/10 transition-all appearance-none cursor-pointer" required>
                                <option value="">Choose student</option>
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}" @selected(old('student_id') == $student->id)>
                                        {{ $student->name }} ({{ $student->student_id }})
                                    </option>
                                @endforeach
                            </select>
                            @error('student_id')
                                <p class="text-rose-600 text-[10px] font-black uppercase tracking-widest mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="due_date" class="text-[10px] font-black text-slate-900 uppercase tracking-widest mb-3 block">Due Date</label>
                            <input type="date" id="due_date" name="due_date" value="{{ old('due_date', date('Y-m-d', strtotime('+7 days'))) }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl text-sm font-bold text-slate-900 focus:ring-4 focus:ring-indigo-600/10 transition-all" required>
                            @error('due_date')
                                <p class="text-rose-600 text-[10px] font-black uppercase tracking-widest mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Protocol Rules -->
                <div class="bg-slate-900 rounded-[2.5rem] p-10 text-white shadow-xl shadow-slate-900/20">
                    <h5 class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-6">Library Rules</h5>
                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <div class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center text-amber-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Late Penalty</p>
                                <p class="text-xs font-bold text-slate-200">₱10.00 / Day per book</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center text-indigo-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Limit</p>
                                <p class="text-xs font-bold text-slate-200">Max 5 books</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 pt-8 border-t border-slate-800">
                        <a href="{{ route('borrows.index') }}" class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] hover:text-white transition-colors">Cancel Borrowing</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection