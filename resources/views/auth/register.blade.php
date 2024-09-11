<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <!-- Name -->
        <div class="form-floating mb-20px">
            <input class="form-control fs-13px h-45px border-0" placeholder="name" type="text" name="name"
                :value="old('name')" required autofocus />
            <label for="name":value="__('Name')" class="d-flex align-items-center text-gray-600 fs-13px">Name</label>
        </div>
        <div class="form-floating mb-20px">
            <input class="form-control fs-13px h-45px border-0" placeholder="Email Address" type="email"
                name="email" :value="old('email')" required />
            <label for="email" :value="__('Email')" class="d-flex align-items-center text-gray-600 fs-13px">Email
                Address</label>
        </div>
        <div class="form-floating mb-20px">
            <input class="form-control fs-13px h-45px border-0" placeholder="Passwrd" type="password" name="password"
                required />
            <label for="password" :value="__('Password')"
                class="d-flex align-items-center text-gray-600 fs-13px">Password</label>
        </div>
        <div class="form-floating mb-20px">
            <input class="form-control fs-13px h-45px border-0" placeholder=" Confirm Password" type="password"
                name="password_confirmation" required />
            <label for="password_confirmation" :value="__('Confirm Password')"
                class="d-flex align-items-center text-gray-600 fs-13px">
                Confirm Password</label>
        </div>
        <div class="mb-20px">
            <button type="submit" class="btn btn-success d-block w-100 h-45px btn-lg">Register</button>
        </div>

        {{-- <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div> --}}
    </form>
</x-guest-layout>
