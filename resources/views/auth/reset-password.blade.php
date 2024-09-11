<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <input class="form-control fs-13px h-45px border-0 mb-4" placeholder="Email Address" type="email"
                name="email" value="{{ $request->email }}" required />
            <label for="email" :value="__('Email')" class="d-flex align-items-center text-gray-600 fs-13px">
            </label>
        </div>

        <!-- Password -->
        <div class="form-floating mb-20px">
            <input class="form-control fs-13px h-45px border-0" placeholder="Password" type="password" name="password"
                required />
            <label for="password" :value="__('Password')"
                class="d-flex align-items-center text-gray-600 fs-13px">Password</label>
        </div>

        <!-- Confirm Password -->
        <div class="form-floating mb-20px">
            <input class="form-control fs-13px h-45px border-0" placeholder=" Confirm Password" type="password"
                name="password_confirmation" required />
            <label for="password_confirmation" :value="__('Confirm Password')"
                class="d-flex align-items-center text-gray-600 fs-13px">
                Confirm Password</label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
