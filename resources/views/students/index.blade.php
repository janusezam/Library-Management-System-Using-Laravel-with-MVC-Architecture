@extends('layouts.app')

@section('title', 'Students')

@section('content')
    <!-- Header Area -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
        <div>
            <h1 class="text-4xl font-black text-slate-900 tracking-tight">Student Directory</h1>
            <p class="text-slate-500 font-bold text-xs uppercase tracking-[0.2em] mt-2 flex items-center gap-2">
                <span class="w-8 h-[2px] bg-indigo-500"></span>
                Membership Records
            </p>
        </div>
        <a href="{{ route('students.create') }}" 
           class="group flex items-center gap-3 bg-slate-900 hover:bg-indigo-600 text-white px-8 py-4 rounded-[1.5rem] shadow-xl shadow-slate-200 transition-all duration-300 hover:-translate-y-1">
            <div class="w-8 h-8 bg-white/20 rounded-xl flex items-center justify-center group-hover:bg-white group-hover:text-indigo-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path>
                </svg>
            </div>
            <span class="font-black text-sm uppercase tracking-widest">Add Student</span>
        </a>
    </div>

    <!-- Stats Bar -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex items-center gap-4">
            <div class="w-14 h-14 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Students</p>
                <h3 class="text-2xl font-black text-slate-900">{{ $students->total() }}</h3>
            </div>
        </div>
    </div>

    <!-- Main Table Card -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-8 py-6 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Security ID</th>
                        <th class="px-8 py-6 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Student Information</th>
                        <th class="px-8 py-6 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Academic Details</th>
                        <th class="px-8 py-6 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Burden Status</th>
                        <th class="px-8 py-6 text-right text-[10px] font-black text-slate-400 uppercase tracking-widest">Operations</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse ($students as $student)
                        <tr class="group hover:bg-slate-50/50 transition-colors duration-300">
                            <td class="px-8 py-6">
                                <span class="font-mono text-xs font-bold text-slate-400 group-hover:text-indigo-600 transition-colors">
                                    {{ $student->student_id }}
                                </span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-slate-100 rounded-xl flex items-center justify-center font-black text-slate-400 uppercase group-hover:bg-indigo-100 group-hover:text-indigo-600 transition-all">
                                        {{ substr($student->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-black text-slate-900 tracking-tight">{{ $student->name }}</h4>
                                        <p class="text-[10px] font-bold text-slate-400 lowercase">{{ $student->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex flex-col gap-1">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-slate-100 text-slate-600 text-[10px] font-bold w-fit">
                                        {{ $student->course }}
                                    </span>
                                    <span class="text-[10px] font-bold text-slate-400 italic">Level {{ $student->year_level }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                @if ($student->borrow_transactions_count > 0)
                                    <div class="flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                                        <span class="text-[10px] font-black text-amber-600 uppercase tracking-tight">
                                            {{ $student->borrow_transactions_count }} Active Borrows
                                        </span>
                                    </div>
                                @else
                                    <div class="flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                        <span class="text-[10px] font-black text-emerald-600 uppercase tracking-tight">No Liabilities</span>
                                    </div>
                                @endif
                            </td>
                            <td class="px-8 py-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('students.show', $student) }}" 
                                       class="p-2.5 bg-slate-50 text-slate-400 hover:bg-indigo-600 hover:text-white rounded-xl transition-all duration-300 hover:shadow-lg hover:shadow-indigo-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                    <a href="{{ route('students.edit', $student) }}" 
                                       class="p-2.5 bg-slate-50 text-slate-400 hover:bg-amber-600 hover:text-white rounded-xl transition-all duration-300 hover:shadow-lg hover:shadow-amber-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('students.destroy', $student) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Archive record permanently?')"
                                                class="p-2.5 bg-slate-50 text-slate-400 hover:bg-rose-600 hover:text-white rounded-xl transition-all duration-300 hover:shadow-lg hover:shadow-rose-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                <div class="flex flex-col items-center">
                                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center text-slate-200 mb-4">
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-sm font-black text-slate-900 uppercase tracking-tight">No Students Identified</h3>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">The system has zero membership records.</p>
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
        {{ $students->links() }}
    </div>
@endsection
