@php
    $user = auth()->check() ? App\Models\User::find(auth()->id()) : null;
@endphp

<!DOCTYPE html>
<html lang="en">
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
            * {
                -webkit-print-color-adjust: exact !important;
                color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            img {
                max-width: 100% !important;
                height: auto !important;
                display: block !important;
                object-fit: cover !important;
            }

            td {
                page-break-inside: avoid !important;
            }

            table {
                width: 100% !important;
                table-layout: fixed !important;
                border-spacing: 10px !important;
            }

            body {
                background: white !important;
                padding: 20px !important;
                margin: 0 !important;
                font-size: 12px !important;
                line-height: 1.4 !important;
            }

            .max-w-6xl {
                max-width: none !important;
                width: 100% !important;
            }

            .glass-card, .glass-header {
                backdrop-filter: none !important;
                -webkit-backdrop-filter: none !important;
                background: white !important;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1) !important;
                border: 1px solid #e5e7eb !important;
                margin-bottom: 20px !important;
                page-break-inside: avoid !important;
            }

            .glass-header {
                background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%) !important;
                color: white !important;
            }

            .feature-item, .price-card {
                background: #f8fafc !important;
                border: 1px solid #e5e7eb !important;
                box-shadow: none !important;
            }

            .hotel-card {
                background: white !important;
                border: 1px solid #e5e7eb !important;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1) !important;
                page-break-inside: avoid !important;
            }

            .inclusions li::before, .exclusions li::before {
                background: white !important;
                border: 2px solid #22c55e !important;
            }

            .exclusions li::before {
                border-color: #ef4444 !important;
            }

            .text-primary {
                color: #2563eb !important;
            }

            .text-green-600 {
                color: #16a34a !important;
            }

            .text-red-600 {
                color: #dc2626 !important;
            }

            .text-accent {
                color: #e11d48 !important;
            }

            .bg-primary {
                background-color: #2563eb !important;
            }

            .bg-green-100 {
                background-color: #dcfce7 !important;
            }

            .bg-red-100 {
                background-color: #fee2e2 !important;
            }

            .bg-blue-100 {
                background-color: #dbeafe !important;
            }

            .bg-purple-100 {
                background-color: #f3e8ff !important;
            }

            .border-primary {
                border-color: #2563eb !important;
            }

            .border-green-600 {
                border-color: #16a34a !important;
            }

            .border-red-600 {
                border-color: #dc2626 !important;
            }

            .rounded-xl, .rounded-2xl, .rounded-lg {
                border-radius: 8px !important;
            }

            .rounded-full {
                border-radius: 9999px !important;
            }

            .p-6 {
                padding: 20px !important;
            }

            .p-8 {
                padding: 24px !important;
            }

            .mb-8 {
                margin-bottom: 24px !important;
            }

            .mb-6 {
                margin-bottom: 20px !important;
            }

            .mb-4 {
                margin-bottom: 16px !important;
            }

            .text-4xl {
                font-size: 28px !important;
            }

            .text-3xl {
                font-size: 24px !important;
            }

            .text-2xl {
                font-size: 20px !important;
            }

            .text-xl {
                font-size: 18px !important;
            }

            .text-lg {
                font-size: 16px !important;
            }

            .text-sm {
                font-size: 11px !important;
            }

            .text-xs {
                font-size: 10px !important;
            }

            .grid {
                display: grid !important;
            }

            .md\\:grid-cols-2 {
                grid-template-columns: repeat(2, 1fr) !important;
            }

            .flex {
                display: flex !important;
            }

            .flex-col {
                flex-direction: column !important;
            }

            .items-center {
                align-items: center !important;
            }

            .justify-center {
                justify-content: center !important;
            }

            .gap-4 {
                gap: 16px !important;
            }

            .gap-2 {
                gap: 8px !important;
            }

            .space-y-6 > * + * {
                margin-top: 24px !important;
            }

            .space-y-4 > * + * {
                margin-top: 16px !important;
            }

            .space-y-3 > * + * {
                margin-top: 12px !important;
            }

            .w-full {
                width: 100% !important;
            }

            .h-24 {
                height: 96px !important;
            }

            .w-24 {
                width: 96px !important;
            }

            .object-contain {
                object-fit: contain !important;
            }

            .overflow-hidden {
                overflow: hidden !important;
            }

            .text-center {
                text-align: center !important;
            }

            .font-bold {
                font-weight: 700 !important;
            }

            .font-medium {
                font-weight: 500 !important;
            }

            .font-playfair {
                font-family: 'Playfair Display', serif !important;
            }

            .font-poppins {
                font-family: 'Poppins', sans-serif !important;
            }

            .border-collapse {
                border-collapse: collapse !important;
            }

            .divide-y > * + * {
                border-top: 1px solid #e5e7eb !important;
            }

            .bg-gray-100\\/50 {
                background-color: #f9fafb !important;
            }

            .hover\\:bg-gray-50\\/50:hover {
                background-color: #f9fafb !important;
            }

            .py-3 {
                padding-top: 12px !important;
                padding-bottom: 12px !important;
            }

            .px-4 {
                padding-left: 16px !important;
                padding-right: 16px !important;
            }

            .colspan-3 {
                grid-column: span 3 / span 3 !important;
            }

            .aspect-w-16 {
                position: relative !important;
                padding-bottom: 56.25% !important;
            }

            .aspect-h-9 {
                position: absolute !important;
                height: 100% !important;
                width: 100% !important;
                top: 0 !important;
                right: 0 !important;
                bottom: 0 !important;
                left: 0 !important;
            }

            .bg-gray-200 {
                background-color: #e5e7eb !important;
            }

            .border-2 {
                border-width: 2px !important;
            }

            .border-dashed {
                border-style: dashed !important;
            }

            .h-24 {
                height: 96px !important;
            }

            .text-yellow-400 {
                color: #facc15 !important;
            }

            .text-gray-300 {
                color: #d1d5db !important;
            }

            .text-gray-600 {
                color: #4b5563 !important;
            }

            .text-gray-800 {
                color: #1f2937 !important;
            }

            .text-white {
                color: white !important;
            }

            .bg-white {
                background-color: white !important;
            }

            .bg-white\\/30 {
                background-color: rgba(255, 255, 255, 0.3) !important;
            }

            .bg-primary\\/10 {
                background-color: rgba(37, 99, 235, 0.1) !important;
            }

            .bg-gradient-to-br {
                background-image: linear-gradient(to bottom right, var(--tw-gradient-stops)) !important;
            }

            .from-blue-50 {
                --tw-gradient-from: #eff6ff !important;
                --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(239, 246, 255, 0)) !important;
            }

            .to-cyan-50 {
                --tw-gradient-to: #ecfeff !important;
            }

            .md\\:w-2\\/5 {
                width: 40% !important;
            }

            .md\\:w-3\\/5 {
                width: 60% !important;
            }

            .md\\:flex {
                display: flex !important;
            }

            .md\\:pr-10 {
                padding-right: 40px !important;
            }

            .md\\:pl-10 {
                padding-left: 40px !important;
            }

            .md\\:text-right {
                text-align: right !important;
            }

            .md\\:grid-cols-2 {
                grid-template-columns: repeat(2, 1fr) !important;
            }

            .md\\:flex-row {
                flex-direction: row !important;
            }

            .md\\:mb-0 {
                margin-bottom: 0 !important;
            }

            .md\\:text-5xl {
                font-size: 32px !important;
            }

            .md\\:text-3xl {
                font-size: 24px !important;
            }

            .md\\:text-base {
                font-size: 14px !important;
            }

            .md\\:p-8 {
                padding: 24px !important;
            }

            .md\\:grid-cols-2 {
                grid-template-columns: repeat(2, 1fr) !important;
            }

            .max-w-lg {
                max-width: 512px !important;
            }

            .mx-auto {
                margin-left: auto !important;
                margin-right: auto !important;
            }

            .max-w-2xl {
                max-width: 672px !important;
            }

            .text-3xl {
                font-size: 24px !important;
            }

            .text-2xl {
                font-size: 20px !important;
            }

            .text-xl {
                font-size: 18px !important;
            }

            .text-lg {
                font-size: 16px !important;
            }

            .text-sm {
                font-size: 11px !important;
            }

            .text-xs {
                font-size: 10px !important;
            }

            .p-3 {
                padding: 12px !important;
            }

            .p-4 {
                padding: 16px !important;
            }

            .p-5 {
                padding: 20px !important;
            }

            .py-1 {
                padding-top: 4px !important;
                padding-bottom: 4px !important;
            }

            .px-4 {
                padding-left: 16px !important;
                padding-right: 16px !important;
            }

            .py-3 {
                padding-top: 12px !important;
                padding-bottom: 12px !important;
            }

            .px-4 {
                padding-left: 16px !important;
                padding-right: 16px !important;
            }

            .py-8 {
                padding-top: 32px !important;
                padding-bottom: 32px !important;
            }

            .py-4 {
                padding-top: 16px !important;
                padding-bottom: 16px !important;
            }

            .py-3 {
                padding-top: 12px !important;
                padding-bottom: 12px !important;
            }

            .px-8 {
                padding-left: 32px !important;
                padding-right: 32px !important;
            }

            .mt-2 {
                margin-top: 8px !important;
            }

            .mt-3 {
                margin-top: 12px !important;
            }

            .mt-4 {
                margin-top: 16px !important;
            }

            .mt-6 {
                margin-top: 24px !important;
            }

            .mt-8 {
                margin-top: 32px !important;
            }

            .mt-10 {
                margin-top: 40px !important;
            }

            .mb-2 {
                margin-bottom: 8px !important;
            }

            .mb-3 {
                margin-bottom: 12px !important;
            }

            .mb-4 {
                margin-bottom: 16px !important;
            }

            .mb-6 {
                margin-bottom: 24px !important;
            }

            .mb-8 {
                margin-bottom: 32px !important;
            }

            .mb-10 {
                margin-bottom: 40px !important;
            }

            .mb-16 {
                margin-bottom: 64px !important;
            }

            .ml-auto {
                margin-left: auto !important;
            }

            .mr-auto {
                margin-right: auto !important;
            }

            .mx-auto {
                margin-left: auto !important;
                margin-right: auto !important;
            }

            .pt-6 {
                padding-top: 24px !important;
            }

            .border-t {
                border-top-width: 1px !important;
            }

            .border-gray-200\\/50 {
                border-color: rgba(229, 231, 235, 0.5) !important;
            }

            .border-b-2 {
                border-bottom-width: 2px !important;
            }

            .border-white\\/40 {
                border-color: rgba(255, 255, 255, 0.4) !important;
            }

            .border-white\\/30 {
                border-color: rgba(255, 255, 255, 0.3) !important;
            }

            .rounded-xl {
                border-radius: 12px !important;
            }

            .rounded-lg {
                border-radius: 8px !important;
            }

            .rounded-full {
                border-radius: 9999px !important;
            }

            .rounded-2xl {
                border-radius: 16px !important;
            }

            .overflow-hidden {
                overflow: hidden !important;
            }

            .overflow-x-auto {
                overflow-x: auto !important;
            }

            .text-left {
                text-align: left !important;
            }

            .text-center {
                text-align: center !important;
            }

            .text-right {
                text-align: right !important;
            }

            .font-bold {
                font-weight: 700 !important;
            }

            .font-medium {
                font-weight: 500 !important;
            }

            .font-playfair {
                font-family: 'Playfair Display', serif !important;
            }

            .font-poppins {
                font-family: 'Poppins', sans-serif !important;
            }

            .inline-block {
                display: inline-block !important;
            }

            .inline-flex {
                display: inline-flex !important;
            }

            .flex {
                display: flex !important;
            }

            .grid {
                display: grid !important;
            }

            .hidden {
                display: none !important;
            }

            .items-center {
                align-items: center !important;
            }

            .items-start {
                align-items: flex-start !important;
            }

            .justify-center {
                justify-content: center !important;
            }

            .justify-between {
                justify-content: space-between !important;
            }

            .flex-col {
                flex-direction: column !important;
            }

            .flex-row {
                flex-direction: row !important;
            }

            .flex-wrap {
                flex-wrap: wrap !important;
            }

            .flex-shrink-0 {
                flex-shrink: 0 !important;
            }

            .gap-2 {
                gap: 8px !important;
            }

            .gap-4 {
                gap: 16px !important;
            }

            .space-y-3 > * + * {
                margin-top: 12px !important;
            }

            .space-y-4 > * + * {
                margin-top: 16px !important;
            }

            .space-y-6 > * + * {
                margin-top: 24px !important;
            }

            .divide-y > * + * {
                border-top: 1px solid #e5e7eb !important;
            }

            .w-full {
                width: 100% !important;
            }

            .w-6 {
                width: 24px !important;
            }

            .w-8 {
                width: 32px !important;
            }

            .w-24 {
                width: 96px !important;
            }

            .h-6 {
                height: 24px !important;
            }

            .h-8 {
                height: 32px !important;
            }

            .h-24 {
                height: 96px !important;
            }

            .object-contain {
                object-fit: contain !important;
            }

            .bg-cover {
                background-size: cover !important;
            }

            .bg-center {
                background-position: center !important;
            }

            .relative {
                position: relative !important;
            }

            .absolute {
                position: absolute !important;
            }

            .z-10 {
                z-index: 10 !important;
            }

            .top-2 {
                top: 8px !important;
            }

            .left-0 {
                left: 0 !important;
            }

            .-ml-2 {
                margin-left: -8px !important;
            }

            .-ml-2 {
                margin-left: -8px !important;
            }

            .w-4 {
                width: 16px !important;
            }

            .h-4 {
                height: 16px !important;
            }

            .border-4 {
                border-width: 4px !important;
            }

            .border-white {
                border-color: white !important;
            }

            .no-print-shadow {
                box-shadow: none !important;
            }

            .print-padding {
                padding: 8px !important;
            }

            /* Ensure images print properly */
            img {
                max-width: 100% !important;
                height: auto !important;
                page-break-inside: avoid !important;
                display: block !important;
            }

            /* Hotel image specific styles for print */
            .hotel-card img {
                width: 100% !important;
                height: 96px !important;
                object-fit: cover !important;
                border-radius: 12px !important;
                display: block !important;
                max-width: none !important;
            }

            /* Ensure images are properly sized in PDF */
            .hotel-card .grid img {
                width: 100% !important;
                height: 96px !important;
                object-fit: cover !important;
                border-radius: 12px !important;
                display: block !important;
            }

            /* Ensure hotel image containers work properly in print */
            .hotel-card .rounded-xl {
                border-radius: 12px !important;
                overflow: hidden !important;
            }

            /* Fallback for missing images in print */
            .hotel-card .bg-gray-200 {
                background-color: #e5e7eb !important;
                border: 2px dashed #9ca3af !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
            }

            .hotel-card .material-icons {
                font-size: 24px !important;
                color: #9ca3af !important;
            }

            /* Prevent page breaks in critical sections */
            .glass-header {
                page-break-after: avoid !important;
            }

            .hotel-card {
                page-break-inside: avoid !important;
            }

            /* Ensure table rows don't break across pages */
            tr {
                page-break-inside: avoid !important;
            }

            /* Ensure list items don't break across pages */
            li {
                page-break-inside: avoid !important;
            }

            /* Hide any elements that shouldn't print */
            .no-print {
                display: none !important;
            }

            /* Ensure proper spacing for print */
            .print-spacing {
                margin-bottom: 20px !important;
            }

            /* Itinerary specific print styles */
            .glass-card {
                page-break-inside: avoid !important;
            }

            /* Timeline line for print */
            .glass-card div[style*="position: absolute"][style*="left: 30px"] {
                background: linear-gradient(to bottom, #7c3aed, #2563eb) !important;
                width: 3px !important;
                border-radius: 2px !important;
            }

            /* Day circles for print */
            .glass-card div[style*="border-radius: 50%"] {
                background: #2563eb !important;
                border: 4px solid white !important;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important;
            }

            /* Content cards for print */
            .glass-card div[style*="background: white"][style*="border-radius: 12px"] {
                background: white !important;
                border: 1px solid #e5e7eb !important;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important;
                page-break-inside: avoid !important;
            }

            /* Tags for print */
            .glass-card span[style*="background: #f3f4f6"] {
                background: #f3f4f6 !important;
                color: #374151 !important;
                border: 1px solid #e5e7eb !important;
            }

            /* Ensure timeline items don't break across pages */
            .glass-card div[style*="position: relative"][style*="margin-bottom: 40px"] {
                page-break-inside: avoid !important;
                margin-bottom: 30px !important;
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

        @php
            $cruises = collect($record->cruz);
            $chunks = $cruises->chunk(2);
        @endphp

        <table style="width: 100%; border-spacing: 16px;">
            @foreach ($chunks as $row)
                <tr>
                    @foreach ($row as $cruise)
                        @php
                            $ferry = App\Models\Ferry::where('id', $cruise['cruz'])->first();
                        @endphp
                        <td style="width: 50%; vertical-align: top;">
                            <div style="display: flex; background: #f9f9f9; border-radius: 12px; padding: 12px; gap: 12px;">
                                <div style="background: #e0e7ff; padding: 12px; border-radius: 8px;">
                                    <i class="material-icons" style="font-size: 28px; color: #3b82f6;">directions_boat</i>
                                </div>
                                <div>
                                    <h3 style="font-weight: bold; font-size: 16px; color: #1f2937;">{{ $ferry->Title ?? 'Cruise Name Not Available' }}</h3>
                                    <div style="margin-top: 4px; font-size: 14px; color: #374151;">
                                        @if (!empty($cruise['source']))
                                            <p style="margin: 2px 0;">📍 Route: {{ $cruise['source'] }}</p>
                                        @endif
                                        @if (!empty($cruise['class']))
                                            <p style="margin: 2px 0;">⭐ Class: {{ $cruise['class'] }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                    @endforeach

                    @if ($row->count() < 2)
                        <td style="width: 50%;"></td> {{-- Fill blank cell if odd number --}}
                    @endif
                </tr>
            @endforeach
        </table>
    </div>
@endif


            <!-- Itinerary -->
            <div class="glass-card p-6 md:p-8">
                <h2 class="font-playfair text-2xl md:text-3xl font-bold text-primary mb-6 pb-2 border-b-2 border-primary inline-block">
                    Detailed Itinerary
                </h2>

                <div class="mt-8" style="position: relative;">
                    <!-- Vertical Timeline Line -->
                    <div style="position: absolute; left: 30px; top: 0; bottom: 0; width: 3px; background: linear-gradient(to bottom, #7c3aed, #2563eb); border-radius: 2px;"></div>

                    @if (!empty($record->itinerary))
                        @foreach ($record->itinerary as $index => $itinerary)
                            <div style="position: relative; margin-bottom: 40px; padding-left: 80px;">
                                <!-- Day Circle -->
                                <div style="position: absolute; left: 0; top: 0; width: 60px; height: 60px; background: #2563eb; border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 4px solid white; box-shadow: 0 2px 8px rgba(0,0,0,0.1); z-index: 10;">
                                    <span style="color: white; font-weight: bold; font-size: 18px;">{{ $itinerary['days'] ?? $index + 1 }}</span>
                                </div>

                                <!-- Content Card -->
                                <div style="background: white; border-radius: 12px; padding: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); border: 1px solid #e5e7eb;">
                                    <h3 style="font-weight: bold; font-size: 20px; color: #1f2937; margin-bottom: 12px; font-family: 'Playfair Display', serif;">
                                        {{ $itinerary['name'] ?? 'Day ' . ($itinerary['days'] ?? $index + 1) }}
                                    </h3>

                                    <div style="color: #374151; line-height: 1.6; margin-bottom: 16px;">
                                        {!! $itinerary['longdescription'] ?? 'No details available.' !!}
                                    </div>

                                    <!-- Tags -->
                                    <div style="display: flex; gap: 8px; flex-wrap: wrap; margin-top: 12px;">
                                        @if (!empty($itinerary['destination']))
                                        <span style="background: #f3f4f6; color: #374151; padding: 4px 12px; border-radius: 16px; font-size: 12px; font-weight: 500;">
                                            Destination: {{ $itinerary['destination'] }}
                                        </span>
                                        @endif
                                        @if (!empty($itinerary['description']))
                                        <span style="background: #f3f4f6; color: #374151; padding: 4px 12px; border-radius: 16px; font-size: 12px; font-weight: 500;">
                                            {{ $itinerary['description'] }}
                                        </span>
                                        @endif
                                        @if (!empty($itinerary['locations']))
                                        <span style="background: #f3f4f6; color: #374151; padding: 4px 12px; border-radius: 16px; font-size: 12px; font-weight: 500;">
                                            Locations: {{ is_array($itinerary['locations']) ? implode(', ', $itinerary['locations']) : $itinerary['locations'] }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div style="text-align: center; padding: 40px; color: #6b7280;">
                            <i class="material-icons" style="font-size: 48px; color: #d1d5db; margin-bottom: 16px;">schedule</i>
                            <p style="font-size: 16px;">No itinerary details available.</p>
                        </div>
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
                                    @php
                                        $hotelImages = App\Models\HotelImage::where('hotel_id', $room['hotel_name'])->first();
                                    @endphp
                                    @if ($hotelImages && !empty($hotelImages->images))
                                        <table style="width: 100%; border-spacing: 8px; table-layout: fixed; margin-top: 10px;">
                                            <tr>
                                                @foreach (array_slice($hotelImages->images, 0, 4) as $i => $image)
                                                    <td style="width: 50%; padding: 0;">
                                                        <img src="{{ asset('storage/' . $image) }}"
                                                            alt="Hotel Image"
                                                            style="width: 100%; height: 100px; object-fit: cover; border-radius: 12px; display: block;" />
                                                    </td>
                                                    @if (($i + 1) % 2 == 0 && $i !== 3)
                                                        </tr><tr>
                                                    @endif
                                                @endforeach
                                            </tr>
                                        </table>
                                    @else
                                        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 8px; margin-top: 10px;">
                                            @for ($i = 0; $i < 4; $i++)
                                                <div style="background-color: #e5e7eb; border: 2px dashed #ccc; border-radius: 12px; width: 100%; height: 100px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="material-icons" style="color: #ccc;">image</i>
                                                </div>
                                            @endfor
                                        </div>
                                    @endif

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
