<!DOCTYPE html>
<html lang="en">

@php
    $user = App\Models\User::findorfail(auth()->id());
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <title>{{ $record->name }}</title>
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #e74c3c;
            --accent-color: #3498db;
            --text-color: #2c3e50;
            --light-bg: #f8f9fa;
            --border-radius: 8px;
            --box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background-color: var(--light-bg);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
        }

        .main-header {
            text-align: center;
        }

        .main-header img {
            max-width: 300px;
            height: auto;
            margin-bottom: 1.5rem;
        }

        .main-header h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: white;
        }

        .main-header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .section {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .section h2 {
            color: var(--primary-color);
            border-bottom: 3px solid var(--secondary-color);
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
        }

        /* Package Details Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 1rem 0;
        }

        th, td {
            padding: 1rem;
            border: 1px solid #dee2e6;
        }

        th {
            background: var(--light-bg);
            font-weight: 600;
            width: 25%;
        }

        /* Itinerary Section */
        .itinerary-day {
            background: white;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border-left: 4px solid var(--secondary-color);
        }

        .itinerary-day h3 {
            color: var(--secondary-color);
            margin-bottom: 1rem;
        }

        /* Hotels Section */
        .hotel-block {
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            margin-bottom: 2rem;
            box-shadow: var(--box-shadow);
        }

        .hotel-info {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
            padding: 1.5rem;
        }

        .hotel-images {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
        }

        .hotel-images img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: var(--border-radius);
        }

        .hotel-details {
            padding: 1.5rem;
            background: var(--light-bg);
            border-radius: var(--border-radius);
        }

        /* Inclusions/Exclusions Lists */
        .styled-list {
            list-style: none;
        }

        .styled-list li {
            padding: 1rem;
            margin-bottom: 0.5rem;
            background: white;
            border-radius: var(--border-radius);
            border-left: 4px solid var(--accent-color);
            position: relative;
            padding-left: 3rem;
        }

        .styled-list li:before {
            position: absolute;
            left: 1rem;
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
        }

        .inclusions .styled-list li:before {
            content: "\f00c";
            color: #28a745;
        }

        .exclusions .styled-list li:before {
            content: "\f00d";
            color: #dc3545;
        }

        /* Terms and Cancellation Policy */
        .policy-content {
            background: var(--light-bg);
            padding: 1.5rem;
            border-radius: var(--border-radius);
        }

        .styled-policy-list li {
            background: white;
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        /* Why Book Section */
        .why-book-section {
            text-align: center;
            padding: 2rem;
        }

        .features {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .feature-item {
            background: white;
            padding: 1rem 2rem;
            border-radius: 30px;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: var(--box-shadow);
            transition: transform 0.2s;
        }

        .feature-item:hover {
            transform: translateY(-2px);
        }

        /* Print Styles */
        @media print {
            body {
                background: white;
                color: black;
            }

            .container {
                max-width: 100%;
                padding: 0;
            }

            header {
                background: white !important;
                color: black;
                padding: 1rem 0;
            }

            .section {
                break-inside: avoid;
                box-shadow: none;
                border: 1px solid #ddd;
                margin: 1rem 0;
            }

            .hotel-images img {
                max-height: 100px;
            }

            .feature-item {
                border: 1px solid #ddd;
                box-shadow: none;
            }

            table {
                break-inside: avoid;
            }

            .itinerary-day {
                break-inside: avoid;
            }

            .styled-list li {
                break-inside: avoid;
            }

            @page {
                margin: 1.5cm;
                size: A4;
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hotel-info {
                grid-template-columns: 1fr;
            }

            .container {
                padding: 0 1rem;
            }

            .features {
                flex-direction: column;
            }

            .feature-item {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="container">
            <div class="main-header">
                @if ($user['logo'] == '')
                    <img src="{{ asset('Images/default.webp') }}" alt="Logo">
                @else
                    <img src="{{ asset('storage/' . $user['logo']) }}" alt="Logo">
                @endif
                <h1>Hello, {{ $record->customers->customer }}</h1>
                <p>{{ $user['website'] }} | +91-{{ $user['phone'] }} | {{ $user['email'] }}</p>
                <p>{{ $user['address'] }}</p>
            </div>
        </div>
    </header>

    <div class="container">
        <section class="section package-details">
            <h2>Package Details</h2>
            <table>
                <tr>
                    <th>Arrival:</th>
                    <td>{{ Carbon\Carbon::parse($record->customers->dateofarrival)->format('d F, Y') }}</td>
                    <th>Departure:</th>
                    <td>{{ Carbon\Carbon::parse($record->customers->dateofdeparture)->format('d F, Y') }}</td>
                </tr>
                <tr>
                    <th>Adults:</th>
                    <td>{{ $record->customers->adults }}</td>
                    <th>Children (5y-12y):</th>
                    <td>{{ $record->customers->childgreaterthan5 }}</td>
                </tr>
                <tr>
                    <th>Children (2y-5y):</th>
                    <td>{{ $record->customers->childlessthan5 }}</td>
                    <th>Mobile:</th>
                    <td>{{ $record->customers->number }}</td>
                </tr>
                <tr>
                    <th>Package Name:</th>
                    <td colspan="3">{{ $record->name }}</td>
                </tr>
                <tr>
                    <th>Duration:</th>
                    <td colspan="3">{{ $record->days }}-Days {{ $record->nights }}-Nights</td>
                </tr>
            </table>
        </section>

        <section class="section itinerary">
            <h2>Short Itinerary</h2>
            <table>
                <tr>
                    <th>Day</th>
                    <th>Itinerary</th>
                    <th>Location Covered</th>
                </tr>
                @foreach ($record->itinerary as $itinerary)
                    <tr>
                        <td><strong>{{ $itinerary['days'] }}</strong></td>
                        <td>{{ $itinerary['description'] }}</td>
                        <td>{{ $itinerary['destination'] }}</td>
                    </tr>
                @endforeach
            </table>
        </section>

        <section class="section detailed-itinerary">
            <h2>Detailed Itinerary</h2>
            @foreach ($record->itinerary as $itinerary)
                <div class="itinerary-day">
                    <h3>Day {{ $itinerary['days'] }}</h3>
                    {!! $itinerary['longdescription'] !!}
                </div>
            @endforeach
        </section>

        <section class="section hotels">
            <h2>Hotel Plan</h2>
            @foreach ($hotelrates as $index => $hotelrates)
                @php
                    $hoteltype = App\Models\HotelCategory::findorfail($index);
                @endphp
                <div class="hotel-category">
                    <h3>{{ $hoteltype['category'] }} - ₹.{{ number_format($hotelrates) }}/- Per Person</h3>

                    @foreach ($record->rooms as $room)
                        @if ($room['hotel_type'] == $hoteltype['id'])
                            @php
                                $des = App\Models\destination::findorfail($room['location']);
                                $roomtype = App\Models\RoomCategory::findorfail($room['room_type']);
                                $hotelImages = App\Models\HotelImage::where('hotel_id', $room['hotel_name'])->get();
                                $hotel = App\Models\Hotel::findorfail($room['hotel_name']);
                            @endphp
                            <div class="hotel-block">
                                <h4>Day {{ $room['days'] }} - {{ $des['Title'] }}</h4>
                                <div class="hotel-info">
                                    <div class="hotel-images">
                                        @foreach ($hotelImages as $images)
                                            @foreach ($images['images'] as $image)
                                                <img src="{{ asset('storage/' . $image) }}" alt="Hotel Image">
                                            @endforeach
                                        @endforeach
                                    </div>
                                    <div class="hotel-details">
                                        <h5>{{ strtoupper($hotel['hotelName']) }}</h5>
                                        <p><strong>Room Type:</strong> {{ $roomtype['category'] }}</p>
                                        <p><strong>Meal Plan:</strong> {{ strtoupper($room['meal_plan']) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </section>

        <section class="section inclusions">
            <h2>Package Includes</h2>
            <ul class="styled-list">
                @foreach ($record->inclusions as $inclusion)
                    <li>{{ ucwords($inclusion) }}</li>
                @endforeach
            </ul>
        </section>

        <section class="section exclusions">
            <h2>Package Excludes</h2>
            <ul class="styled-list">
                @foreach ($record->exclusions as $exclusion)
                    <li>{{ ucwords($exclusion) }}</li>
                @endforeach
            </ul>
        </section>

        <section class="section cancellation-policy">
            <h2>Refund and Cancellation Policy</h2>
            @php
                $refunds = App\Models\Refund::where('user_id', auth()->id())->get();
            @endphp
            <div class="policy-content">
                <ol class="styled-policy-list">
                    @foreach ($refunds as $refund)
                        <li>{{ $refund['point'] }}</li>
                    @endforeach
                </ol>
            </div>
        </section>

        <section class="section terms-and-conditions">
            <h2>Terms and Conditions</h2>
            @php
                $terms = App\Models\Termsandconditions::where('user_id', auth()->id())->get();
            @endphp
            <div class="policy-content">
                <ol class="styled-policy-list">
                    @foreach ($terms as $term)
                        <li>{{ $term['point'] }}</li>
                    @endforeach
                </ol>
            </div>
        </section>

        <section class="section kindly-notes">
            <h2>Kindly Note</h2>
            @php
                $kns = App\Models\Kindlynote::where('user_id', auth()->id())->get();
            @endphp
            <div class="policy-content">
                <ol class="styled-policy-list">
                    @foreach ($kns as $kn)
                        <li>{{ $kn['point'] }}</li>
                    @endforeach
                </ol>
            </div>
        </section>

        <section class="section why-book-section">
            <h2>Why Book with {{ $user['name'] }}?</h2>
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
            </div>
        </section>
    </div>
</body>
</html>
