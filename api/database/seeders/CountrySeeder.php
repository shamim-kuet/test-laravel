<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::create( [
           'iso2'=>'AF',
            'name'=>'Afghanistan',
            'status'=>1,
            'phone_code'=>'93',
            'iso3'=>'AFG',
            'region'=>'Asia',
            'sub_region'=>'Southern Asia'
        ] );
                        
            Country::create( [
           'iso2'=>'AX',
            'name'=>'Aland Islands',
            'status'=>1,
            'phone_code'=>'358',
            'iso3'=>'ALA',
            'region'=>'Europe',
            'sub_region'=>'Northern Europe'
            ] );
                        
            Country::create( [
           'iso2'=>'AL',
            'name'=>'Albania',
            'status'=>1,
            'phone_code'=>'355',
            'iso3'=>'ALB',
            'region'=>'Europe',
            'sub_region'=>'Southern Europe'
            ] );
                        
            Country::create( [
           'iso2'=>'DZ',
            'name'=>'Algeria',
            'status'=>1,
            'phone_code'=>'213',
            'iso3'=>'DZA',
            'region'=>'Africa',
            'sub_region'=>'Northern Africa'
            ] );
                        
            Country::create( [
           'iso2'=>'AS',
            'name'=>'American Samoa',
            'status'=>1,
            'phone_code'=>'1',
            'iso3'=>'ASM',
            'region'=>'Oceania',
            'sub_region'=>'Polynesia'
            ] );
                        
            Country::create( [
           'iso2'=>'AD',
            'name'=>'Andorra',
            'status'=>1,
            'phone_code'=>'376',
            'iso3'=>'AND',
            'region'=>'Europe',
            'sub_region'=>'Southern Europe'
            ] );
                        
            Country::create( [
           'iso2'=>'AO',
            'name'=>'Angola',
            'status'=>1,
            'phone_code'=>'244',
            'iso3'=>'AGO',
            'region'=>'Africa',
            'sub_region'=>'Middle Africa'
            ] );
                        
            Country::create( [
           'iso2'=>'AI',
            'name'=>'Anguilla',
            'status'=>1,
            'phone_code'=>'1',
            'iso3'=>'AIA',
            'region'=>'Americas',
            'sub_region'=>'Caribbean'
            ] );
                        
            Country::create( [
           'iso2'=>'AQ',
            'name'=>'Antarctica',
            'status'=>1,
            'phone_code'=>'672',
            'iso3'=>'ATA',
            'region'=>'Polar',
            'sub_region'=>''
            ] );
                        
            Country::create( [
            'iso2'=>'AG',
            'name'=>'Antigua And Barbuda',
            'status'=>1,
            'phone_code'=>'1',
            'iso3'=>'ATG',
            'region'=>'Americas',
            'sub_region'=>'Caribbean'
            ] );
                        
            Country::create( [
            'iso2'=>'AR',
            'name'=>'Argentina',
            'status'=>1,
            'phone_code'=>'54',
            'iso3'=>'ARG',
            'region'=>'Americas',
            'sub_region'=>'South America'
            ] );
                        
            Country::create( [
            'iso2'=>'AM',
            'name'=>'Armenia',
            'status'=>1,
            'phone_code'=>'374',
            'iso3'=>'ARM',
            'region'=>'Asia',
            'sub_region'=>'Western Asia'
            ] );
                        
            Country::create( [
            'iso2'=>'AW',
            'name'=>'Aruba',
            'status'=>1,
            'phone_code'=>'297',
            'iso3'=>'ABW',
            'region'=>'Americas',
            'sub_region'=>'Caribbean'
            ] );
                        
            Country::create( [
            'iso2'=>'AU',
            'name'=>'Australia',
            'status'=>1,
            'phone_code'=>'61',
            'iso3'=>'AUS',
            'region'=>'Oceania',
            'sub_region'=>'Australia and New Zealand'
            ] );
                        
            Country::create( [
            'iso2'=>'AT',
            'name'=>'Austria',
            'status'=>1,
            'phone_code'=>'43',
            'iso3'=>'AUT',
            'region'=>'Europe',
            'sub_region'=>'Western Europe'
            ] );
                        
            Country::create( [
            'iso2'=>'AZ',
            'name'=>'Azerbaijan',
            'status'=>1,
            'phone_code'=>'994',
            'iso3'=>'AZE',
            'region'=>'Asia',
            'sub_region'=>'Western Asia'
            ] );
                        
            Country::create( [
            'iso2'=>'BH',
            'name'=>'Bahrain',
            'status'=>1,
            'phone_code'=>'973',
            'iso3'=>'BHR',
            'region'=>'Asia',
            'sub_region'=>'Western Asia'
            ] );
                        
            Country::create( [
            'iso2'=>'BD',
            'name'=>'Bangladesh',
            'status'=>1,
            'phone_code'=>'880',
            'iso3'=>'BGD',
            'region'=>'Asia',
            'sub_region'=>'Southern Asia'
            ] );
                        
            Country::create( [
            'iso2'=>'BB',
            'name'=>'Barbados',
            'status'=>1,
            'phone_code'=>'1',
            'iso3'=>'BRB',
            'region'=>'Americas',
            'sub_region'=>'Caribbean'
            ] );
                        
            Country::create( [
            'iso2'=>'BY',
            'name'=>'Belarus',
            'status'=>1,
            'phone_code'=>'375',
            'iso3'=>'BLR',
            'region'=>'Europe',
            'sub_region'=>'Eastern Europe'
            ] );
                        
            Country::create( [
            'iso2'=>'BE',
            'name'=>'Belgium',
            'status'=>1,
            'phone_code'=>'32',
            'iso3'=>'BEL',
            'region'=>'Europe',
            'sub_region'=>'Western Europe'
            ] );
                        
            Country::create( [
            'iso2'=>'BZ',
            'name'=>'Belize',
            'status'=>1,
            'phone_code'=>'501',
            'iso3'=>'BLZ',
            'region'=>'Americas',
            'sub_region'=>'Central America'
            ] );
                        
            Country::create( [
            'iso2'=>'BJ',
            'name'=>'Benin',
            'status'=>1,
            'phone_code'=>'229',
            'iso3'=>'BEN',
            'region'=>'Africa',
            'sub_region'=>'Western Africa'
            ] );
                        
            Country::create( [
            'iso2'=>'BM',
            'name'=>'Bermuda',
            'status'=>1,
            'phone_code'=>'1',
            'iso3'=>'BMU',
            'region'=>'Americas',
            'sub_region'=>'Northern America'
            ] );
                        
            Country::create( [
            'iso2'=>'BT',
            'name'=>'Bhutan',
            'status'=>1,
            'phone_code'=>'975',
            'iso3'=>'BTN',
            'region'=>'Asia',
            'sub_region'=>'Southern Asia'
            ] );
                        
            Country::create( [
            'iso2'=>'BO',
            'name'=>'Bolivia',
            'status'=>1,
            'phone_code'=>'591',
            'iso3'=>'BOL',
            'region'=>'Americas',
            'sub_region'=>'South America'
            ] );
                        
            Country::create( [
            'iso2'=>'BQ',
            'name'=>'Bonaire, Sint Eustatius and Saba',
            'status'=>1,
            'phone_code'=>'599',
            'iso3'=>'BES',
            'region'=>'Americas',
            'sub_region'=>'Caribbean'
            ] );
                        
            Country::create( [
            'iso2'=>'BA',
            'name'=>'Bosnia and Herzegovina',
            'status'=>1,
            'phone_code'=>'387',
            'iso3'=>'BIH',
            'region'=>'Europe',
            'sub_region'=>'Southern Europe'
            ] );
                        
            Country::create( [
            'iso2'=>'BW',
            'name'=>'Botswana',
            'status'=>1,
            'phone_code'=>'267',
            'iso3'=>'BWA',
            'region'=>'Africa',
            'sub_region'=>'Southern Africa'
            ] );
                        
            Country::create( [
            'iso2'=>'BV',
            'name'=>'Bouvet Island',
            'status'=>1,
            'phone_code'=>'0055',
            'iso3'=>'BVT',
            'region'=>'',
            'sub_region'=>''
            ] );
                        
            Country::create( [
            'iso2'=>'BR',
            'name'=>'Brazil',
            'status'=>1,
            'phone_code'=>'55',
            'iso3'=>'BRA',
            'region'=>'Americas',
            'sub_region'=>'South America'
            ] );
                        
            Country::create( [
            'iso2'=>'IO',
            'name'=>'British Indian Ocean Territory',
            'status'=>1,
            'phone_code'=>'246',
            'iso3'=>'IOT',
            'region'=>'Africa',
            'sub_region'=>'Eastern Africa'
            ] );
                        
            Country::create( [
            'iso2'=>'BN',
            'name'=>'Brunei',
            'status'=>1,
            'phone_code'=>'673',
            'iso3'=>'BRN',
            'region'=>'Asia',
            'sub_region'=>'South-Eastern Asia'
            ] );
                        
            Country::create( [
            'iso2'=>'BG',
            'name'=>'Bulgaria',
            'status'=>1,
            'phone_code'=>'359',
            'iso3'=>'BGR',
            'region'=>'Europe',
            'sub_region'=>'Eastern Europe'
            ] );
                        
            Country::create( [
            'iso2'=>'BF',
            'name'=>'Burkina Faso',
            'status'=>1,
            'phone_code'=>'226',
            'iso3'=>'BFA',
            'region'=>'Africa',
            'sub_region'=>'Western Africa'
            ] );
                        
            Country::create( [
            'iso2'=>'BI',
            'name'=>'Burundi',
            'status'=>1,
            'phone_code'=>'257',
            'iso3'=>'BDI',
            'region'=>'Africa',
            'sub_region'=>'Eastern Africa'
            ] );
                        
            Country::create( [
            'iso2'=>'KH',
            'name'=>'Cambodia',
            'status'=>1,
            'phone_code'=>'855',
            'iso3'=>'KHM',
            'region'=>'Asia',
            'sub_region'=>'South-Eastern Asia'
            ] );
                        
            Country::create( [
            'iso2'=>'CM',
            'name'=>'Cameroon',
            'status'=>1,
            'phone_code'=>'237',
            'iso3'=>'CMR',
            'region'=>'Africa',
            'sub_region'=>'Middle Africa'
            ] );
                        
            Country::create( [
            'iso2'=>'CA',
            'name'=>'Canada',
            'status'=>1,
            'phone_code'=>'1',
            'iso3'=>'CAN',
            'region'=>'Americas',
            'sub_region'=>'Northern America'
            ] );
                        
            Country::create( [
            'iso2'=>'CV',
            'name'=>'Cape Verde',
            'status'=>1,
            'phone_code'=>'238',
            'iso3'=>'CPV',
            'region'=>'Africa',
            'sub_region'=>'Western Africa'
            ] );
                        
            Country::create( [
            'iso2'=>'KY',
            'name'=>'Cayman Islands',
            'status'=>1,
            'phone_code'=>'1',
            'iso3'=>'CYM',
            'region'=>'Americas',
            'sub_region'=>'Caribbean'
            ] );
                        
            Country::create( [
            'iso2'=>'CF',
            'name'=>'Central African Republic',
            'status'=>1,
            'phone_code'=>'236',
            'iso3'=>'CAF',
            'region'=>'Africa',
            'sub_region'=>'Middle Africa'
            ] );
                        
            Country::create( [
            'iso2'=>'TD',
            'name'=>'Chad',
            'status'=>1,
            'phone_code'=>'235',
            'iso3'=>'TCD',
            'region'=>'Africa',
            'sub_region'=>'Middle Africa'
            ] );
                        
            Country::create( [
            'iso2'=>'CL',
            'name'=>'Chile',
            'status'=>1,
            'phone_code'=>'56',
            'iso3'=>'CHL',
            'region'=>'Americas',
            'sub_region'=>'South America'
            ] );
                        
            Country::create( [
            'iso2'=>'CN',
            'name'=>'China',
            'status'=>1,
            'phone_code'=>'86',
            'iso3'=>'CHN',
            'region'=>'Asia',
            'sub_region'=>'Eastern Asia'
            ] );
                        
            Country::create( [
            'iso2'=>'CX',
            'name'=>'Christmas Island',
            'status'=>1,
            'phone_code'=>'61',
            'iso3'=>'CXR',
            'region'=>'Oceania',
            'sub_region'=>'Australia and New Zealand'
            ] );
                        
            Country::create( [
            'iso2'=>'CC',
            'name'=>'Cocos (Keeling) Islands',
            'status'=>1,
            'phone_code'=>'61',
            'iso3'=>'CCK',
            'region'=>'Oceania',
            'sub_region'=>'Australia and New Zealand'
            ] );
                        
            Country::create( [
            'iso2'=>'CO',
            'name'=>'Colombia',
            'status'=>1,
            'phone_code'=>'57',
            'iso3'=>'COL',
            'region'=>'Americas',
            'sub_region'=>'South America'
            ] );
                        
            Country::create( [
            'iso2'=>'KM',
            'name'=>'Comoros',
            'status'=>1,
            'phone_code'=>'269',
            'iso3'=>'COM',
            'region'=>'Africa',
            'sub_region'=>'Eastern Africa'
            ] );
                        
            Country::create( [
            'iso2'=>'CG',
            'name'=>'Congo',
            'status'=>1,
            'phone_code'=>'242',
            'iso3'=>'COG',
            'region'=>'Africa',
            'sub_region'=>'Middle Africa'
            ] );
                        
            Country::create( [
            'iso2'=>'CK',
            'name'=>'Cook Islands',
            'status'=>1,
            'phone_code'=>'682',
            'iso3'=>'COK',
            'region'=>'Oceania',
            'sub_region'=>'Polynesia'
            ] );
                        
            Country::create( [
            'iso2'=>'CR',
            'name'=>'Costa Rica',
            'status'=>1,
            'phone_code'=>'506',
            'iso3'=>'CRI',
            'region'=>'Americas',
            'sub_region'=>'Central America'
            ] );
                        
            Country::create( [
            'iso2'=>'CI',
            'name'=>'Cote D\'Ivoire (Ivory Coast)',
            'status'=>1,
            'phone_code'=>'225',
            'iso3'=>'CIV',
            'region'=>'Africa',
            'sub_region'=>'Western Africa'
            ] );
                        
            Country::create( [
            'iso2'=>'HR',
            'name'=>'Croatia',
            'status'=>1,
            'phone_code'=>'385',
            'iso3'=>'HRV',
            'region'=>'Europe',
            'sub_region'=>'Southern Europe'
            ] );
                        
            Country::create( [
            'iso2'=>'CU',
            'name'=>'Cuba',
            'status'=>1,
            'phone_code'=>'53',
            'iso3'=>'CUB',
            'region'=>'Americas',
            'sub_region'=>'Caribbean'
            ] );
                        
            Country::create( [
            'iso2'=>'CW',
            'name'=>'Curaçao',
            'status'=>1,
            'phone_code'=>'599',
            'iso3'=>'CUW',
            'region'=>'Americas',
            'sub_region'=>'Caribbean'
            ] );
                        
            Country::create( [
            'iso2'=>'CY',
            'name'=>'Cyprus',
            'status'=>1,
            'phone_code'=>'357',
            'iso3'=>'CYP',
            'region'=>'Europe',
            'sub_region'=>'Southern Europe'
            ] );
                        
            Country::create( [
            'iso2'=>'CZ',
            'name'=>'Czech Republic',
            'status'=>1,
            'phone_code'=>'420',
            'iso3'=>'CZE',
            'region'=>'Europe',
            'sub_region'=>'Eastern Europe'
            ] );
                        
            Country::create( [
            'iso2'=>'CD',
            'name'=>'Democratic Republic of the Congo',
            'status'=>1,
            'phone_code'=>'243',
            'iso3'=>'COD',
            'region'=>'Africa',
            'sub_region'=>'Middle Africa'
            ] );
                        
            Country::create( [
            'iso2'=>'DK',
            'name'=>'Denmark',
            'status'=>1,
            'phone_code'=>'45',
            'iso3'=>'DNK',
            'region'=>'Europe',
            'sub_region'=>'Northern Europe'
            ] );
                        
            Country::create( [
            'iso2'=>'DJ',
            'name'=>'Djibouti',
            'status'=>1,
            'phone_code'=>'253',
            'iso3'=>'DJI',
            'region'=>'Africa',
            'sub_region'=>'Eastern Africa'
            ] );
                        
            Country::create( [
            'iso2'=>'DM',
            'name'=>'Dominica',
            'status'=>1,
            'phone_code'=>'1',
            'iso3'=>'DMA',
            'region'=>'Americas',
            'sub_region'=>'Caribbean'
            ] );
                        
            Country::create( [
            'iso2'=>'DO',
            'name'=>'Dominican Republic',
            'status'=>1,
            'phone_code'=>'1',
            'iso3'=>'DOM',
            'region'=>'Americas',
            'sub_region'=>'Caribbean'
            ] );
                        
            Country::create( [
            'iso2'=>'TL',
            'name'=>'East Timor',
            'status'=>1,
            'phone_code'=>'670',
            'iso3'=>'TLS',
            'region'=>'Asia',
            'sub_region'=>'South-Eastern Asia'
            ] );
                        
            Country::create( [
            'iso2'=>'EC',
            'name'=>'Ecuador',
            'status'=>1,
            'phone_code'=>'593',
            'iso3'=>'ECU',
            'region'=>'Americas',
            'sub_region'=>'South America'
            ] );
                        
            Country::create( [
            'iso2'=>'EG',
            'name'=>'Egypt',
            'status'=>1,
            'phone_code'=>'20',
            'iso3'=>'EGY',
            'region'=>'Africa',
            'sub_region'=>'Northern Africa'
            ] );
                        
            Country::create( [
            'iso2'=>'SV',
            'name'=>'El Salvador',
            'status'=>1,
            'phone_code'=>'503',
            'iso3'=>'SLV',
            'region'=>'Americas',
            'sub_region'=>'Central America'
            ] );
                        
            Country::create( [
            'iso2'=>'GQ',
            'name'=>'Equatorial Guinea',
            'status'=>1,
            'phone_code'=>'240',
            'iso3'=>'GNQ',
            'region'=>'Africa',
            'sub_region'=>'Middle Africa'
            ] );
                        
            Country::create( [
            'iso2'=>'ER',
            'name'=>'Eritrea',
            'status'=>1,
            'phone_code'=>'291',
            'iso3'=>'ERI',
            'region'=>'Africa',
            'sub_region'=>'Eastern Africa'
            ] );
                        
            Country::create( [
            'iso2'=>'EE',
            'name'=>'Estonia',
            'status'=>1,
            'phone_code'=>'372',
            'iso3'=>'EST',
            'region'=>'Europe',
            'sub_region'=>'Northern Europe'
            ] );
                        
            Country::create( [
            'iso2'=>'ET',
            'name'=>'Ethiopia',
            'status'=>1,
            'phone_code'=>'251',
            'iso3'=>'ETH',
            'region'=>'Africa',
            'sub_region'=>'Eastern Africa'
            ] );
                        
            Country::create( [
            'iso2'=>'FK',
            'name'=>'Falkland Islands',
            'status'=>1,
            'phone_code'=>'500',
            'iso3'=>'FLK',
            'region'=>'Americas',
            'sub_region'=>'South America'
            ] );
                        
            Country::create( [
            'iso2'=>'FO',
            'name'=>'Faroe Islands',
            'status'=>1,
            'phone_code'=>'298',
            'iso3'=>'FRO',
            'region'=>'Europe',
            'sub_region'=>'Northern Europe'
            ] );
                        
            Country::create( [
            'iso2'=>'FJ',
            'name'=>'Fiji Islands',
            'status'=>1,
            'phone_code'=>'679',
            'iso3'=>'FJI',
            'region'=>'Oceania',
            'sub_region'=>'Melanesia'
            ] );
                        
            Country::create( [
            'iso2'=>'FI',
            'name'=>'Finland',
            'status'=>1,
            'phone_code'=>'358',
            'iso3'=>'FIN',
            'region'=>'Europe',
            'sub_region'=>'Northern Europe'
            ] );
                        
            Country::create( [
            'iso2'=>'FR',
            'name'=>'France',
            'status'=>1,
            'phone_code'=>'33',
            'iso3'=>'FRA',
            'region'=>'Europe',
            'sub_region'=>'Western Europe'
            ] );
                        
            Country::create( [
            'iso2'=>'GF',
            'name'=>'French Guiana',
            'status'=>1,
            'phone_code'=>'594',
            'iso3'=>'GUF',
            'region'=>'Americas',
            'sub_region'=>'South America'
            ] );
                        
            Country::create( [
            'iso2'=>'PF',
            'name'=>'French Polynesia',
            'status'=>1,
            'phone_code'=>'689',
            'iso3'=>'PYF',
            'region'=>'Oceania',
            'sub_region'=>'Polynesia'
            ] );
                        
            Country::create( [
            'iso2'=>'TF',
            'name'=>'French Southern Territories',
            'status'=>1,
            'phone_code'=>'262',
            'iso3'=>'ATF',
            'region'=>'Africa',
            'sub_region'=>'Southern Africa'
            ] );
                        
            Country::create( [
            'iso2'=>'GA',
            'name'=>'Gabon',
            'status'=>1,
            'phone_code'=>'241',
            'iso3'=>'GAB',
            'region'=>'Africa',
            'sub_region'=>'Middle Africa'
            ] );
                        
            Country::create( [
            'iso2'=>'GM',
            'name'=>'Gambia The',
            'status'=>1,
            'phone_code'=>'220',
            'iso3'=>'GMB',
            'region'=>'Africa',
            'sub_region'=>'Western Africa'
            ] );
                        
            Country::create( [
            'iso2'=>'GE',
            'name'=>'Georgia',
            'status'=>1,
            'phone_code'=>'995',
            'iso3'=>'GEO',
            'region'=>'Asia',
            'sub_region'=>'Western Asia'
            ] );
                        
            Country::create( [
            'iso2'=>'DE',
            'name'=>'Germany',
            'status'=>1,
            'phone_code'=>'49',
            'iso3'=>'DEU',
            'region'=>'Europe',
            'sub_region'=>'Western Europe'
            ] );
                        
            Country::create( [
            'iso2'=>'GH',
            'name'=>'Ghana',
            'status'=>1,
            'phone_code'=>'233',
            'iso3'=>'GHA',
            'region'=>'Africa',
            'sub_region'=>'Western Africa'
            ] );
                        
            Country::create( [
            'iso2'=>'GI',
            'name'=>'Gibraltar',
            'status'=>1,
            'phone_code'=>'350',
            'iso3'=>'GIB',
            'region'=>'Europe',
            'sub_region'=>'Southern Europe'
            ] );
                        
            Country::create( [
            'iso2'=>'GR',
            'name'=>'Greece',
            'status'=>1,
            'phone_code'=>'30',
            'iso3'=>'GRC',
            'region'=>'Europe',
            'sub_region'=>'Southern Europe'
            ] );
                        
            Country::create( [
            'iso2'=>'GL',
            'name'=>'Greenland',
            'status'=>1,
            'phone_code'=>'299',
            'iso3'=>'GRL',
            'region'=>'Americas',
            'sub_region'=>'Northern America'
            ] );
                        
            Country::create( [
            'iso2'=>'GD',
            'name'=>'Grenada',
            'status'=>1,
            'phone_code'=>'1',
            'iso3'=>'GRD',
            'region'=>'Americas',
            'sub_region'=>'Caribbean'
            ] );
                        
            Country::create( [
            'iso2'=>'GP',
            'name'=>'Guadeloupe',
            'status'=>1,
            'phone_code'=>'590',
            'iso3'=>'GLP',
            'region'=>'Americas',
            'sub_region'=>'Caribbean'
            ] );
                        
            Country::create( [
            'iso2'=>'GU',
            'name'=>'Guam',
            'status'=>1,
            'phone_code'=>'1',
            'iso3'=>'GUM',
            'region'=>'Oceania',
            'sub_region'=>'Micronesia'
            ] );
                        
            Country::create( [
            'iso2'=>'GT',
            'name'=>'Guatemala',
            'status'=>1,
            'phone_code'=>'502',
            'iso3'=>'GTM',
            'region'=>'Americas',
            'sub_region'=>'Central America'
            ] );
                        
            Country::create( [
            'iso2'=>'GG',
            'name'=>'Guernsey and Alderney',
            'status'=>1,
            'phone_code'=>'44',
            'iso3'=>'GGY',
            'region'=>'Europe',
            'sub_region'=>'Northern Europe'
            ] );
                        
            Country::create( [
            'iso2'=>'GN',
            'name'=>'Guinea',
            'status'=>1,
            'phone_code'=>'224',
            'iso3'=>'GIN',
            'region'=>'Africa',
            'sub_region'=>'Western Africa'
            ] );
                        
            Country::create( [
            'iso2'=>'GW',
            'name'=>'Guinea-Bissau',
            'status'=>1,
            'phone_code'=>'245',
            'iso3'=>'GNB',
            'region'=>'Africa',
            'sub_region'=>'Western Africa'
            ] );
                        
            Country::create( [
            'iso2'=>'GY',
            'name'=>'Guyana',
            'status'=>1,
            'phone_code'=>'592',
            'iso3'=>'GUY',
            'region'=>'Americas',
            'sub_region'=>'South America'
            ] );
                        
            Country::create( [
            'iso2'=>'HT',
            'name'=>'Haiti',
            'status'=>1,
            'phone_code'=>'509',
            'iso3'=>'HTI',
            'region'=>'Americas',
            'sub_region'=>'Caribbean'
            ] );
                        
            Country::create( [
            'iso2'=>'HM',
            'name'=>'Heard Island and McDonald Islands',
            'status'=>1,
            'phone_code'=>'672',
            'iso3'=>'HMD',
            'region'=>'',
            'sub_region'=>''
            ] );
                        
            Country::create( [
            'iso2'=>'HN',
            'name'=>'Honduras',
            'status'=>1,
            'phone_code'=>'504',
            'iso3'=>'HND',
            'region'=>'Americas',
            'sub_region'=>'Central America'
            ] );
                        
            Country::create( [
            'iso2'=>'HK',
            'name'=>'Hong Kong S.A.R.',
            'status'=>1,
            'phone_code'=>'852',
            'iso3'=>'HKG',
            'region'=>'Asia',
            'sub_region'=>'Eastern Asia'
            ] );
                        
            Country::create( [

            'iso2'=>'HU',
            'name'=>'Hungary',
            'status'=>1,
            'phone_code'=>'36',
            'iso3'=>'HUN',
            'region'=>'Europe',
            'sub_region'=>'Eastern Europe'
            ] );
                        
            Country::create( [

            'iso2'=>'IS',
            'name'=>'Iceland',
            'status'=>1,
            'phone_code'=>'354',
            'iso3'=>'ISL',
            'region'=>'Europe',
            'sub_region'=>'Northern Europe'
            ] );
                        
            Country::create( [

            'iso2'=>'IN',
            'name'=>'India',
            'status'=>1,
            'phone_code'=>'91',
            'iso3'=>'IND',
            'region'=>'Asia',
            'sub_region'=>'Southern Asia'
            ] );
                        
            Country::create( [

            'iso2'=>'ID',
            'name'=>'Indonesia',
            'status'=>1,
            'phone_code'=>'62',
            'iso3'=>'IDN',
            'region'=>'Asia',
            'sub_region'=>'South-Eastern Asia'
            ] );
                        
            Country::create( [

            'iso2'=>'IR',
            'name'=>'Iran',
            'status'=>1,
            'phone_code'=>'98',
            'iso3'=>'IRN',
            'region'=>'Asia',
            'sub_region'=>'Southern Asia'
            ] );
                        
            Country::create( [

            'iso2'=>'IQ',
            'name'=>'Iraq',
            'status'=>1,
            'phone_code'=>'964',
            'iso3'=>'IRQ',
            'region'=>'Asia',
            'sub_region'=>'Western Asia'
            ] );
                        
            Country::create( [

            'iso2'=>'IE',
            'name'=>'Ireland',
            'status'=>1,
            'phone_code'=>'353',
            'iso3'=>'IRL',
            'region'=>'Europe',
            'sub_region'=>'Northern Europe'
            ] );
                        
            Country::create( [

            'iso2'=>'IL',
            'name'=>'Israel',
            'status'=>1,
            'phone_code'=>'972',
            'iso3'=>'ISR',
            'region'=>'Asia',
            'sub_region'=>'Western Asia'
            ] );
                        
            Country::create( [

            'iso2'=>'IT',
            'name'=>'Italy',
            'status'=>1,
            'phone_code'=>'39',
            'iso3'=>'ITA',
            'region'=>'Europe',
            'sub_region'=>'Southern Europe'
            ] );
                        
            Country::create( [

            'iso2'=>'JM',
            'name'=>'Jamaica',
            'status'=>1,
            'phone_code'=>'1',
            'iso3'=>'JAM',
            'region'=>'Americas',
            'sub_region'=>'Caribbean'
            ] );
                        
            Country::create( [

            'iso2'=>'JP',
            'name'=>'Japan',
            'status'=>1,
            'phone_code'=>'81',
            'iso3'=>'JPN',
            'region'=>'Asia',
            'sub_region'=>'Eastern Asia'
            ] );
                        
            Country::create( [

            'iso2'=>'JE',
            'name'=>'Jersey',
            'status'=>1,
            'phone_code'=>'44',
            'iso3'=>'JEY',
            'region'=>'Europe',
            'sub_region'=>'Northern Europe'
            ] );
                        
            Country::create( [

            'iso2'=>'JO',
            'name'=>'Jordan',
            'status'=>1,
            'phone_code'=>'962',
            'iso3'=>'JOR',
            'region'=>'Asia',
            'sub_region'=>'Western Asia'
            ] );
                        
            Country::create( [

            'iso2'=>'KZ',
            'name'=>'Kazakhstan',
            'status'=>1,
            'phone_code'=>'7',
            'iso3'=>'KAZ',
            'region'=>'Asia',
            'sub_region'=>'Central Asia'
            ] );
                        
            Country::create( [

            'iso2'=>'KE',
            'name'=>'Kenya',
            'status'=>1,
            'phone_code'=>'254',
            'iso3'=>'KEN',
            'region'=>'Africa',
            'sub_region'=>'Eastern Africa'
            ] );
                        
            Country::create( [

            'iso2'=>'KI',
            'name'=>'Kiribati',
            'status'=>1,
            'phone_code'=>'686',
            'iso3'=>'KIR',
            'region'=>'Oceania',
            'sub_region'=>'Micronesia'
            ] );
                        
            Country::create( [

            'iso2'=>'XK',
            'name'=>'Kosovo',
            'status'=>1,
            'phone_code'=>'383',
            'iso3'=>'XKX',
            'region'=>'Europe',
            'sub_region'=>'Eastern Europe'
            ] );
                        
            Country::create( [

            'iso2'=>'KW',
            'name'=>'Kuwait',
            'status'=>1,
            'phone_code'=>'965',
            'iso3'=>'KWT',
            'region'=>'Asia',
            'sub_region'=>'Western Asia'
            ] );
                        
            Country::create( [

            'iso2'=>'KG',
            'name'=>'Kyrgyzstan',
            'status'=>1,
            'phone_code'=>'996',
            'iso3'=>'KGZ',
            'region'=>'Asia',
            'sub_region'=>'Central Asia'
            ] );
                        
            Country::create( [

            'iso2'=>'LA',
            'name'=>'Laos',
            'status'=>1,
            'phone_code'=>'856',
            'iso3'=>'LAO',
            'region'=>'Asia',
            'sub_region'=>'South-Eastern Asia'
            ] );
                        
            Country::create( [

            'iso2'=>'LV',
            'name'=>'Latvia',
            'status'=>1,
            'phone_code'=>'371',
            'iso3'=>'LVA',
            'region'=>'Europe',
            'sub_region'=>'Northern Europe'
            ] );
                        
            Country::create( [

            'iso2'=>'LB',
            'name'=>'Lebanon',
            'status'=>1,
            'phone_code'=>'961',
            'iso3'=>'LBN',
            'region'=>'Asia',
            'sub_region'=>'Western Asia'
            ] );
                        
            Country::create( [

            'iso2'=>'LS',
            'name'=>'Lesotho',
            'status'=>1,
            'phone_code'=>'266',
            'iso3'=>'LSO',
            'region'=>'Africa',
            'sub_region'=>'Southern Africa'
            ] );
                        
            Country::create( [

            'iso2'=>'LR',
            'name'=>'Liberia',
            'status'=>1,
            'phone_code'=>'231',
            'iso3'=>'LBR',
            'region'=>'Africa',
            'sub_region'=>'Western Africa'
            ] );
                        
            Country::create( [

            'iso2'=>'LY',
            'name'=>'Libya',
            'status'=>1,
            'phone_code'=>'218',
            'iso3'=>'LBY',
            'region'=>'Africa',
            'sub_region'=>'Northern Africa'
            ] );
                        
            Country::create( [

            'iso2'=>'LI',
            'name'=>'Liechtenstein',
            'status'=>1,
            'phone_code'=>'423',
            'iso3'=>'LIE',
            'region'=>'Europe',
            'sub_region'=>'Western Europe'
            ] );
                        
            Country::create( [

            'iso2'=>'LT',
            'name'=>'Lithuania',
            'status'=>1,
            'phone_code'=>'370',
            'iso3'=>'LTU',
            'region'=>'Europe',
            'sub_region'=>'Northern Europe'
            ] );
                        
            Country::create( [

            'iso2'=>'LU',
            'name'=>'Luxembourg',
            'status'=>1,
            'phone_code'=>'352',
            'iso3'=>'LUX',
            'region'=>'Europe',
            'sub_region'=>'Western Europe'
            ] );
                        
            Country::create( [

            'iso2'=>'MO',
            'name'=>'Macau S.A.R.',
            'status'=>1,
            'phone_code'=>'853',
            'iso3'=>'MAC',
            'region'=>'Asia',
            'sub_region'=>'Eastern Asia'
            ] );
                        
            Country::create( [

            'iso2'=>'MK',
            'name'=>'Macedonia',
            'status'=>1,
            'phone_code'=>'389',
            'iso3'=>'MKD',
            'region'=>'Europe',
            'sub_region'=>'Southern Europe'
            ] );
                        
            Country::create( [

            'iso2'=>'MG',
            'name'=>'Madagascar',
            'status'=>1,
            'phone_code'=>'261',
            'iso3'=>'MDG',
            'region'=>'Africa',
            'sub_region'=>'Eastern Africa'
            ] );
                        
            Country::create( [

            'iso2'=>'MW',
            'name'=>'Malawi',
            'status'=>1,
            'phone_code'=>'265',
            'iso3'=>'MWI',
            'region'=>'Africa',
            'sub_region'=>'Eastern Africa'
            ] );
                        
            Country::create( [

            'iso2'=>'MY',
            'name'=>'Malaysia',
            'status'=>1,
            'phone_code'=>'60',
            'iso3'=>'MYS',
            'region'=>'Asia',
            'sub_region'=>'South-Eastern Asia'
            ] );
                        
            Country::create( [

            'iso2'=>'MV',
            'name'=>'Maldives',
            'status'=>1,
            'phone_code'=>'960',
            'iso3'=>'MDV',
            'region'=>'Asia',
            'sub_region'=>'Southern Asia'
            ] );
                        
            Country::create( [

            'iso2'=>'ML',
            'name'=>'Mali',
            'status'=>1,
            'phone_code'=>'223',
            'iso3'=>'MLI',
            'region'=>'Africa',
            'sub_region'=>'Western Africa'
            ] );
                        
            Country::create( [

            'iso2'=>'MT',
            'name'=>'Malta',
            'status'=>1,
            'phone_code'=>'356',
            'iso3'=>'MLT',
            'region'=>'Europe',
            'sub_region'=>'Southern Europe'
            ] );
                        
            Country::create( [

            'iso2'=>'IM',
            'name'=>'Man (Isle of)',
            'status'=>1,
            'phone_code'=>'44',
            'iso3'=>'IMN',
            'region'=>'Europe',
            'sub_region'=>'Northern Europe'
            ] );
                        
            Country::create( [

            'iso2'=>'MH',
            'name'=>'Marshall Islands',
            'status'=>1,
            'phone_code'=>'692',
            'iso3'=>'MHL',
            'region'=>'Oceania',
            'sub_region'=>'Micronesia'
            ] );
                        
            Country::create( [

            'iso2'=>'MQ',
            'name'=>'Martinique',
            'status'=>1,
            'phone_code'=>'596',
            'iso3'=>'MTQ',
            'region'=>'Americas',
            'sub_region'=>'Caribbean'
            ] );
                        
            Country::create( [

            'iso2'=>'MR',
            'name'=>'Mauritania',
            'status'=>1,
            'phone_code'=>'222',
            'iso3'=>'MRT',
            'region'=>'Africa',
            'sub_region'=>'Western Africa'
            ] );
                        
            Country::create( [

            'iso2'=>'MU',
            'name'=>'Mauritius',
            'status'=>1,
            'phone_code'=>'230',
            'iso3'=>'MUS',
            'region'=>'Africa',
            'sub_region'=>'Eastern Africa'
            ] );
                        
            Country::create( [

            'iso2'=>'YT',
            'name'=>'Mayotte',
            'status'=>1,
            'phone_code'=>'262',
            'iso3'=>'MYT',
            'region'=>'Africa',
            'sub_region'=>'Eastern Africa'
            ] );
                        
            Country::create( [

            'iso2'=>'MX',
            'name'=>'Mexico',
            'status'=>1,
            'phone_code'=>'52',
            'iso3'=>'MEX',
            'region'=>'Americas',
            'sub_region'=>'Central America'
            ] );
                        
            Country::create( [

            'iso2'=>'FM',
            'name'=>'Micronesia',
            'status'=>1,
            'phone_code'=>'691',
            'iso3'=>'FSM',
            'region'=>'Oceania',
            'sub_region'=>'Micronesia'
            ] );
                        
            Country::create( [

            'iso2'=>'MD',
            'name'=>'Moldova',
            'status'=>1,
            'phone_code'=>'373',
            'iso3'=>'MDA',
            'region'=>'Europe',
            'sub_region'=>'Eastern Europe'
            ] );
                        
            Country::create( [

            'iso2'=>'MC',
            'name'=>'Monaco',
            'status'=>1,
            'phone_code'=>'377',
            'iso3'=>'MCO',
            'region'=>'Europe',
            'sub_region'=>'Western Europe'
            ] );
                        
            Country::create( [

            'iso2'=>'MN',
            'name'=>'Mongolia',
            'status'=>1,
            'phone_code'=>'976',
            'iso3'=>'MNG',
            'region'=>'Asia',
            'sub_region'=>'Eastern Asia'
            ] );
                        
            Country::create( [

            'iso2'=>'ME',
            'name'=>'Montenegro',
            'status'=>1,
            'phone_code'=>'382',
            'iso3'=>'MNE',
            'region'=>'Europe',
            'sub_region'=>'Southern Europe'
            ] );
                        
            Country::create( [

            'iso2'=>'MS',
            'name'=>'Montserrat',
            'status'=>1,
            'phone_code'=>'1',
            'iso3'=>'MSR',
            'region'=>'Americas',
            'sub_region'=>'Caribbean'
            ] );
                        
            Country::create( [

            'iso2'=>'MA',
            'name'=>'Morocco',
            'status'=>1,
            'phone_code'=>'212',
            'iso3'=>'MAR',
            'region'=>'Africa',
            'sub_region'=>'Northern Africa'
            ] );
                        
            Country::create( [

            'iso2'=>'MZ',
            'name'=>'Mozambique',
            'status'=>1,
            'phone_code'=>'258',
            'iso3'=>'MOZ',
            'region'=>'Africa',
            'sub_region'=>'Eastern Africa'
            ] );
                        
            Country::create( [

            'iso2'=>'MM',
            'name'=>'Myanmar',
            'status'=>1,
            'phone_code'=>'95',
            'iso3'=>'MMR',
            'region'=>'Asia',
            'sub_region'=>'South-Eastern Asia'
            ] );
                        
            Country::create( [

            'iso2'=>'NA',
            'name'=>'Namibia',
            'status'=>1,
            'phone_code'=>'264',
            'iso3'=>'NAM',
            'region'=>'Africa',
            'sub_region'=>'Southern Africa'
            ] );
                        
            Country::create( [

            'iso2'=>'NR',
            'name'=>'Nauru',
            'status'=>1,
            'phone_code'=>'674',
            'iso3'=>'NRU',
            'region'=>'Oceania',
            'sub_region'=>'Micronesia'
            ] );
                        
            Country::create( [

            'iso2'=>'NP',
            'name'=>'Nepal',
            'status'=>1,
            'phone_code'=>'977',
            'iso3'=>'NPL',
            'region'=>'Asia',
            'sub_region'=>'Southern Asia'
            ] );
                        
            Country::create( [

            'iso2'=>'NL',
            'name'=>'Netherlands',
            'status'=>1,
            'phone_code'=>'31',
            'iso3'=>'NLD',
            'region'=>'Europe',
            'sub_region'=>'Western Europe'
            ] );
                        
            Country::create( [

            'iso2'=>'NC',
            'name'=>'New Caledonia',
            'status'=>1,
            'phone_code'=>'687',
            'iso3'=>'NCL',
            'region'=>'Oceania',
            'sub_region'=>'Melanesia'
            ] );
                        
            Country::create( [

            'iso2'=>'NZ',
            'name'=>'New Zealand',
            'status'=>1,
            'phone_code'=>'64',
            'iso3'=>'NZL',
            'region'=>'Oceania',
            'sub_region'=>'Australia and New Zealand'
            ] );
                        
            Country::create( [

            'iso2'=>'NI',
            'name'=>'Nicaragua',
            'status'=>1,
            'phone_code'=>'505',
            'iso3'=>'NIC',
            'region'=>'Americas',
            'sub_region'=>'Central America'
            ] );
                        
            Country::create( [

            'iso2'=>'NE',
            'name'=>'Niger',
            'status'=>1,
            'phone_code'=>'227',
            'iso3'=>'NER',
            'region'=>'Africa',
            'sub_region'=>'Western Africa'
            ] );
                        
            Country::create( [

            'iso2'=>'NG',
            'name'=>'Nigeria',
            'status'=>1,
            'phone_code'=>'234',
            'iso3'=>'NGA',
            'region'=>'Africa',
            'sub_region'=>'Western Africa'
            ] );
                        
            Country::create( [

            'iso2'=>'NU',
            'name'=>'Niue',
            'status'=>1,
            'phone_code'=>'683',
            'iso3'=>'NIU',
            'region'=>'Oceania',
            'sub_region'=>'Polynesia'
            ] );
                        
            Country::create( [

            'iso2'=>'NF',
            'name'=>'Norfolk Island',
            'status'=>1,
            'phone_code'=>'672',
            'iso3'=>'NFK',
            'region'=>'Oceania',
            'sub_region'=>'Australia and New Zealand'
            ] );
                        
            Country::create( [

            'iso2'=>'KP',
            'name'=>'North Korea',
            'status'=>1,
            'phone_code'=>'850',
            'iso3'=>'PRK',
            'region'=>'Asia',
            'sub_region'=>'Eastern Asia'
            ] );
                        
            Country::create( [

            'iso2'=>'MP',
            'name'=>'Northern Mariana Islands',
            'status'=>1,
            'phone_code'=>'1',
            'iso3'=>'MNP',
            'region'=>'Oceania',
            'sub_region'=>'Micronesia'
            ] );
                        
            Country::create( [

            'iso2'=>'NO',
            'name'=>'Norway',
            'status'=>1,
            'phone_code'=>'47',
            'iso3'=>'NOR',
            'region'=>'Europe',
            'sub_region'=>'Northern Europe'
            ] );
                        
            Country::create( [

            'iso2'=>'OM',
            'name'=>'Oman',
            'status'=>1,
            'phone_code'=>'968',
            'iso3'=>'OMN',
            'region'=>'Asia',
            'sub_region'=>'Western Asia'
            ] );
                        
            Country::create( [

            'iso2'=>'PK',
            'name'=>'Pakistan',
            'status'=>1,
            'phone_code'=>'92',
            'iso3'=>'PAK',
            'region'=>'Asia',
            'sub_region'=>'Southern Asia'
            ] );
                        
            Country::create( [

            'iso2'=>'PW',
            'name'=>'Palau',
            'status'=>1,
            'phone_code'=>'680',
            'iso3'=>'PLW',
            'region'=>'Oceania',
            'sub_region'=>'Micronesia'
            ] );
                        
            Country::create( [

            'iso2'=>'PS',
            'name'=>'Palestinian Territory Occupied',
            'status'=>1,
            'phone_code'=>'970',
            'iso3'=>'PSE',
            'region'=>'Asia',
            'sub_region'=>'Western Asia'
            ] );
                        
            Country::create( [

            'iso2'=>'PA',
            'name'=>'Panama',
            'status'=>1,
            'phone_code'=>'507',
            'iso3'=>'PAN',
            'region'=>'Americas',
            'sub_region'=>'Central America'
            ] );
                        
            Country::create( [

            'iso2'=>'PG',
            'name'=>'Papua new Guinea',
            'status'=>1,
            'phone_code'=>'675',
            'iso3'=>'PNG',
            'region'=>'Oceania',
            'sub_region'=>'Melanesia'
            ] );
                        
            Country::create( [

            'iso2'=>'PY',
            'name'=>'Paraguay',
            'status'=>1,
            'phone_code'=>'595',
            'iso3'=>'PRY',
            'region'=>'Americas',
            'sub_region'=>'South America'
            ] );
                        
            Country::create( [

            'iso2'=>'PE',
            'name'=>'Peru',
            'status'=>1,
            'phone_code'=>'51',
            'iso3'=>'PER',
            'region'=>'Americas',
            'sub_region'=>'South America'
            ] );
                        
            Country::create( [

            'iso2'=>'PH',
            'name'=>'Philippines',
            'status'=>1,
            'phone_code'=>'63',
            'iso3'=>'PHL',
            'region'=>'Asia',
            'sub_region'=>'South-Eastern Asia'
            ] );
                        
            Country::create( [

            'iso2'=>'PN',
            'name'=>'Pitcairn Island',
            'status'=>1,
            'phone_code'=>'870',
            'iso3'=>'PCN',
            'region'=>'Oceania',
            'sub_region'=>'Polynesia'
            ] );
                        
            Country::create( [

            'iso2'=>'PL',
            'name'=>'Poland',
            'status'=>1,
            'phone_code'=>'48',
            'iso3'=>'POL',
            'region'=>'Europe',
            'sub_region'=>'Eastern Europe'
            ] );
                        
            Country::create( [

            'iso2'=>'PT',
            'name'=>'Portugal',
            'status'=>1,
            'phone_code'=>'351',
            'iso3'=>'PRT',
            'region'=>'Europe',
            'sub_region'=>'Southern Europe'
            ] );
                        
            Country::create( [

            'iso2'=>'PR',
            'name'=>'Puerto Rico',
            'status'=>1,
            'phone_code'=>'1',
            'iso3'=>'PRI',
            'region'=>'Americas',
            'sub_region'=>'Caribbean'
            ] );
                        
            Country::create( [

            'iso2'=>'QA',
            'name'=>'Qatar',
            'status'=>1,
            'phone_code'=>'974',
            'iso3'=>'QAT',
            'region'=>'Asia',
            'sub_region'=>'Western Asia'
            ] );
                        
            Country::create( [

            'iso2'=>'RE',
            'name'=>'Reunion',
            'status'=>1,
            'phone_code'=>'262',
            'iso3'=>'REU',
            'region'=>'Africa',
            'sub_region'=>'Eastern Africa'
            ] );
                        
            Country::create( [

            'iso2'=>'RO',
            'name'=>'Romania',
            'status'=>1,
            'phone_code'=>'40',
            'iso3'=>'ROU',
            'region'=>'Europe',
            'sub_region'=>'Eastern Europe'
            ] );
                        
            Country::create( [

            'iso2'=>'RU',
            'name'=>'Russia',
            'status'=>1,
            'phone_code'=>'7',
            'iso3'=>'RUS',
            'region'=>'Europe',
            'sub_region'=>'Eastern Europe'
            ] );
                        
            Country::create( [

            'iso2'=>'RW',
            'name'=>'Rwanda',
            'status'=>1,
            'phone_code'=>'250',
            'iso3'=>'RWA',
            'region'=>'Africa',
            'sub_region'=>'Eastern Africa'
            ] );
                        
            Country::create( [

            'iso2'=>'SH',
            'name'=>'Saint Helena',
            'status'=>1,
            'phone_code'=>'290',
            'iso3'=>'SHN',
            'region'=>'Africa',
            'sub_region'=>'Western Africa'
            ] );
                        
            Country::create( [

            'iso2'=>'KN',
            'name'=>'Saint Kitts And Nevis',
            'status'=>1,
            'phone_code'=>'1',
            'iso3'=>'KNA',
            'region'=>'Americas',
            'sub_region'=>'Caribbean'
            ] );
                        
            Country::create( [

            'iso2'=>'LC',
            'name'=>'Saint Lucia',
            'status'=>1,
            'phone_code'=>'1',
            'iso3'=>'LCA',
            'region'=>'Americas',
            'sub_region'=>'Caribbean'
            ] );
                        
            Country::create( [

            'iso2'=>'PM',
            'name'=>'Saint Pierre and Miquelon',
            'status'=>1,
            'phone_code'=>'508',
            'iso3'=>'SPM',
            'region'=>'Americas',
            'sub_region'=>'Northern America'
            ] );
                        
            Country::create( [

            'iso2'=>'VC',
            'name'=>'Saint Vincent And The Grenadines',
            'status'=>1,
            'phone_code'=>'1',
            'iso3'=>'VCT',
            'region'=>'Americas',
            'sub_region'=>'Caribbean'
            ] );
                        
            Country::create( [

            'iso2'=>'BL',
            'name'=>'Saint-Barthelemy',
            'status'=>1,
            'phone_code'=>'590',
            'iso3'=>'BLM',
            'region'=>'Americas',
            'sub_region'=>'Caribbean'
            ] );
                        
            Country::create( [

            'iso2'=>'MF',
            'name'=>'Saint-Martin (French part)',
            'status'=>1,
            'phone_code'=>'590',
            'iso3'=>'MAF',
            'region'=>'Americas',
            'sub_region'=>'Caribbean'
            ] );
                        
            Country::create( [

            'iso2'=>'WS',
            'name'=>'Samoa',
            'status'=>1,
            'phone_code'=>'685',
            'iso3'=>'WSM',
            'region'=>'Oceania',
            'sub_region'=>'Polynesia'
            ] );
                        
            Country::create( [

            'iso2'=>'SM',
            'name'=>'San Marino',
            'status'=>1,
            'phone_code'=>'378',
            'iso3'=>'SMR',
            'region'=>'Europe',
            'sub_region'=>'Southern Europe'
            ] );
                        
            Country::create( [

            'iso2'=>'ST',
            'name'=>'Sao Tome and Principe',
            'status'=>1,
            'phone_code'=>'239',
            'iso3'=>'STP',
            'region'=>'Africa',
            'sub_region'=>'Middle Africa'
            ] );
                        
            Country::create( [

            'iso2'=>'SA',
            'name'=>'Saudi Arabia',
            'status'=>1,
            'phone_code'=>'966',
            'iso3'=>'SAU',
            'region'=>'Asia',
            'sub_region'=>'Western Asia'
            ] );
                        
            Country::create( [

            'iso2'=>'SN',
            'name'=>'Senegal',
            'status'=>1,
            'phone_code'=>'221',
            'iso3'=>'SEN',
            'region'=>'Africa',
            'sub_region'=>'Western Africa'
            ] );
                        
            Country::create( [

            'iso2'=>'RS',
            'name'=>'Serbia',
            'status'=>1,
            'phone_code'=>'381',
            'iso3'=>'SRB',
            'region'=>'Europe',
            'sub_region'=>'Southern Europe'
            ] );
                        
            Country::create( [

            'iso2'=>'SC',
            'name'=>'Seychelles',
            'status'=>1,
            'phone_code'=>'248',
            'iso3'=>'SYC',
            'region'=>'Africa',
            'sub_region'=>'Eastern Africa'
            ] );
                        
            Country::create( [

            'iso2'=>'SL',
            'name'=>'Sierra Leone',
            'status'=>1,
            'phone_code'=>'232',
            'iso3'=>'SLE',
            'region'=>'Africa',
            'sub_region'=>'Western Africa'
            ] );
                        
            Country::create( [

            'iso2'=>'SG',
            'name'=>'Singapore',
            'status'=>1,
            'phone_code'=>'65',
            'iso3'=>'SGP',
            'region'=>'Asia',
            'sub_region'=>'South-Eastern Asia'
            ] );
                        
            Country::create( [

            'iso2'=>'SX',
            'name'=>'Sint Maarten (Dutch part)',
            'status'=>1,
            'phone_code'=>'1721',
            'iso3'=>'SXM',
            'region'=>'Americas',
            'sub_region'=>'Caribbean'
            ] );
                        
            Country::create( [

            'iso2'=>'SK',
            'name'=>'Slovakia',
            'status'=>1,
            'phone_code'=>'421',
            'iso3'=>'SVK',
            'region'=>'Europe',
            'sub_region'=>'Eastern Europe'
            ] );
                        
            Country::create( [

            'iso2'=>'SI',
            'name'=>'Slovenia',
            'status'=>1,
            'phone_code'=>'386',
            'iso3'=>'SVN',
            'region'=>'Europe',
            'sub_region'=>'Southern Europe'
            ] );
                        
            Country::create( [

            'iso2'=>'SB',
            'name'=>'Solomon Islands',
            'status'=>1,
            'phone_code'=>'677',
            'iso3'=>'SLB',
            'region'=>'Oceania',
            'sub_region'=>'Melanesia'
            ] );
                        
            Country::create( [

            'iso2'=>'SO',
            'name'=>'Somalia',
            'status'=>1,
            'phone_code'=>'252',
            'iso3'=>'SOM',
            'region'=>'Africa',
            'sub_region'=>'Eastern Africa'
            ] );
                        
            Country::create( [

            'iso2'=>'ZA',
            'name'=>'South Africa',
            'status'=>1,
            'phone_code'=>'27',
            'iso3'=>'ZAF',
            'region'=>'Africa',
            'sub_region'=>'Southern Africa'
            ] );
                        
            Country::create( [

            'iso2'=>'GS',
            'name'=>'South Georgia',
            'status'=>1,
            'phone_code'=>'500',
            'iso3'=>'SGS',
            'region'=>'Americas',
            'sub_region'=>'South America'
            ] );
                        
            Country::create( [

            'iso2'=>'KR',
            'name'=>'South Korea',
            'status'=>1,
            'phone_code'=>'82',
            'iso3'=>'KOR',
            'region'=>'Asia',
            'sub_region'=>'Eastern Asia'
            ] );
                        
            Country::create( [

            'iso2'=>'SS',
            'name'=>'South Sudan',
            'status'=>1,
            'phone_code'=>'211',
            'iso3'=>'SSD',
            'region'=>'Africa',
            'sub_region'=>'Middle Africa'
            ] );
                        
            Country::create( [

            'iso2'=>'ES',
            'name'=>'Spain',
            'status'=>1,
            'phone_code'=>'34',
            'iso3'=>'ESP',
            'region'=>'Europe',
            'sub_region'=>'Southern Europe'
            ] );
                        
            Country::create( [

            'iso2'=>'LK',
            'name'=>'Sri Lanka',
            'status'=>1,
            'phone_code'=>'94',
            'iso3'=>'LKA',
            'region'=>'Asia',
            'sub_region'=>'Southern Asia'
            ] );
                        
            Country::create( [

            'iso2'=>'SD',
            'name'=>'Sudan',
            'status'=>1,
            'phone_code'=>'249',
            'iso3'=>'SDN',
            'region'=>'Africa',
            'sub_region'=>'Northern Africa'
            ] );
                        
            Country::create( [

            'iso2'=>'SR',
            'name'=>'Suriname',
            'status'=>1,
            'phone_code'=>'597',
            'iso3'=>'SUR',
            'region'=>'Americas',
            'sub_region'=>'South America'
            ] );
                        
            Country::create( [

            'iso2'=>'SJ',
            'name'=>'Svalbard And Jan Mayen Islands',
            'status'=>1,
            'phone_code'=>'47',
            'iso3'=>'SJM',
            'region'=>'Europe',
            'sub_region'=>'Northern Europe'
            ] );
                        
            Country::create( [

            'iso2'=>'SZ',
            'name'=>'Swaziland',
            'status'=>1,
            'phone_code'=>'268',
            'iso3'=>'SWZ',
            'region'=>'Africa',
            'sub_region'=>'Southern Africa'
            ] );
                        
            Country::create( [

            'iso2'=>'SE',
            'name'=>'Sweden',
            'status'=>1,
            'phone_code'=>'46',
            'iso3'=>'SWE',
            'region'=>'Europe',
            'sub_region'=>'Northern Europe'
            ] );
                        
            Country::create( [

            'iso2'=>'CH',
            'name'=>'Switzerland',
            'status'=>1,
            'phone_code'=>'41',
            'iso3'=>'CHE',
            'region'=>'Europe',
            'sub_region'=>'Western Europe'
            ] );
                        
            Country::create( [

            'iso2'=>'SY',
            'name'=>'Syria',
            'status'=>1,
            'phone_code'=>'963',
            'iso3'=>'SYR',
            'region'=>'Asia',
            'sub_region'=>'Western Asia'
            ] );
                        
            Country::create( [

            'iso2'=>'TW',
            'name'=>'Taiwan',
            'status'=>1,
            'phone_code'=>'886',
            'iso3'=>'TWN',
            'region'=>'Asia',
            'sub_region'=>'Eastern Asia'
            ] );
                        
            Country::create( [

            'iso2'=>'TJ',
            'name'=>'Tajikistan',
            'status'=>1,
            'phone_code'=>'992',
            'iso3'=>'TJK',
            'region'=>'Asia',
            'sub_region'=>'Central Asia'
            ] );
                        
            Country::create( [

            'iso2'=>'TZ',
            'name'=>'Tanzania',
            'status'=>1,
            'phone_code'=>'255',
            'iso3'=>'TZA',
            'region'=>'Africa',
            'sub_region'=>'Eastern Africa'
            ] );
                        
            Country::create( [

            'iso2'=>'TH',
            'name'=>'Thailand',
            'status'=>1,
            'phone_code'=>'66',
            'iso3'=>'THA',
            'region'=>'Asia',
            'sub_region'=>'South-Eastern Asia'
            ] );
                        
            Country::create( [

            'iso2'=>'BS',
            'name'=>'The Bahamas',
            'status'=>1,
            'phone_code'=>'1',
            'iso3'=>'BHS',
            'region'=>'Americas',
            'sub_region'=>'Caribbean'
            ] );
                        
            Country::create( [

            'iso2'=>'TG',
            'name'=>'Togo',
            'status'=>1,
            'phone_code'=>'228',
            'iso3'=>'TGO',
            'region'=>'Africa',
            'sub_region'=>'Western Africa'
            ] );
                        
            Country::create( [

            'iso2'=>'TK',
            'name'=>'Tokelau',
            'status'=>1,
            'phone_code'=>'690',
            'iso3'=>'TKL',
            'region'=>'Oceania',
            'sub_region'=>'Polynesia'
            ] );
                        
            Country::create( [

            'iso2'=>'TO',
            'name'=>'Tonga',
            'status'=>1,
            'phone_code'=>'676',
            'iso3'=>'TON',
            'region'=>'Oceania',
            'sub_region'=>'Polynesia'
            ] );
                        
            Country::create( [

            'iso2'=>'TT',
            'name'=>'Trinidad And Tobago',
            'status'=>1,
            'phone_code'=>'1',
            'iso3'=>'TTO',
            'region'=>'Americas',
            'sub_region'=>'Caribbean'
            ] );
                        
            Country::create( [

            'iso2'=>'TN',
            'name'=>'Tunisia',
            'status'=>1,
            'phone_code'=>'216',
            'iso3'=>'TUN',
            'region'=>'Africa',
            'sub_region'=>'Northern Africa'
            ] );
                        
            Country::create( [

            'iso2'=>'TR',
            'name'=>'Turkey',
            'status'=>1,
            'phone_code'=>'90',
            'iso3'=>'TUR',
            'region'=>'Asia',
            'sub_region'=>'Western Asia'
            ] );
                        
            Country::create( [

            'iso2'=>'TM',
            'name'=>'Turkmenistan',
            'status'=>1,
            'phone_code'=>'993',
            'iso3'=>'TKM',
            'region'=>'Asia',
            'sub_region'=>'Central Asia'
            ] );
                        
            Country::create( [

            'iso2'=>'TC',
            'name'=>'Turks And Caicos Islands',
            'status'=>1,
            'phone_code'=>'1',
            'iso3'=>'TCA',
            'region'=>'Americas',
            'sub_region'=>'Caribbean'
            ] );
                        
            Country::create( [

            'iso2'=>'TV',
            'name'=>'Tuvalu',
            'status'=>1,
            'phone_code'=>'688',
            'iso3'=>'TUV',
            'region'=>'Oceania',
            'sub_region'=>'Polynesia'
            ] );
                        
            Country::create( [

            'iso2'=>'UG',
            'name'=>'Uganda',
            'status'=>1,
            'phone_code'=>'256',
            'iso3'=>'UGA',
            'region'=>'Africa',
            'sub_region'=>'Eastern Africa'
            ] );
                        
            Country::create( [

            'iso2'=>'UA',
            'name'=>'Ukraine',
            'status'=>1,
            'phone_code'=>'380',
            'iso3'=>'UKR',
            'region'=>'Europe',
            'sub_region'=>'Eastern Europe'
            ] );
                        
            Country::create( [

            'iso2'=>'AE',
            'name'=>'United Arab Emirates',
            'status'=>1,
            'phone_code'=>'971',
            'iso3'=>'ARE',
            'region'=>'Asia',
            'sub_region'=>'Western Asia'
            ] );
                        
            Country::create( [

            'iso2'=>'GB',
            'name'=>'United Kingdom',
            'status'=>1,
            'phone_code'=>'44',
            'iso3'=>'GBR',
            'region'=>'Europe',
            'sub_region'=>'Northern Europe'
            ] );
                        
            Country::create( [

            'iso2'=>'US',
            'name'=>'United States',
            'status'=>1,
            'phone_code'=>'1',
            'iso3'=>'USA',
            'region'=>'Americas',
            'sub_region'=>'Northern America'
            ] );
                        
            Country::create( [

            'iso2'=>'UM',
            'name'=>'United States Minor Outlying Islands',
            'status'=>1,
            'phone_code'=>'1',
            'iso3'=>'UMI',
            'region'=>'Americas',
            'sub_region'=>'Northern America'
            ] );
                        
            Country::create( [

            'iso2'=>'UY',
            'name'=>'Uruguay',
            'status'=>1,
            'phone_code'=>'598',
            'iso3'=>'URY',
            'region'=>'Americas',
            'sub_region'=>'South America'
            ] );
                        
            Country::create( [

            'iso2'=>'UZ',
            'name'=>'Uzbekistan',
            'status'=>1,
            'phone_code'=>'998',
            'iso3'=>'UZB',
            'region'=>'Asia',
            'sub_region'=>'Central Asia'
            ] );
                        
            Country::create( [

            'iso2'=>'VU',
            'name'=>'Vanuatu',
            'status'=>1,
            'phone_code'=>'678',
            'iso3'=>'VUT',
            'region'=>'Oceania',
            'sub_region'=>'Melanesia'
            ] );
                        
            Country::create( [

            'iso2'=>'VA',
            'name'=>'Vatican City State (Holy See)',
            'status'=>1,
            'phone_code'=>'379',
            'iso3'=>'VAT',
            'region'=>'Europe',
            'sub_region'=>'Southern Europe'
            ] );
                        
            Country::create( [

            'iso2'=>'VE',
            'name'=>'Venezuela',
            'status'=>1,
            'phone_code'=>'58',
            'iso3'=>'VEN',
            'region'=>'Americas',
            'sub_region'=>'South America'
            ] );
                        
            Country::create( [

            'iso2'=>'VN',
            'name'=>'Vietnam',
            'status'=>1,
            'phone_code'=>'84',
            'iso3'=>'VNM',
            'region'=>'Asia',
            'sub_region'=>'South-Eastern Asia'
            ] );
                        
            Country::create( [

            'iso2'=>'VG',
            'name'=>'Virgin Islands (British)',
            'status'=>1,
            'phone_code'=>'1',
            'iso3'=>'VGB',
            'region'=>'Americas',
            'sub_region'=>'Caribbean'
            ] );
                        
            Country::create( [

            'iso2'=>'VI',
            'name'=>'Virgin Islands (US)',
            'status'=>1,
            'phone_code'=>'1',
            'iso3'=>'VIR',
            'region'=>'Americas',
            'sub_region'=>'Caribbean'
            ] );
                        
            Country::create( [

            'iso2'=>'WF',
            'name'=>'Wallis And Futuna Islands',
            'status'=>1,
            'phone_code'=>'681',
            'iso3'=>'WLF',
            'region'=>'Oceania',
            'sub_region'=>'Polynesia'
            ] );
                        
            Country::create( [

            'iso2'=>'EH',
            'name'=>'Western Sahara',
            'status'=>1,
            'phone_code'=>'212',
            'iso3'=>'ESH',
            'region'=>'Africa',
            'sub_region'=>'Northern Africa'
            ] );
                        
            Country::create( [

            'iso2'=>'YE',
            'name'=>'Yemen',
            'status'=>1,
            'phone_code'=>'967',
            'iso3'=>'YEM',
            'region'=>'Asia',
            'sub_region'=>'Western Asia'
            ] );
                        
            Country::create( [

            'iso2'=>'ZM',
            'name'=>'Zambia',
            'status'=>1,
            'phone_code'=>'260',
            'iso3'=>'ZMB',
            'region'=>'Africa',
            'sub_region'=>'Eastern Africa'
            ] );
                        
            Country::create( [

            'iso2'=>'ZW',
            'name'=>'Zimbabwe',
            'status'=>1,
            'phone_code'=>'263',
            'iso3'=>'ZWE',
            'region'=>'Africa',
            'sub_region'=>'Eastern Africa'
            ] );
    }
}
