<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#F8F3E9] to-[#E8DCC8] py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full">
            {{-- Logo Section --}}
            <div class="text-center mb-8 animate-fade-in">
                <a href="{{ route('home') }}" class="inline-block transition-transform duration-300 hover:scale-105">
                    <img src="{{ asset('images/logo.png') }}" alt="SABIMUL Logo" class="h-16 mx-auto mb-4">
                </a>
                <h2 class="text-3xl font-bold text-[#443937] mb-2">Create Account</h2>
                <p class="text-sm text-[#443937]/70">Join us and start your journey</p>
            </div>

            {{-- Register Card --}}
            <div class="bg-white rounded-2xl shadow-xl p-8 backdrop-blur-sm bg-opacity-95 transform transition-all duration-300 hover:shadow-2xl">
                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <!-- Name -->
                    <div class="transform transition-all duration-300 focus-within:scale-[1.02]">
                        <x-input-label for="name" :value="__('Name')" class="text-[#443937] font-medium mb-2" />
                        <x-text-input 
                            id="name" 
                            class="block mt-1 w-full rounded-lg border-gray-300 focus:border-[#443937] focus:ring focus:ring-[#443937]/20 transition-all duration-300" 
                            type="text" 
                            name="name" 
                            :value="old('name')" 
                            required 
                            autofocus 
                            autocomplete="name"
                            placeholder="Enter your full name"
                        />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="transform transition-all duration-300 focus-within:scale-[1.02]">
                        <x-input-label for="email" :value="__('Email')" class="text-[#443937] font-medium mb-2" />
                        <x-text-input 
                            id="email" 
                            class="block mt-1 w-full rounded-lg border-gray-300 focus:border-[#443937] focus:ring focus:ring-[#443937]/20 transition-all duration-300" 
                            type="email" 
                            name="email" 
                            :value="old('email')" 
                            required 
                            autocomplete="username"
                            placeholder="Enter your email"
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="transform transition-all duration-300 focus-within:scale-[1.02]">
                        <x-input-label for="password" :value="__('Password')" class="text-[#443937] font-medium mb-2" />
                        <x-text-input 
                            id="password" 
                            class="block mt-1 w-full rounded-lg border-gray-300 focus:border-[#443937] focus:ring focus:ring-[#443937]/20 transition-all duration-300"
                            type="password"
                            name="password"
                            required 
                            autocomplete="new-password"
                            placeholder="Create a strong password"
                        />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="transform transition-all duration-300 focus-within:scale-[1.02]">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-[#443937] font-medium mb-2" />
                        <x-text-input 
                            id="password_confirmation" 
                            class="block mt-1 w-full rounded-lg border-gray-300 focus:border-[#443937] focus:ring focus:ring-[#443937]/20 transition-all duration-300"
                            type="password"
                            name="password_confirmation" 
                            required 
                            autocomplete="new-password"
                            placeholder="Confirm your password"
                        />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Submit Button & Login Link -->
                    <div class="space-y-4 pt-2">
                        <button 
                            type="submit"
                            class="w-full bg-[#443937] text-white py-3 px-4 rounded-lg font-medium shadow-lg hover:bg-[#332B29] transform transition-all duration-300 hover:scale-[1.02] hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-[#443937]/50 focus:ring-offset-2"
                        >
                            {{ __('Register') }}
                        </button>

                        {{-- Login Link --}}
                        <div class="text-center">
                            <span class="text-sm text-[#443937]/70">Already have an account? </span>
                            <a 
                                href="{{ route('login') }}" 
                                class="text-sm text-[#443937] hover:text-gray-900 font-medium transition-colors duration-200 relative group"
                            >
                                Sign in
                                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#443937] group-hover:w-full transition-all duration-300"></span>
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Footer Text --}}
            <p class="mt-8 text-center text-sm text-[#443937]/60">
                © {{ date('Y') }} SABIMUL. All rights reserved.
            </p>
        </div>
    </div>

    {{-- Custom Animation Styles --}}
    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in {
            animation: fade-in 0.6s ease-out;
        }
    </style>
</x-guest-layout>