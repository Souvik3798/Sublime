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
        $waterSportsTotal = 0;

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

        // Calculate total fee
        $fee = $record->fee * ($record->customers->adults + $record->customers->childgreaterthan5 + $record->customers->childlessthan5);

        // Calculate total addon costs
        foreach ($record->addons as $addon) {
            $totaladdon += $addon['price'];
        }

        // Calculate water sports costs
        if (!empty($record->water_sports)) {
            foreach ($record->water_sports as $activity) {
                $waterSportsTotal += ($activity['adult_price'] * $totalcustomers);
                $waterSportsTotal += ($activity['child_5_12_price'] * $childwithbed);
                $waterSportsTotal += ($activity['child_2_5_price'] * $childwithoutbed);
                $waterSportsTotal += ($activity['infant_price']);
            }
        }

        // Calculate total hotel costs
        $totalHotelCost = 0;
        if (!empty($record->rooms)) {
            foreach ($record->rooms as $room) {
                $totalHotelCost += ($room['price'] * $room['no_of_room']);
                $totalHotelCost += $room['adult_mattress_price'];
                $totalHotelCost += $room['extra_person_mattress'];
                $totalHotelCost += $room['child_with_mattress_price'];
                $totalHotelCost += $room['surge_charges'];
                $totalHotelCost += $room['gala_dinner_24_dec'];
                $totalHotelCost += $room['gala_dinner_31_dec'];
            }
        }

        $extras = $adultcruz + $childcruz + $totalvehicle + $totaladdon + $fee + $waterSportsTotal;
        $margin = $record->margin * ($record->customers->adults + $record->customers->childgreaterthan5 + $record->customers->childlessthan5);

        // Calculate ultimate price per person
        $totalPersons = $record->customers->adults + $record->customers->childgreaterthan5;
        $ultimatePrice = ($totalHotelCost + $extras + $margin) / $totalPersons;

        // Return the view (unchanged)
        return view('pdf.package', compact('record', 'ultimatePrice'));
    }
}
