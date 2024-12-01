<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" oninput="updateEmail()" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Show Encrypted Email -->
        <div>
            <label for="encrypted-email" class="block text-sm font-medium text-gray-700">Encrypted Email</label>
            <input type="text" id="encrypted-email" class="block mt-1 w-full" readonly />
        </div>

        <!-- Show Decrypted Email (for debug purposes, but keep it hidden in production) -->
        <div>
            <label for="decrypted-email" class="block text-sm font-medium text-gray-700">Decrypted Email</label>
            <input type="text" id="decrypted-email" class="block mt-1 w-full" readonly />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Include CryptoJS for client-side encryption -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>

    <script>
        // Encrypt and Decrypt Email dynamically
        function updateEmail() {
            let emailField = document.querySelector('input[name="email"]');
            let encryptedEmailField = document.querySelector('#encrypted-email');
            let decryptedEmailField = document.querySelector('#decrypted-email');
            let secretKey = 'your-secret-key';  // Replace with your encryption key

            // Encrypt the email
            let encryptedEmail = CryptoJS.AES.encrypt(emailField.value, secretKey).toString();

            // Display the encrypted email in the form
            encryptedEmailField.value = encryptedEmail;

            // Decrypt the email (for display purposes)
            let decryptedEmail = CryptoJS.AES.decrypt(encryptedEmail, secretKey).toString(CryptoJS.enc.Utf8);

            // Display the decrypted email (for debugging)
            decryptedEmailField.value = decryptedEmail;
        }
    </script>
</x-guest-layout>

