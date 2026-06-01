 <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css" integrity="sha512-t7Few9xlddEmgd3oKZQahkNI4dS6l80+eGEzFQiqtyVYdvcSG2D3Iub77R20BdotfRPA9caaRkg1tyaJiPmO0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<section class="min-h-screen grid lg:grid-cols-2">

    <!-- LEFT (IMAGE / ILLUSTRATION) -->
    <div class="bg-[#EAF1F7] flex items-center justify-center p-10">
        <div class="grid grid-cols-2 gap-6  w-full h-full">

            <!-- BIG IMAGE -->
            <div class="col-span-2 rounded-2xl overflow-hidden">
                <img src="{{ asset('images/program-image-1.png')}}" class="w-full h-full object-cover rounded-2xl">
            </div>

            <!-- SMALL -->
            <div class="rounded-2xl overflow-hidden">
                <img src="{{ asset('images/program-image-2.png')}}" class="w-full h-full object-cover rounded-2xl">
            </div>

            <div class="rounded-2xl overflow-hidden">
                <img src="{{ asset('images/program-image-3.png')}}" class="w-full h-full object-cover rounded-2xl">
            </div>

        </div>
    </div>


    <!-- RIGHT (FORM LOGIN) -->
    <div class="flex items-center justify-center px-6 lg:px-20 bg-white">

        <div class="w-full max-w-md">

            <!-- LOGO -->
            <div class="flex items-center gap-3 mb-8">
                <img src="{{ asset('logo/crygle-logo.png')}}" class="w-30  ">
                {{-- <span class="text-lg font-semibold text-blue-900">Crygle Academy</span> --}}
            </div>

            <!-- TITLE -->
            <h2 class="text-2xl font-bold text-gray-800 mb-2">
                Halo, Selamat Datang 👋
            </h2>

            <p class="text-gray-500 text-sm mb-6">
                Silahkan register dan buat Akun Kamu
            </p>

            <!-- FORM -->
            <form class="space-y-5">

                <!-- First -->
                <div>
                    <label class="text-sm text-gray-600 mb-1 block">First name</label>
                    <input type="text"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Input your first name">
                </div>
                <!-- Last -->
                <div>
                    <label class="text-sm text-gray-600 mb-1 block">Last name</label>
                    <input type="text"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Input your last name">
                </div>
                
                <!-- EMAIL -->
                <div>
                    <label class="text-sm text-gray-600 mb-1 block">Email Address</label>
                    <input type="email"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan email">
                </div>

                <!-- PASSWORD -->
                <div>
                    <label class="text-sm text-gray-600 mb-1 block">Password</label>
                    <input type="password"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan password">
                </div>

                <!-- REMEMBER -->
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2 text-gray-600">
                        <input type="checkbox" class="accent-blue-600">
                        Ingatkan Saya
                    </label>

                    <a href="#" class="text-blue-600 hover:underline">
                        Lupa Password?
                    </a>
                </div>

                <!-- BUTTON -->
                <button
                    class="w-full bg-blue-700 hover:bg-blue-800 text-white py-3 rounded-full font-semibold transition">
                    Login
                </button>

            </form>

            <!-- REGISTER -->
            <p class="text-center text-sm text-gray-500 mt-6">
                Apakah kamu sudah memiliki akun?
                <a href="/login" class="text-blue-600 font-semibold hover:underline">
                    Masuk
                </a>
            </p>

        </div>

    </div>

</section>