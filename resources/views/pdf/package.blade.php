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

        /* per person price */

        /* General Material Design styles */
        .material-card {
            display: flex;
            align-items: center;
            padding: 16px;
            margin: 16px auto;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            max-width: 500px;
        }

        /* Icon styling */
        .icon-wrapper {
            flex-shrink: 0;
            background-color: #f32121;
            color: #ffffff;
            border-radius: 50%;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 16px;
        }

        .icon-wrapper i {
            font-size: 24px;
        }

        /* Content Styling */
        .content {
            flex-grow: 1;
        }

        .price-label {
            font-size: 16px;
            color: #555555;
            margin: 0;
            font-weight: 600;
        }

        .price-value {
            font-size: 20px;
            color: #f32121;
            margin: 4px 0 0;
            font-weight: bold;
        }

        @media screen and (max-width: 768px) {
            .feature-item {
                flex-basis: 100%;
                justify-content: center;
            }
        }

        /* kindly notes */
        .kindly-notes {
            background-color: #ffffff;
            border-left: 5px solid #28a745;
            padding: 20px 30px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .kindly-notes h2 {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            font-size: 26px;
            margin-bottom: 15px;
            border-bottom: 2px solid #f1f1f1;
            padding-bottom: 10px;
        }

        .kindly-content {
            padding-left: 10px;
        }

        .styled-kindly-list {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .styled-kindly-list li {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #555;
            font-size: 18px;
            line-height: 1.8;
            margin-bottom: 15px;
            padding-left: 40px;
            position: relative;
            transition: all 0.3s ease-in-out;
        }

        .styled-kindly-list li::before {
            content: "\1F4DD";
            font-size: 22px;
            color: #007bff;
            position: absolute;
            left: 0;
            top: 0;
        }


        /* cruise details section */
        .cruise-details {
            background: #ffffff;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .cruise-details h2 {
            border-bottom: 2px solid #e8491d;
            padding-bottom: 10px;
            color: #333;
            margin-bottom: 20px;
        }

        .cruise-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .cruise-card {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            border: 1px solid #e2e8f0;
            transition: transform 0.2s ease;
        }

        .cruise-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .cruise-header h3 {
            color: #2c5aa0;
            margin: 0 0 10px 0;
            font-size: 1.2em;
        }

        .cruise-header h3 i {
            color: #4CAF50;
            margin-right: 8px;
        }

        .cruise-info p {
            margin: 8px 0;
            color: #555;
            line-height: 1.4;
        }

        .cruise-pricing {
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
        }

        .cruise-pricing .price-item {
            display: inline-block;
            background: #e8f5e8;
            padding: 5px 10px;
            margin-right: 10px;
            border-radius: 4px;
            font-size: 0.9em;
            color: #2e7d32;
        }

        /* addons-container */
        .addons-section {
            margin: 20px 0;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 8px;
        }

        .addon-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px;
            margin: 8px 0;
            background: white;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .addon-details {
            flex: 1;
        }

        .addon-day {
            color: #666;
            font-size: 0.9em;
            font-style: italic;
        }

        .addon-price {
            font-weight: bold;
            color: #2c5282;
            padding: 5px 10px;
            background: #ebf4ff;
            border-radius: 4px;
        }

        .addon-title {
            font-weight: 600;
            color: #1a202c;
            margin-bottom: 4px;
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
                background: #ffffff;
                color: #000000;
                padding-top: 30px;
                min-height: 70px;
                border-bottom: #e8491d 3px solid;

            }

            header .main-header h1 {
                font-size: 25pt;
                color: #000;
            }

            header .main-header p {
                text-align: center;
                margin: 0;
                padding: 0;
                font-size: 10pt;
                color: #000000;
            }

            header .main-header img {
                width: 50%;
                height: auto;
            }

            .kindly-notes {
                background-color: #ffffff !important;
                border-left: 5px solid #28a745 !important;
                /* Ensure border is visible in print */
                padding: 20px 30px;
                margin-bottom: 20px;
                border-radius: 10px !important;
                /* Ensure border radius is applied */
                box-shadow: none !important;
                /* Remove shadow in print */
            }

            .kindly-notes h2 {
                color: #333 !important;
                font-size: 22px;
                /* Slightly reduce font size for print */
                margin-bottom: 10px;
                border-bottom: 1px solid #ddd;
                /* Lighter border for print */
                padding-bottom: 5px;
            }

            .styled-kindly-list li {
                font-size: 16px;
                margin-bottom: 10px;
            }

            .package-details,
            .hotels,
            .cruise-details,
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

        .addons-container {
            padding: 2rem;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            margin: 2rem 0;
        }

        .addons-heading {
            font-size: 1.5rem;
            color: #1a1a1a;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e5e7eb;
        }

        .addons-heading i {
            color: #4CAF50;
            margin-right: 0.5rem;
        }

        .addon-card {
            background: #f8fafc;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
            border: 1px solid #e2e8f0;
            transition: transform 0.2s ease;
        }

        .addon-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .addon-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.75rem;
        }

        .addon-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2d3748;
            margin: 0;
        }

        .addon-name i {
            color: #4CAF50;
            margin-right: 0.5rem;
        }

        .addon-day {
            background: #edf2f7;
            padding: 0.25rem 0.75rem;
            border-radius: 999px;
            font-size: 0.875rem;
            color: #4a5568;
        }

        .addon-day i {
            color: #3182ce;
            margin-right: 0.5rem;
        }

        .addon-body {
            display: grid;
            gap: 0.75rem;
        }

        .addon-location {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #4a5568;
            font-size: 0.95rem;
        }

        .addon-location i {
            color: #e53e3e;
        }

        .addon-price {
            font-weight: 600;
            color: #2c5282;
            background: #ebf8ff;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            display: inline-block;
        }

        .addon-notes {
            background: #fffaf0;
            padding: 0.75rem;
            border-radius: 6px;
            border-left: 3px solid #ed8936;
            font-size: 0.9rem;
            color: #744210;
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
        }

        .addon-notes i {
            color: #ed8936;
            margin-top: 0.2rem;
        }
    </style>

</head>

<body>
    <header>
        <div class="container">
            <div class="main-header">
                @if ($user && $user->logo)
                    <img src="{{ asset('storage/' . $user->logo) }}" alt="Logo"
                        style="vertical-align: middle; margin-right: 10px; margin-bottom: 20px">
                @else
                    <img src="{{ asset('Images/default.webp') }}" alt="Logo"
                        style="width: 400px; height: auto; vertical-align: middle; margin-right: 10px; margin-bottom: 20px">
                @endif
                <br>
                <h1 style="display: inline; font-family: Georgia, 'Times New Roman', Times, serif">
                    Hello, {{ $record->customers->customer ?? 'Guest' }}
                </h1>
                <p>{{ $user->website ?? 'Your Website' }} | +91-{{ $user->phone ?? 'XXXXXXX' }} |
                    {{ $user->email ?? 'support@example.com' }}</p>
                <p style="font-size: 15px; margin-top: 20px">{{ $user->address ?? 'Your Address' }}</p>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="package-details">
            <h2>Package Details</h2>
            <table>
                <tr>
                    <th>Arrival:</th>
                    <td>{{ optional($record->customers)->dateofarrival ? Carbon\Carbon::parse($record->customers->dateofarrival)->format('d F, Y') : 'N/A' }}
                    </td>
                    <th>Departure:</th>
                    <td>{{ optional($record->customers)->dateofdeparture ? Carbon\Carbon::parse($record->customers->dateofdeparture)->format('d F, Y') : 'N/A' }}
                    </td>
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

        @if (!empty($record->cruz))
            <div class="cruise-details">
                <h2>Cruise Details</h2>
                <div class="cruise-container">
                    @foreach ($record->cruz as $cruise)
                        <div class="cruise-card">
                            <div class="cruise-header">
                                <?php
                                    foreach ($cruise['ferry'] as $cruises) {
                                        dd($cruises);
                                    }
                                    ?>
                                <h3><i class="fas fa-ship"></i> {{ $cruise['Title'] ?? 'Cruise Name Not Available' }}</h3>
                            </div>
                            <div class="cruise-info">
                                @if (!empty($cruise['source']))
                                    <p><strong>Route:</strong> {{ $cruise['source'] }}</p>
                                @endif
                                @if (!empty($cruise['class']))
                                    <p><strong>Class:</strong> {{ $cruise['class'] }}</p>
                                @endif
                                <div class="cruise-pricing">
                                    @if (!empty($cruise['price_adult']))
                                        <span class="price-item"><strong>Adult:</strong> ₹{{ number_format($cruise['price_adult']) }}</span>
                                    @endif
                                    @if (!empty($cruise['price_infant']))
                                        <span class="price-item"><strong>Child:</strong> ₹{{ number_format($cruise['price_infant']) }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="itinerary">
            <h2>Detailed Itinerary</h2>
            @if (!empty($record->itinerary))
                @foreach ($record->itinerary as $itinerary)
                    <h3 style="color: red"><strong> Day {{ $itinerary['days'] ?? 'N/A' }} </strong></h3>
                    {!! $itinerary['longdescription'] ?? 'No details available.' !!} <br /><br />
                @endforeach
            @else
                <p>No itinerary details available.</p>
            @endif
        </div>

        @if (!empty($record->rooms))
            <div class="hotels">
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
                                        <img src="{{ asset('storage/' . $image) }}" width="10px" alt="Hotel Image">
                                    @endforeach
                                @else
                                    <p>No images available.</p>
                                @endif
                            </div>
                            <div class="hotel-details">
                                <br><strong>{{ strtoupper($hotel->hotelName ?? 'Unknown Hotel') }}</strong><br>
                                Category: <strong>{{ $hoteltype->category ?? 'N/A' }}</strong><br>
                                Room Type: <strong>{{ $roomtype->category ?? 'N/A' }}</strong><br>
                                Meal Plan: <strong>{{ strtoupper($room['meal_plan'] ?? 'N/A') }}</strong>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        @if (empty($record->rooms))
            <div class="extras-margin material-card">
                <div class="icon-wrapper">
                    <i class="material-icons">info_outline</i>
                </div>
                <div class="content">
                    <p class="price-label">Per Person Price:</p>
                    <p class="price-value">₹.{{ number_format($ultimatePrice) }}/-</p>
                </div>
            </div>
        @endif


        <div class="inclusions">
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

        <div class="exclusions">
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

        <div class="cancellation-policy">
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

        <div class="kindly-notes">
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
                <div class="feature-item">
                    <i class="fas fa-calendar"></i>
                    <span>Since 2002</span>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
