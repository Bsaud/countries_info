<html>
<head>
<title>Countries information</title>
<link rel="stylesheet" type="text/css" href="main.css">
</head>
<?php
# a function that gets contries names from countries-db.db and add them to the select box
$db =  new sqlite3('countries-db.db');
function get_countries_names() {
    global $db;
    $query = "SELECT country_name FROM mytable";
    $countries = $db->query($query);
    #$countries_array = array();
    $countries_array=$countries;
    return $countries_array;
}

# a function that creates a select box with countries names

function create_countries_select_box() {
    global $db;
    $arr=$db->query("SELECT country_name FROM mytable");
    $select_box = '<select name="country">';
    while ($row = $arr->fetchArray()) {
        $x=$row['country_name'];
        $select_box .= "<option value='$x'>$x</option>";
    
    }
    $select_box .= '</select>';
    return $select_box;}

function create_country_table($country){
    global $db;
    $query = "select country_name,country_code,capital,population,total_area,currency_name,currency_code,currency_symbol,lang_name FROM mytable WHERE country_name = '$country'";
    $country_info = $db->query($query);
    $country_table = '<table>';
    while($row = $country_info->fetchArray()) {
        $country_table .= '<tr>';
        $country_table .= '<th class="tbl-header">Country Name</th>';
        $country_table .= '<th class="tbl-header">Country Code</th>';
        $country_table .= '<th class="tbl-header">Capital</th>';
        $country_table .= '<th class="tbl-header">Population</th>';
        $country_table .= '<th class="tbl-header">Total Area</th>';
        $country_table .= '<th class="tbl-header">Currency Name</th>';
        $country_table .= '<th class="tbl-header">Currency Code</th>';
        $country_table .= '<th class="tbl-header">Currency Symbol</th>';
        $country_table .= '<th class="tbl-header">Language Name</th>';
        $country_table .= '</tr>';
        $country_table .= '<td class="tbl-content">' . $row['country_name'] . '</td>';
        $country_table .= '<td class="tbl-content">' . $row['country_code'] . '</td>';
        $country_table .= '<td class="tbl-content">' . $row['capital'] . '</td>';
        $country_table .= '<td class="tbl-content">' . $row['population'] . '</td>';
        $country_table .= '<td class="tbl-content">' . $row['total_area'] . '</td>';
        $country_table .= '<td class="tbl-content">' . $row['currency_name'] . '</td>';
        $country_table .= '<td class="tbl-content">' . $row['currency_code'] . '</td>';
        $country_table .= '<td class="tbl-content">' . $row['currency_symbol'] . '</td>';
        $country_table .= '<td class="tbl-content">' . $row['lang_name'] . '</td>';
        $country_table .= '</tr>';
    }
    $country_table .= '</table>';
    return $country_table;
}
?>

<body>
<h1>Country Information</h1>
<form name="" action="" method="POST">
    <?php
    $select_box = create_countries_select_box();
    echo $select_box;
    ?>
    <input type="submit" value="Show Country Info">
</form>
<?php
if (isset($_POST['country'])) {
    $country = $_POST['country'];
    create_country_table($country);
}
if (isset($country)) {
   echo create_country_table($country);
}
?>
</body>
</html>