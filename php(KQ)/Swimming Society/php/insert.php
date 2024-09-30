<?php
$PAGE_TITLE = 'Create Event';
require_once('helper.php');

if (!empty($_POST)) {
    $event_name = trim($_POST['event_name']); // Changed variable name
    $event_ID = trim($_POST['event_ID']); // Changed variable name
    $start_time = trim($_POST['start_time']); // Changed variable name
    $end_time = trim($_POST['end_time']); // Changed variable name
    $start_date = trim($_POST['start_date']); // Changed variable name
    $end_date = trim($_POST['end_date']); // Changed variable name
    $location = trim($_POST['location']); // Changed variable name
    $entrance_fees = trim($_POST['entrance_fees']); // Changed variable name

    // Validations
    $error['event_name'] = validateEventName($event_name); // Changed variable name
    $error['event_ID'] = validateEventID($event_ID); // Changed variable name
    $error['start_time'] = validateStartTime($start_time); // Changed variable name
    $error['end_time'] = validateEndTime($end_time); // Changed variable name
    $error['start_date'] = validateStartDate($start_date); // Changed variable name
    $error['end_date'] = validateEndDate($end_date); // Changed variable name
    $error['location'] = validateLocation($location); // Changed variable name
    $error['entrance_fees'] = validateEntranceFees($entrance_fees); // Changed variable name

    $error = array_filter($error); // Remove null values.

    if (empty($error)) {
        $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        $sql = 'INSERT INTO createevent (event_name, event_ID, start_time, end_time, start_date, end_date, location, entrance_fees) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
        $stm = $con->prepare($sql);
        $stm->bind_param('ssssssss', $event_name, $event_ID, $start_time, $end_time, $start_date, $end_date, $location, $entrance_fees);
        $stm->execute();

   
        

        if ($stm->affected_rows > 0) {
            printf('
                <div class="info">
                Event <strong>%s</strong> has been created.
                [ <a href="listevent.php">Back to list</a> ]
                </div>',
                $event_name);

            // Reset fields.
            $event_name = $event_ID = $start_time = $end_time = $start_date = $end_date = $location = $entrance_fees = null;
        } else {
            echo '
                <div class="error">
                Oops. Database issue. Event not created.
                </div>
                ';
        }

        $stm->close();
        $con->close();
    } else {
        echo '<ul class="error">';
        foreach ($error as $value) {
            echo "<li>$value</li>";
        }
        echo '</ul>';
    }
}
?>

<form action="" method="post">
    <table cellpadding="5" cellspacing="0">
        <tr>
            <td><label for="event_name">Event Name :</label></td>
            <td>
                <?php htmlInputText('event_name', isset($event_name) ? $event_name : "", 50) ?>
            </td>
        </tr>
        <tr>
            <td><label for="event_ID">Event ID :</label></td>
            <td>
                <?php htmlInputText('event_ID', isset($event_ID) ? $event_ID : "") ?>
            </td>
        </tr>
        <tr>
            <td><label for="start_time">Start Time :</label></td>
            <td>
                <input type="time" name="start_time" id="start_time" value="<?php echo isset($start_time) ? $start_time : ''; ?>">
            </td>
        </tr>
        <tr>
            <td><label for="end_time">End Time :</label></td>
            <td>
                <input type="time" name="end_time" id="end_time" value="<?php echo isset($end_time) ? $end_time : ''; ?>">
            </td>
        </tr>
        <tr>
            <td><label for="start_date">Start Date :</label></td>
            <td>
                <input type="date" name="start_date" id="start_date" value="<?php echo isset($start_date) ? $start_date : ''; ?>">
            </td>
        </tr>
        <tr>
            <td><label for="end_date">End Date :</label></td>
            <td>
                <input type="date" name="end_date" id="end_date" value="<?php echo isset($end_date) ? $end_date : ''; ?>">
            </td>
        </tr>
        <tr>
            <td><label for="location">Location :</label></td>
            <td>
                <?php htmlInputText('location', isset($location) ? $location : "") ?>
            </td>
        </tr>
        <tr>
            <td><label for="entrance_fees">Entrance Fees :</label></td>
            <td>
                <?php htmlInputText('entrance_fees', isset($entrance_fees) ? $entrance_fees : "") ?>
            </td>
        </tr>
    </table>

    <input type="submit" name="insert" value="Create" />
    <input type="button" value="Cancel" onclick="location='listevent.php'" />
</form>
