<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('countries')->delete();

		DB::table('countries')->insert([
			['code' => 'AF', 'description' => 'Afghanistan'],
			['code' => 'AL', 'description' => 'Albania'],
			['code' => 'DZ', 'description' => 'Algeria'],
			['code' => 'AS', 'description' => 'American Samoa'],
			['code' => 'AD', 'description' => 'Andorra'],
			['code' => 'AO', 'description' => 'Angola'],
			['code' => 'AI', 'description' => 'Anguilla'],
			['code' => 'AQ', 'description' => 'Antarctica'],
			['code' => 'AR', 'description' => 'Argentina'],
			['code' => 'AM', 'description' => 'Armenia'],
			['code' => 'AW', 'description' => 'Aruba'],
			['code' => 'AU', 'description' => 'Australia'],
			['code' => 'AT', 'description' => 'Austria'],
			['code' => 'AZ', 'description' => 'Azerbaijan'],
			['code' => 'BS', 'description' => 'Bahamas'],
			['code' => 'BH', 'description' => 'Bahrain'],
			['code' => 'BD', 'description' => 'Bangladesh'],
			['code' => 'BB', 'description' => 'Barbados'],
			['code' => 'BY', 'description' => 'Belarus'],
			['code' => 'BE', 'description' => 'Belgium'],
			['code' => 'BZ', 'description' => 'Belize'],
			['code' => 'BJ', 'description' => 'Benin'],
			['code' => 'BM', 'description' => 'Bermuda'],
			['code' => 'BT', 'description' => 'Bhutan'],
			['code' => 'BO', 'description' => 'Bolivia'],
			['code' => 'BA', 'description' => 'Bosnia and Herzegovina'],
			['code' => 'BW', 'description' => 'Botswana'],
			['code' => 'BR', 'description' => 'Brazil'],
			['code' => 'VG', 'description' => 'British Virgin Islands'],
			['code' => 'BN', 'description' => 'Brunei'],
			['code' => 'BG', 'description' => 'Bulgaria'],
			['code' => 'BF', 'description' => 'Burkina Faso'],
			['code' => 'BI', 'description' => 'Burundi'],
			['code' => 'KH', 'description' => 'Cambodia'],
			['code' => 'CM', 'description' => 'Cameroon'],
			['code' => 'CA', 'description' => 'Canada'],
			['code' => 'CV', 'description' => 'Cape Verde'],
			['code' => 'KY', 'description' => 'Cayman Islands'],
			['code' => 'CF', 'description' => 'Central African Republic'],
			['code' => 'CL', 'description' => 'Chile'],
			['code' => 'CN', 'description' => 'China'],
			['code' => 'CO', 'description' => 'Colombia'],
			['code' => 'KM', 'description' => 'Comoros'],
			['code' => 'CK', 'description' => 'Cook Islands'],
			['code' => 'CR', 'description' => 'Costa Rica'],
			['code' => 'HR', 'description' => 'Croatia'],
			['code' => 'CU', 'description' => 'Cuba'],
			['code' => 'CW', 'description' => 'Curacao'],
			['code' => 'CY', 'description' => 'Cyprus'],
			['code' => 'CZ', 'description' => 'Czech Republic'],
			['code' => 'CD', 'description' => 'Democratic Republic of Congo'],
			['code' => 'DK', 'description' => 'Denmark'],
			['code' => 'DJ', 'description' => 'Djibouti'],
			['code' => 'DM', 'description' => 'Dominica'],
			['code' => 'DO', 'description' => 'Dominican Republic'],
			['code' => 'TL', 'description' => 'East Timor'],
			['code' => 'EC', 'description' => 'Ecuador'],
			['code' => 'EG', 'description' => 'Egypt'],
			['code' => 'SV', 'description' => 'El Salvador'],
			['code' => 'GQ', 'description' => 'Equatorial Guinea'],
			['code' => 'ER', 'description' => 'Eritrea'],
			['code' => 'EE', 'description' => 'Estonia'],
			['code' => 'ET', 'description' => 'Ethiopia'],
			['code' => 'FK', 'description' => 'Falkland Islands'],
			['code' => 'FO', 'description' => 'Faroe Islands'],
			['code' => 'FJ', 'description' => 'Fiji'],
			['code' => 'FI', 'description' => 'Finland'],
			['code' => 'FR', 'description' => 'France'],
			['code' => 'PF', 'description' => 'French Polynesia'],
			['code' => 'GA', 'description' => 'Gabon'],
			['code' => 'GM', 'description' => 'Gambia'],
			['code' => 'GE', 'description' => 'Georgia'],
			['code' => 'DE', 'description' => 'Germany'],
			['code' => 'GH', 'description' => 'Ghana'],
			['code' => 'GI', 'description' => 'Gibraltar'],
			['code' => 'GR', 'description' => 'Greece'],
			['code' => 'GL', 'description' => 'Greenland'],
			['code' => 'GP', 'description' => 'Guadeloupe'],
			['code' => 'GU', 'description' => 'Guam'],
			['code' => 'GT', 'description' => 'Guatemala'],
			['code' => 'GN', 'description' => 'Guinea'],
			['code' => 'GW', 'description' => 'Guinea-Bissau'],
			['code' => 'GY', 'description' => 'Guyana'],
			['code' => 'HT', 'description' => 'Haiti'],
			['code' => 'HN', 'description' => 'Honduras'],
			['code' => 'HK', 'description' => 'Hong Kong'],
			['code' => 'HU', 'description' => 'Hungary'],
			['code' => 'IS', 'description' => 'Iceland'],
			['code' => 'IN', 'description' => 'India'],
			['code' => 'ID', 'description' => 'Indonesia'],
			['code' => 'IR', 'description' => 'Iran'],
			['code' => 'IQ', 'description' => 'Iraq'],
			['code' => 'IE', 'description' => 'Ireland'],
			['code' => 'IM', 'description' => 'Isle of Man'],
			['code' => 'IL', 'description' => 'Israel'],
			['code' => 'IT', 'description' => 'Italy'],
			['code' => 'CI', 'description' => 'Ivory Coast'],
			['code' => 'JM', 'description' => 'Jamaica'],
			['code' => 'JP', 'description' => 'Japan'],
			['code' => 'JO', 'description' => 'Jordan'],
			['code' => 'KZ', 'description' => 'Kazakhstan'],
			['code' => 'KE', 'description' => 'Kenya'],
			['code' => 'KI', 'description' => 'Kiribati'],
			['code' => 'XK', 'description' => 'Kosovo'],
			['code' => 'KW', 'description' => 'Kuwait'],
			['code' => 'KG', 'description' => 'Kyrgyzstan'],
			['code' => 'LA', 'description' => 'Laos'],
			['code' => 'LV', 'description' => 'Latvia'],
			['code' => 'LB', 'description' => 'Lebanon'],
			['code' => 'LS', 'description' => 'Lesotho'],
			['code' => 'LR', 'description' => 'Liberia'],
			['code' => 'LY', 'description' => 'Libya'],
			['code' => 'LI', 'description' => 'Liechtenstein'],
			['code' => 'LT', 'description' => 'Lithuania'],
			['code' => 'LU', 'description' => 'Luxembourg'],
			['code' => 'MO', 'description' => 'Macau'],
			['code' => 'MK', 'description' => 'Macedonia'],
			['code' => 'MG', 'description' => 'Madagascar'],
			['code' => 'MW', 'description' => 'Malawi'],
			['code' => 'MY', 'description' => 'Malaysia'],
			['code' => 'MV', 'description' => 'Maldives'],
			['code' => 'ML', 'description' => 'Mali'],
			['code' => 'MT', 'description' => 'Malta'],
			['code' => 'MH', 'description' => 'Marshall Islands'],
			['code' => 'MR', 'description' => 'Mauritania'],
			['code' => 'MU', 'description' => 'Mauritius'],
			['code' => 'MX', 'description' => 'Mexico'],
			['code' => 'FM', 'description' => 'Micronesia'],
			['code' => 'MD', 'description' => 'Moldova'],
			['code' => 'MC', 'description' => 'Monaco'],
			['code' => 'MN', 'description' => 'Mongolia'],
			['code' => 'ME', 'description' => 'Montenegro'],
			['code' => 'MS', 'description' => 'Montserrat'],
			['code' => 'MA', 'description' => 'Morocco'],
			['code' => 'MZ', 'description' => 'Mozambique'],
			['code' => 'MM', 'description' => 'Myanmar [Burma]'],
			['code' => 'NA', 'description' => 'Namibia'],
			['code' => 'NR', 'description' => 'Nauru'],
			['code' => 'NP', 'description' => 'Nepal'],
			['code' => 'NL', 'description' => 'Netherlands'],
			['code' => 'NC', 'description' => 'New Caledonia'],
			['code' => 'NZ', 'description' => 'New Zealand'],
			['code' => 'NI', 'description' => 'Nicaragua'],
			['code' => 'NE', 'description' => 'Niger'],
			['code' => 'NG', 'description' => 'Nigeria'],
			['code' => 'NU', 'description' => 'Niue'],
			['code' => 'NF', 'description' => 'Norfolk Island'],
			['code' => 'KP', 'description' => 'North Korea'],
			['code' => 'MP', 'description' => 'Northern Mariana Islands'],
			['code' => 'NO', 'description' => 'Norway'],
			['code' => 'OM', 'description' => 'Oman'],
			['code' => 'PK', 'description' => 'Pakistan'],
			['code' => 'PW', 'description' => 'Palau'],
			['code' => 'PA', 'description' => 'Panama'],
			['code' => 'PG', 'description' => 'Papua New Guinea'],
			['code' => 'PY', 'description' => 'Paraguay'],
			['code' => 'PE', 'description' => 'Peru'],
			['code' => 'PH', 'description' => 'Philippines'],
			['code' => 'PN', 'description' => 'Pitcairn Islands'],
			['code' => 'PL', 'description' => 'Poland'],
			['code' => 'PT', 'description' => 'Portugal'],
			['code' => 'PR', 'description' => 'Puerto Rico'],
			['code' => 'QA', 'description' => 'Qatar'],
			['code' => 'CG', 'description' => 'Republic of the Congo'],
			['code' => 'RE', 'description' => 'Reunion'],
			['code' => 'RO', 'description' => 'Romania'],
			['code' => 'RU', 'description' => 'Russia'],
			['code' => 'RW', 'description' => 'Rwanda'],
			['code' => 'BL', 'description' => 'Saint Barthélemy'],
			['code' => 'SH', 'description' => 'Saint Helena'],
			['code' => 'KN', 'description' => 'Saint Kitts and Nevis'],
			['code' => 'LC', 'description' => 'Saint Lucia'],
			['code' => 'MF', 'description' => 'Saint Martin'],
			['code' => 'PM', 'description' => 'Saint Pierre and Miquelon'],
			['code' => 'VC', 'description' => 'Saint Vincent and the Grenadines'],
			['code' => 'WS', 'description' => 'Samoa'],
			['code' => 'SM', 'description' => 'San Marino'],
			['code' => 'ST', 'description' => 'Sao Tome and Principe'],
			['code' => 'SA', 'description' => 'Saudi Arabia'],
			['code' => 'SN', 'description' => 'Senegal'],
			['code' => 'RS', 'description' => 'Serbia'],
			['code' => 'SC', 'description' => 'Seychelles'],
			['code' => 'SL', 'description' => 'Sierra Leone'],
			['code' => 'SG', 'description' => 'Singapore'],
			['code' => 'SK', 'description' => 'Slovakia'],
			['code' => 'SI', 'description' => 'Slovenia'],
			['code' => 'SB', 'description' => 'Solomon Islands'],
			['code' => 'SO', 'description' => 'Somalia'],
			['code' => 'ZA', 'description' => 'South Africa'],
			['code' => 'KR', 'description' => 'South Korea'],
			['code' => 'SS', 'description' => 'South Sudan'],
			['code' => 'ES', 'description' => 'Spain'],
			['code' => 'LK', 'description' => 'Sri Lanka'],
			['code' => 'SD', 'description' => 'Sudan'],
			['code' => 'SR', 'description' => 'Suriname'],
			['code' => 'SZ', 'description' => 'Swaziland'],
			['code' => 'SE', 'description' => 'Sweden'],
			['code' => 'CH', 'description' => 'Switzerland'],
			['code' => 'SY', 'description' => 'Syria'],
			['code' => 'TW', 'description' => 'Taiwan'],
			['code' => 'TJ', 'description' => 'Tajikistan'],
			['code' => 'TZ', 'description' => 'Tanzania'],
			['code' => 'TH', 'description' => 'Thailand'],
			['code' => 'TG', 'description' => 'Togo'],
			['code' => 'TK', 'description' => 'Tokelau'],
			['code' => 'TT', 'description' => 'Trinidad and Tobago'],
			['code' => 'TN', 'description' => 'Tunisia'],
			['code' => 'TR', 'description' => 'Turkey'],
			['code' => 'TM', 'description' => 'Turkmenistan'],
			['code' => 'TV', 'description' => 'Tuvalu'],
			['code' => 'UG', 'description' => 'Uganda'],
			['code' => 'UA', 'description' => 'Ukraine'],
			['code' => 'AE', 'description' => 'United Arab Emirates'],
			['code' => 'GB', 'description' => 'United Kingdom'],
			['code' => 'US', 'description' => 'United States'],
			['code' => 'UY', 'description' => 'Uruguay'],
			['code' => 'UZ', 'description' => 'Uzbekistan'],
			['code' => 'VU', 'description' => 'Vanuatu'],
			['code' => 'VA', 'description' => 'Vatican'],
			['code' => 'VE', 'description' => 'Venezuela'],
			['code' => 'VN', 'description' => 'Vietnam'],
			['code' => 'EH', 'description' => 'Western Sahara'],
			['code' => 'YE', 'description' => 'Yemen'],
			['code' => 'ZM', 'description' => 'Zambia'],
			['code' => 'ZW', 'description' => 'Zimbabwe']
		]);
	}

}