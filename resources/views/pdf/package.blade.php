<!DOCTYPE html>
<html lang="en">

@php
    $user = auth()->check() ? App\Models\User::find(auth()->id()) : null;
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>{{ $record->name ?? 'Package Details' }}</title>
    <style>
        /* Reset and Base Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Georgia, 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
        }

        /* Container and Layout */
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        /* Header Styles */
        header {
            background: #35424a;
            color: #ffffff;
            padding: 20px 0;
            border-bottom: #e8491d 3px solid;
        }

        .main-header {
            text-align: center;
            padding: 20px 0;
        }

        .main-header img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }

        .main-header h1 {
            font-size: 2.2rem;
            margin-bottom: 10px;
        }

        .main-header p {
            margin-bottom: 5px;
            font-size: 1rem;
        }

        /* Card Styles */
        .card {
            background: #ffffff;
            padding: 25px;
            margin: 20px 0;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
        }

        .card h2 {
            border-bottom: 2px solid #e8491d;
            padding-bottom: 12px;
            margin-bottom: 20px;
            color: #2c3e50;
            font-size: 1.8rem;
            position: relative;
        }

        .card h2::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 60px;
            height: 3px;
            background: #e8491d;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }

        th, td {
            border: 1px solid #e0e0e0;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f5f7fa;
            font-weight: 600;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Hotel Section */
        .hotel-block {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px dashed #e0e0e0;
        }

        .hotel-block:last-child {
            border-bottom: none;
        }

        .hotel-info {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 20px;
        }

        .hotel-images {
            flex: 1;
            min-width: 250px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .hotel-images img {
            flex: 1;
            min-width: 100px;
            max-width: 200px;
            height: auto;
            border-radius: 8px;
            object-fit: cover;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        .hotel-details {
            flex: 1;
            min-width: 250px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .hotel-details p {
            margin: 8px 0;
        }

        .hotel-details strong {
            color: #2c3e50;
        }

        /* Material Design Card */
        .material-card {
            display: flex;
            align-items: center;
            padding: 20px;
            margin: 25px auto;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            background: linear-gradient(135deg, #ffffff 0%, #f9f9f9 100%);
            border: 1px solid #e0e0e0;
            max-width: 500px;
        }

        .icon-wrapper {
            flex-shrink: 0;
            background: linear-gradient(135deg, #e8491d 0%, #c0392b 100%);
            color: #ffffff;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            box-shadow: 0 4px 10px rgba(232, 73, 29, 0.3);
        }

        .icon-wrapper i {
            font-size: 28px;
        }

        .content {
            flex-grow: 1;
        }

        .price-label {
            font-size: 18px;
            color: #555;
            margin: 0;
            font-weight: 600;
        }

        .price-value {
            font-size: 26px;
            color: #e8491d;
            margin: 5px 0 0;
            font-weight: bold;
        }

        /* List Styles */
        .styled-list {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .styled-list li {
            padding: 12px 0 12px 35px;
            margin: 8px 0;
            position: relative;
            border-bottom: 1px solid #f0f0f0;
        }

        .styled-list li:before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 14px;
        }

        .inclusions .styled-list li:before {
            content: '\2713';
            background-color: #e8f5e9;
            color: #2e7d32;
            border: 2px solid #2e7d32;
        }

        .exclusions .styled-list li:before {
            content: '\2717';
            background-color: #ffebee;
            color: #c62828;
            border: 2px solid #c62828;
        }

        .styled-policy-list {
            counter-reset: item;
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .styled-policy-list li {
            counter-increment: item;
            padding: 15px 15px 15px 50px;
            margin: 10px 0;
            position: relative;
            background: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .styled-policy-list li:before {
            content: counter(item);
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: #e8491d;
            color: white;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 16px;
        }

        /* Why Choose Us Section */
        .why-book-section {
            text-align: center;
            margin: 40px 0;
            padding: 20px;
        }

        .why-book-section h3 {
            font-size: 1.8rem;
            margin-bottom: 30px;
            color: #2c3e50;
            position: relative;
            padding-bottom: 15px;
        }

        .why-book-section h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: #e8491d;
        }

        .features {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            max-width: 1000px;
            margin: 0 auto;
        }

        .feature-item {
            flex: 1 1 calc(33.333% - 30px);
            min-width: 250px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #28a745;
            border-radius: 8px;
            padding: 15px;
            background: linear-gradient(to right, #ffffff, #f0fff4);
            color: #28a745;
            font-size: 1.05rem;
            transition: all 0.3s ease;
            text-align: left;
        }

        .feature-item i {
            margin-right: 12px;
            font-size: 1.4rem;
            flex-shrink: 0;
        }

        .feature-item:hover {
            background: linear-gradient(to right, #28a745, #218838);
            color: #ffffff;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
        }

        /* Timeline Styles */
        .timeline-container {
            position: relative;
            max-width: 100%;
            margin: 0 auto;
            padding: 20px 0;
        }

        .timeline-container::after {
            content: '';
            position: absolute;
            width: 2px;
            background: #e8491d;
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -1px;
        }

        .timeline-item {
            padding: 15px 40px;
            position: relative;
            width: 50%;
            box-sizing: border-box;
        }

        .timeline-item::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            right: -10px;
            background-color: white;
            border: 4px solid #e8491d;
            top: 15px;
            border-radius: 50%;
            z-index: 1;
        }

        .left {
            left: 0;
        }

        .right {
            left: 50%;
        }

        .timeline-content {
            padding: 20px;
            background-color: white;
            position: relative;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        .timeline-content h3 {
            color: #e8491d;
            margin-bottom: 10px;
            font-size: 1.4rem;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .feature-item {
                flex: 1 1 calc(50% - 30px);
            }
        }

        @media (max-width: 768px) {
            .hotel-info {
                flex-direction: column;
            }

            .hotel-images {
                flex-direction: row;
                justify-content: center;
            }

            .timeline-container::after {
                left: 31px;
            }

            .timeline-item {
                width: 100%;
                padding-left: 70px;
                padding-right: 25px;
            }

            .right {
                left: 0;
            }

            .timeline-item::after {
                left: 21px;
            }

            .material-card {
                max-width: 100%;
            }
        }

        @media (max-width: 576px) {
            .card {
                padding: 20px 15px;
            }

            .feature-item {
                flex: 1 1 100%;
            }

            .main-header h1 {
                font-size: 1.8rem;
            }

            .price-label {
                font-size: 16px;
            }

            .price-value {
                font-size: 22px;
            }
        }

        /* Print Styles */
        @media print {
            body {
                background-color: #ffffff;
                font-size: 10pt;
                color: #000000;
                padding: 0;
                margin: 0;
            }

            .container {
                width: 100%;
                max-width: 100%;
                padding: 0;
            }

            header {
                background: #ffffff !important;
                color: #000000 !important;
                border-bottom: #000000 2px solid !important;
                padding: 10px 0 !important;
                box-shadow: none !important;
            }

            .main-header img {
                max-width: 300px;
                margin: 0 auto 10px;
            }

            .main-header h1 {
                color: #000 !important;
                font-size: 18pt !important;
            }

            .card {
                background-color: #ffffff !important;
                box-shadow: none !important;
                border: 1px solid #ddd !important;
                margin: 10px 0 !important;
                padding: 15px !important;
                page-break-inside: avoid;
            }

            .card h2 {
                color: #000 !important;
                border-bottom: 2px solid #000 !important;
            }

            table {
                width: 100% !important;
                font-size: 9pt !important;
            }

            th, td {
                padding: 6px !important;
            }

            .material-card {
                box-shadow: none !important;
                border: 1px solid #ddd !important;
                max-width: 100% !important;
            }

            .hotel-images img {
                max-width: 80px !important;
                height: auto !important;
                margin: 0 5px 5px 0 !important;
            }

            .feature-item {
                flex: 1 1 100% !important;
                min-width: 100% !important;
                margin-bottom: 5px !important;
                page-break-inside: avoid;
            }

            .why-book-section {
                margin: 20px 0 !important;
            }

            .timeline-container::after {
                display: none;
            }

            .timeline-item {
                width: 100% !important;
                padding: 0 0 20px 0 !important;
                left: 0 !important;
                margin-bottom: 20px;
            }

            .timeline-item::after {
                display: none;
            }

            .timeline-content {
                box-shadow: none !important;
                border: 1px solid #ddd !important;
            }

            .features {
                display: block;
            }

            .feature-item {
                border: 1px solid #ccc !important;
                color: #000 !important;
                background: #fff !important;
                margin-bottom: 5px;
            }

            @page {
                size: A4;
                margin: 1cm;
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="container">
            <div class="main-header">
                @if ($user && $user->logo)
                    <img src="{{ asset('storage/' . $user->logo) }}" alt="Logo">
                @else
                    <img src="{{ asset('Images/default.webp') }}" alt="Logo" style="max-width: 400px;">
                @endif
                <h1>
                    Hello, {{ $record->customers->customer ?? 'Guest' }}
                </h1>
                <p>{{ $user->website ?? 'Your Website' }} | +91-{{ $user->phone ?? 'XXXXXXX' }} |
                    {{ $user->email ?? 'support@example.com' }}</p>
                <p>{{ $user->address ?? 'Your Address' }}</p>
            </div>
        </div>
    </header>

    <div class="container">
        <!-- Package Details Card -->
        <div class="card package-details">
            <h2>Package Details</h2>
            <table>
                <tr>
                    <th>Arrival:</th>
                    <td>{{ optional($record->customers)->dateofarrival ? Carbon\Carbon::parse($record->customers->dateofarrival)->format('d F, Y') : 'N/A' }}</td>
                    <th>Departure:</th>
                    <td>{{ optional($record->customers)->dateofdeparture ? Carbon\Carbon::parse($record->customers->dateofdeparture)->format('d F, Y') : 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Adults:</th>
                    <td>{{ $record->customers->adults ?? 0 }}</td>
                    <th>Children (5y-12y):</th>
                    <td>{{ $record->customers->childgreaterthan5 ?? 0 }}</td>
                </tr>
                <tr>
                    <th>Children (2y-5y):</th>
                    <td>{{ $record->customers->childlessthan5 ?? 0 }}</td>
                    <th>Mobile:</th>
                    <td>{{ $record->customers->number ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Package Name:</th>
                    <td colspan="3">{{ $record->name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Duration:</th>
                    <td colspan="3">{{ $record->days ?? 0 }}-Days {{ $record->nights ?? 0 }}-Nights</td>
                </tr>
            </table>
        </div>

        <!-- Cruise Details Card -->
        @if (!empty($record->cruz))
        <div class="card cruise-details">
            <h2>Cruise Details</h2>
            <div class="cruise-container">
                @foreach ($record->cruz as $cruise)
                    <div class="cruise-card">
                        <div class="cruise-header">
                            <?php
                                $ferry = App\Models\Ferry::where('id', $cruise['cruz'])->first();
                            ?>
                            <h3><i class="fas fa-ship"></i> {{ $ferry->Title ?? 'Cruise Name Not Available' }}</h3>
                        </div>
                        <div class="cruise-info">
                            @if (!empty($cruise['source']))
                                <p><strong>Route:</strong> {{ $cruise['source'] }}</p>
                            @endif
                            @if (!empty($cruise['class']))
                                <p><strong>Class:</strong> {{ $cruise['class'] }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Itinerary Card -->
        <div class="card itinerary">
            <h2>Detailed Itinerary</h2>
            @if (!empty($record->itinerary))
                <div class="timeline-container">
                    @foreach ($record->itinerary as $itinerary)
                        <div class="timeline-item left">
                            <div class="timeline-content">
                                <h3>Day {{ $itinerary['days'] ?? 'N/A' }}</h3>
                                {!! $itinerary['longdescription'] ?? 'No details available.' !!}
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>No itinerary details available.</p>
            @endif
        </div>

        <!-- Hotel Plan Card -->
        @if (!empty($record->rooms))
        <div class="card hotels">
            <h2>Hotel Plan</h2>
            <div class="material-card">
                <div class="icon-wrapper">
                    <i class="material-icons">apartment</i>
                </div>
                <div class="content">
                    <p class="price-label">Package Price Per Person:</p>
                    <p class="price-value">₹.{{ number_format($ultimatePrice) }}/-</p>
                </div>
            </div>

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
                <div class="hotel-block">
                    <h3>Day {{ $room['days'] ?? 'N/A' }} - {{ $des->Title ?? 'Unknown Location' }}</h3>
                    <div class="hotel-info">
                        <div class="hotel-images">
                            @php
                                $hotelImages = App\Models\HotelImage::where(
                                    'hotel_id',
                                    $room['hotel_name'],
                                )->first();
                            @endphp
                            @if ($hotelImages && !empty($hotelImages->images))
                                @foreach ($hotelImages->images as $image)
                                    <img src="{{ asset('storage/' . $image) }}" alt="Hotel Image">
                                @endforeach
                            @else
                                <p>No images available.</p>
                            @endif
                        </div>
                        <div class="hotel-details">
                            <p><strong>{{ strtoupper($hotel->hotelName ?? 'Unknown Hotel') }}</strong></p>
                            <p>Category: <strong>{{ $hoteltype->category ?? 'N/A' }}</strong></p>
                            <p>Room Type: <strong>{{ $roomtype->category ?? 'N/A' }}</strong></p>
                            <p>Meal Plan: <strong>{{ strtoupper($room['meal_plan'] ?? 'N/A' }}</strong></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @endif

        <!-- Price Card (if no rooms) -->
        @if (empty($record->rooms))
        <div class="material-card">
            <div class="icon-wrapper">
                <i class="material-icons">info_outline</i>
            </div>
            <div class="content">
                <p class="price-label">Per Person Price:</p>
                <p class="price-value">₹.{{ number_format($ultimatePrice) }}/-</p>
            </div>
        </div>
        @endif

        <!-- Inclusions Card -->
        <div class="card inclusions">
            <h2>Package Includes</h2>
            @if (!empty($record->inclusions))
                <ul class="styled-list">
                    @foreach ($record->inclusions as $inclusion)
                        <li>{{ ucwords($inclusion) }}</li>
                    @endforeach
                </ul>
            @else
                <p>No inclusions available.</p>
            @endif
        </div>

        <!-- Exclusions Card -->
        <div class="card exclusions">
            <h2>Package Excludes</h2>
            @if (!empty($record->exclusions))
                <ul class="styled-list">
                    @foreach ($record->exclusions as $exclusion)
                        <li>{{ ucwords($exclusion) }}</li>
                    @endforeach
                </ul>
            @else
                <p>No exclusions available.</p>
            @endif
        </div>

        <!-- Cancellation Policy Card -->
        <div class="card cancellation-policy">
            <h2>Refund and Cancellation Policy</h2>
            @php
                $refunds = App\Models\Refund::where('user_id', auth()->id())->get();
            @endphp
            @if ($refunds->isNotEmpty())
                <div class="policy-content">
                    <ol class="styled-policy-list">
                        @foreach ($refunds as $refund)
                            <li>{{ $refund->point }}</li>
                        @endforeach
                    </ol>
                </div>
            @else
                <p>No refund policies available.</p>
            @endif
        </div>

        <!-- Terms and Conditions Card -->
        <div class="card terms-and-conditions">
            <h2>Terms and Conditions</h2>
            @php
                $terms = App\Models\Termsandconditions::where('user_id', auth()->id())->get();
            @endphp
            <div class="terms-content">
                <ol class="styled-terms-list">
                    @foreach ($terms as $term)
                        <li>{{ $term['point'] }}</li>
                    @endforeach
                </ol>
            </div>
        </div>

        <!-- Kindly Notes Card -->
        <div class="card kindly-notes">
            <h2>Kindly Note</h2>
            @php
                $kns = App\Models\Kindlynote::where('user_id', auth()->id())->get();
            @endphp
            <div class="kindly-content">
                <ol class="styled-kindly-list">
                    @foreach ($kns as $kn)
                        <li>{{ $kn['point'] }}</li>
                    @endforeach
                </ol>
            </div>
        </div>

        <!-- Why Choose Us Section -->
        <div class="why-book-section">
            <h3>Why Book with {{ $user['name'] ?? 'Us' }} ?</h3>
            <div class="features">
                <div class="feature-item">
                    <i class="fas fa-calendar-alt"></i>
                    <span>8+ Years of Experience</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-star"></i>
                    <span>750+ 5* Reviews on Google</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Govt. Approved and Registered</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-ban"></i>
                    <span>No Hidden Fees</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-exchange-alt"></i>
                    <span>Easy Refunds & Rescheduling</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-hotel"></i>
                    <span>Vetted Hotels & Resorts</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-calendar"></i>
                    <span>Since 2002</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-headset"></i>
                    <span>24/7 Customer Support</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-shield-alt"></i>
                    <span>Secure Payment Options</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
