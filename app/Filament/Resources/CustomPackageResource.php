<?php


namespace App\Filament\Resources;

use App\Filament\Resources\CustomPackageResource\Pages;
use App\Models\Addon;
use App\Models\Cab;
use App\Models\Cabs;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Customers;
use App\Models\CustomPackage;
use App\Models\destination;
use App\Models\Entryfees;
use App\Models\Ferry;
use App\Models\Hotel;
use App\Models\HotelCategory;
use App\Models\IternityTemplate;
use App\Models\PackageTemplate;
use App\Models\RoomCategory;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\ReplicateAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Log;

class CustomPackageResource extends Resource
{
    protected static ?string $model = CustomPackage::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Packages';

    protected static ?int $navigationSort = 12;




    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Tabs::make('General Package')
                    ->tabs([
                        Tab::make('Personal Info')
                            ->schema([
                                TextInput::make('customers_id')
                                    ->label('Customer Number')
                                    ->disabled()
                                    ->live()
                                    ->dehydrated(),

                                Hidden::make('user_id')
                                    ->default(auth()->id()),
                                Select::make('cid')
                                    ->options(Customers::where('user_id', auth()->id())->pluck('customer', 'cid'))
                                    ->searchable()
                                    ->live()
                                    ->label('Customer Name')
                                    ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                        if ($operation !== 'create' && $operation !== 'edit') {
                                            return;
                                        }
                                        self::populateCustomerData($state, $set);
                                    })
                                    ->afterStateHydrated(function ($state, Forms\Set $set) {
                                        self::populateCustomerData($state, $set);
                                    }),
                                TextInput::make('customer')
                                    ->label('Customer ID')
                                    ->dehydrated()
                                    ->disabled()
                                    ->live(),
                                TextInput::make('number')
                                    ->label('Mobile Number')
                                    ->prefix('+91')
                                    ->disabled(),
                                TextInput::make('adults')
                                    ->label('Number of Adults')
                                    ->numeric()
                                    ->disabled()
                                    ->default(0)
                                    ->afterStateUpdated(function ($state) {
                                        session(['adults' => $state]);
                                    })
                                    ->afterStateHydrated(function ($state) {
                                        session(['adults' => $state]);
                                    })
                                    ->live()
                                    ->reactive(),
                                TextInput::make('childgreaterthan5')
                                    ->label('Number of children (5-12 yrs)')
                                    ->disabled()
                                    ->placeholder('If none, please type 0')
                                    ->default(0)
                                    ->numeric(),
                                TextInput::make('childlessthan5')
                                    ->label('Number of children (Upto 2-5 yrs)')
                                    ->disabled()
                                    ->placeholder('If none, please type 0')
                                    ->default(0)
                                    ->numeric(),
                                TextInput::make('dateofarrival')
                                    ->label('Date of Arrival')
                                    ->disabled(),
                                TextInput::make('dateofdeparture')
                                    ->label('Date of Departure')
                                    ->disabled(),
                            ])->columns(3),


                        Tab::make('Add Package')
                            ->schema([
                                Select::make('category_id')
                                    ->label('Category')
                                    ->options(Category::where('user_id', auth()->id())->pluck('name', 'id'))
                                    ->live()
                                    ->required(),
                                TextInput::make('name')
                                    ->label('Title')
                                    ->datalist(function (callable $get) {
                                        if (!$get('category_id')) {
                                            return;
                                        } else {
                                            return PackageTemplate::where('category_id', $get('category_id'))->pluck('name');
                                        }
                                    })
                                    ->live()
                                    ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                        if ($operation !== 'create' && $operation !== 'edit') {
                                            return;
                                        }


                                        $packs = PackageTemplate::where('name', $state)->get();


                                        foreach ($packs as $pack) {
                                            $day = $pack->days;
                                            $night = $pack->nights;
                                            $inclusions = $pack->inclusions;
                                            $exclusions = $pack->exclusions;
                                            $catid = $pack->category_id;
                                        }

                                        if ($packs->count() > 0) {
                                            $set('inclusions', $inclusions);
                                            $set('exclusions', $exclusions);
                                            $set('days', $day);
                                            $set('nights', $night);
                                            $set('category_id', $catid);
                                        }
                                    })
                                    ->required()
                                    ->autocomplete('off'),
                                TextInput::make('days')
                                    ->required()
                                    ->label('Number of Days')
                                    ->numeric(),
                                TextInput::make('nights')
                                    ->required()
                                    ->label('Number of Nights')
                                    ->numeric(),
                                TagsInput::make('inclusions')
                                    ->required(),
                                TagsInput::make('exclusions')
                                    ->required()
                                    ->hintColor('green'),
                                TextInput::make('margin')
                                    ->label('Enter Margin Price Per Customer')
                                    ->required()
                                    ->numeric()
                                    ->default(5),
                                // FileUpload::make('image')
                                // ->disk('public')->directory('custom')
                                // ->image()
                            ])->columns(4),
                        Tab::make('Add itinerary')
                            ->schema([
                                Repeater::make('itinerary')
                                    ->schema([
                                        Select::make('days')
                                            ->label('Day')
                                            ->required()
                                            ->options(['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20']),
                                        Select::make('destination')
                                            ->label('Select Destinations')
                                            ->options(destination::where('user_id', auth()->id())->pluck('Title', 'Title'))
                                            ->required(),
                                        TextInput::make('name')
                                            ->label('Title')
                                            ->datalist(IternityTemplate::where('user_id', auth()->id())->pluck('Title'))
                                            ->live()
                                            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                                if ($operation !== 'create' && $operation !== 'edit') {
                                                    return;
                                                }

                                                $packs = IternityTemplate::where('Title', $state)->get();

                                                foreach ($packs as $pack) {
                                                    $description = $pack->Description;
                                                    $longdescription = $pack->Longdescription;
                                                    $locations = $pack->locationCovered;
                                                }

                                                $s = ["<p>", "</p>", "<i>", "</i>"];
                                                if ($packs->count() > 0) {
                                                    $set('description', str_replace($s, "", $description));
                                                    $set('locations', $locations);
                                                    $set('longdescription', $longdescription);
                                                }
                                            })
                                            ->required(),
                                        Textarea::make('description')
                                            ->label('Short description')
                                            ->required(),
                                        TagsInput::make('locations')
                                            ->required(),
                                        RichEditor::make('longdescription')
                                            ->label('Detailed Description')
                                            ->required(),
                                        // DatePicker::make('date')
                                        //     ->label('Date')
                                    ])->columns(2)->addActionLabel('Add itinerary')
                            ]),
                        Tab::make('Add Rooms')
                            ->schema([
                                Repeater::make('rooms')
                                    ->schema([
                                        Section::make('Basic Details')
                                            ->schema([
                                                Fieldset::make('Location details')
                                                    ->schema([
                                                        Select::make('location')
                                                            ->label('Select Location')
                                                            ->options(destination::where('user_id', auth()->id())->pluck('Title', 'id'))
                                                            ->required()
                                                            ->live()
                                                            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                                                if ($operation === 'create' || $operation === 'edit') {
                                                                    $set('hotel_type', null); // Reset hotel type
                                                                    $set('hotel_name', null); // Reset hotel name
                                                                    $set('room_type', null);
                                                                    $set('meal_plan', null);  // Reset meal plan
                                                                    $set('price', null);
                                                                }
                                                            }),
                                                        Select::make('days')
                                                            ->label('Day')
                                                            ->required()
                                                            ->options(['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20']),
                                                        Select::make('no_of_room')
                                                            ->label('Select Number of Rooms')
                                                            ->required()
                                                            ->options(['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20']),
                                                    ])->columns(3),
                                                Fieldset::make('Hotel details')
                                                    ->schema([
                                                        Select::make('hotel_type')
                                                            ->label('Hotel Type')
                                                            // ->options(HotelCategory::all()->pluck('category', 'id'))
                                                            ->options(function (callable $get) {
                                                                $locationId = $get('location');
                                                                if ($locationId) {
                                                                    $hotels = Hotel::where('destination_id', $locationId)->get();
                                                                    $hotelCategoryIds = $hotels->pluck('hotel_category_id')->unique();
                                                                    return HotelCategory::whereIn('id', $hotelCategoryIds)->pluck('category', 'id');
                                                                }
                                                                return [];
                                                            })
                                                            ->required()
                                                            ->live()
                                                            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                                                if ($operation === 'create' || $operation === 'edit') {
                                                                    $set('hotel_name', null); // Reset hotel name
                                                                    $set('room_type', null);
                                                                    $set('meal_plan', null);  // Reset meal plan
                                                                    $set('price', null);
                                                                }
                                                            }),

                                                        Select::make('hotel_name')
                                                            ->label('Hotel Name')
                                                            ->options(function (callable $get) {
                                                                $hotelcategory = HotelCategory::find($get('hotel_type'));
                                                                if (!$hotelcategory) {
                                                                    return [];
                                                                }
                                                                $loc = destination::findOrFail($get('location'));
                                                                $des = $loc->id;
                                                                return $hotelcategory->hotel->where('destination_id', $des)->pluck('hotelName', 'id');
                                                            })
                                                            ->required()
                                                            ->live()
                                                            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                                                if ($operation === 'create' || $operation === 'edit') {
                                                                    $set('meal_plan', null);  // Reset meal plan
                                                                    $set('price', null);
                                                                }
                                                            }),

                                                        Select::make('room_type')
                                                            ->label('Room Type')
                                                            ->options(function (callable $get) {
                                                                $hotel = Hotel::find($get('hotel_name'));
                                                                if (!$hotel) {
                                                                    return [];
                                                                }
                                                                return $hotel->room_category->pluck('category', 'id');
                                                            })
                                                            ->required()
                                                            ->live()
                                                            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                                                if ($operation === 'create' || $operation === 'edit') {
                                                                    $set('meal_plan', null);  // Reset meal plan
                                                                    $set('price', null);
                                                                }
                                                            }),

                                                        Select::make('meal_plan')
                                                            ->label('Meal Plan')
                                                            ->live()
                                                            ->options(function (callable $get) {
                                                                $roomtype = $get('room_type');
                                                                if ($roomtype) {
                                                                    $roomtype = RoomCategory::find($roomtype);
                                                                    if ($roomtype) {
                                                                        return [
                                                                            'cp' => 'CP - ₹.' . $roomtype->cp . '/-',
                                                                            'map' => 'MAP - ₹.' . $roomtype->map . '/-',
                                                                            'ap' => 'AP - ₹.' . $roomtype->ap . '/-',
                                                                        ];
                                                                    }
                                                                }
                                                                return []; // Return an empty array if no hotel is selected
                                                            })
                                                            ->required()
                                                            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set, $get) {
                                                                if ($operation === 'create' || $operation === 'edit') {
                                                                    $roomtype = $get('room_type');
                                                                    $mealPlan = $state;
                                                                    $price = 0;

                                                                    if ($roomtype) {
                                                                        $roomtype = RoomCategory::find($roomtype);
                                                                        if ($roomtype) {
                                                                            switch ($mealPlan) {
                                                                                case 'cp':
                                                                                    $price = $roomtype->cp;
                                                                                    break;
                                                                                case 'map':
                                                                                    $price = $roomtype->map;
                                                                                    break;
                                                                                case 'ap':
                                                                                    $price = $roomtype->ap;
                                                                                    break;
                                                                            }
                                                                        }
                                                                    }

                                                                    $set('price', $price); // Set the price field
                                                                }
                                                            }),
                                                        TextInput::make('price')
                                                            ->label('Cost')
                                                            ->numeric()
                                                            ->live()
                                                            ->prefix('₹')
                                                            ->suffix('/-')
                                                            ->required(),
                                                        // DatePicker::make('date')
                                                        //     ->label('Date'),
                                                    ])->columns(3),
                                            ]),
                                        Section::make('Extras')
                                            ->schema([
                                                Fieldset::make('Extra Matress')
                                                    ->schema([
                                                        TextInput::make('adult_mattress_price')
                                                            ->label('Adult with Matress')
                                                            ->required()
                                                            ->default(0)
                                                            ->numeric()
                                                            ->prefix('₹')
                                                            ->suffix('/-'),

                                                        TextInput::make('child_with_mattress_price')
                                                            ->label('Child With Matress')
                                                            ->required()
                                                            ->default(0)
                                                            ->numeric()
                                                            ->prefix('₹')
                                                            ->suffix('/-'),

                                                        TextInput::make('extra_person_mattress')
                                                            ->label('Extra Person mattress')
                                                            ->required()
                                                            ->default(0)
                                                            ->numeric()
                                                            ->prefix('₹')
                                                            ->suffix('/-')

                                                    ])->columns(3),
                                            ])
                                    ]),
                            ]),
                        Tab::make('Add Logistics')
                            ->schema([
                                Section::make('Enter Entry Fee Details')
                                    ->schema([
                                        Fieldset::make('entry_fee')
                                            ->label('Entry Fee Details')
                                            ->schema([
                                                Select::make('place')
                                                    ->label('Choose the Place')
                                                    ->required()
                                                    ->options(Entryfees::where('user_id', auth()->id())->pluck('place', 'id'))
                                                    ->multiple()
                                                    ->live()
                                                    ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                                        if ($operation !== 'create' && $operation !== 'edit') {
                                                            return;
                                                        }
                                                        // dd($state);
                                                        if (empty($state)) {
                                                            $set('fee', null);
                                                            return;
                                                        }

                                                        $totalPrice = 0;
                                                        foreach ($state as $place) {
                                                            $entryfees = Entryfees::where('id', $place)->get();

                                                            foreach ($entryfees as $entryfee) {
                                                                $totalPrice += $entryfee->fee;
                                                            }
                                                        }

                                                        // Check if totalPrice is greater than zero before setting the fee
                                                        if ($totalPrice > 0) {
                                                            $set('fee', $totalPrice);
                                                        }
                                                    }),
                                                TextInput::make('fee')
                                                    ->label('Price')
                                                    ->numeric()
                                                    ->prefix('₹')
                                                    ->suffix('/-')
                                                    ->required(),
                                            ]),
                                    ])->columnSpan(4),
                                Section::make('Enter Cruise Details')
                                    ->schema([


                                        Repeater::make('cruz')
                                            ->label('Cruise Details')
                                            ->schema([
                                                // Step 1: Select the ferry
                                                Select::make('cruz')
                                                    ->label('Cruise')
                                                    ->options(Ferry::where('user_id', auth()->id())->pluck('Title', 'id'))
                                                    ->live()
                                                    ->afterStateUpdated(function ($state, $set) {
                                                        if (!$state) {
                                                            return;
                                                        }

                                                        // Fetch the ferry details including the prices for different locations and classes
                                                        $ferry = Ferry::find($state);

                                                        // If ferry exists, set the locations and pricing data
                                                        if ($ferry) {
                                                            $priceData = $ferry->price;
                                                            $locationOptions = collect($priceData)->pluck('location')->unique();
                                                            $pricingData = [];
                                                            foreach ($priceData as $priceDetail) {
                                                                $pricingData[$priceDetail['location']][$priceDetail['class']] = $priceDetail['price'];
                                                            }
                                                            $set('locationOptions', $locationOptions->toArray());
                                                            $set('pricingData', $pricingData);
                                                        }
                                                    }),

                                                // Step 2: Select the location
                                                Select::make('source')
                                                    ->label('Select Route')
                                                    ->options(function (callable $get) {
                                                        $locationOptions = $get('locationOptions');
                                                        if ($locationOptions) {
                                                            return array_combine($locationOptions, $locationOptions);
                                                        }
                                                        return [];
                                                    })
                                                    ->live(),

                                                // Step 3: Select the class based on the location
                                                Select::make('class')
                                                    ->label('Select Class')
                                                    ->options(function (callable $get) {
                                                        $location = $get('source');
                                                        $pricingData = $get('pricingData');
                                                        if (isset($pricingData[$location])) {
                                                            return array_combine(array_keys($pricingData[$location]), array_keys($pricingData[$location]));
                                                        }
                                                        return [];
                                                    })
                                                    ->live()
                                                    ->afterStateUpdated(function ($state, $get, $set) {
                                                        // Fetch the dynamic price based on the selected location and class
                                                        $location = $get('source');
                                                        $pricingData = $get('pricingData');

                                                        if (isset($pricingData[$location][$state])) {
                                                            $set('price_adult', $pricingData[$location][$state]);
                                                        }
                                                    }),

                                                // Step 4: Display the price for the selected class
                                                TextInput::make('price_adult')
                                                    ->label('Price for Adult')
                                                    ->numeric()
                                                    ->prefix('₹')
                                                    ->suffix('/-')
                                                    ->required(),

                                                // Optional: Price for infant if needed
                                                TextInput::make('price_infant')
                                                    ->label('Price for Infant')
                                                    ->numeric()
                                                    ->default(0)
                                                    ->prefix('₹')
                                                    ->suffix('/-')
                                                    ->required()
                                            ]),
                                    ])->columnSpan(2),
                                Section::make('Enter Vehicle Details')
                                    ->schema([
                                        Repeater::make('vehicle')
                                            ->label('Vehicle Details')
                                            ->schema([
                                                Checkbox::make('include_luggage')
                                                    ->label('Include Luggage Vehicle')
                                                    ->reactive() // Ensure it updates the form when toggled
                                                    ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                                                        // Re-trigger vehicle selection update
                                                        $set('vehicle', $get('vehicle'));
                                                        self::updatePrice($set, $get);
                                                    }),

                                                Select::make('days')
                                                    ->label('Day')
                                                    ->options([
                                                        '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5',
                                                        '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10',
                                                        '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15',
                                                        '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20'
                                                    ]),

                                                Select::make('vehicle')
                                                    ->label('Vehicle Type')
                                                    ->options(function (Forms\Get $get, $state, Set $set) {
                                                        $adults = session('adults') + session('child');

                                                        Log::info('Adults' . $adults);
                                                        $includeLuggage = $get('include_luggage'); // Get the value of the luggage checkbox

                                                        if (is_null($adults)) {
                                                            return ['Error: Adults value is missing'];
                                                        }

                                                        $vehicles = [];
                                                        // Fetch all cabs with their price data
                                                        $cabs = Cab::where('user_id', auth()->id())->get();

                                                        foreach ($cabs as $cab) {
                                                            $prices = $cab->price; // Directly use the array

                                                            foreach ($prices as $price) {
                                                                if ($adults <= 4 && $price['vehicle_type'] == '7') {
                                                                    $vehicles[$cab->id] = $cab->Title . ' - 7 Seater';
                                                                } elseif ($adults > 4 && $adults <= 9 && $price['vehicle_type'] == '7') {
                                                                    $vehicles[$cab->id] = $cab->Title . ($includeLuggage ? ' - 2 x 7 Seater' : ' - 7 Seater');
                                                                } elseif ($adults > 9 && $adults <= 14 && $price['vehicle_type'] == '17') {
                                                                    $vehicles[$cab->id] = $cab->Title . ' - 17 Seater';
                                                                } elseif ($adults > 14 && $adults <= 17 && in_array($price['vehicle_type'], ['17', '7'])) {
                                                                    $vehicles[$cab->id] = $cab->Title . ($includeLuggage ? ' - 17 Seater + 7 Seater' : ' - 17 Seater');
                                                                } elseif ($adults > 17 && $adults <= 25 && in_array($price['vehicle_type'], ['26', '7'])) {
                                                                    $vehicles[$cab->id] = $cab->Title . ($includeLuggage ? ' - 26 Seater + 7 Seater' : ' - 26 Seater');
                                                                }
                                                            }
                                                        }

                                                        return $vehicles;
                                                    })
                                                    ->live()
                                                    ->reactive()
                                                    ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                                                        // Get the selected vehicle's price
                                                        if (empty($state)) {
                                                            $set('price', 0);
                                                        } else {
                                                            // Update price after vehicle type is selected
                                                            self::updatePrice($set, $get);
                                                        }
                                                    }),

                                                TextInput::make('price')
                                                    ->label('Price')
                                                    ->numeric()
                                                    ->live()
                                                    ->reactive()
                                                    ->prefix('₹')
                                                    ->suffix('/-')
                                                    ->required(),
                                            ]), // Adjust column layout if needed
                                    ])->columnSpan(2),
                            ])->columns(4),
                        Tab::make('Add Extras')
                            ->schema([
                                Section::make('Enter Extras')
                                    ->schema([
                                        Repeater::make('addons')
                                            ->schema([
                                                Select::make('days')
                                                    ->label('Day')
                                                    ->options(['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20']),
                                                Select::make('addon')
                                                    ->options(Addon::where('user_id', auth()->id())->pluck('name', 'id'))
                                                    ->live()
                                                    ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                                        if ($operation !== 'create' && $operation !== 'edit') {
                                                            return;
                                                        }
                                                        $p = Addon::where('id', $state)->get();
                                                        foreach ($p as $p) {
                                                            $set('price', $p->price);
                                                        }
                                                    }),
                                                TextInput::make('price')
                                                    ->label('Price')
                                                    ->prefix('₹')
                                                    ->suffix('/-')
                                                    ->live()
                                                    ->numeric(),
                                                Select::make('source')
                                                    ->label('Location')
                                                    ->options(destination::where('user_id', auth()->id())->pluck('Title', 'Title')),

                                                Textarea::make('notes')
                                                    ->label('Notes (if any)')
                                            ])->columns(3),
                                    ])
                            ]),
                        Tab::make('Voucher Conformation')
                            ->schema([
                                Checkbox::make('voucher')
                                    ->label('Tick to Conform voucher'),
                            ])

                    ])->columnSpanFull(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customers.customer')
                    ->label('Customer')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Package')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('customers.number')
                    ->label('Contact')
                    ->prefix('+91-')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('days')
                    ->label('Days')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Time')
                    ->date()->since()
                    ->sortable()
                    ->searchable(),
                BooleanColumn::make('voucher')
                    ->label('Voucher')
                    ->sortable()
                    ->searchable(),
            ])->defaultSort('updated_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Action::make('View Doc')
                        ->icon('heroicon-o-eye')
                        ->url(fn (CustomPackage $record) => route('CustomPackage.pdf.view', $record))
                        ->openUrlInNewTab()
                        ->color('info'),
                    Tables\Actions\EditAction::make(),
                    DeleteAction::make(),
                    // Action::make('Download Pdf')
                    // ->icon('heroicon-o-arrow-down-on-square-stack')
                    // ->url(fn(CustomPackage $record) => route('CustomPackage.pdf.download',$record))
                    // ->openUrlInNewTab(),
                    ReplicateAction::make()
                ])


            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),

                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])->modifyQueryUsing(function ($query) {
                return $query->where('user_id', auth()->id());
            });
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomPackages::route('/'),
            'create' => Pages\CreateCustomPackage::route('/create'),
            'edit' => Pages\EditCustomPackage::route('/{record}/edit'),
        ];
    }

    public static function populateCustomerData($cid, Set $set)
    {
        $customer = Customers::where('cid', $cid)->first();

        if ($customer) {
            $set('customers_id', $customer->id);
            $set('customer', $customer->cid);
            $set('number', $customer->number);
            $set('adults', $customer->adults);
            session(['adults' => $customer->adults]);
            $set('childgreaterthan5', $customer->childgreaterthan5);
            session(['child' => $customer->childgreaterthan5]);
            $set('childlessthan5', $customer->childlessthan5);
            $set('dateofarrival', date('F d, Y', strtotime($customer->dateofarrival)));
            $set('dateofdeparture', date('F d, Y', strtotime($customer->dateofdeparture)));
        }
    }
    protected static function updatePrice(Forms\Set $set, Forms\Get $get)
    {
        $adults = session('adults');
        $includeLuggage = $get('include_luggage');
        $vehicle = Cab::find($get('vehicle'));

        if ($vehicle) {
            $prices = $vehicle->price;
            $price = 0;

            // Find the price of the 7-seater vehicle
            $sevenSeaterPrice = 0;
            foreach ($prices as $p) {
                if ($p['vehicle_type'] == '7') {
                    $sevenSeaterPrice = $p['price'];
                    break;  // Assuming there's only one 7-seater option
                }
            }

            foreach ($prices as $p) {
                if ($adults <= 4 && $p['vehicle_type'] == '7') {
                    $price = $p['price'];
                } elseif ($adults > 4 && $adults <= 9 && $p['vehicle_type'] == '7') {
                    $price = $includeLuggage ? $p['price'] + $sevenSeaterPrice : $p['price'];
                } elseif ($adults > 9 && $adults <= 14 && $p['vehicle_type'] == '17') {
                    $price = $p['price'];
                } elseif ($adults > 14 && $adults <= 17 && in_array($p['vehicle_type'], ['17', '7'])) {
                    $price = $includeLuggage ? $p['price'] + $sevenSeaterPrice : $p['price'];
                } elseif ($adults > 17 && $adults <= 25 && in_array($p['vehicle_type'], ['26', '7'])) {
                    $price = $includeLuggage ? $p['price'] + $sevenSeaterPrice : $p['price'];
                }
            }

            $set('price', $price);
        }
    }
}
