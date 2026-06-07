<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css"
    integrity="sha512-t7Few9xlddEmgd3oKZQahkNI4dS6l80+eGEzFQiqtyVYdvcSG2D3Iub77R20BdotfRPA9caaRkg1tyaJiPmO0g=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer" />

<section class="min-h-screen grid lg:grid-cols-2">

    {{-- LEFT --}}
    <div class="bg-[#EAF1F7] flex items-center justify-center p-10">
        <div class="grid grid-cols-2 gap-6 w-full h-full">

            <div class="col-span-2 rounded-2xl overflow-hidden">
                <img src="{{ asset('images/program-image-1.png') }}"
                    class="w-full h-full object-cover rounded-2xl">
            </div>

            <div class="rounded-2xl overflow-hidden">
                <img src="{{ asset('images/program-image-2.png') }}"
                    class="w-full h-full object-cover rounded-2xl">
            </div>

            <div class="rounded-2xl overflow-hidden">
                <img src="{{ asset('images/program-image-3.png') }}"
                    class="w-full h-full object-cover rounded-2xl">
            </div>

        </div>
    </div>

    {{-- RIGHT --}}
    <div class="flex items-center justify-center px-6 lg:px-20 bg-white">

        <div class="w-full max-w-md">

            {{-- LOGO --}}
            <div class="flex items-center gap-3 mb-8">
                <img src="{{ asset('logo/crygle-logo.png') }}" class="w-30">
            </div>

            {{-- TITLE --}}
            <h2 class="text-2xl font-bold text-gray-800 mb-2">
                Halo, Selamat Datang 👋
            </h2>

            <p class="text-gray-500 text-sm mb-6">
                Silahkan register dan buat akun kamu
            </p>

            {{-- ERROR --}}
            @if ($errors->any())
                <div class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4">
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                            <li class="text-sm text-red-600 flex items-center gap-2">
                                <i class="bi bi-exclamation-circle"></i>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- FORM --}}
            <form action="{{ route('register.post') }}"
                method="POST"
                class="space-y-5">

                @csrf

                {{-- Hidden Name --}}
                <input type="hidden" name="name" id="name">

                {{-- First Name --}}
                <div>
                    <label class="text-sm text-gray-600 mb-1 block">
                        First Name
                    </label>

                    <input type="text"
                        name="first_name"
                        value="{{ old('first_name') }}"
                        required
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Input your first name">
                </div>

                {{-- Last Name --}}
                <div>
                    <label class="text-sm text-gray-600 mb-1 block">
                        Last Name
                    </label>

                    <input type="text"
                        name="last_name"
                        value="{{ old('last_name') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Input your last name">
                </div>

                {{-- Email --}}
                <div>
                    <label class="text-sm text-gray-600 mb-1 block">
                        Email Address
                    </label>

                    <input type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan email">
                </div>

                {{-- Password --}}
                <div>
                    <label class="text-sm text-gray-600 mb-1 block">
                        Password
                    </label>

                    <input type="password"
                        id="password"
                        name="password"
                        required
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan password">
                </div>

                {{-- Hidden Confirmation --}}
                <input type="hidden"
                    id="password_confirmation"
                    name="password_confirmation">

                {{-- Terms --}}
                <div class="flex items-start gap-2 text-sm">
                    <input type="checkbox"
                        id="terms"
                        name="terms"
                        required
                        class="accent-blue-600 mt-1">

                    <label for="terms" class="text-gray-600">
                        Saya menyetujui
                        <a href="#"
                            class="text-blue-600 hover:underline font-medium">
                            Terms & Conditions
                        </a>
                    </label>
                </div>

                {{-- BUTTON --}}
                <button type="submit"
                    class="w-full bg-blue-700 hover:bg-blue-800 text-white py-3 rounded-full font-semibold transition">
                    Buat Akun
                </button>

            </form>

            {{-- LOGIN --}}
            <p class="text-center text-sm text-gray-500 mt-6">
                Apakah kamu sudah memiliki akun?

                <a href="{{ route('login') }}"
                    class="text-blue-600 font-semibold hover:underline">
                    Masuk
                </a>
            </p>

        </div>

    </div>

</section>

<script>
    document.querySelector('form').addEventListener('submit', function() {

        const firstName = document.querySelector('[name="first_name"]').value.trim();
        const lastName = document.querySelector('[name="last_name"]').value.trim();

        document.getElementById('name').value =
            firstName + (lastName ? ' ' + lastName : '');

        document.getElementById('password_confirmation').value =
            document.getElementById('password').value;
    });
</script>