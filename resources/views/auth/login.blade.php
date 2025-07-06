<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <h1>تسجيل الدخول</h1>
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('البريد الإلكتروني') }}" dir="rtl" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('كلمة المرور') }}" dir="rtl" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    
                @endif

                <x-button class="ms-4">
                    {{ __('تسجيل الدخول') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
