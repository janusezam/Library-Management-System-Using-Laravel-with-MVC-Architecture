<section>
    <header class="mb-10">
        <h2 class="text-2xl font-black text-slate-900 tracking-tight">
            {{ __('Manage Your Profile') }}
        </h2>
        <p class="mt-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest">
            {{ __("Keep your information up to date and choose how you’d like to be contacted.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-8">
        @csrf
        @method('patch')

        <!-- Name Field -->
        <div>
            <label for="name" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">
                Display Name
            </label>
            <input id="name" name="name" type="text" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-sky-500 font-bold text-slate-700 transition-all @error('name') ring-2 ring-rose-500 @enderror" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            @error('name')
                <p class="mt-2 text-[10px] font-black text-rose-500 uppercase px-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email Field -->
        <div>
            <label for="email" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">
                Verified Email
            </label>
            <input id="email" name="email" type="email" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-sky-500 font-bold text-slate-700 transition-all @error('email') ring-2 ring-rose-500 @enderror" value="{{ old('email', $user->email) }}" required autocomplete="username" />
            @error('email')
                <p class="mt-2 text-[10px] font-black text-rose-500 uppercase px-1">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 p-4 bg-amber-50 rounded-xl border border-amber-100">
                    <p class="text-[10px] font-bold text-amber-700">
                        {{ __('Identity verification incomplete.') }}
                        <button form="send-verification" class="underline font-black hover:text-amber-900 ml-1">
                            {{ __('Transmit new token.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-black text-[9px] text-emerald-600 uppercase">
                            {{ __('Verification payload has been dispatched.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Submit Section -->
        <div class="flex items-center gap-6 pt-4">
            <button type="submit" class="bg-slate-900 hover:bg-sky-600 text-white font-black uppercase tracking-widest text-[10px] py-4 px-10 rounded-2xl transition-all duration-300 shadow-xl shadow-slate-200">
                {{ __('Update Profile') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p class="text-[10px] font-black text-emerald-500 uppercase tracking-widest animate-pulse">{{ __('Changes Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
