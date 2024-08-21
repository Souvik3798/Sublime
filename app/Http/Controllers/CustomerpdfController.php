<?php

namespace App\Http\Controllers;

use App\Models\CustomPackage;
use App\Models\HotelCategory;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CustomerpdfController extends Controller
{
    // public function pdf(CustomPackage $record){



    //     $extracustomer = 0;
    //     $totalcustomers = 0;
    //     $childwithbed = 0;
    //     $childwithoutbed = 0;
    //     $totalroom = 0;
    //     $totaladultmatress = 0;
    //     $totalextrameal = 0;
    //     $totalmap = 0;
    //     $totalap = 0;
    //     $totalcruz = 0;
    //     $totalvehicle = 0;
    //     $totaladdon = 0;
    //     $grandtotal = 0;

    //     if($record->customers->adults>1 ){
    //         if(($record->customers->adults % 2) != 0){
    //             $totalcustomers = $record->customers->adults - 1;
    //             $extracustomer = 1;
    //         }
    //         else{
    //             $totalcustomers = $record->customers->adults;
    //         }
    //     }else{
    //         $totalcustomers = 1;
    //     }


    //     $childwithbed = $record->customers->childgreaterthan5;
    //     $childwithoutbed = $record->customers->childlessthan5;
    //     // dd($record->rooms);



    //     $adultcruz = 0;
    //     $childcruz = 0;

    //     $totalcruzpassenger = $totalcustomers+$extracustomer;

    //     foreach ($record->cruz as $cruz) {
    //         $adultcruz = $adultcruz + $cruz['price_adult']*$totalcruzpassenger;
    //         $childcruz = $childcruz + $cruz['price_infant']*$childwithoutbed;
    //     }

    //     $totalvehiclepassengers = $totalcustomers + $extracustomer + $childwithbed + $childwithoutbed;

    //     foreach ($record->vehicle as $vehicle){
    //         $totalvehicle = $totalvehicle + $vehicle['price'] * $totalvehiclepassengers;
    //     }

    //     foreach ($record->addons as $addon){
    //         $totaladdon = $totaladdon + $addon['price'];
    //     }


    //     $person=0;
    //     $hotelrates = [];
    //     foreach ($record->rooms as $room) {
    //         // dd($room['hotel_type']);
    //         $roomtype = HotelCategory::all();
    //         for ($i=1; $i <= count($roomtype); $i++) {
    //             if($room['hotel_type'] == $i){
    //                 if(!array_key_exists($i,$hotelrates)){
    //                     $hotelrates[$i] =  ($room['price']/2) + $room['adult_mattress_price'] + $room['child_without_mattress_price'] + $room['child_with_mattress_price'] + $room['extra_meal_price'] + $room['map'] + $room['ap'] * $room['no_of_room']*$totalcustomers;

    //                     if($extracustomer != 0){
    //                         $hotelrates[$i] = $hotelrates[$i] + ($room['price']/2) + $room['adult_mattress_price'] + $room['child_without_mattress_price'] + $room['child_with_mattress_price'] + $room['extra_meal_price'] + $room['map'] + $room['ap'] * $room['no_of_room'];
    //                     }
    //                 }
    //                 else{
    //                     $hotelrates[$i] = $hotelrates[$i] + ($room['price']/2) + $room['adult_mattress_price'] + $room['child_without_mattress_price'] + $room['child_with_mattress_price'] + $room['extra_meal_price'] + $room['map'] + $room['ap'] * $room['no_of_room']*$totalcustomers;

    //                     if($extracustomer != 0){
    //                         $hotelrates[$i] = $hotelrates[$i] + ($room['price']/2) + $room['adult_mattress_price'] + $room['child_without_mattress_price'] + $room['child_with_mattress_price'] + $room['extra_meal_price'] + $room['map'] + $room['ap'] * $room['no_of_room'];
    //                     }
    //                 }
    //             }
    //         }
    //     }

    //     $test = $hotelrates;
    //     foreach ($hotelrates as $rate => $room) {
    //          $hotelrates[$rate] = $hotelrates[$rate] + $adultcruz + $childcruz + $totalvehicle + $totaladdon;
    //     }

    //     $extras = $adultcruz +$childcruz + $totalvehicle + $totaladdon;



    //     $pdf = Pdf::loadView('pdf.package',compact(['record','hotelrates']));
    //     return $pdf->download($record->customers->customer.'.pdf');
    // }
    public function view(CustomPackage $record)
    {
        $extracustomer = 0;
        $totalcustomers = 0;
        $childwithbed = 0;
        $childwithoutbed = 0;
        $totalroom = 0;
        $totaladultmatress = 0;
        $totalextrameal = 0;
        $totalmap = 0;
        $totalap = 0;
        $totalcruz = 0;
        $totalvehicle = 0;
        $totaladdon = 0;
        $grandtotal = 0;
        $fee = 0;

        // Calculate total customers and extra customers
        $totalcustomers = $record->customers->adults;

        $childwithbed = $record->customers->childgreaterthan5;
        $childwithoutbed = $record->customers->childlessthan5;

        // Calculate total cruz costs
        $adultcruz = 0;
        $childcruz = 0;
        $totalcruzpassenger = $totalcustomers + $childwithbed;

        foreach ($record->cruz as $cruz) {
            $adultcruz += $cruz['price_adult'] * $totalcruzpassenger;
            $childcruz += $cruz['price_infant'] * $childwithoutbed;
        }


        $totalvehicle = $record->price + $record->luggage;


        //calculate Total fee

        $fee = $record->fee * ($record->customers->adults + $record->customers->childgreaterthan5 + $record->customers->childlessthan5);

        // Calculate total addon costs
        foreach ($record->addons as $addon) {
            $totaladdon += $addon['price'];
        }

        // Fetch all hotel categories once
        $hotelCategories = HotelCategory::all()->keyBy('id');

        // Calculate hotel rates
        $hotelrates = [];
        foreach ($record->rooms as $room) {
            $hotelTypeId = $room['hotel_type'];
            if (isset($hotelCategories[$hotelTypeId])) {
                if (!isset($hotelrates[$hotelTypeId])) {
                    $hotelrates[$hotelTypeId] = 0;
                }
                $hotelrates[$hotelTypeId] += ($room['price']) * $room['no_of_room'];
                $hotelrates[$hotelTypeId] += $room['adult_mattress_price'];
                $hotelrates[$hotelTypeId] += $room['extra_person_mattress'];
                $hotelrates[$hotelTypeId] += $room['child_with_mattress_price'];
            }
        }

        $extras = $adultcruz + $childcruz + $totalvehicle + $totaladdon + $fee;

        // dd($hotelrates);

        $margin = $record->margin * ($record->customers->adults + $record->customers->childgreaterthan5 + $record->customers->childlessthan5);
        // Add other rates to hotel rates
        foreach ($hotelrates as $type => $rate) {
            $hotelrates[$type] += $extras + $margin;
            // Log::info($hotelrates[$type]);
            $hotelrates[$type] /= ($record->customers->adults + $record->customers->childgreaterthan5);
            // Log::info($hotelrates[$type] . ',' . $record->customers->adults . ',' . $record->customers->childgreaterthan5);
        }

        // dd($hotelrates);



        // dd($margin, $record->customers->adults, $record->customers->childgreaterthan5, $record->customers->childlessthan5, $hotelrates);



        return view('pdf.package', compact(['record', 'hotelrates', 'margin']));
    }
}
