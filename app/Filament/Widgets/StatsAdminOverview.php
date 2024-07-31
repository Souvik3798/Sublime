<?php

namespace App\Filament\Widgets;

use App\Models\Addon;
use App\Models\Category;
use App\Models\Customers;
use App\Models\CustomPackage;
use App\Models\destination;
use App\Models\Hotel;
use App\Models\HotelCategory;
use App\Models\IternityTemplate;
use App\Models\PackageTemplate;
use App\Models\payment;
use App\Models\RoomCategory;
use App\Models\User;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsAdminOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $userId = auth()->id();

        // Define the time range (e.g., last 7 days)
        $startDate = Carbon::now()->subDays(6);
        $endDate = Carbon::now();

        // Initialize arrays to hold the counts for each stat
        $customPackageCounts = [];
        $customerCounts = [];
        $categoryCounts = [];
        $addonCounts = [];
        $iternityTemplateCounts = [];
        $packageTemplateCounts = [];
        $destinationCounts = [];
        $hotelCategoryCounts = [];
        $hotelCounts = [];
        $roomCategoryCounts = [];

        // Loop through each day in the range
        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            $customPackageCounts[] = CustomPackage::where('user_id', $userId)->whereDate('created_at', $date->format('Y-m-d'))->count();
            $customerCounts[] = Customers::where('user_id', $userId)->whereDate('created_at', $date->format('Y-m-d'))->count();
            $categoryCounts[] = Category::where('user_id', $userId)->whereDate('created_at', $date->format('Y-m-d'))->count();
            $addonCounts[] = Addon::where('user_id', $userId)->whereDate('created_at', $date->format('Y-m-d'))->count();
            $iternityTemplateCounts[] = IternityTemplate::where('user_id', $userId)->whereDate('created_at', $date->format('Y-m-d'))->count();
            $packageTemplateCounts[] = PackageTemplate::where('user_id', $userId)->whereDate('created_at', $date->format('Y-m-d'))->count();
            $destinationCounts[] = destination::where('user_id', $userId)->whereDate('created_at', $date->format('Y-m-d'))->count();
            $hotelCategoryCounts[] = HotelCategory::where('user_id', $userId)->whereDate('created_at', $date->format('Y-m-d'))->count();
            $hotelCounts[] = Hotel::where('user_id', $userId)->whereDate('created_at', $date->format('Y-m-d'))->count();
            $roomCategoryCounts[] = RoomCategory::where('user_id', $userId)->whereDate('created_at', $date->format('Y-m-d'))->count();
            $userCounts[] = User::whereDate('created_at', $date->format('Y-m-d'))->count(); // Count new users per day
            $revenuePerDay[] = Payment::where('user_id', $userId)->whereDate('created_at', $date->format('Y-m-d'))->sum('amount_paid'); // Sum revenue per day
        }

        $stats = [
            Stat::make('No. of Custom Packages', CustomPackage::where('user_id', $userId)->count())
                ->chart($customPackageCounts)
                ->color(array_sum($customPackageCounts) > 10 ? 'success' : (array_sum($customPackageCounts) > 5 ? 'warning' : 'danger'))
                ->description(array_sum($customPackageCounts) . ' packages created in last 7 days')
                ->descriptionIcon(array_sum($customPackageCounts) > 10 ? 'heroicon-m-arrow-trending-up' : (array_sum($customPackageCounts) > 5 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')),

            Stat::make('No. of Customers', Customers::where('user_id', $userId)->count())
                ->chart($customerCounts)
                ->color(array_sum($customerCounts) > 10 ? 'success' : (array_sum($customerCounts) > 5 ? 'warning' : 'danger'))
                ->description(array_sum($customerCounts) . ' customers added in last 7 days')
                ->descriptionIcon(array_sum($customerCounts) > 10 ? 'heroicon-m-arrow-trending-up' : (array_sum($customerCounts) > 5 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')),

            Stat::make('Total Categories', Category::where('user_id', $userId)->count())
                ->chart($categoryCounts)
                ->color(array_sum($categoryCounts) > 10 ? 'success' : (array_sum($categoryCounts) > 5 ? 'warning' : 'danger'))
                ->description(array_sum($categoryCounts) . ' categories added in last 7 days')
                ->descriptionIcon(array_sum($categoryCounts) > 10 ? 'heroicon-m-arrow-trending-up' : (array_sum($categoryCounts) > 5 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')),

            Stat::make('Total Addons', Addon::where('user_id', $userId)->count())
                ->chart($addonCounts)
                ->color(array_sum($addonCounts) > 10 ? 'success' : (array_sum($addonCounts) > 5 ? 'warning' : 'danger'))
                ->description(array_sum($addonCounts) . ' addons added in last 7 days')
                ->descriptionIcon(array_sum($addonCounts) > 10 ? 'heroicon-m-arrow-trending-up' : (array_sum($addonCounts) > 5 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')),

            Stat::make('Total Iternity Template', IternityTemplate::where('user_id', $userId)->count())
                ->chart($iternityTemplateCounts)
                ->color(array_sum($iternityTemplateCounts) > 10 ? 'success' : (array_sum($iternityTemplateCounts) > 5 ? 'warning' : 'danger'))
                ->description(array_sum($iternityTemplateCounts) . ' templates added in last 7 days')
                ->descriptionIcon(array_sum($iternityTemplateCounts) > 10 ? 'heroicon-m-arrow-trending-up' : (array_sum($iternityTemplateCounts) > 5 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')),

            Stat::make('Total Package Template', PackageTemplate::where('user_id', $userId)->count())
                ->chart($packageTemplateCounts)
                ->color(array_sum($packageTemplateCounts) > 10 ? 'success' : (array_sum($packageTemplateCounts) > 5 ? 'warning' : 'danger'))
                ->description(array_sum($packageTemplateCounts) . ' templates added in last 7 days')
                ->descriptionIcon(array_sum($packageTemplateCounts) > 10 ? 'heroicon-m-arrow-trending-up' : (array_sum($packageTemplateCounts) > 5 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')),

            Stat::make('Total Destinations', destination::where('user_id', $userId)->count())
                ->chart($destinationCounts)
                ->color(array_sum($destinationCounts) > 10 ? 'success' : (array_sum($destinationCounts) > 5 ? 'warning' : 'danger'))
                ->description(array_sum($destinationCounts) . ' destinations added in last 7 days')
                ->descriptionIcon(array_sum($destinationCounts) > 10 ? 'heroicon-m-arrow-trending-up' : (array_sum($destinationCounts) > 5 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')),

            Stat::make('Total Hotel Types', HotelCategory::where('user_id', $userId)->count())
                ->chart($hotelCategoryCounts)
                ->color(array_sum($hotelCategoryCounts) > 10 ? 'success' : (array_sum($hotelCategoryCounts) > 5 ? 'warning' : 'danger'))
                ->description(array_sum($hotelCategoryCounts) . ' categories added in last 7 days')
                ->descriptionIcon(array_sum($hotelCategoryCounts) > 10 ? 'heroicon-m-arrow-trending-up' : (array_sum($hotelCategoryCounts) > 5 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')),

            Stat::make('Total Hotels', Hotel::where('user_id', $userId)->count())
                ->chart($hotelCounts)
                ->color(array_sum($hotelCounts) > 10 ? 'success' : (array_sum($hotelCounts) > 5 ? 'warning' : 'danger'))
                ->description(array_sum($hotelCounts) . ' hotels added in last 7 days')
                ->descriptionIcon(array_sum($hotelCounts) > 10 ? 'heroicon-m-arrow-trending-up' : (array_sum($hotelCounts) > 5 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')),

            Stat::make('Total Room Types', RoomCategory::where('user_id', $userId)->count())
                ->chart($roomCategoryCounts)
                ->color(array_sum($roomCategoryCounts) > 10 ? 'success' : (array_sum($roomCategoryCounts) > 5 ? 'warning' : 'danger'))
                ->description(array_sum($roomCategoryCounts) . ' room categories added in last 7 days')
                ->descriptionIcon(array_sum($roomCategoryCounts) > 10 ? 'heroicon-m-arrow-trending-up' : (array_sum($roomCategoryCounts) > 5 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')),
        ];

        // Only add the payment stats if the user ID is 1
        if ($userId === 1) {
            $paymentCounts = [];
            for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
                $paymentCounts[] = Payment::where('user_id', $userId)->whereDate('created_at', $date->format('Y-m-d'))->count();
            }
            $stats[] = Stat::make('Total Users', User::count())
                ->chart($userCounts)
                ->color(array_sum($userCounts) > 10 ? 'success' : (array_sum($userCounts) > 5 ? 'warning' : 'danger'))
                ->description(array_sum($userCounts) . ' new users added in last 7 days')
                ->descriptionIcon(array_sum($userCounts) > 10 ? 'heroicon-m-arrow-trending-up' : (array_sum($userCounts) > 5 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down'));
            $stats[] = Stat::make('No. of Payment Voucher', Payment::where('user_id', $userId)->count())
                ->chart($paymentCounts)
                ->color(array_sum($paymentCounts) > 10 ? 'success' : (array_sum($paymentCounts) > 5 ? 'warning' : 'danger'))
                ->description(array_sum($paymentCounts) . ' payments processed in last 7 days')
                ->descriptionIcon(array_sum($paymentCounts) > 10 ? 'heroicon-m-arrow-trending-up' : (array_sum($paymentCounts) > 5 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down'));
            $stats[] = Stat::make('Total Revenue', '₹ ' . Payment::where('user_id', $userId)->sum('amount_paid'))
                ->chart($revenuePerDay)
                ->color(array_sum($revenuePerDay) > 10000 ? 'success' : (array_sum($revenuePerDay) > 5000 ? 'warning' : 'danger'))
                ->description('₹ ' . array_sum($revenuePerDay) . ' revenue generated in last 7 days')
                ->descriptionIcon(array_sum($revenuePerDay) > 10000 ? 'heroicon-m-arrow-trending-up' : (array_sum($revenuePerDay) > 5000 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down'));
        }

        return $stats;
    }
}
