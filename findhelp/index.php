<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Head Home - Find Help</title>
    <link type="text/css" rel="stylesheet" href="../stylesheet.css">
    <link rel="icon" href="../pictures/icon.ico" type="image/x-icon">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-130504552-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-130504552-1');
    </script>
</head>

<body class="page">
    <a id="mainlink" href="#maincontent">Skip to main content</a>

    <!-- Page Header and Navigation bar ----------->
    <header class="top">
        <div class="logo">
            <a href="../index.html">
                <img src="../pictures/logo.png" alt="Head Home logo">
            </a>
        </div> <!-- logo -->
        <div class="sitetitle">
            <h1>Head Home</h1>
        </div> <!-- sitetitle -->
        <div class="navigation">
        <nav>
            <ul>
                <li><a class="shortlink" href="../index.html">Home</a></li>
                <li><a class="active shortlink" href="">Find Help</a></li>
                <li><a class="mediumlink" href="../addresource/index.php">Add a Resource</a></li>
                <li><a class="longlink" href="../homelessness/index.html">Learn About Homelessness</a></li>
                <li><a class="longlink" href="../mentalhealth/index.html">Learn About Mental Health</a></li>
            </ul>
        </nav>
        </div> <!-- navigation -->
    </header>

    <!-- Main Content -------------->
    <main id="maincontent">
        <div class="pagetitle">
            <h1>Find Help</h1>
        </div>

        <!-- Instructions -->
        <article class="instructions">
            <div id="howtosearch">
                <p>
                    To search the list of places you can get help, click on each box to see a list of search options for its category. You can chose an option from the Type of Help menu, the City menu, or both. Then click on the Search button to find available resources. The results will show in the table at the bottom of the page.
                </p>
            </div>
            <!-- description/definition list of resources -->
            <div id="descriptions">
                <p>
                    See the following list for descriptions of each type of resource. You can click on the name of the resource type and a description will appear. Click on it again to hide the description.
                </p>

                <button class="accordion">Clinic</button>
                <div class="panel">
                    A facility devoted to diagnosing and treating medical and/or emotional conditions on an outpatient basis
                </div>

                <button class="accordion">Government Agency</button>
                <div class="panel">
                    A unit of government with specific responsibilities. It may be able to provide financial or other assistance
                </div>

                <button class="accordion">Hospital</button>
                <div class="panel">
                    An institution for treating sick or injured people medically or surgically
                </div>

                <button class="accordion">Inpatient</button>
                <div class="panel">
                    A place where people are admitted for mental health treatment that requires at least one overnight stay. Generally not used for long-term treatment.
                </div>

                <button class="accordion">Library</button>
                <div class="panel">
                    A public institution that provides access to information, services, education, and computers, often for free
                </div>

                <button class="accordion">Psychiatry</button>
                <div class="panel">
                    A place to get mental disorders diagnosed and treated, sometimes with medication
                </div>

                <button class="accordion">Residential Treatment</button>
                <div class="panel">
                    Provides mental health or substance abuse treatment in a live-in health care facility
                </div>

                <button class="accordion">Shelter</button>
                <div class="panel">
                    Service that provides temporary residence for individuals and families
                </div>

                <button class="accordion">Support Group</button>
                <div class="panel">
                    A meeting of people who are going through or have gone through similar experiences. A place to connect with others.
                </div>
            </div> <!-- description/definition list of resources -->

<!-- JavaScript for accordion buttons & panels -->
                <script>
                    var acc = document.getElementsByClassName("accordion");
                    var i;

                    for (i = 0; i < acc.length; i++) {
                        acc[i].addEventListener("click", function() {
                            this.classList.toggle("active");
                            var panel = this.nextElementSibling;
                            if (panel.style.display === "block") {
                                panel.style.display = "none";
                            } else {
                                panel.style.display = "block";
                            }
                        });
                    }
                </script>


        </article> <!-- instructions -->

<?php

require_once "../php/database_headhome.php";
include_once "../php/my_functions.php";

$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);

if ($conn->connect_error) die($conn->connect_error);

$droplist_query = "SELECT DISTINCT service_type FROM service
ORDER BY service_type";

$droplist_result = $conn->query($droplist_query);
if(!$droplist_result) die($conn->error);

$num_droplist_rows = $droplist_result->num_rows;

//post adds security
echo '<div id="search">';

echo '<h2>Search:</h2>';

echo '<div id="searchtype">';
echo '<form method="post" action="index.php">';
echo '<label for="typeselect"><span class="formlabel">Type of Help:</span></label>';
echo    '<select id="typeselect" name="service_type_select">';
echo        '<option value="all">All</option>';
for ($i = 0; $i < $num_droplist_rows; $i++)
{
	$droplist_result->data_seek($i);
	$droplist_row = $droplist_result->fetch_array(MYSQLI_ASSOC);

	echo "        <option value=\"" . $droplist_row['service_type'] . "\">" . $droplist_row['service_type'] . "</option>";
}
echo '</select>';
echo '</div>'; // searchtype

//----------------------------start of second drop box
echo '<div id="searchcity">';
$droplist_city_query = "SELECT DISTINCT city_name FROM city
ORDER BY city_name";

$droplist_city_result = $conn->query($droplist_city_query);
if(!$droplist_city_result) die($conn->error);

$num_droplist_city_rows = $droplist_city_result->num_rows;

//post adds security
echo '<div id="searchcity">';
echo '<form method="post" action="index.php">';
echo '<label for="cityselect"><span class="formlabel">City:</span></label>';
echo '	<select id="cityselect" name="city_select">';

echo '        <option value="all">All</option>';
for($j = 0; $j < $num_droplist_city_rows; $j++)
{
	$droplist_city_result->data_seek($j);
	$droplist_city_row = $droplist_city_result->fetch_array(MYSQLI_ASSOC);

	echo "        <option value=\"" . $droplist_city_row['city_name'] . "\">" . $droplist_city_row['city_name'] . "</option>";
}

echo '	</select>';
echo '</div>'; // searchcity

echo '	<input type ="submit" name="submit" value="Search">';
echo '<form>';
echo '</div>'; // search
//---------------------------------------end of form

//---------------------------------------feedback for user saying what they searched for

$where_clause = "WHERE 1 = 1 ";

if(isset($_POST['service_type_select']))
{
	printp("You selected \"" . $_POST['service_type_select'] . "\" for service type.");

	if($_POST['service_type_select'] != "all")
	{
		$where_clause .= "AND service_type = '" . $_POST['service_type_select'] . "' ";
	}
}

if(isset($_POST['city_select']))
{
	printp("You selected \"" . $_POST['city_select'] . "\" for city.");

	if($_POST['city_select'] != "all")
	{
		$where_clause .= "AND city_name = '" . $_POST['city_select'] . "' ";
	}
}

//------------------------------table

$query = <<<_QUERY
SELECT r.resource_name, s.service_type, l.address, c.city_name, z.zip_code, l.phone, l.fax, l.website
FROM resource r
	LEFT OUTER JOIN location l
	ON r.location_id = l.location_id
	LEFT OUTER JOIN service s
	ON s.service_id = r.service_id
	LEFT OUTER JOIN zip_code z
	ON z.zip_code = l.zip_code
	LEFT OUTER JOIN  city c
	ON c.city_id = l.city_id

_QUERY;

$query .= $where_clause ;

$query .= "ORDER BY service_type ASC, city_name, resource_name";

$result = $conn->query($query);
if(!$result) die($conn->error);

$num_rows = $result->num_rows;

print "\n";

if($num_rows > 0)
{
print "<table>\n";
print "    <tr>\n";
print "        <th>Resource Name</th>\n";
print "        <th>Service Type</th>\n";
print "        <th>Address</th>\n";
print "        <th>City</th>\n";
print "        <th>Zip Code</th>\n";
print "        <th>Phone Number</th>\n";
print "        <th>Fax Number</th>\n";
print "        <th>Website</th>\n";
print "    </tr>\n";
}
else
{
echo "<b>Sorry, no results found</b>\n";
}

for($i = 0; $i < $num_rows; $i++)
{
    $result->data_seek($i);
    $row = $result->fetch_array(MYSQLI_NUM);
    $num_cols = $result->field_count;

    echo "    <tr>\n";

    for($j = 0; $j < $num_cols; $j++)
    {
        echo "        <td>" . $row[$j] . "</td>\n";
    }

    echo "    </tr>\n";
}

if($num_rows > 0)
{
print "</table>\n";
}

$result->close();


$conn->close();

?>
<!-- End of table, end of PHP -->


    </main>

    <!-- Footer -->
    <footer>
        <p>
            This website was designed by Kari L. as a project for LIS 7530 (Internet Fundamentals) at St. Catherine University. Fall 2018.
        </p>

    </footer>
</body>

</html>
