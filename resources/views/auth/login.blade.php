<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin — Desa Cibulakan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-[#192E03]">Desa Cibulakan</h1>
            <p class="text-sm text-slate-500 mt-1">Dashboard Admin</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
            <h2 class="text-lg font-semibold text-slate-800 mb-6">Masuk ke Akun Anda</h2>

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full rounded-lg border-slate-300 focus:border-[#192E03] focus:ring-[#192E03] text-sm">
                    @error('email')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                    <input type="password" name="password" required
                        class="w-full rounded-lg border-slate-300 focus:border-[#192E03] focus:ring-[#192E03] text-sm">
                    @error('password')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" name="remember" id="remember"
                        class="rounded border-slate-300 text-[#192E03] focus:ring-[#192E03]">
                    <label for="remember" class="text-sm text-slate-600">Ingat saya</label>
                </div>

                <button type="submit"
                    class="w-full py-2.5 bg-[#192E03] text-white text-sm font-medium rounded-lg hover:bg-[#1F3B04] transition">
                    Masuk
                </button>
            </form>
        </div>
    </div>
</body>
</html>