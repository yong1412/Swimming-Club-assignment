<?php
///////////////////////////////////////////////////////////////////////////////
// Database connection details ////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////

// Constants. Please change accordingly.
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'admin');

///////////////////////////////////////////////////////////////////////////////
// Lookup tables //////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////

// Return an array of all states.
function getPrograms()
{
    return array(
        'IA' => 'Information Systems Engineering',
        'IB' => 'Business Information Systems',
        'IT' => 'Internet Technology'
    );
}

// Return an array of all genders.
function getGenders()
{
    return array(
        'F' => 'Female',
        'M' => 'Male'
    );
}

// Array versions of lookup tables.
$PROGRAMS = getPrograms();
$GENDERS = getGenders();

///////////////////////////////////////////////////////////////////////////////
// HTML helpers ///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////

// Print a <select> element.
function htmlSelect($name, $items, $selectedValue = '', $default = '')
{
    printf('<select name="%s" id="%s">' . "\n",
           $name, $name);

    if ($default != null)
    {
        printf('<option value="">%s</option>', $default);
    }

    foreach ($items as $value => $text)
    {
        printf('<option value="%s" %s>%s</option>' . "\n",
               $value,
               $value == $selectedValue ? 'selected="selected"' : '',
               $text);
    }
    
    echo "</select>\n";
}

// Print a <input type="text"> element.
function htmlInputText($name, $value = '', $maxlength = '')
{
    printf('<input type="text" name="%s" id="%s" value="%s" maxlength="%s" />' . "\n",
           $name, $name, $value, $maxlength);
}

// Print a <input type="password"> element.
function htmlInputPassword($name, $value = '', $maxlength = '')
{
    printf('<input type="password" name="%s" id="%s" value="%s" maxlength="%s" />' . "\n",
           $name, $name, $value, $maxlength);
}

// Print a <input type="hidden"> element.
function htmlInputHidden($name, $value = '')
{
    printf('<input type="hidden" name="%s" id="%s" value="%s" />' . "\n",
           $name, $name, $value);
}

// Print a group of <input type="radio"> elements.
function htmlRadioList($name, $items, $selectedValue = '', $break = false)
{
    foreach ($items as $value => $text)
    {
        printf('
            <input type="radio" name="%s" id="%s" value="%s" %s />
            <label for="%s">%s</label>' . "\n",
            $name, $value, $value,
            $value == $selectedValue ? 'checked="checked"' : '',
            $value, $text);

        if ($break)
            echo "<br />\n";
    }
}

///////////////////////////////////////////////////////////////////////////////
// Validators /////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////

// Validate Event Name.
// Return nothing if no error.
function validateEventName($event_name)
{
    if ($event_name == null)
    {
        return 'Please enter <strong>Event Name</strong>.';
    }
    else if (!preg_match('/^[A-Za-z @,\'\.\-\/]+$/', $event_name))
    {
        return '<strong>Event Name</strong> is of invalid format. Format: 99XXX99999.';
    }

}

function validateEventID($event_ID)
{
    if ($event_ID == null)
    {
        return 'Please enter <strong>Event ID</strong>.';
    }
    else if (!preg_match('/^EID\d+$/', $event_ID))
    {
        return '<strong>Event ID</strong> is invalid. It should start with "EID" followed by numbers.';
    }
}


// Function to check if event ID already exists
function isEventIDExist($eventID) {
    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Prepare SQL query
    $sql = "SELECT event_ID FROM createevent WHERE event_ID = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('s', $event_ID);
    
    // Execute the query
    $stmt->execute();
    
    // Get result
    $result = $stmt->get_result();
    
    // Check if any rows returned
    if ($result->num_rows > 0) {
        // Event ID already exists
        return 'Event ID already exists.';
    } else {
        // Event ID is available
        return ''; // Return empty string for success
    }
}


// Function to check if event ID already exists

// Validate Start Date.
// Return nothing if no error.
function validateStartDate($start_date)
{
    if ($start_date == null)
    {
        return 'Please enter <strong>Start Date</strong>.';
    }
    
    $dateObj = DateTime::createFromFormat('Y-m-d', $start_date);
    
    if (!$dateObj)
    {
        return '<strong>Start Date</strong> is not a valid date format. Format: YYYY-MM-DD.';
    }
    
    $errors = DateTime::getLastErrors();
    
    if (is_array($errors) && ($errors['warning_count'] + $errors['error_count']) > 0)
    {
        return '<strong>Start Date</strong> is not a valid date format. Format: YYYY-MM-DD.';
    }
}

// Validate Destination.
// Return nothing if no error.
function validateLocation($location)
{
    if ($location == null)
    {
        return 'Please enter <strong>Destination</strong>.';
    }
}

// Validate Entrance Fee.
// Return nothing if no error.
function validateEntranceFees($entrance_fees)
{
    if ($entrance_fees == null)
    {
        return 'Please enter <strong>Entrance Fee(RM) : </strong>.';
    }
    
    if (strcasecmp($entrance_fees, "FREE") != 0 && (!is_numeric($entrance_fees) || $entrance_fees < 1))
    {
        return '<strong>Entrance Fee</strong> must be "FREE" or RM 1 or more.';
    }
}


// Validate End Date.
// Return nothing if no error.
function validateEndDate($end_date)
{
    if ($end_date == null)
    {
        return 'Please enter <strong>End Date</strong>.';
    }
    
    $dateObj = DateTime::createFromFormat('Y-m-d', $end_date);
    
    if (!$dateObj)
    {
        return '<strong>End Date</strong> is not a valid date format. Format: YYYY-MM-DD.';
    }
    
    $errors = DateTime::getLastErrors();
    
    if (is_array($errors) && ($errors['warning_count'] + $errors['error_count']) > 0)
    {
        return '<strong>End Date</strong> is not a valid date format. Format: YYYY-MM-DD.';
    }
}





// Validate Start Time.
// Return nothing if no error.
function validateStartTime($start_time)
{
    if ($start_time == null)
    {
        return 'Please enter <strong>Start Time</strong>.';
    }
    else if (!preg_match('/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/', $start_time))
    {
        return '<strong>Start Time</strong> is not a valid time format. Format: HH:MM.';
    }
}


// Validate End Time.
// Return nothing if no error.
function validateEndTime($end_time)
{
    if ($end_time == null)
    {
        return 'Please enter <strong>End Time</strong>.';
    }
    else if (!preg_match('/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/', $end_time))
    {
        return '<strong>End Time</strong> is not a valid time format. Format: HH:MM.';
    }
}
