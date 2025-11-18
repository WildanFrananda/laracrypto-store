<div class="bg-[#F8F3E9]">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="relative h-96 md:h-full min-h-[400px] rounded-lg overflow-hidden">
                    <img src="{{ asset('images/contact.webp') }}" alt="Contact Us" class="absolute inset-0 w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex flex-col justify-center p-8">
                        <h1 class="text-4xl font-bold text-white">Contact</h1>
                        <p class="mt-4 text-lg text-gray-200">
                            We really appreciate the time and input you give to us to help us to continue to provide the best service.
                        </p>
                    </div>
                </div>
                <div>
                    @if (session()->has('success'))
                        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-md" role="alert">
                            {{ session('success') }}
                        </div>
                    @else
                        <h2 class="text-2xl font-semibold text-[#443937] mb-2">What can we help?</h2>
                        <form wire:submit.prevent="submitForm" class="space-y-6">
                            <div>
                                <label for="name" class="sr-only">Name</label>
                                <input type="text" wire:model="name" id="name" placeholder="Name" class="w-full px-4 py-3 border-gray-300 rounded-md focus:ring-gray-500 focus:border-gray-500">
                                @error('name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="email" class="sr-only">E-mail</label>
                                <input type="email" wire:model="email" id="email" placeholder="E-mail" class="w-full px-4 py-3 border-gray-300 rounded-md focus:ring-gray-500 focus:border-gray-500">
                                @error('email') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="message" class="sr-only">Message</label>
                                <textarea wire:model="message" id="message" rows="5" placeholder="Message" class="w-full px-4 py-3 border-gray-300 rounded-md focus:ring-gray-500 focus:border-gray-500"></textarea>
                                @error('message') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <button type="submit" class="w-full bg-[#9B7E5C] text-white py-3 px-6 rounded-md hover:bg-amber-700 disabled:opacity-50">
                                    Submit
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
