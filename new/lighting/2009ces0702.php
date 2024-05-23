<?PHP
######################################################
#                                                    #
#                Forms To Go 4.5.4                   #
#             http://www.bebosoft.com/               #
#                                                    #
######################################################




define('kOptional', true);
define('kMandatory', false);

define('kStringRangeFrom', 1);
define('kStringRangeTo', 2);
define('kStringRangeBetween', 3);

define('kYes', 'yes');
define('kNo', 'no');




error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('track_errors', true);

function DoStripSlashes($fieldValue)  { 
// temporary fix for PHP6 compatibility - magic quotes deprecated in PHP6
    if ( function_exists( 'get_magic_quotes_gpc' ) && get_magic_quotes_gpc() ) {
        if (is_array($fieldValue) ) {
            return array_map('DoStripSlashes', $fieldValue);
        } else {
            return trim(stripslashes($fieldValue));
        }
    } else {
        return $fieldValue;
    }
}

function FilterCChars($theString) {
    return preg_replace('/[\x00-\x1F]/', '', $theString);
}

function ProcessPHPFile($PHPFile) {

    ob_start();

    if (file_exists($PHPFile)) {
        require $PHPFile;
    } else {
        echo '<html><head><meta http-equiv="content-type" content="text/html; charset=utf-8" /><title>Error</title></head><body>Forms To Go - Error: Unable to load HTML form: ' . $PHPFile . '</body></html>';
        exit;
    }

    return ob_get_clean();
}

function CheckString($value, $low, $high, $mode, $limitAlpha, $limitNumbers, $limitEmptySpaces, $limitExtraChars, $optional) {

    $regEx = '';

    if ($limitAlpha == kYes) {
        $regExp = 'A-Za-z';
    }

    if ($limitNumbers == kYes) {
        $regExp .= '0-9';
    }

    if ($limitEmptySpaces == kYes) {
        $regExp .= ' ';
    }

    if (strlen($limitExtraChars) > 0) {

        $search = array('\\', '[', ']', '-', '$', '.', '*', '(', ')', '?', '+', '^', '{', '}', '|', '/');
        $replace = array('\\\\', '\[', '\]', '\-', '\$', '\.', '\*', '\(', '\)', '\?', '\+', '\^', '\{', '\}', '\|', '\/');

        $regExp .= str_replace($search, $replace, $limitExtraChars);

    }

    if ( (strlen($regExp) > 0) && (strlen($value) > 0) ){
        if (preg_match('/[^' . $regExp . ']/', $value)) {
            return false;
        }
    }

    if ( (strlen($value) == 0) && ($optional === kOptional) ) {
        return true;
    } elseif ( (strlen($value) >= $low) && ($mode == kStringRangeFrom) ) {
        return true;
    } elseif ( (strlen($value) <= $high) && ($mode == kStringRangeTo) ) {
        return true;
    } elseif ( (strlen($value) >= $low) && (strlen($value) <= $high) && ($mode == kStringRangeBetween) ) {
        return true;
    } else {
        return false;
    }

}


function CheckEmail($email, $optional) {
    if ( (strlen($email) == 0) && ($optional === kOptional) ) {
        return true;
    } elseif ( preg_match("/^([\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+\.)*[\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+@((((([a-z0-9]{1}[a-z0-9\-]{0,62}[a-z0-9]{1})|[a-z])\.)+[a-z]{2,6})|(\d{1,3}\.){3}\d{1,3}(\:\d{1,5})?)$/i", $email) == 1 ) {
        return true;
    } else {
        return false;
    }
}




if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $clientIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $clientIP = $_SERVER['REMOTE_ADDR'];
}

$FTGname = DoStripSlashes( $_POST['name'] );
$FTGcompany = DoStripSlashes( $_POST['company'] );
$FTGemail = DoStripSlashes( $_POST['email'] );
$FTGphone = DoStripSlashes( $_POST['phone'] );
$FTGinterest = DoStripSlashes( $_POST['interest'] );
$FTGmanufacturer = DoStripSlashes( $_POST['manufacturer'] );
$FTGother = DoStripSlashes( $_POST['other'] );
$FTGreferred = DoStripSlashes( $_POST['referred'] );
$FTGbotcatcher = DoStripSlashes( $_POST['botcatcher'] );



$validationFailed = false;

# Fields Validations


if (!CheckString($FTGname, 1, 0, kStringRangeFrom, kNo, kNo, kNo, '', kMandatory)) {
    $FTGErrorMessage['name'] = '*Please enter your name';
    $validationFailed = true;
}

if (!CheckEmail($FTGemail, kMandatory)) {
    $FTGErrorMessage['email'] = '*Please enter a valid email address';
    $validationFailed = true;
}

if (!CheckString($FTGbotcatcher, 1, 1, kStringRangeBetween, kNo, kNo, kNo, '', kMandatory)) {
    $FTGErrorMessage['botcatcher'] = '';
    $validationFailed = true;
}



# Embed error page and dump it to the browser

if ($validationFailed === true) {

    $fileErrorPage = 'error.php';

    if (file_exists($fileErrorPage) === false) {
        echo '<html><head><meta http-equiv="content-type" content="text/html; charset=utf-8" /><title>Error</title></head><body>The error page: <b>' . $fileErrorPage. '</b> cannot be found on the server.</body></html>';
        exit;
    }

    $errorPage = ProcessPHPFile($fileErrorPage);

    $errorList = @implode("<br />\n", $FTGErrorMessage);
    $errorPage = str_replace('<!--VALIDATIONERROR-->', $errorList, $errorPage);

    $errorPage = str_replace('<!--FIELDVALUE:name-->', $FTGname, $errorPage);
    $errorPage = str_replace('<!--FIELDVALUE:company-->', $FTGcompany, $errorPage);
    $errorPage = str_replace('<!--FIELDVALUE:email-->', $FTGemail, $errorPage);
    $errorPage = str_replace('<!--FIELDVALUE:phone-->', $FTGphone, $errorPage);
    $errorPage = str_replace('<!--FIELDVALUE:interest-->', $FTGinterest, $errorPage);
    $errorPage = str_replace('<!--FIELDVALUE:manufacturer-->', $FTGmanufacturer, $errorPage);
    $errorPage = str_replace('<!--FIELDVALUE:other-->', $FTGother, $errorPage);
    $errorPage = str_replace('<!--FIELDVALUE:referred-->', $FTGreferred, $errorPage);
    $errorPage = str_replace('<!--FIELDVALUE:botcatcher-->', $FTGbotcatcher, $errorPage);
    $errorPage = str_replace('<!--ERRORMSG:name-->', $FTGErrorMessage['name'], $errorPage);
    $errorPage = str_replace('<!--ERRORMSG:email-->', $FTGErrorMessage['email'], $errorPage);




    echo $errorPage;

}

if ( $validationFailed === false ) {

# Email to Form Owner

    $emailSubject = FilterCChars("Contact Request From Clark Lighting Solutions Website");

    $emailBody = "" . date('Y-m-d H:i:s') . "\n"
    . "\n"
    . "Scott,\n"
    . "\n"
    . "A contact request has been submitted to the Clark Lighting Solutions website.  The details follow:\n"
    . "\n"
    . "CONTACT INFORMATION\n"
    . "===================\n"
    . "\n"
    . "Name: $FTGname\n"
    . "Company: $FTGcompany\n"
    . "Email: $FTGemail\n"
    . "Phone: $FTGphone\n"
    . "Area of Interest: $FTGinterest\n"
    . "Manufacturer: $FTGmanufacturer\n"
    . "Other: $FTGother\n"
    . "Referred By: $FTGreferred\n"
    . "\n"
    . "###";
    if ($FTGbotcatcher == "a") {

        $emailTo = 'Scott Clark <info@clark-inc.com>';

        $emailFrom = FilterCChars("$FTGemail");

        $emailHeader = "From: $emailFrom\n"
        . 'Bcc: Kelley Rao <support@web-eze.com>' . "\n"
        . "MIME-Version: 1.0\n"
        . "Content-type: text/plain; charset=\"ISO-8859-1\"\n"
        . "Content-transfer-encoding: 7bit\n";

        mail($emailTo, $emailSubject, $emailBody, $emailHeader);

    }

# Confirmation Email to User

    $confEmailTo = FilterCChars($FTGemail);

    $confEmailSubject = FilterCChars("$FTGname, Thank you for your inquiry");

    $confEmailBody = chunk_split( base64_encode( "" . date('m/d/y') . "\n"
        . "\n"
        . "Hello $FTGname,\n"
        . "\n"
        . "Thank you for your inquiry. One of our sales professionals will be in touch with you shortly. Should you have any immediate needs, please do not hesitate to contact us at (480) 347-9765.\n"
        . "\n"
        . "Sincerely,\n"
        . "\n"
        . "Clark Lighting Solutions\n"
        . "\n"
        . "7825 E. Gelding Dr., Suite 102\n"
        . "Scottsdale, AZ 85260\n"
        . "Phone: 480-347-9765\n"
        . "Fax: 480-284-7628" ) );

    $confEmailHeader = "From: Clark Lighting Solutions <info@clark-inc.com>\n"
    . "MIME-Version: 1.0\n"
    . "Content-type: text/plain; charset=\"ISO-8859-1\"\n"
    . "Content-transfer-encoding: base64\n";

    mail($confEmailTo, $confEmailSubject, $confEmailBody, $confEmailHeader);



# Redirect user to success page

    header("Location: http://www.clarklightingsolutions.com/success.php");

}

?>