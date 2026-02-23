<section>
    <header class="mb-10">
        <h2 class="text-2xl font-black text-slate-900 tracking-tight">
            {{ __('Account Security') }}
        </h2>
        <p class="mt-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-relaxed">
            {{ __('Use a secure password to make sure only you can access your account.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-8">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div>
            <label for="update_password_current_password" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">
                {{ __('Current Password') }}
            </label>
            <input id="update_password_current_password" name="current_password" type="password" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-sky-500 font-bold text-slate-700 transition-all @error('current_password', 'updatePassword') ring-2 ring-rose-500 @enderror" autocomplete="current-password" />
            @error('current_password', 'updatePassword')
                <p class="mt-2 text-[10px] font-black text-rose-500 uppercase px-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 border-t border-slate-50 pt-8">
            <!-- New Password -->
            <div>
                <label for="update_password_password" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">
                    {{ __('New Password') }}
                </label>
                <input id="update_password_password" name="password" type="password" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-sky-500 font-bold text-slate-700 transition-all @error('password', 'updatePassword') ring-2 ring-rose-500 @enderror" autocomplete="new-password" />
                @error('password', 'updatePassword')
                    <p class="mt-2 text-[10px] font-black text-rose-500 uppercase px-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="update_password_password_confirmation" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">
                    {{ __('Confirm New Password') }}
                </label>
                <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-sky-500 font-bold text-slate-700 transition-all @error('password_confirmation', 'updatePassword') ring-2 ring-rose-500 @enderror" autocomplete="new-password" />
                @error('password_confirmation', 'updatePassword')
                    <p class="mt-2 text-[10px] font-black text-rose-500 uppercase px-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Submit Section -->
        <div class="flex items-center gap-6 pt-4">
            <button type="submit" class="bg-slate-900 hover:bg-sky-600 text-white font-black uppercase tracking-widest text-[10px] py-4 px-10 rounded-2xl transition-all duration-300 shadow-xl shadow-slate-200">
                {{ __('Change Password') }}
            </button>

            @if (session('status') === 'password-updated')
                <p class="text-[10px] font-black text-emerald-500 uppercase tracking-widest animate-pulse">{{ __('Sequence Synchronized.') }}</p>
            @endif
        </div>
    </form>
</section>
