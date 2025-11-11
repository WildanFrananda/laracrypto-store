<div>
    <div class="bg-gradient-to-b from-[#F8F3E9] via-[#FCF8F0] to-[#F8F3E9] min-h-screen">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            @if($content)
                {{-- Breadcrumb --}}
                <nav class="flex mb-8 animate-[fadeInDown_0.6s_ease-out]" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-2">
                        <li class="inline-flex items-center">
                            <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-[#443937] hover:text-[#CEA87C] transition-colors duration-300">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                                </svg>
                                Home
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-[#CEA87C]" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="ml-2 text-sm font-medium text-[#CEA87C]">About Us</span>
                            </div>
                        </li>
                    </ol>
                </nav>

                {{-- We Are Section --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center mb-20">
                    <div class="animate-[fadeInLeft_0.8s_ease-out]">
                        <div class="inline-flex items-center mb-4">
                            <div class="h-1 w-12 bg-gradient-to-r from-[#CEA87C] to-transparent rounded-full"></div>
                            <svg class="w-6 h-6 mx-3 text-[#CEA87C]" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        
                        <h2 class="text-4xl lg:text-5xl font-bold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-[#443937] to-[#CEA87C] mb-6">
                            We Are
                        </h2>
                        
                        <div class="mt-6 prose lg:prose-lg text-[#443937]/80 leading-relaxed">
                            {!! $content->narrative !!}
                        </div>

                        <!-- Decorative Element -->
                        <div class="mt-8 flex items-center space-x-4">
                            <div class="flex -space-x-2">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#CEA87C] to-[#9B7E5C] border-2 border-white shadow-lg"></div>
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#9B7E5C] to-[#7A6349] border-2 border-white shadow-lg"></div>
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#CEA87C] to-[#9B7E5C] border-2 border-white shadow-lg"></div>
                            </div>
                            <p class="text-sm text-[#443937]/60 font-medium">Trusted by thousands of customers</p>
                        </div>
                    </div>
                    
                    <div class="animate-[fadeInRight_0.8s_ease-out]">
                        <div class="relative group">
                            <div class="absolute -inset-4 bg-gradient-to-r from-[#CEA87C] to-[#9B7E5C] rounded-2xl opacity-20 blur-xl group-hover:opacity-30 transition-opacity duration-500"></div>
                            <div class="relative aspect-[4/3] bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl overflow-hidden shadow-2xl">
                                <img src="{{ asset('images/about-us.png') }}" 
                                     alt="About Us" 
                                     class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                                
                                <!-- Decorative Corner -->
                                <div class="absolute top-0 right-0 w-32 h-32">
                                    <div class="absolute top-4 right-4 w-20 h-20 bg-gradient-to-br from-[#CEA87C]/30 to-transparent rounded-full blur-2xl"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Statistics Section --}}
                <div class="mb-20 animate-[fadeInUp_0.8s_ease-out_0.3s_both]">
                    <div class="relative bg-gradient-to-br from-white to-[#FCF8F0] rounded-3xl p-8 lg:p-12 shadow-xl overflow-hidden">
                        <!-- Background Pattern -->
                        <div class="absolute inset-0 opacity-5">
                            <div class="absolute inset-0" style="background-image: radial-gradient(circle, #CEA87C 1px, transparent 1px); background-size: 20px 20px;"></div>
                        </div>
                        
                        <div class="relative grid grid-cols-1 md:grid-cols-3 gap-8 lg:gap-12">
                            <div class="text-center group">
                                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-[#CEA87C] to-[#9B7E5C] rounded-2xl shadow-lg mb-4 transform group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                    </svg>
                                </div>
                                <p class="text-5xl lg:text-6xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-[#CEA87C] to-[#9B7E5C] mb-2 tabular-nums">
                                    {{ number_format($content->total_orders) }}+
                                </p>
                                <p class="text-lg font-semibold text-[#443937] mb-1">Total Orders</p>
                                <p class="text-sm text-[#443937]/60">Successfully completed</p>
                            </div>
                            
                            <div class="text-center group">
                                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-[#9B7E5C] to-[#7A6349] rounded-2xl shadow-lg mb-4 transform group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                </div>
                                <p class="text-5xl lg:text-6xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-[#9B7E5C] to-[#7A6349] mb-2 tabular-nums">
                                    {{ number_format($content->active_customers) }}+
                                </p>
                                <p class="text-lg font-semibold text-[#443937] mb-1">Active Customers</p>
                                <p class="text-sm text-[#443937]/60">Happy clients worldwide</p>
                            </div>
                            
                            <div class="text-center group">
                                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-[#CEA87C] to-[#9B7E5C] rounded-2xl shadow-lg mb-4 transform group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                                <p class="text-5xl lg:text-6xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-[#CEA87C] to-[#9B7E5C] mb-2 tabular-nums">
                                    {{ number_format($content->store_branches) }}+
                                </p>
                                <p class="text-lg font-semibold text-[#443937] mb-1">Store Branches</p>
                                <p class="text-sm text-[#443937]/60">Locations nationwide</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Gallery Section --}}
                <div class="animate-[fadeInUp_0.8s_ease-out_0.5s_both]">
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center justify-center mb-4">
                            <div class="h-1 w-12 bg-gradient-to-r from-transparent via-[#CEA87C] to-transparent rounded-full"></div>
                            <svg class="w-8 h-8 mx-4 text-[#CEA87C]" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                            </svg>
                            <div class="h-1 w-12 bg-gradient-to-r from-[#CEA87C] via-transparent to-transparent rounded-full"></div>
                        </div>
                        
                        <h2 class="text-4xl font-bold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-[#443937] via-[#CEA87C] to-[#443937] mb-6">
                            Our Gallery
                        </h2>
                        
                        <div class="flex justify-center mb-6">
                            <div class="relative w-64">
                                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                    <div class="w-full border-t-2 border-gradient-to-r from-transparent via-[#CEA87C] to-transparent"></div>
                                </div>
                                <div class="relative flex justify-center">
                                    <img class="h-8 drop-shadow-lg" 
                                         src="{{ asset('images/separator.svg') }}" 
                                         alt="Separator">
                                </div>
                            </div>
                        </div>
                        
                        <p class="text-lg text-[#443937]/70 max-w-2xl mx-auto">
                            Explore our collection through these beautiful moments
                        </p>
                    </div>
                    
                    <div class="mt-12 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 lg:gap-6">
                        @foreach($content->getMedia('gallery') as $index => $image)
                            <div class="group relative aspect-square overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 animate-[scaleIn_0.5s_ease-out_{{$index * 0.1}}s_both]">
                                {{ $image->img()->attributes(['class' => 'w-full h-full object-cover transform group-hover:scale-110 group-hover:rotate-2 transition-all duration-700']) }}
                                
                                <!-- Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                    <div class="absolute bottom-4 left-4 right-4 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                                        <div class="flex items-center justify-between">
                                            <span class="text-white font-semibold text-sm">Gallery {{ $index + 1 }}</span>
                                            <button class="w-8 h-8 bg-white/90 rounded-full flex items-center justify-center hover:bg-white transition-colors duration-300">
                                                <svg class="w-5 h-5 text-[#443937]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Border Animation -->
                                <div class="absolute inset-0 border-4 border-transparent group-hover:border-[#CEA87C]/50 rounded-2xl transition-all duration-500"></div>
                            </div>
                        @endforeach
                    </div>
                </div>

            @else
                <div class="text-center py-20 animate-[fadeIn_0.8s_ease-out]">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-[#CEA87C] to-[#9B7E5C] rounded-full mb-6 shadow-lg">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[#443937] mb-2">Content Not Available</h3>
                    <p class="text-[#443937]/60">The "About Us" content has not been set up yet.</p>
                </div>
            @endif
        </div>
    </div>
    <style>
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes fadeInLeft {
        from {
            opacity: 0;
            transform: translateX(-50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    @keyframes fadeInRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
</style>
</div>
