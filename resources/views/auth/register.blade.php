<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi User - Komite Etik Unand</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
<div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <div class="flex justify-center">
            <img class="h-12 w-auto" src="{{ asset('images/logo-unand.png') }}" alt="UNAND Logo">
        </div>
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
            Registrasi Akun Baru
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
            Komite Etik Penelitian Universitas Andalas
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <form class="space-y-6" action="{{ route('register') }}" method="POST">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <div class="mt-1">
                        <input id="name" name="name" type="text" required
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('name') border-red-300 @enderror"
                               value="{{ old('name') }}" placeholder="Masukkan nama lengkap">
                    </div>
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" required
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('email') border-red-300 @enderror"
                               value="{{ old('email') }}" placeholder="contoh@email.com">
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">
                        Nomor Telepon
                    </label>
                    <div class="mt-1">
                        <input id="phone" name="phone" type="tel"
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('phone') border-red-300 @enderror"
                               value="{{ old('phone') }}" placeholder="08xxxxxxxxxx">
                    </div>
                    @error('phone')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Institution -->
                <div>
                    <label for="institution" class="block text-sm font-medium text-gray-700">
                        Institusi/Universitas
                    </label>
                    <div class="mt-1">
                        <input id="institution" name="institution" type="text"
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('institution') border-red-300 @enderror"
                               value="{{ old('institution') }}" placeholder="Nama institusi">
                    </div>
                    @error('institution')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Department -->
                <div>
                    <label for="department" class="block text-sm font-medium text-gray-700">
                        Fakultas/Departemen
                    </label>
                    <div class="mt-1">
                        <input id="department" name="department" type="text"
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('department') border-red-300 @enderror"
                               value="{{ old('department') }}" placeholder="Nama fakultas/departemen">
                    </div>
                    @error('department')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Reason for Registration -->
                <div>
                    <label for="reason_for_registration" class="block text-sm font-medium text-gray-700">
                        Alasan Pendaftaran <span class="text-red-500">*</span>
                    </label>
                    <div class="mt-1">
                        <textarea id="reason_for_registration" name="reason_for_registration" rows="4" required
                                  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('reason_for_registration') border-red-300 @enderror"
                                  placeholder="Jelaskan alasan Anda mendaftar dan bagaimana Anda akan menggunakan sistem ini...">{{ old('reason_for_registration') }}</textarea>
                    </div>
                    @error('reason_for_registration')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Terms and Conditions -->
                <div class="flex items-center">
                    <input id="terms" name="terms" type="checkbox" required
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="terms" class="ml-2 block text-sm text-gray-900">
                        Saya setuju dengan <a href="#" class="text-indigo-600 hover:text-indigo-500">syarat dan ketentuan</a> yang berlaku.
                    </label>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                        Daftar Sekarang
                    </button>
                </div>

                <!-- Login Link -->
                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        Sudah memiliki akun?
                        <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                            Masuk di sini
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Auto-resize textarea
    document.getElementById('reason_for_registration').addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
    });
</script>
</body>
</html>