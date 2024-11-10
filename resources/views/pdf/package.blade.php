<!DOCTYPE html>
<html lang="en">

@php
    $user = App\Models\User::findorfail(auth()->id());
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <title>{{ $record->name }} </title>
    <style>
        /* CSS Variables for Colors and Fonts */
        :root {
            --primary-color: #6200ee;
            --secondary-color: #03dac6;
            --background-color: #f5f5f5;
            --text-color: #212121;
            --font-family: 'Roboto', sans-serif;
        }

        body {
            font-family: var(--font-family);
            margin: 0;
            padding: 0;
            background-color: var(--background-color);
            color: var(--text-color);
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: auto;
            overflow: hidden;
            padding: 20px;
        }

        header {
            background: var(--primary-color);
            color: #ffffff;
            padding: 30px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        header .main-header {
            text-align: center;
        }

        header .main-header img {
            max-width: 200px;
            height: auto;
            margin-bottom: 20px;
        }

        header .main-header h1 {
            font-size: 2em;
            font-weight: 500;
            margin: 10px 0;
        }

        header .main-header p {
            margin: 5px 0;
        }

        h2 {
            font-size: 1.8em;
            color: var(--primary-color);
            margin-bottom: 20px;
            border-bottom: 2px solid var(--secondary-color);
            padding-bottom: 10px;
        }

        /* Package Details */
        .package-details {
            background: #ffffff;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .package-details table {
            width: 100%;
            border-collapse: collapse;
        }

        .package-details th,
        .package-details td {
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .package-details th {
            width: 25%;
            color: var(--primary-color);
            font-weight: 500;
        }

        /* Short Itinerary */
        .vehicles {
            background: #ffffff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .vehicles table {
            width: 100%;
            border-collapse: collapse;
        }

        .vehicles th,
        .vehicles td {
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .vehicles th {
            color: var(--primary-color);
            font-weight: 500;
        }

        /* Detailed Itinerary */
        .itinerary {
            background: #ffffff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .itinerary h3 {
            color: var(--primary-color);
            font-size: 1.5em;
            margin-top: 30px;
        }

        /* Hotels */
        .hotels {
            background: #ffffff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .hotel-block {
            margin-bottom: 20px;
        }

        .hotel-info {
            display: flex;
            flex-wrap: wrap;
            margin-top: 10px;
        }

        .hotel-images {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            flex: 1;
        }

        .hotel-images img {
            width: 100px;
            height: auto;
            border-radius: 5px;
        }

        .hotel-details {
            flex: 1;
            padding-left: 20px;
        }

        .hotel-details strong {
            font-size: 1.2em;
        }

        /* Styled Lists */
        .styled-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .styled-list li {
            display: flex;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }

        .styled-list li i.material-icons {
            color: var(--primary-color);
            margin-right: 10px;
        }

        .inclusions i.material-icons {
            color: #388e3c;
        }

        .exclusions i.material-icons {
            color: #d32f2f;
        }

        /* Inclusions & Exclusions */
        .inclusions,
        .exclusions {
            background: #ffffff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Cancellation Policy */
        .cancellation-policy {
            background: #ffffff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .cancellation-policy ol {
            padding-left: 20px;
        }

        .cancellation-policy li {
            margin-bottom: 10px;
        }

        /* Terms and Conditions */
        .terms-and-conditions {
            background: #e3f2fd;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .terms-and-conditions h2 {
            color: #1976d2;
            border-bottom-color: #1976d2;
        }

        /* Why Book With Us */
        .why-book-section {
            text-align: center;
            margin: 40px 0;
            padding: 20px;
        }

        .why-book-section h3 {
            font-size: 1.8em;
            color: var(--primary-color);
            margin-bottom: 30px;
        }

        .features {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            border: 1px solid var(--secondary-color);
            border-radius: 30px;
            padding: 10px 20px;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            color: var(--primary-color);
            font-size: 1em;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .feature-item i.material-icons {
            margin-right: 10px;
            font-size: 1.5em;
        }

        .feature-item:hover {
            background-color: var(--primary-color);
            color: #ffffff;
        }

        .feature-item:hover i.material-icons {
            color: #ffffff;
        }

        @media screen and (max-width: 768px) {
            .hotel-info {
                flex-direction: column;
            }

            .feature-item {
                flex-basis: 100%;
                justify-content: center;
            }
        }

        /* Kindly Notes */
        .kindly-notes {
            background-color: #ffffff;
            padding: 20px;
            margin-bottom: 20px;
            border-left: 5px solid #388e3c;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .kindly-notes h2 {
            color: #388e3c;
            border-bottom: 2px solid #c8e6c9;
        }

        .styled-kindly-list li {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .styled-kindly-list li i.material-icons {
            color: #388e3c;
            margin-right: 10px;
        }

        /* Print Styles */
        @media print {
            body {
                background-color: #ffffff;
                font-size: 10pt;
                color: #000000;
            }

            .container {
                width: 100%;
                margin: 0;
                padding: 0;
            }

            header {
                background: #ffffff;
                color: #000000;
                padding-top: 30px;
                min-height: 70px;
                box-shadow: none;
            }

            header .main-header h1 {
                font-size: 25pt;
                color: #000;
            }

            header .main-header p {
                font-size: 10pt;
                color: #000000;
            }

            .package-details,
            .hotels,
            .kindly-notes,
            .inclusions,
            .exclusions,
            .cancellation-policy,
            .vehicles,
            .terms-and-conditions,
            .why-book-section,
            .itinerary {
                box-shadow: none;
                margin: 10px 0;
                page-break-inside: avoid;
                border: 1px solid #ddd;
                background-color: #ffffff;
            }

            h2 {
                color: #000000;
                border-bottom: 2px solid #000000;
            }

            a {
                text-decoration: none;
                color: #000000;
            }

            @page {
                margin: 0.7cm !important;
            }

            @page :first {
                margin-top: 4cm !important;
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
                <p style="font-size: 15px; margin-top: 20px">{{ $user['address'] }}</p>
            </div>
        </div>
    </header>

    <div class="container">
        <!-- Package Details -->
        <div class="package-details">
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
        </div>

        <!-- Short Itinerary -->
        <div class="vehicles">
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
        </div>

        <!-- Detailed Itinerary -->
        <div class="itinerary">
            <h2>Detailed Itinerary</h2>
            @foreach ($record->itinerary as $itinerary)
                <h3><strong>Day {{ $itinerary['days'] }}</strong></h3>
                {!! $itinerary['longdescription'] !!} <br /><br />
            @endforeach
        </div>

        <!-- Hotel Plan -->
        @foreach ($hotelrates as $index => $hotelrate)
            @php
                $hoteltype = App\Models\HotelCategory::findorfail($index);
            @endphp
            <div class="hotels">
                <h2>{{ $hoteltype['category'] }} - <mark>₹{{ number_format($hotelrate) }}/-</mark> Per Person</h2>
                @foreach ($record->rooms as $room)
                    @if ($room['hotel_type'] == $hoteltype['id'])
                        <div class="hotel-block">
                            @php
                                $des = App\Models\destination::findorfail($room['location']);
                                $roomtype = App\Models\RoomCategory::findorfail($room['room_type']);
                                $hotelImages = App\Models\HotelImage::where('hotel_id', $room['hotel_name'])->get();
                                $hotel = App\Models\Hotel::findorfail($room['hotel_name']);
                            @endphp
                            <h3>Day {{ $room['days'] }} - {{ $des['Title'] }}, Hotel Details</h3>
                            <div class="hotel-info">
                                <div class="hotel-images">
                                    @foreach ($hotelImages as $images)
                                        @foreach ($images['images'] as $image)
                                            <img src="{{ asset('storage/' . $image) }}"
                                                alt="{{ $hotel['hotelName'] }}">
                                        @endforeach
                                    @endforeach
                                </div>
                                <div class="hotel-details">
                                    <strong>{{ strtoupper($hotel['hotelName']) }}</strong><br>
                                    Room Type: <strong>{{ $roomtype['category'] }}</strong><br>
                                    Meal Plan: <strong>{{ strtoupper($room['meal_plan']) }}</strong>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endforeach

        <!-- Inclusions -->
        <div class="inclusions">
            <h2>Package Includes</h2>
            <ul class="styled-list">
                @foreach ($record->inclusions as $inclusion)
                    <li><i class="material-icons">check_circle</i>{{ ucwords($inclusion) }}</li>
                @endforeach
            </ul>
        </div>

        <!-- Exclusions -->
        <div class="exclusions">
            <h2>Package Excludes</h2>
            <ul class="styled-list">
                @foreach ($record->exclusions as $exclusion)
                    <li><i class="material-icons">cancel</i>{{ ucwords($exclusion) }}</li>
                @endforeach
            </ul>
        </div>

        <!-- Cancellation Policy -->
        <div class="cancellation-policy">
            <h2>Refund and Cancellation Policy</h2>
            @php
                $refunds = App\Models\Refund::where('user_id', auth()->id())->get();
            @endphp
            <div class="policy-content">
                <ol>
                    @foreach ($refunds as $refund)
                        <li>{{ $refund['point'] }}</li>
                    @endforeach
                </ol>
            </div>
        </div>

        <!-- Terms and Conditions -->
        <div class="terms-and-conditions">
            <h2>Terms and Conditions</h2>
            @php
                $terms = App\Models\Termsandconditions::where('user_id', auth()->id())->get();
            @endphp
            <div class="terms-content">
                <ol>
                    @foreach ($terms as $term)
                        <li>{{ $term['point'] }}</li>
                    @endforeach
                </ol>
            </div>
        </div>

        <!-- Kindly Note -->
        <div class="kindly-notes">
            <h2>Kindly Note</h2>
            @php
                $kns = App\Models\Kindlynote::where('user_id', auth()->id())->get();
            @endphp
            <div class="kindly-content">
                <ul class="styled-kindly-list">
                    @foreach ($kns as $kn)
                        <li><i class="material-icons">edit_note</i>{{ $kn['point'] }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Why Book With Us -->
        <div class="why-book-section">
            <h3>Why Book with {{ $user['name'] }}?</h3>
            <div class="features">
                <div class="feature-item">
                    <i class="material-icons">calendar_today</i>
                    <span>8+ Years of Experience</span>
                </div>
                <div class="feature-item">
                    <i class="material-icons">star</i>
                    <span>750+ 5-Star Reviews on Google</span>
                </div>
                <div class="feature-item">
                    <i class="material-icons">verified_user</i>
                    <span>Govt. Approved and Registered</span>
                </div>
                <div class="feature-item">
                    <i class="material-icons">no_accounts</i>
                    <span>No Hidden Fees</span>
                </div>
                <div class="feature-item">
                    <i class="material-icons">autorenew</i>
                    <span>Easy Refunds & Rescheduling</span>
                </div>
                <div class="feature-item">
                    <i class="material-icons">hotel</i>
                    <span>Vetted Hotels & Resorts</span>
                </div>
                <div class="feature-item">
                    <i class="material-icons">event</i>
                    <span>Since 2002</span>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
