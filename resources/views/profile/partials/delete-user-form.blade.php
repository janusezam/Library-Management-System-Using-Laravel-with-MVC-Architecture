<section>
    <header class="mb-10">
        <h2 class="text-2xl font-black text-rose-600 tracking-tight">
            {{ __('Delete Account') }}
        </h2>
        <p class="mt-2 text-[10px] font-bold text-slate-500 uppercase tracking-widest leading-relaxed">
            {{ __('Deleting your account will permanently remove your profile and transaction history. This action cannot be undone.') }}
        </p>
    </header>

    <button type="button" onclick="openDeleteModal()" class="bg-rose-600 hover:bg-rose-700 text-white font-black uppercase tracking-widest text-[10px] py-4 px-10 rounded-2xl shadow-xl shadow-rose-100 transition-all duration-300">
        {{ __('Delete Account') }}
    </button>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="@if($errors->userDeletion->isNotEmpty()) @else hidden @endif fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center z-[100] p-6 transition-all duration-300">
        <div class="bg-white rounded-[2.5rem] shadow-2xl p-10 max-w-lg w-full border border-slate-100 relative overflow-hidden">
            <!-- Alert Wave -->
            <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-rose-500 to-rose-600"></div>

            <h2 class="text-2xl font-black text-slate-900 tracking-tight mb-4 text-center">
                {{ __('Terminal Confirmation Required') }}
            </h2>

            <!-- Warning Panel -->
            <div class="bg-rose-50 border border-rose-100 rounded-2xl p-6 mb-8">
                <p class="text-[10px] font-black text-rose-600 uppercase tracking-widest mb-4 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    CRITICAL WARNING
                </p>
                <ul class="text-[10px] font-bold text-rose-700 space-y-2 uppercase tracking-tight opacity-80">
                    <li>• IRREVERSIBLE IDENTITY DESTRUCTION</li>
                    <li>• ALL HISTORICAL AUDITS WILL BE VOIDED</li>
                    <li>• PERMANENT LOSS OF MEMBERSHIP STANDING</li>
                </ul>
            </div>

            @if($errors->userDeletion->isNotEmpty())
                <div class="mb-8 p-4 bg-rose-100 rounded-xl border border-rose-200">
                    @foreach($errors->userDeletion->all() as $error)
                        <p class="text-[9px] font-black text-rose-600 uppercase tracking-tight">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="post" action="{{ route('profile.destroy') }}" onsubmit="return validateDelete()">
                @csrf
                @method('delete')

                <div class="space-y-6">
                    <div>
                        <label for="deleteConfirm" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">
                            {{ __('Type "PURGE" to authorize:') }}
                        </label>
                        <input id="deleteConfirm" type="text" placeholder="PURGE" value="" autocomplete="off"
                               class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-rose-500 text-center font-black text-xl text-rose-600 transition-all uppercase placeholder-slate-200"
                               oninput="toggleDeleteButton()" />
                    </div>

                    <div>
                        <label for="password" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">
                            {{ __('Verification Password') }}
                        </label>
                        <input id="password" name="password" type="password" required
                               class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-rose-500 font-bold text-slate-700 transition-all"
                               placeholder="Authorize Deletion" />
                    </div>
                </div>

                <div class="mt-10 flex gap-4">
                    <button type="button" onclick="document.getElementById('deleteModal').classList.add('hidden')"
                            class="flex-1 py-4 bg-slate-100 hover:bg-slate-200 text-slate-600 font-black uppercase tracking-widest text-[10px] rounded-2xl transition-all">
                        {{ __('Cancel') }}
                    </button>
                    <button type="submit" id="deleteButton" disabled
                            class="flex-1 py-4 bg-rose-600 hover:bg-rose-700 text-white font-black uppercase tracking-widest text-[10px] rounded-2xl shadow-xl shadow-rose-100 transition-all disabled:opacity-30 disabled:cursor-not-allowed">
                        {{ __('Confirm Deletion') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript for confirmation -->
    <script>
        function openDeleteModal() {
            document.getElementById('deleteConfirm').value = '';
            document.getElementById('password').value = '';
            document.getElementById('deleteButton').disabled = true;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function toggleDeleteButton() {
            const input = document.getElementById('deleteConfirm').value;
            const button = document.getElementById('deleteButton');
            button.disabled = input !== 'PURGE';
        }

        function validateDelete() {
            const input = document.getElementById('deleteConfirm').value;
            if (input !== 'PURGE') {
                return false;
            }
            return true;
        }
    </script>
</section>
