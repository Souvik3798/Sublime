<?php


namespace App\Filament\Owner\Resources;

use App\Filament\Owner\Resources\CustomPackageResource\Pages;
use App\Models\Addon;
use App\Models\Cab;
use App\Models\Cabs;
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
                                    ->options(Customers::pluck('customer', 'cid'))
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
                                    ->options(Category::pluck('name', 'id'))
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
                                            ->options(destination::pluck('Title', 'Title'))
                                            ->required(),
                                        TextInput::make('name')
                                            ->label('Title')
                                            ->datalist(IternityTemplate::pluck('Title'))
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
                                                            ->options(destination::pluck('Title', 'id'))
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
                                                            ->required()
                                                            ->live()
                                                            ->prefix('₹')
                                                            ->suffix('/-'),
                                                        // DatePicker::make('date')
                                                        //     ->label('Date'),
                                                    ])->columns(3),
                                            ]),
                                        Section::make('Extras')
                                            ->schema([
                                                Fieldset::make('Extra Mattress')
                                                    ->schema([
                                                        TextInput::make('adult_mattress_price')
                                                            ->label('Adult with Mattress')
                                                            ->default(0)
                                                            ->numeric()
                                                            ->prefix('₹')
                                                            ->suffix('/-'),

                                                        TextInput::make('child_with_mattress_price')
                                                            ->label('Child With Mattress')
                                                            ->default(0)
                                                            ->numeric()
                                                            ->prefix('₹')
                                                            ->suffix('/-'),

                                                        TextInput::make('extra_person_mattress')
                                                            ->label('Extra Person Mattress')
                                                            ->default(0)
                                                            ->numeric()
                                                            ->prefix('₹')
                                                            ->suffix('/-')
                                                    ])->columns(3),

                                                Fieldset::make('Additional Charges')
                                                    ->schema([
                                                        TextInput::make('surge_charges')
                                                            ->label('Peak Season Charges')
                                                            ->default(0)
                                                            ->numeric()
                                                            ->prefix('₹')
                                                            ->suffix('/-'),

                                                        TextInput::make('gala_dinner_24_dec')
                                                            ->label('Gala Dinner (24th Dec)')
                                                            ->default(0)
                                                            ->numeric()
                                                            ->prefix('₹')
                                                            ->suffix('/-'),

                                                        TextInput::make('gala_dinner_31_dec')
                                                            ->label('Gala Dinner (31st Dec)')
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
                                                    ->options(Entryfees::pluck('place', 'id'))
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
                                                    ->options(Ferry::all()->pluck('Title', 'id'))
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

                                        Select::make('vehicle')
                                            ->label('Vehicle Type')
                                            ->options(Cab::all()->pluck('Title', 'id'))
                                            ->multiple()
                                            ->live()
                                            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                                if ($operation !== 'create' && $operation !== 'edit') {
                                                    return;
                                                }

                                                if (empty($state)) {
                                                    $set('price', 0);
                                                    return;
                                                }

                                                $totalPrice = 0;
                                                $adults = session('adults') + session('child'); // Calculate the total number of passengers

                                                foreach ($state as $vehicleId) {
                                                    $cab = Cab::find($vehicleId);
                                                    if ($cab) {
                                                        Log::info('Selected Vehicle:', ['id' => $cab->id, 'title' => $cab->Title, 'price' => $cab->price]);

                                                        foreach ($cab->price as $priceDetail) {
                                                            if ($adults <= 4 && $priceDetail['vehicle_type'] == '7') {
                                                                // 7-seater vehicle for up to 4 passengers
                                                                $totalPrice += (int)$priceDetail['price'];
                                                            } elseif ($adults > 4 && $adults <= 9 && $priceDetail['vehicle_type'] == '7') {
                                                                // 7-seater vehicle for 5 to 9 passengers
                                                                $totalPrice += (int)$priceDetail['price'];
                                                            } elseif ($adults > 9 && $adults <= 14 && $priceDetail['vehicle_type'] == '17') {
                                                                // 17-seater vehicle for 10 to 14 passengers
                                                                $totalPrice += (int)$priceDetail['price'];
                                                            } elseif ($adults > 14 && $adults <= 17 && $priceDetail['vehicle_type'] == '17') {
                                                                // 17-seater vehicle for 15 to 17 passengers
                                                                $totalPrice += (int)$priceDetail['price'];
                                                            } elseif ($adults > 17 && $adults <= 25 && $priceDetail['vehicle_type'] == '26') {
                                                                // 26-seater vehicle for 18 to 25 passengers
                                                                $totalPrice += (int)$priceDetail['price'];
                                                            } elseif ($adults > 25) {
                                                                // For more than 25 passengers, manual price entry is required
                                                                $set('price', 'Please enter price manually for more than 25 passengers');
                                                                return;
                                                            }
                                                        }
                                                    }
                                                }

                                                $set('price', $totalPrice);
                                            }),

                                        TextInput::make('luggage')
                                            ->label('Luggage Price')
                                            ->numeric()
                                            ->live()
                                            ->prefix('₹')
                                            ->suffix('/-')
                                            ->required(),

                                        TextInput::make('price')
                                            ->label('Total Price')
                                            ->numeric()
                                            ->prefix('₹')
                                            ->suffix('/-')
                                            ->required(), // Disable the input to make it read-only

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
                                                    ->options(Addon::pluck('name', 'id'))
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
                                                    ->options(destination::pluck('Title', 'id')),
                                                Textarea::make('notes')
                                                    ->label('Notes (if any)')
                                            ])->columns(3),
                                    ])
                            ]),
                        Tab::make('Water Sports Activity')
                            ->schema([
                                Repeater::make('water_sports')
                                    ->schema([
                                        Checkbox::make('manual')
                                            ->label('Custom')
                                            ->live(),

                                        Select::make('Day')
                                            ->label('Select Day')
                                            ->options(
                                                collect(range(1, 30)) // Adjust the range based on your requirement
                                                    ->mapWithKeys(fn($day) => ["Day {$day}" => "Day {$day}"])
                                                    ->toArray()
                                            )
                                            ->required()
                                            ->live(),


                                        TextInput::make('activity_name')
                                            ->label('Activity Name')
                                            ->required()
                                            ->datalist(function () {
                                                // Fetch activity names for the current user
                                                return \App\Models\WaterSportsActivity::pluck('name');
                                            })
                                            ->live()
                                            ->afterStateUpdated(function ($state, Forms\Set $set) {
                                                if (!$state) {
                                                    return;
                                                }

                                                // Fetch and populate data based on selected activity name
                                                $activity = \App\Models\WaterSportsActivity::where('name', $state)
                                                    ->first();

                                                if ($activity) {
                                                    $set('description', $activity->description);
                                                    $set('adult_price', $activity->adult_price);
                                                    $set('child_5_12_price', $activity->child_5_12_price);
                                                    $set('child_2_5_price', $activity->child_2_5_price);
                                                    $set('infant_price', $activity->infant_price);
                                                }
                                            }),

                                        Textarea::make('description')
                                            ->label('Description')
                                            ->placeholder('Auto-filled or enter manually')
                                            ->disabled(fn(Forms\Get $get) => !$get('manual')),

                                        TextInput::make('adult_price')
                                            ->label('Price (Adult)')
                                            ->numeric()
                                            ->default(0)
                                            ->prefix('₹')
                                            ->disabled(fn(Forms\Get $get) => !$get('manual')),

                                        TextInput::make('child_5_12_price')
                                            ->label('Price (Child 5-12 Years)')
                                            ->numeric()
                                            ->default(0)
                                            ->prefix('₹')
                                            ->disabled(fn(Forms\Get $get) => !$get('manual')),

                                        TextInput::make('child_2_5_price')
                                            ->label('Price (Child 2-5 Years)')
                                            ->numeric()
                                            ->default(0)
                                            ->prefix('₹')
                                            ->disabled(fn(Forms\Get $get) => !$get('manual')),

                                        TextInput::make('infant_price')
                                            ->label('Price (Infant)')
                                            ->numeric()
                                            ->default(0)
                                            ->prefix('₹')
                                            ->disabled(fn(Forms\Get $get) => !$get('manual')),
                                    ])
                                    ->columns(2)
                                    ->addActionLabel('Add Water Sports Activity'),
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
                        ->url(fn(CustomPackage $record) => route('CustomPackage.pdf.view', $record))
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
            ]);
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
}
