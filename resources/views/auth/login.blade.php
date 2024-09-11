<x-guest-layout>
    <div class="login-content">
        <form action="{{ route('login') }}" method="POSt">
            @csrf
            <div class="form-floating mb-20px">
                <input class="form-control fs-13px h-45px border-0" id="emailAddress" type="email" name="email" required
                    autofocus />
                <label for="emailAddress" class="d-flex align-items-center text-gray-600 fs-13px">Email Address</label>

                @error('email')
                    <div class="status-msg">
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    </div>
                @enderror

            </div>
            <div class="form-floating mb-20px">
                <input type="password" name="password" required class="form-control fs-13px h-45px border-0"
                    placeholder="Password" />
                <label for="password" class="d-flex align-items-center text-gray-600 fs-13px">Password</label>
            </div>
            <div class="mb-20px">
                <button type="submit" class="btn btn-success d-block w-100 h-45px btn-lg">Sign me in</button>
            </div>
            {{-- <div class="text-gray-500">
                Not a member yet? Click <a href="{{ route('register') }}" class="text-white">here</a> to register.
            </div> --}}
            <div class="d-flex align-items-center justify-content-between">

                <div>
                    <a href="{{ route('password.request') }}" class="text-white">Forgot Password?</a>
                </div>
            </div>

        </form>
    </div>
</x-guest-layout>
