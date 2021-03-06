<?php
/*  php Card Generator v1.1
 *  author: ayimdomnic
 *  requirements
 *  etc
 *
 *
 *
 */

$visaPrefixList[] =  "4539";
$visaPrefixList[] =  "4556";
$visaPrefixList[] =  "4916";
$visaPrefixList[] =  "4532";
$visaPrefixList[] =  "4929";
$visaPrefixList[] =  "40240071";
$visaPrefixList[] =  "4485";
$visaPrefixList[] =  "4716";
$visaPrefixList[] =  "4";

$mastercardPrefixList[] =  "51";
$mastercardPrefixList[] =  "52";
$mastercardPrefixList[] =  "53";
$mastercardPrefixList[] =  "54";
$mastercardPrefixList[] =  "55";

$amexPrefixList[] =  "34";
$amexPrefixList[] =  "37";

$discoverPrefixList[] = "6011";

$dinersPrefixList[] =  "300";
$dinersPrefixList[] =  "301";
$dinersPrefixList[] =  "302";
$dinersPrefixList[] =  "303";
$dinersPrefixList[] =  "36";
$dinersPrefixList[] =  "38";

$enRoutePrefixList[] =  "2014";
$enRoutePrefixList[] =  "2149";

$jcbPrefixList[] =  "35";

$voyagerPrefixList[] = "8699";

/*
'prefix' is the start of the CC number as a string, any number of digits.
'length' is the length of the CC number to generate. Typically 13 or 16
*/
function completed_number($prefix, $length) {

    $ccnumber = $prefix;

    # generate digits

    while ( strlen($ccnumber) < ($length - 1) ) {
        $ccnumber .= rand(0,9);
    }

    # Calculate sum

    $sum = 0;
    $pos = 0;

    $reversedCCnumber = strrev( $ccnumber );

    while ( $pos < $length - 1 ) {

        $odd = $reversedCCnumber[ $pos ] * 2;
        if ( $odd > 9 ) {
            $odd -= 9;
        }

        $sum += $odd;

        if ( $pos != ($length - 2) ) {

            $sum += $reversedCCnumber[ $pos +1 ];
        }
        $pos += 2;
    }

    # Calculate check digit

    $checkdigit = (( floor($sum/10) + 1) * 10 - $sum) % 10;
    $ccnumber .= $checkdigit;

    return $ccnumber;
}

function credit_card_number($prefixList, $length, $howMany) {

    //echo $prefixList .'\n';
    for ($i = 0; $i < $howMany; $i++) {

        $ccnumber = $prefixList[ array_rand($prefixList) ];
        $result[] = completed_number($ccnumber, $length);
    }
    return $result;
}
/*
function output($title, $numbers) {

    $result[] = "<div class='creditCardNumbers'>";
    $result[] = "<h3>$title</h3>";
    $result[] = implode('<br />', $numbers);
    $result[]= '</div>';

    return implode('<br />', $result);
}

#
# Main
#

echo "<div class='creditCardSet'>";
$mastercard = credit_card_number($mastercardPrefixList, 16, 10);
echo output("Mastercard", $mastercard);

$visa16 = credit_card_number($visaPrefixList, 16, 10);
echo output("VISA 16 digit", $visa16);
echo "</div>";

echo "<div class='creditCardSet'>";
$visa13 = credit_card_number($visaPrefixList, 13, 5);
echo output("VISA 13 digit", $visa13);

$amex = credit_card_number($amexPrefixList, 15, 5);
echo output("American Express", $amex);
echo "</div>";

# Minor cards

echo "<div class='creditCardSet'>";
$discover = credit_card_number($discoverPrefixList, 16, 3);
echo output("Discover", $discover);

$diners = credit_card_number($dinersPrefixList, 14, 3);
echo output("Diners Club", $diners);
echo "</div>";

echo "<div class='creditCardSet'>";
$enRoute = credit_card_number($enRoutePrefixList, 15, 3);
echo output("enRoute", $enRoute);

$jcb = credit_card_number($jcbPrefixList, 16, 3);
echo output("JCB", $jcb);
echo "</div>";

echo "<div class='creditCardSet'>";
$voyager = credit_card_number($voyagerPrefixList, 15, 3);
echo output("Voyager", $voyager);
echo "</div>";
?>
*/