<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Andaman Island Tour Package</title>
    <style>
        body {
            font-family: Arial, sans-serif;
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
                font-size: 12pt;
                color: #000000;
            }

            .container {
                width: 100%;
                margin: 0;
                padding: 0;
            }

            header {
                background: none;
                color: black;
                border-bottom: none;
                padding: 0;
                min-height: auto;
            }

            header .main-header h1,
            header .main-header p {
                text-align: center;
                margin: 0;
                padding: 0;
            }

            .package-details,
            .hotels,
            .inclusions,
            .exclusions,
            .cancellation-policy,
            .vehicles,
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
                margin: 2cm;
            }

            /* Print-specific styles for the timeline
            .timeline::after {
                display: none;
            }

            .container-timeline {
                width: 100%;
                padding: 10px 0;
                page-break-inside: avoid;
            }

            .container-timeline.left,
            .container-timeline.right {
                left: 0;
            }

            .container-timeline::after,
            .left::before,
            .right::before {
                display: none;
            }

            .content {
                box-shadow: none;
                border: 1px solid #000;
            } */
        }
    </style>
</head>

<body>
    <header>
        <div class="container">
            <div class="main-header">
                <h1>Andaman Island Tour Package</h1>
                <p>www.adventureandaman.com | +91 9675904934, +91 7063904363 | contact@adventureandaman.com</p>
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
        <div class="itinerary">

            <div class="timeline">
                <h2>Itinerary</h2>
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
                        <p><strong>Description:</strong> {{ $itinerary['description'] }}</p>
                        <p><strong>Date:</strong> {{ $itinerary['date'] }}</p>
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
    </div>

    @foreach ($hotelrates as $index => $hotelrates)
        @php
            $hoteltype = App\Models\HotelCategory::findorfail($index);
        @endphp
        <div class="hotels">
            <h2>{{ $hoteltype['category'] }} - ₹.{{ number_format($hotelrates) }}/-</h2>

            @foreach ($record->rooms as $room)
                @if ($room['hotel_type'] == $hoteltype['id'])
                    <div class="hotel-block">
                        @php
                            $des = App\Models\destination::findorfail($room['location']);
                            $roomtype = App\Models\RoomCategory::findorfail($room['room_type']);
                            $hotelImages = App\Models\HotelImage::where('hotel_id', $room['hotel_name'])->get();
                        @endphp
                        <h3>Day {{ $room['days'] }} ({{ Carbon\Carbon::parse($room['date'])->format('d F Y') }})
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
                                <p><strong>Seashell Coral Cove</strong><br>
                                    Date: {{ Carbon\Carbon::parse($room['date'])->format('d F Y') }}<br>
                                    Meal Plan: {{ strtoupper($room['meal_plan']) }}<br>
                                    Room Type: {{ $roomtype['category'] }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

        </div>
    @endforeach

    <div class="inclusions">
        <h2>Package Includes</h2>
        <ul>
            @foreach ($record->inclusions as $inclusion)
                <li>{{ ucwords($inclusion) }}</li>
            @endforeach
        </ul>
    </div>
    <div class="exclusions">
        <h2>Package Excludes</h2>
        <ul>
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
        @foreach ($refunds as $refund)
            <p>{{ $refund['point'] }}</p>
        @endforeach


    </div>
    </div>
</body>

</html>
