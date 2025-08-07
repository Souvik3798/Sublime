<!DOCTYPE html>
<html lang="en">
    @php
    $user = auth()->check() ? App\Models\User::find(auth()->id()) : null;
@endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $record->name ?? 'Package Details' }}</title>

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2563eb',
                        secondary: '#7c3aed',
                        accent: '#e11d48',
                        glass: 'rgba(255, 255, 255, 0.15)',
                        darkGlass: 'rgba(0, 0, 0, 0.1)'
                    },
                    fontFamily: {
                        poppins: ['Poppins', 'sans-serif'],
                        playfair: ['Playfair Display', 'serif']
                    },
                    backdropBlur: {
                        xs: '2px',
                        sm: '4px',
                        md: '8px',
                        lg: '12px',
                        xl: '20px',
                    }
                }
            }
        }
    </script>
    <style type="text/css">
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            min-height: 100vh;
            padding: 20px;
            background-attachment: fixed;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .glass-header {
            background: rgba(37, 99, 235, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }

        .timeline::after {
            background: linear-gradient(to bottom, #2563eb, #7c3aed);
        }

        .container-timeline::after {
            border: 4px solid #7c3aed;
        }

        .feature-item {
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.25);
        }

        .feature-item:hover {
            transform: translateY(-5px);
            background: rgba(37, 99, 235, 0.8);
        }

        .price-card {
            background: linear-gradient(135deg, rgba(255,255,255,0.25) 0%, rgba(255,255,255,0.15) 100%);
        }

        .hotel-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hotel-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .inclusions li::before {
            background: rgba(34, 197, 94, 0.2);
            border-color: #22c55e;
        }

        .exclusions li::before {
            background: rgba(239, 68, 68, 0.2);
            border-color: #ef4444;
        }

        .print\:shadow-none {
            box-shadow: none !important;
        }

        .print\:bg-transparent {
            background: transparent !important;
        }

        @media print {
            body {
                background: white !important;
                padding: 0;
            }

            .glass-card, .glass-header {
                backdrop-filter: none !important;
                -webkit-backdrop-filter: none !important;
                background: white !important;
                box-shadow: none !important;
                border: 1px solid #e5e7eb !important;
            }

            .feature-item, .price-card {
                background: white !important;
                border: 1px solid #e5e7eb !important;
            }

            .no-print-shadow {
                box-shadow: none !important;
            }

            .print-padding {
                padding: 8px !important;
            }
        }
    </style>
</head>

<body class="bg-gray-50">
    <div class="max-w-6xl mx-auto">
        <!-- Header with glass effect -->
        <header class="glass-header rounded-t-2xl mb-8 overflow-hidden">
            <div class="flex flex-col items-center py-8 px-4 text-center">
                <div class="mb-6">
                    <div class="bg-white p-3 rounded-full inline-flex items-center justify-center shadow-lg">
                        @if ($user && $user->logo)
                            <img src="{{ asset('storage/' . $user->logo) }}" alt="Logo" class="h-24 w-24 object-contain">
                        @else
                            <img src="{{ asset('Images/default.webp') }}" alt="Logo" class="h-24 w-24 object-contain">
                        @endif
                    </div>
                </div>

                <h1 class="font-playfair text-4xl md:text-5xl font-bold text-white mb-3">
                    Hello, {{ $record->customers->customer ?? 'Guest' }}
                </h1>

                <div class="flex flex-wrap justify-center gap-4 text-white text-sm md:text-base">
                    @if($user && $user->website)
                    <div class="flex items-center gap-2">
                        <i class="material-icons text-sm">public</i>
                        <span>{{ $user->website }}</span>
                    </div>
                    @endif

                    @if($user && $user->phone)
                    <div class="flex items-center gap-2">
                        <i class="material-icons text-sm">phone</i>
                        <span>+91-{{ $user->phone }}</span>
                    </div>
                    @endif

                    @if($user && $user->email)
                    <div class="flex items-center gap-2">
                        <i class="material-icons text-sm">email</i>
                        <span>{{ $user->email }}</span>
                    </div>
                    @endif
                </div>

                @if($user && $user->address)
                <p class="text-white mt-4 text-sm max-w-2xl">
                    {{ $user->address }}
                </p>
                @endif
            </div>
        </header>

        <div class="space-y-6">
            <!-- Package Details Card -->
            <div class="glass-card p-6 md:p-8">
                <h2 class="font-playfair text-2xl md:text-3xl font-bold text-primary mb-6 pb-2 border-b-2 border-primary inline-block">
                    Package Details
                </h2>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <tbody class="divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50/50">
                                <th class="py-3 px-4 bg-gray-100/50 font-medium">Arrival:</th>
                                <td class="py-3 px-4">{{ optional($record->customers)->dateofarrival ? Carbon\Carbon::parse($record->customers->dateofarrival)->format('d F, Y') : 'N/A' }}</td>
                                <th class="py-3 px-4 bg-gray-100/50 font-medium">Departure:</th>
                                <td class="py-3 px-4">{{ optional($record->customers)->dateofdeparture ? Carbon\Carbon::parse($record->customers->dateofdeparture)->format('d F, Y') : 'N/A' }}</td>
                            </tr>
                            <tr class="hover:bg-gray-50/50">
                                <th class="py-3 px-4 bg-gray-100/50 font-medium">Adults:</th>
                                <td class="py-3 px-4">{{ $record->customers->adults ?? 0 }}</td>
                                <th class="py-3 px-4 bg-gray-100/50 font-medium">Children (5y-12y):</th>
                                <td class="py-3 px-4">{{ $record->customers->childgreaterthan5 ?? 0 }}</td>
                            </tr>
                            <tr class="hover:bg-gray-50/50">
                                <th class="py-3 px-4 bg-gray-100/50 font-medium">Children (2y-5y):</th>
                                <td class="py-3 px-4">{{ $record->customers->childlessthan5 ?? 0 }}</td>
                                <th class="py-3 px-4 bg-gray-100/50 font-medium">Mobile:</th>
                                <td class="py-3 px-4">{{ $record->customers->number ?? 'N/A' }}</td>
                            </tr>
                            <tr class="hover:bg-gray-50/50">
                                <th class="py-3 px-4 bg-gray-100/50 font-medium">Package Name:</th>
                                <td class="py-3 px-4 font-medium" colspan="3">{{ $record->name ?? 'N/A' }}</td>
                            </tr>
                            <tr class="hover:bg-gray-50/50">
                                <th class="py-3 px-4 bg-gray-100/50 font-medium">Duration:</th>
                                <td class="py-3 px-4 font-medium text-accent" colspan="3">{{ $record->days ?? 0 }}-Days {{ $record->nights ?? 0 }}-Nights</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            @if (!empty($record->cruz))
            <!-- Cruise Details -->
            <div class="glass-card p-6 md:p-8">
                <h2 class="font-playfair text-2xl md:text-3xl font-bold text-primary mb-6 pb-2 border-b-2 border-primary inline-block">
                    Cruise Details
                </h2>

                <div class="grid md:grid-cols-2 gap-4 mt-6">
                    @foreach ($record->cruz as $cruise)
                        @php
                            $ferry = App\Models\Ferry::where('id', $cruise['cruz'])->first();
                        @endphp
                        <div class="hotel-card bg-white/30 rounded-xl p-5 border border-white/40">
                            <div class="flex items-start gap-4">
                                <div class="bg-primary/10 p-3 rounded-lg">
                                    <i class="material-icons text-primary text-3xl">directions_boat</i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg text-gray-800">{{ $ferry->Title ?? 'Cruise Name Not Available' }}</h3>
                                    <div class="mt-2 space-y-1 text-sm">
                                        @if (!empty($cruise['source']))
                                            <p class="flex items-center gap-2"><i class="material-icons text-sm text-gray-600">place</i> <span>Route: {{ $cruise['source'] }}</span></p>
                                        @endif
                                        @if (!empty($cruise['class']))
                                            <p class="flex items-center gap-2"><i class="material-icons text-sm text-gray-600">star</i> <span>Class: {{ $cruise['class'] }}</span></p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Itinerary -->
            <div class="glass-card p-6 md:p-8">
                <h2 class="font-playfair text-2xl md:text-3xl font-bold text-primary mb-6 pb-2 border-b-2 border-primary inline-block">
                    Detailed Itinerary
                </h2>

                <div class="mt-8">
                    @if (!empty($record->itinerary))
                        @foreach ($record->itinerary as $itinerary)
                            <div class="mb-10 relative">
                                <div class="flex flex-col md:flex-row mb-16">
                                    <div class="md:w-1/2 md:pr-10 md:text-right mb-4 md:mb-0">
                                        <div class="inline-block bg-primary text-white py-1 px-4 rounded-full font-bold">Day {{ $itinerary['days'] ?? 'N/A' }}</div>
                                        <h3 class="text-xl font-bold mt-2 text-gray-800">{{ $itinerary['title'] ?? 'Day ' . $itinerary['days'] }}</h3>
                                    </div>
                                    <div class="md:w-1/2 md:pl-10 relative">
                                        <div class="absolute left-0 top-2 -ml-2 w-4 h-4 bg-primary rounded-full border-4 border-white z-10"></div>
                                        <div class="glass-card p-5">
                                            {!! $itinerary['longdescription'] ?? 'No details available.' !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center py-8">No itinerary details available.</p>
                    @endif
                </div>
            </div>

            @if (!empty($record->rooms))
            <!-- Hotel Plan -->
            <div class="glass-card p-6 md:p-8">
                <h2 class="font-playfair text-2xl md:text-3xl font-bold text-primary mb-6 pb-2 border-b-2 border-primary inline-block">
                    Hotel Plan
                </h2>

                <!-- Price Card -->
                <div class="price-card rounded-xl p-5 mb-8 max-w-lg mx-auto border border-white/40">
                    <div class="flex items-center gap-4">
                        <div class="bg-primary/10 p-3 rounded-lg">
                            <i class="material-icons text-primary text-3xl">apartment</i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-600">Package Price Per Person</p>
                            <p class="text-2xl font-bold text-primary">₹.{{ number_format($ultimatePrice) }}/-</p>
                        </div>
                    </div>
                </div>

                <!-- Hotels -->
                <div class="space-y-6">
                    @php
                        $sortedRooms = collect($record->rooms)->sortBy('days');
                    @endphp

                    @foreach ($sortedRooms as $room)
                        @php
                            $des = App\Models\destination::find($room['location']);
                            $roomtype = App\Models\RoomCategory::find($room['room_type']);
                            $hotel = App\Models\Hotel::find($room['hotel_name']);
                            $hoteltype = App\Models\HotelCategory::find($room['hotel_type']);
                        @endphp

                        <div class="hotel-card bg-white/30 rounded-xl overflow-hidden">
                            <div class="md:flex">
                                <div class="md:w-2/5 p-4 bg-gradient-to-br from-blue-50 to-cyan-50">
                                    <h3 class="font-bold text-lg text-gray-800 mb-2">Day {{ $room['days'] ?? 'N/A' }} - {{ $des->Title ?? 'Unknown Location' }}</h3>
                                    <div class="flex flex-wrap gap-2 mb-4">
                                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">{{ $hoteltype->category ?? 'N/A' }}</span>
                                        <span class="bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded">{{ $roomtype->category ?? 'N/A' }}</span>
                                        <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">{{ strtoupper($room['meal_plan'] ?? 'N/A') }}</span>
                                    </div>
                                    <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden">
                                        @php
                                            $hotelImages = App\Models\HotelImage::where('hotel_id', $room['hotel_name'])->first();
                                        @endphp
                                        @if ($hotelImages && !empty($hotelImages->images))
                                            <div class="grid grid-cols-2 gap-2">
                                                @foreach ($hotelImages->images as $image)
                                                    <div class="bg-gray-200 rounded-xl w-full h-24 bg-cover bg-center" style="background-image: url('{{ asset('storage/' . $image) }}')"></div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="grid grid-cols-2 gap-2">
                                                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-24"></div>
                                                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-24"></div>
                                                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-24"></div>
                                                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-24"></div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="md:w-3/5 p-5">
                                    <h3 class="font-playfair text-xl font-bold text-gray-800 mb-2">{{ strtoupper($hotel->hotelName ?? 'Unknown Hotel') }}</h3>
                                    @if($hotel && $hotel->address)
                                    <div class="flex items-center gap-2 text-gray-600 mb-3">
                                        <i class="material-icons text-sm">place</i>
                                        <p>{{ $hotel->address }}</p>
                                    </div>
                                    @endif
                                    <div class="text-gray-600 mb-4">
                                        <p><strong>Category:</strong> {{ $hoteltype->category ?? 'N/A' }}</p>
                                        <p><strong>Room Type:</strong> {{ $roomtype->category ?? 'N/A' }}</p>
                                        <p><strong>Meal Plan:</strong> {{ strtoupper($room['meal_plan'] ?? 'N/A') }}</p>
                                    </div>
                                    @if($hotel && $hotel->rating)
                                    <div class="flex items-center gap-2 text-sm">
                                        @for ($i = 0; $i < 5; $i++)
                                            <i class="material-icons {{ $i < $hotel->rating ? 'text-yellow-400' : 'text-gray-300' }}">star</i>
                                        @endfor
                                        <span class="text-gray-600">{{ $hotel->rating }} ({{ $hotel->reviews ?? 0 }} reviews)</span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            @if (empty($record->rooms))
            <!-- Price Card -->
            <div class="glass-card p-6 md:p-8">
                <div class="price-card rounded-xl p-5 max-w-lg mx-auto border border-white/40">
                    <div class="flex items-center gap-4">
                        <div class="bg-primary/10 p-3 rounded-lg">
                            <i class="material-icons text-primary text-3xl">info_outline</i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-600">Per Person Price</p>
                            <p class="text-2xl font-bold text-primary">₹.{{ number_format($ultimatePrice) }}/-</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="grid md:grid-cols-2 gap-6">
                <!-- Inclusions -->
                <div class="glass-card p-6">
                    <h2 class="font-playfair text-2xl font-bold text-green-600 mb-4 pb-2 border-b-2 border-green-600 inline-block">
                        Package Includes
                    </h2>
                    @if (!empty($record->inclusions))
                        <ul class="mt-4 space-y-3">
                            @foreach ($record->inclusions as $inclusion)
                                <li class="inclusions flex items-start gap-3">
                                    <div class="flex-shrink-0 w-6 h-6 rounded-full border-2 border-green-500 flex items-center justify-center mt-1">
                                        <i class="material-icons text-green-500 text-sm">check</i>
                                    </div>
                                    <span>{{ ucwords($inclusion) }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-center py-4">No inclusions available.</p>
                    @endif
                </div>

                <!-- Exclusions -->
                <div class="glass-card p-6">
                    <h2 class="font-playfair text-2xl font-bold text-red-600 mb-4 pb-2 border-b-2 border-red-600 inline-block">
                        Package Excludes
                    </h2>
                    @if (!empty($record->exclusions))
                        <ul class="mt-4 space-y-3">
                            @foreach ($record->exclusions as $exclusion)
                                <li class="exclusions flex items-start gap-3">
                                    <div class="flex-shrink-0 w-6 h-6 rounded-full border-2 border-red-500 flex items-center justify-center mt-1">
                                        <i class="material-icons text-red-500 text-sm">close</i>
                                    </div>
                                    <span>{{ ucwords($exclusion) }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-center py-4">No exclusions available.</p>
                    @endif
                </div>
            </div>

            <!-- Policies -->
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Cancellation Policy -->
                <div class="glass-card p-6">
                    <h2 class="font-playfair text-2xl font-bold text-primary mb-4 pb-2 border-b-2 border-primary inline-block">
                        Refund & Cancellation Policy
                    </h2>
                    @php
                        $refunds = App\Models\Refund::where('user_id', auth()->id())->get();
                    @endphp
                    @if ($refunds->isNotEmpty())
                        <div class="mt-4 space-y-4">
                            @foreach ($refunds as $index => $refund)
                                <div class="flex items-start gap-4">
                                    <div class="flex-shrink-0 w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center mt-1">
                                        {{ $index + 1 }}
                                    </div>
                                    <div>
                                        <p class="font-medium">{{ $refund->point }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center py-4">No refund policies available.</p>
                    @endif
                </div>

                <!-- Terms & Conditions -->
                <div class="glass-card p-6">
                    <h2 class="font-playfair text-2xl font-bold text-primary mb-4 pb-2 border-b-2 border-primary inline-block">
                        Terms & Conditions
                    </h2>
                    @php
                        $terms = App\Models\Termsandconditions::where('user_id', auth()->id())->get();
                    @endphp
                    @if ($terms->isNotEmpty())
                        <ul class="mt-4 space-y-3">
                            @foreach ($terms as $term)
                                <li class="flex items-start gap-3">
                                    <i class="material-icons text-primary mt-1">check_circle</i>
                                    <span>{{ $term['point'] }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-center py-4">No terms available.</p>
                    @endif
                </div>
            </div>

            <!-- Kindly Notes -->
            <div class="glass-card p-6">
                <h2 class="font-playfair text-2xl font-bold text-primary mb-4 pb-2 border-b-2 border-primary inline-block">
                    Kindly Note
                </h2>
                @php
                    $kns = App\Models\Kindlynote::where('user_id', auth()->id())->get();
                @endphp
                @if ($kns->isNotEmpty())
                    <ul class="mt-4 space-y-3">
                        @foreach ($kns as $kn)
                            <li class="flex items-start gap-3">
                                <i class="material-icons text-accent mt-1">info</i>
                                <span>{{ $kn['point'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-center py-4">No notes available.</p>
                @endif
            </div>

            <!-- Why Book With Us -->
            <div class="glass-card p-6 md:p-8 text-center">
                <h2 class="font-playfair text-2xl md:text-3xl font-bold text-primary mb-8">
                    Why Book With {{ $user['name'] ?? 'Us' }}?
                </h2>

                <div class="flex flex-wrap justify-center gap-4">
                    <div class="feature-item rounded-full px-5 py-3 flex items-center gap-2">
                        <i class="fas fa-calendar-alt"></i>
                        <span>8+ Years of Experience</span>
                    </div>
                    <div class="feature-item rounded-full px-5 py-3 flex items-center gap-2">
                        <i class="fas fa-star"></i>
                        <span>750+ 5* Reviews on Google</span>
                    </div>
                    <div class="feature-item rounded-full px-5 py-3 flex items-center gap-2">
                        <i class="fas fa-check-circle"></i>
                        <span>Govt. Approved and Registered</span>
                    </div>
                    <div class="feature-item rounded-full px-5 py-3 flex items-center gap-2">
                        <i class="fas fa-ban"></i>
                        <span>No Hidden Fees</span>
                    </div>
                    <div class="feature-item rounded-full px-5 py-3 flex items-center gap-2">
                        <i class="fas fa-exchange-alt"></i>
                        <span>Easy Refunds & Rescheduling</span>
                    </div>
                    <div class="feature-item rounded-full px-5 py-3 flex items-center gap-2">
                        <i class="fas fa-hotel"></i>
                        <span>Vetted Hotels & Resorts</span>
                    </div>
                    <div class="feature-item rounded-full px-5 py-3 flex items-center gap-2">
                        <i class="fas fa-calendar"></i>
                        <span>Since 2002</span>
                    </div>
                </div>

                <div class="mt-10 pt-6 border-t border-gray-200/50">
                    <h3 class="font-bold text-lg text-gray-700 mb-4">Ready to Book Your Adventure?</h3>
                    <div class="flex flex-wrap justify-center gap-4">
                        @if($user && $user->phone)
                        <a href="tel:+91-{{ $user->phone }}" class="bg-primary hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full flex items-center gap-2 transition-all">
                            <i class="material-icons">phone</i> Call Now: +91-{{ $user->phone }}
                        </a>
                        @endif
                        @if($user && $user->email)
                        <a href="mailto:{{ $user->email }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-full flex items-center gap-2 transition-all">
                            <i class="material-icons">email</i> Email Us
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
