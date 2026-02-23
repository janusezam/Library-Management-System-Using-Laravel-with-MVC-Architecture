@extends('layouts.app')

@section('title', 'Profile Settings')

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-12">
            <h1 class="text-4xl font-black text-slate-900 tracking-tight">Security & Identity</h1>
            <p class="text-slate-500 font-bold text-[10px] uppercase tracking-[0.2em] mt-2 flex items-center gap-2">
                <span class="w-8 h-[2px] bg-sky-500"></span>
                System Access Controls
            </p>
        </div>

        <div class="space-y-10">
            <!-- Update Profile Information -->
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden group hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-500">
                <div class="p-10">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password -->
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden group hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-500">
                <div class="p-10">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account -->
            <div class="bg-rose-50 rounded-[2.5rem] border border-rose-100 overflow-hidden">
                <div class="p-10">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
@endsection
