<?php
/**
 * This file has been @generated by a phing task by {@link BuildMetadataPHPFromXml}.
 * See [README.md](README.md#generating-data) for more information.
 *
 * Pull requests changing data in these files will not be accepted. See the
 * [FAQ in the README](README.md#problems-with-invalid-numbers] on how to make
 * metadata changes.
 *
 * Do not modify this file directly!
 */


return array (
  'generalDesc' => 
  array (
    'NationalNumberPattern' => '[12]\\d{7,9}|[57-9]\\d{7}',
    'PossibleLength' => 
    array (
      0 => 8,
      1 => 9,
      2 => 10,
    ),
    'PossibleLengthLocalOnly' => 
    array (
      0 => 4,
      1 => 5,
      2 => 6,
    ),
  ),
  'fixedLine' => 
  array (
    'NationalNumberPattern' => '[12]2[1-3]\\d{5,6}|(?:[12](?:1|27)|5[0568])\\d{6}|[12](?:3[2-8]|4[2-68]|5[1-4689])\\d{6,7}',
    'ExampleNumber' => '50123456',
    'PossibleLength' => 
    array (
    ),
    'PossibleLengthLocalOnly' => 
    array (
      0 => 4,
      1 => 5,
      2 => 6,
    ),
  ),
  'mobile' => 
  array (
    'NationalNumberPattern' => '83[01]\\d{5}|(?:8[05689]|9[013-9])\\d{6}',
    'ExampleNumber' => '88123456',
    'PossibleLength' => 
    array (
      0 => 8,
    ),
    'PossibleLengthLocalOnly' => 
    array (
    ),
  ),
  'tollFree' => 
  array (
    'PossibleLength' => 
    array (
      0 => -1,
    ),
    'PossibleLengthLocalOnly' => 
    array (
    ),
  ),
  'premiumRate' => 
  array (
    'PossibleLength' => 
    array (
      0 => -1,
    ),
    'PossibleLengthLocalOnly' => 
    array (
    ),
  ),
  'sharedCost' => 
  array (
    'PossibleLength' => 
    array (
      0 => -1,
    ),
    'PossibleLengthLocalOnly' => 
    array (
    ),
  ),
  'personalNumber' => 
  array (
    'PossibleLength' => 
    array (
      0 => -1,
    ),
    'PossibleLengthLocalOnly' => 
    array (
    ),
  ),
  'voip' => 
  array (
    'NationalNumberPattern' => '7[05-8]\\d{6}',
    'ExampleNumber' => '75123456',
    'PossibleLength' => 
    array (
      0 => 8,
    ),
    'PossibleLengthLocalOnly' => 
    array (
    ),
  ),
  'pager' => 
  array (
    'PossibleLength' => 
    array (
      0 => -1,
    ),
    'PossibleLengthLocalOnly' => 
    array (
    ),
  ),
  'uan' => 
  array (
    'PossibleLength' => 
    array (
      0 => -1,
    ),
    'PossibleLengthLocalOnly' => 
    array (
    ),
  ),
  'voicemail' => 
  array (
    'PossibleLength' => 
    array (
      0 => -1,
    ),
    'PossibleLengthLocalOnly' => 
    array (
    ),
  ),
  'noInternationalDialling' => 
  array (
    'PossibleLength' => 
    array (
      0 => -1,
    ),
    'PossibleLengthLocalOnly' => 
    array (
    ),
  ),
  'id' => 'MN',
  'countryCode' => 976,
  'internationalPrefix' => '001',
  'nationalPrefix' => '0',
  'nationalPrefixForParsing' => '0',
  'sameMobileAndFixedLinePattern' => false,
  'numberFormat' => 
  array (
    0 => 
    array (
      'pattern' => '(\\d{2})(\\d{2})(\\d{4})',
      'format' => '$1 $2 $3',
      'leadingDigitsPatterns' => 
      array (
        0 => '[12]1',
      ),
      'nationalPrefixFormattingRule' => '0$1',
      'domesticCarrierCodeFormattingRule' => '',
      'nationalPrefixOptionalWhenFormatting' => false,
    ),
    1 => 
    array (
      'pattern' => '(\\d{4})(\\d{4})',
      'format' => '$1 $2',
      'leadingDigitsPatterns' => 
      array (
        0 => '[57-9]',
      ),
      'nationalPrefixFormattingRule' => '',
      'domesticCarrierCodeFormattingRule' => '',
      'nationalPrefixOptionalWhenFormatting' => false,
    ),
    2 => 
    array (
      'pattern' => '(\\d{3})(\\d{5,6})',
      'format' => '$1 $2',
      'leadingDigitsPatterns' => 
      array (
        0 => '[12]2[1-3]',
      ),
      'nationalPrefixFormattingRule' => '0$1',
      'domesticCarrierCodeFormattingRule' => '',
      'nationalPrefixOptionalWhenFormatting' => false,
    ),
    3 => 
    array (
      'pattern' => '(\\d{4})(\\d{5,6})',
      'format' => '$1 $2',
      'leadingDigitsPatterns' => 
      array (
        0 => '[12](?:27|3[2-8]|4[2-68]|5[1-4689])',
        1 => '[12](?:27|3[2-8]|4[2-68]|5[1-4689])[0-3]',
      ),
      'nationalPrefixFormattingRule' => '0$1',
      'domesticCarrierCodeFormattingRule' => '',
      'nationalPrefixOptionalWhenFormatting' => false,
    ),
    4 => 
    array (
      'pattern' => '(\\d{5})(\\d{4,5})',
      'format' => '$1 $2',
      'leadingDigitsPatterns' => 
      array (
        0 => '[12]',
      ),
      'nationalPrefixFormattingRule' => '0$1',
      'domesticCarrierCodeFormattingRule' => '',
      'nationalPrefixOptionalWhenFormatting' => false,
    ),
  ),
  'intlNumberFormat' => 
  array (
  ),
  'mainCountryForCode' => false,
  'leadingZeroPossible' => false,
  'mobileNumberPortableRegion' => false,
);
