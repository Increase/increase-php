<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardSettlement\PurchaseDetails\Fleet;

/**
 * The type of fuel purchased.
 */
enum FuelType: string
{
    case REGULAR = 'regular';

    case MID_OR_PLUS = 'mid_or_plus';

    case PREMIUM_OR_SUPER = 'premium_or_super';

    case MID_OR_PLUS_2 = 'mid_or_plus_2';

    case PREMIUM_OR_SUPER_2 = 'premium_or_super_2';

    case REGULAR_ETHANOL_5_BLEND_NON_US = 'regular_ethanol_5_blend_non_us';

    case MID_OR_PLUS_ETHANOL_5_BLEND_NON_US = 'mid_or_plus_ethanol_5_blend_non_us';

    case PREMIUM_OR_SUPER_ETHANOL_5_BLEND_NON_US = 'premium_or_super_ethanol_5_blend_non_us';

    case MID_OR_PLUS_2_ETHANOL_5_BLEND_NON_US = 'mid_or_plus_2_ethanol_5_blend_non_us';

    case GREEN_GASOLINE_REGULAR = 'green_gasoline_regular';

    case GREEN_GASOLINE_MID_OR_PLUS = 'green_gasoline_mid_or_plus';

    case GREEN_GASOLINE_PREMIUM_OR_SUPER = 'green_gasoline_premium_or_super';

    case REGULAR_DIESEL_2 = 'regular_diesel_2';

    case PREMIUM_DIESEL_2 = 'premium_diesel_2';

    case REGULAR_DIESEL_1 = 'regular_diesel_1';

    case COMPRESSED_NATURAL_GAS = 'compressed_natural_gas';

    case LIQUID_PROPANE_GAS = 'liquid_propane_gas';

    case LIQUID_NATURAL_GAS = 'liquid_natural_gas';

    case E85 = 'e85';

    case REGULAR_REFORMULATED = 'regular_reformulated';

    case MID_OR_PLUS_REFORMULATED = 'mid_or_plus_reformulated';

    case PREMIUM_OR_SUPER_REFORMULATED = 'premium_or_super_reformulated';

    case MID_OR_PLUS_2_REFORMULATED = 'mid_or_plus_2_reformulated';

    case PREMIUM_OR_SUPER_2_REFORMULATED = 'premium_or_super_2_reformulated';

    case DIESEL_OFF_ROAD_1_2_NON_TAXABLE = 'diesel_off_road_1_2_non_taxable';

    case DIESEL_OFF_ROAD_NON_TAXABLE = 'diesel_off_road_non_taxable';

    case BIODIESEL_BLEND_OFF_ROAD_NON_TAXABLE = 'biodiesel_blend_off_road_non_taxable';

    case RACING_FUEL = 'racing_fuel';

    case MID_OR_PLUS_2_ETHANOL_10_BLEND = 'mid_or_plus_2_ethanol_10_blend';

    case PREMIUM_OR_SUPER_2_ETHANOL_10_BLEND = 'premium_or_super_2_ethanol_10_blend';

    case MID_OR_PLUS_ETHANOL_2_15_BLEND = 'mid_or_plus_ethanol_2_15_blend';

    case PREMIUM_OR_SUPER_ETHANOL_2_15_BLEND = 'premium_or_super_ethanol_2_15_blend';

    case PREMIUM_OR_SUPER_2_ETHANOL_5_BLEND_NON_US = 'premium_or_super_2_ethanol_5_blend_non_us';

    case REGULAR_ETHANOL_10_BLEND = 'regular_ethanol_10_blend';

    case MID_OR_PLUS_ETHANOL_10_BLEND = 'mid_or_plus_ethanol_10_blend';

    case PREMIUM_OR_SUPER_ETHANOL_10_BLEND = 'premium_or_super_ethanol_10_blend';

    case B2_DIESEL_BLEND_2_BIODIESEL = 'b2_diesel_blend_2_biodiesel';

    case B5_DIESEL_BLEND_5_BIODIESEL = 'b5_diesel_blend_5_biodiesel';

    case B10_DIESEL_BLEND_10_BIODIESEL = 'b10_diesel_blend_10_biodiesel';

    case B11_DIESEL_BLEND_11_BIODIESEL = 'b11_diesel_blend_11_biodiesel';

    case B15_DIESEL_BLEND_15_BIODIESEL = 'b15_diesel_blend_15_biodiesel';

    case B20_DIESEL_BLEND_20_BIODIESEL = 'b20_diesel_blend_20_biodiesel';

    case B100_DIESEL_BLEND_100_BIODIESEL = 'b100_diesel_blend_100_biodiesel';

    case B1_DIESEL_BLEND_1_BIODIESEL = 'b1_diesel_blend_1_biodiesel';

    case ADDITIZED_DIESEL_2 = 'additized_diesel_2';

    case ADDITIZED_DIESEL_3 = 'additized_diesel_3';

    case B7_DIESEL_BLEND_7_BIODIESEL_NON_US = 'b7_diesel_blend_7_biodiesel_non_us';

    case B7_PREMIUM_DIESEL_BLEND_7_BIODIESEL_NON_US = 'b7_premium_diesel_blend_7_biodiesel_non_us';

    case RENEWABLE_DIESEL_R95_OR_GREATER = 'renewable_diesel_r95_or_greater';

    case RENEWABLE_DIESEL_BIODIESEL_6_TO_20 = 'renewable_diesel_biodiesel_6_to_20';

    case DIESEL_EXHAUST_FLUID_PUMP = 'diesel_exhaust_fluid_pump';

    case PREMIUM_DIESEL_1 = 'premium_diesel_1';

    case REGULAR_ETHANOL_15_BLEND = 'regular_ethanol_15_blend';

    case MID_OR_PLUS_ETHANOL_15_BLEND = 'mid_or_plus_ethanol_15_blend';

    case PREMIUM_OR_SUPER_ETHANOL_15_BLEND = 'premium_or_super_ethanol_15_blend';

    case PREMIUM_DIESEL_BLEND_LESS_THAN_20_BIODIESEL = 'premium_diesel_blend_less_than_20_biodiesel';

    case PREMIUM_DIESEL_BLEND_20_OR_MORE_BIODIESEL = 'premium_diesel_blend_20_or_more_biodiesel';

    case B75_DIESEL_BLEND_75_BIODIESEL = 'b75_diesel_blend_75_biodiesel';

    case B99_DIESEL_BLEND_99_BIODIESEL = 'b99_diesel_blend_99_biodiesel';

    case RESERVED_FOR_PREAUTHORIZATION_USE_ONLY = 'reserved_for_preauthorization_use_only';

    case UNDEFINED_FUEL_RESERVED_FOR_PROPRIETARY_USE = 'undefined_fuel_reserved_for_proprietary_use';

    case MISCELLANEOUS_FUEL = 'miscellaneous_fuel';

    case JET_FUEL = 'jet_fuel';

    case AVIATION_FUEL_REGULAR = 'aviation_fuel_regular';

    case AVIATION_FUEL_PREMIUM = 'aviation_fuel_premium';

    case AVIATION_FUEL_JP8 = 'aviation_fuel_jp8';

    case AVIATION_FUEL_4 = 'aviation_fuel_4';

    case AVIATION_FUEL_5 = 'aviation_fuel_5';

    case BIOJET_DIESEL = 'biojet_diesel';

    case AVIATION_BIOFUEL_GASOLINE = 'aviation_biofuel_gasoline';

    case UNDEFINED_AVIATION_FUEL_RESERVED_FOR_PROPRIETARY_USE = 'undefined_aviation_fuel_reserved_for_proprietary_use';

    case MISCELLANEOUS_AVIATION_FUEL = 'miscellaneous_aviation_fuel';

    case MARINE_FUEL_1 = 'marine_fuel_1';

    case MARINE_FUEL_2 = 'marine_fuel_2';

    case MARINE_FUEL_3 = 'marine_fuel_3';

    case MARINE_FUEL_4 = 'marine_fuel_4';

    case MARINE_FUEL_5 = 'marine_fuel_5';

    case MARINE_OTHER = 'marine_other';

    case MARINE_DIESEL = 'marine_diesel';

    case MISCELLANEOUS_MARINE_FUEL = 'miscellaneous_marine_fuel';

    case KEROSENE_LOW_SULFUR = 'kerosene_low_sulfur';

    case WHITE_GAS = 'white_gas';

    case HEATING_OIL = 'heating_oil';

    case OTHER_FUEL_NON_TAXABLE = 'other_fuel_non_taxable';

    case KEROSENE_ULTRA_LOW_SULFUR = 'kerosene_ultra_low_sulfur';

    case ELECTRIC_VEHICLE_CHARGING_LEVEL_1_110_VOLT = 'electric_vehicle_charging_level_1_110_volt';

    case ELECTRIC_VEHICLE_CHARGING_LEVEL_2_240_VOLT = 'electric_vehicle_charging_level_2_240_volt';

    case ELECTRIC_VEHICLE_CHARGING_LEVEL_3_480_VOLT = 'electric_vehicle_charging_level_3_480_volt';

    case RENEWABLE_DIESEL_R95_OR_GREATER_OFF_ROAD_NON_TAXABLE = 'renewable_diesel_r95_or_greater_off_road_non_taxable';

    case BIODIESEL_BLEND_1_OFF_ROAD_NON_TAXABLE = 'biodiesel_blend_1_off_road_non_taxable';

    case BIODIESEL_BLEND_75_OFF_ROAD_NON_TAXABLE = 'biodiesel_blend_75_off_road_non_taxable';

    case BIODIESEL_BLEND_99_OFF_ROAD_NON_TAXABLE = 'biodiesel_blend_99_off_road_non_taxable';

    case BIODIESEL_BLEND_100_OFF_ROAD_NON_TAXABLE = 'biodiesel_blend_100_off_road_non_taxable';

    case RENEWABLE_DIESEL_BIODIESEL_6_TO_20_OFF_ROAD_NON_TAXABLE = 'renewable_diesel_biodiesel_6_to_20_off_road_non_taxable';

    case ELECTRIC_VEHICLE_CHARGING_LEVEL_4_800_VOLT = 'electric_vehicle_charging_level_4_800_volt';

    case ELECTRIC_VEHICLE_CHARGING_LEVEL_5_MEGAWATT = 'electric_vehicle_charging_level_5_megawatt';

    case HYDROTREATED_VEGETABLE_OIL_100 = 'hydrotreated_vegetable_oil_100';

    case BIO_COMPRESSED_NATURAL_GAS = 'bio_compressed_natural_gas';

    case MISCELLANEOUS_OTHER_FUEL = 'miscellaneous_other_fuel';
}
