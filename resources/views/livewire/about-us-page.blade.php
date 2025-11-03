    <div>
        <div class="bg-[#F8F3E9]">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                @if($content)
                    {{-- Breadcrumb --}}
                    <div class="text-sm mb-8">
                        <a href="{{ route('home') }}" class="text-[414141] hover:text-[414141]">Home</a>
                        <span class="mx-2 text-[414141]">/</span>
                        <span class="text-[414141]">About Us</span>
                    </div>

                    {{-- We Are Section --}}
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                        <div>
                            <h2 class="text-3xl font-bold tracking-tight text-[414141]">We Are</h2>
                            <div class="mt-4 prose lg:prose-lg text-[414141]">
                                {!! $content->narrative !!}
                            </div>
                        </div>
                        <div>
                            <div class="aspect-w-4 aspect-h-3 bg-gray-200 rounded-lg flex items-center justify-center">
                                <img src="{{ asset('images/about-us.png') }}" alt="">
                            </div>
                        </div>
                    </div>

                    {{-- Statistics Section --}}
                    <div class="mt-16 bg-gray-50 rounded-lg p-8">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                            <div>
                                <p class="text-4xl font-bold text-amber-600">{{ $content->total_orders }}+</p>
                                <p class="mt-2 text-base font-medium text-[414141]">Total Orders</p>
                            </div>
                            <div>
                                <p class="text-4xl font-bold text-amber-600">{{ $content->active_customers }}+</p>
                                <p class="mt-2 text-base font-medium text-[414141]">Active Customers</p>
                            </div>
                            <div>
                                <p class="text-4xl font-bold text-amber-600">{{ $content->store_branches }}+</p>
                                <p class="mt-2 text-base font-medium text-[414141]">Store Branch</p>
                            </div>
                        </div>
                    </div>

                    {{-- Gallery Section --}}
                    <div class="mt-16">
                        <div class="text-center">
                            <h2 class="text-3xl font-bold tracking-tight text-[414141]">Gallery</h2>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-center">
                                <img class="text-[#414141]" src="{{ asset('images/separator.svg') }}" alt="">
                            </div>
                        </div>
                        <div class="mt-8 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach($content->getMedia('gallery') as $image)
                                <div class="aspect-w-1 aspect-h-1">
                                    {{ $image->img()->attributes(['class' => 'w-full h-full object-cover rounded-lg']) }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <p class="text-center text-[414141]">Konten "About Us" belum diatur.</p>
                @endif
            </div>
        </div>
    </div>
    