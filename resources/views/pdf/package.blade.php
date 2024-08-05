<!DOCTYPE html>
<html lang="en">

@php
    $user = App\Models\User::findorfail(auth()->id());
    // dd($user);
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <title>{{ $record->name }} </title>
    <style>
        body {
            font-family: Georgia, 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }

        header {
            background: #35424a;
            color: #ffffff;
            padding-top: 30px;
            min-height: 70px;
            border-bottom: #e8491d 3px solid;
        }

        header a {
            color: #ffffff;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 16px;
        }

        header ul {
            padding: 0;
            list-style: none;
        }

        header li {
            float: left;
            display: inline;
            padding: 0 20px 0 20px;
        }

        .main-header {
            text-align: center;
            font-size: 24px;
        }

        .package-details,
        .hotels,
        .inclusions,
        .exclusions,
        .cancellation-policy,
        .vehicles,
        .itinerary {
            background: #ffffff;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .package-details table,
        .hotels table,
        .vehicles table {
            width: 100%;
            border-collapse: collapse;
        }

        .package-details th,
        .package-details td,
        .hotels th,
        .hotels td,
        .vehicles th,
        .vehicles td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .package-details th,
        .hotels th,
        .vehicles th {
            background-color: #f2f2f2;
        }

        .package-details h2,
        .hotels h2,
        .inclusions h2,
        .exclusions h2,
        .cancellation-policy h2,
        .vehicles h2,
        .itinerary h2 {
            border-bottom: 2px solid #e8491d;
            padding-bottom: 10px;
        }

        .hotels img {
            width: 15%;
            height: auto;
            border-radius: 5px;
        }

        .hotel-info {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .hotel-images {
            display: flex;
            flex: 4;
            margin-right: 20px;
        }

        .hotel-details {
            flex: 2;
            padding-left: 20px;
            border-left: 1px solid #ddd;
        }

        .hotel-block {
            width: 100%;
        }

        .hotel-block h3 {
            margin-top: 0;
        }

        .hotel-images img {
            flex: 1;
            margin-right: 10px;
        }

        /* New Itinerary Timeline Styles */
        .itinerary {
            position: relative;
            max-width: 100%;
            margin: 0 auto;
        }

        .timeline {
            position: relative;
            padding: 20px 0;
        }

        .timeline::after {
            content: '';
            position: absolute;
            width: 2px;
            background: #e8491d;
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -1px;
        }

        .container-timeline {
            padding: 10px 40px;
            position: relative;
            background-color: inherit;
            width: 50%;
            box-sizing: border-box;
        }

        .container-timeline::after {
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

        .left::before {
            content: " ";
            height: 0;
            position: absolute;
            top: 22px;
            width: 0;
            z-index: 1;
            right: 30px;
            border: medium solid white;
            border-width: 10px 0 10px 10px;
            border-color: transparent transparent transparent white;
        }

        .right::before {
            content: " ";
            height: 0;
            position: absolute;
            top: 22px;
            width: 0;
            z-index: 1;
            left: 30px;
            border: medium solid white;
            border-width: 10px 10px 10px 0;
            border-color: transparent white transparent transparent;
        }

        .right::after {
            left: -10px;
        }

        .content {
            padding: 20px 30px;
            background-color: white;
            position: relative;
            border-radius: 6px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .content h3 {
            margin-top: 0;
            color: #e8491d;
        }

        .content h4 {
            margin-top: 0;
            color: #333;
        }

        /* Inclusion and exlusions */

        .styled-list {
            list-style-type: none;
            /* Remove default bullets */
            padding: 0;
            margin: 0;
        }

        .styled-list li {
            padding: 10px 0;
            margin: 5px 0;
            border-bottom: 1px solid #ddd;
            position: relative;
            padding-left: 35px;
        }

        .styled-list li:before {
            content: "\2717";
            color: red;
            position: absolute;
            left: 0;
            font-size: 14px;
            line-height: 1.2em;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid red;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: white;
        }

        .exclusions .styled-list li:before {
            content: "\2717";
        }

        .inclusions .styled-list li:before {
            content: "\2713";
            color: green;
            border-color: green;
        }

        .inclusions,
        .exclusions {
            background: #ffffff;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .inclusions h2,
        .exclusions h2 {
            border-bottom: 2px solid #e8491d;
            padding-bottom: 10px;
            color: #e8491d;
        }

        /* calcelation and refund */

        .styled-policy-list {
            counter-reset: item;
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .styled-policy-list li {
            counter-increment: item;
            padding: 10px;
            margin: 5px 0;
            border-bottom: 1px solid #ddd;
            position: relative;
            padding-left: 40px;
            /* background: #f9f9f9; */
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .styled-policy-list li:before {
            content: counter(item);
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            background-color: #e8491d;
            color: white;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
        }

        .cancellation-policy {
            background: #ffffff;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .cancellation-policy h2 {
            border-bottom: 2px solid #e8491d;
            padding-bottom: 10px;
            color: #e8491d;
        }

        .policy-content {
            padding: 15px;
            /* background-color: #f4f4f4; */
            border-radius: 5px;
        }

        /* Terms and Conditions */
        .terms-and-conditions {
            background: #f0f8ff;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .terms-and-conditions h2 {
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            color: #007bff;
            margin-bottom: 20px;
            font-size: 1.5em;
        }

        .terms-content {
            padding: 15px;
            background-color: #e6f2ff;
            border-radius: 5px;
        }

        .styled-terms-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .styled-terms-list li {
            margin-bottom: 10px;
            padding: 10px 15px;
            background-color: #ffffff;
            border-left: 5px solid #007bff;
            border-radius: 5px;
            display: flex;
            align-items: center;
            font-size: 1.1em;
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        .styled-terms-list li i {
            color: #007bff;
            margin-right: 10px;
            font-size: 1.2em;
        }

        .styled-terms-list li:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .styled-terms-list li:last-child {
            margin-bottom: 0;
        }

        /* why choose us */
        .why-book-section {
            text-align: center;
            margin: 40px 0;
            padding: 20px
        }

        .why-book-section h3 {
            font-size: 1.5em;
            margin-bottom: 20px;
            color: #333;
        }

        .features {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            border: 1px solid #28a745;
            border-radius: 30px;
            padding: 10px 20px;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            color: #28a745;
            font-size: 1em;
            transition: all 0.3s ease;
        }

        .feature-item i {
            margin-right: 10px;
            font-size: 1.2em;
        }

        .feature-item:hover {
            background-color: #28a745;
            color: #ffffff;
        }

        .feature-item:hover i {
            color: #ffffff;
        }

        @media screen and (max-width: 768px) {
            .feature-item {
                flex-basis: 100%;
                justify-content: center;
            }
        }

        @media screen and (max-width: 600px) {
            .timeline::after {
                left: 31px;
            }

            .container-timeline {
                width: 100%;
                padding-left: 70px;
                padding-right: 25px;
            }

            .container-timeline::before {
                left: 60px;
                border: medium solid white;
                border-width: 10px 10px 10px 0;
                border-color: transparent white transparent transparent;
            }

            .left::after,
            .right::after {
                left: 21px;
            }

            .right {
                left: 0%;
            }
        }

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
                background: #35424a;
                color: #ffffff;
                padding-top: 30px;
                min-height: 70px;
                border-bottom: #e8491d 3px solid;

            }

            header .main-header h1 {
                font-size: 25pt
            }

            header .main-header p {
                text-align: center;
                margin: 0;
                padding: 0;
                font-size: 10pt
            }

            header .main-header img {
                width: 50%;
                height: auto;
            }

            .package-details,
            .hotels,
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

            .hotel-images img,
            .itinerary img {
                max-width: 100%;
                height: auto;
                display: block;
                page-break-inside: avoid;
            }

            .vehicles table,
            .package-details table,
            .hotels table {
                border-collapse: collapse;
                width: 100%;
            }

            .vehicles th,
            .vehicles td,
            .package-details th,
            .package-details td,
            .hotels th,
            .hotels td {
                border: 1px solid #000;
                padding: 4px;
                page-break-inside: avoid;
            }

            .timeline,
            .container-timeline,
            .content,
            .itinerary h2,
            .package-details h2,
            .hotels h2,
            .inclusions h2,
            .exclusions h2,
            .cancellation-policy h2,
            .vehicles h2 {
                page-break-inside: avoid;
            }

            .hotel-info {
                flex-wrap: nowrap;
                page-break-inside: avoid;
            }

            .hotel-images {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                margin-right: 0;
                page-break-inside: avoid;
            }

            .hotel-images img {
                width: 20%;
                margin-bottom: 10px;
            }

            .hotel-details {
                padding-left: 0;
                border-left: none;
                page-break-inside: avoid;
            }

            .hotel-block {
                page-break-inside: avoid;
                margin-bottom: 20px;
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

            @page: first {
                margin-top: 4cm !important;
            }

            .container-timeline {
                /* padding: 10px 40px !important; */
                position: relative !important;
                background-color: inherit !important;
                width: 57% !important;
                left: -6%;
                /* Increase width here */
                box-sizing: border-box !important;
            }

            .right {
                left: 49%;
            }



        }
    </style>
</head>

<body>
    <header>
        <div class="container">
            <div class="main-header">
                @if ($user['logo'] == '')
                    <img src="{{ asset('Images/default.webp') }}" alt="Logo"
                        style="width: 400px; height: auto; vertical-align: middle; margin-right: 10px;margin-bottom: 20px">
                @else
                    <img src="{{ asset('storage/' . $user['logo']) }}" alt="Logo"
                        style="vertical-align: middle; margin-right: 10px;margin-bottom: 20px">
                @endif
                <br>
                <h1 style="display: inline; font-family: Georgia, 'Times New Roman', Times, serif">
                    Hello, {{ $record->customers->customer }}
                </h1>
                <p>{{ $user['website'] }} | +91-{{ $user['phone'] }} | {{ $user['email'] }}</p>
                <p style="font-size: 15px; margin-top: 20px">{{ $user['address'] }}</p>
            </div>
        </div>
    </header>

    <div class="container">
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

        <div class="vehicles" style="margin-bottom: 20px">
            <h2>Quick Itienary</h2>
            <table>
                <tr>
                    <th>Day</th>
                    <th>Itenary</th>
                    <th>Specialities</th>
                    <th>Location Covered</th>
                </tr>
                @foreach ($record->itinerary as $itinerary)
                    <tr>
                        <td>Day-{{ $itinerary['days'] }}</td>
                        <td>{{ $itinerary['description'] }}</td>
                        <td>
                            @foreach ($itinerary['specialities'] as $speciality)
                                <span class="badge badge-primary">{{ $speciality }}</span>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($itinerary['locations'] as $location)
                                <span class="badge badge-primary">{{ $location }}</span>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

        {{-- <div class="itinerary">

            <div class="timeline">
                <h2>Itinerary Timeline</h2>
                @php
                    $j = 1;
                @endphp
                @foreach ($record->itinerary as $itinerary)
                    @if ($j % 2 != 0)
                        <div class="container-timeline left">
                        @else
                            <div class="container-timeline right">
                    @endif

                    <div class="content">
                        <h3>Day {{ $itinerary['days'] }}</h3>
                        <h4>Title: {{ $itinerary['name'] }}</h4>
                        <p><strong>Date:</strong> {{ date('l, F j, Y', strtotime($itinerary['date'])) }}</p>
                        <p><strong>Specialities:</strong>

                            @foreach ($itinerary['specialities'] as $speciality)
                                {{ $speciality }}
                            @endforeach

                        </p>
                        <p><strong>Locations Covered:</strong>

                            @foreach ($itinerary['locations'] as $location)
                                {{ $location }}
                            @endforeach
                        </p>
                    </div>
            </div>
            @php
                $j++;
            @endphp
            @endforeach

        </div>
    </div>
    <div class="vehicles">
        <h2>Vehicles and Ferry Plan</h2>
        <table>
            <tr>
                <th>Day</th>
                <th>Vehicle</th>
                <th>Ferry</th>
            </tr>

            @php
                $days = $record->days;
            @endphp
            @for ($i = 1; $i <= $days; $i++)
                <tr>
                    <td>Day {{ $i }}</td>
                    <td>
                        @foreach ($record->vehicle as $vehicle)
                            @if ($vehicle['days'] == $i)
                                For {{ $vehicle['source'] }}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach ($record->cruz as $cruz)
                            @if ($cruz['days'] == $i)
                                From {{ $cruz['source'] }} to {{ $cruz['destination'] }}
                            @endif
                        @endforeach
                    </td>
                </tr>
            @endfor


        </table>
    </div> --}}

        <div class="hotels">
            <h2>Hotel Plan</h2>

            @foreach ($hotelrates as $index => $hotelrates)
                @php
                    $hoteltype = App\Models\HotelCategory::findorfail($index);
                @endphp
                <div class="hotels">
                    <h2>{{ $hoteltype['category'] }} -
                        ₹.{{ number_format($hotelrates + $margin) }}/-
                    </h2>

                    @foreach ($record->rooms as $room)
                        @if ($room['hotel_type'] == $hoteltype['id'])
                            <div class="hotel-block">
                                @php
                                    $des = App\Models\destination::findorfail($room['location']);
                                    $roomtype = App\Models\RoomCategory::findorfail($room['room_type']);
                                    $hotelImages = App\Models\HotelImage::where('hotel_id', $room['hotel_name'])->get();
                                    $hotel = App\Models\Hotel::findorfail($room['hotel_name']);
                                @endphp
                                <h3>Day {{ $room['days'] }}
                                    {{-- ({{ Carbon\Carbon::parse($room['date'])->format('d F Y') }}) --}}
                                    - {{ $des['Title'] }}, hotel details</h3>
                                <div class="hotel-info">
                                    <div class="hotel-images">

                                        @foreach ($hotelImages as $images)
                                            @foreach ($images['images'] as $image)
                                                <img src="{{ asset('storage/' . $image) }}" width="10px"
                                                    alt="Seashell Coral Cove">
                                            @endforeach
                                        @endforeach

                                    </div>
                                    <div class="hotel-details">
                                        <br><strong>{{ strtoupper($hotel['hotelName']) }}</strong><br>
                                        {{-- Date: {{ Carbon\Carbon::parse($room['date'])->format('d F Y') }}<br> --}}
                                        Room Type: <strong>{{ $roomtype['category'] }}</strong><br>
                                        Meal Plan: <strong>{{ strtoupper($room['meal_plan']) }}</strong>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>
            @endforeach
        </div>

        <div class="inclusions">
            <h2>Package Includes</h2>
            <ul class="styled-list">
                @foreach ($record->inclusions as $inclusion)
                    <li>{{ ucwords($inclusion) }}</li>
                @endforeach
            </ul>
        </div>

        <div class="exclusions">
            <h2>Package Excludes</h2>
            <ul class="styled-list">
                @foreach ($record->exclusions as $exclusion)
                    <li>{{ ucwords($exclusion) }}</li>
                @endforeach
            </ul>
        </div>

        <div class="cancellation-policy">
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
        </div>

        <div class="terms-and-conditions">
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


        <div class="why-book-section">
            <h3>Why Book with {{ $user['name'] }} ?</h3>
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
            </div>
        </div>


</body>

</html>
