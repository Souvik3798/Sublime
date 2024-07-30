<?php

namespace App\Filament\Widgets;

use App\Models\Addon;
use App\Models\Category;
use App\Models\Customers;
use App\Models\CustomPackage;
use App\Models\IternityTemplate;
use App\Models\PackageTemplate;
use App\Models\payment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsAdminOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $userId = auth()->id();

        $stats = [
            Stat::make('No. of Custom Packages', CustomPackage::where('user_id', $userId)->count()),
            Stat::make('No. of Customer', Customers::where('user_id', $userId)->count()),
            Stat::make('Total Categories', Category::where('user_id', $userId)->count()),
            Stat::make('Total Addons', Addon::where('user_id', $userId)->count()),
            Stat::make('Total Iternity Template', IternityTemplate::where('user_id', $userId)->count()),
            Stat::make('Total Package Template', PackageTemplate::where('user_id', $userId)->count()),
        ];

        // Only add the payment stats if the user ID is 1
        if ($userId === 1) {
            $stats[] = Stat::make('No. of Payment Voucher', Payment::where('user_id', $userId)->count());
            $stats[] = Stat::make('Total Revenue', '₹ ' . Payment::where('user_id', $userId)->sum('amount_paid'));
        }

        return $stats;
    }
}
