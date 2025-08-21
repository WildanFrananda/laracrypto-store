<footer class="bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            {{-- About Section --}}
            <div class="col-span-2 md:col-span-1">
                <h3 class="text-lg font-semibold">SABIMUL</h3>
                <p class="mt-4 text-sm text-gray-400">
                    Find the best hijabs, tunics, and Muslimah clothing to complement your style. Premium quality at affordable prices.
                </p>
            </div>
            {{-- Collections --}}
            <div>
                <h3 class="text-sm font-semibold tracking-wider uppercase">Collections</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="#" class="text-sm text-gray-400 hover:text-white">Pashmina Kaos</a></li>
                    <li><a href="#" class="text-sm text-gray-400 hover:text-white">Pashmina Voile</a></li>
                    <li><a href="#" class="text-sm text-gray-400 hover:text-white">Inner Ciput</a></li>
                </ul>
            </div>
            {{-- Information --}}
            <div>
                <h3 class="text-sm font-semibold tracking-wider uppercase">Information</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="#" class="text-sm text-gray-400 hover:text-white">About Us</a></li>
                    <li><a href="#" class="text-sm text-gray-400 hover:text-white">Contact</a></li>
                    <li><a href="#" class="text-sm text-gray-400 hover:text-white">Privacy Policy</a></li>
                </ul>
            </div>
            {{-- Newsletter --}}
            <div class="col-span-2 md:col-span-1">
                <h3 class="text-sm font-semibold tracking-wider uppercase">Subscribe</h3>
                <p class="mt-4 text-sm text-gray-400">Get the latest info on products and special promotions.</p>
                <form class="mt-4 flex">
                    <input type="email" placeholder="Enter your email" class="w-full px-4 py-2 text-gray-900 rounded-l-md focus:ring-0">
                    <button type="submit" class="px-4 py-2 bg-amber-600 rounded-r-md hover:bg-amber-700">Subscribe</button>
                </form>
            </div>
        </div>
        <div class="mt-8 border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center text-sm text-gray-400">
            <p>&copy; {{ date('Y') }} Sabimul Official. All rights reserved.</p>
            <div class="flex space-x-4 mt-4 md:mt-0">
                <a href="#">FB</a>
                <a href="#">TW</a>
                <a href="#">IG</a>
            </div>
        </div>
    </div>
</footer>
