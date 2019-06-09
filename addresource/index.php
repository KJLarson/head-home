<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Head Home - Add a Resource</title>
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

    <!-- Page Header and Navigation bar ------------>
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
                    <li><a class="shortlink" href="../findhelp/index.php">Find Help</a></li>
                    <li><a class="active mediumlink" href="">Add a Resource</a></li>
                    <li><a class="longlink" href="../homelessness/index.html">Learn About Homelessness</a></li>
                    <li><a class="longlink" href="../mentalhealth/index.html">Learn About Mental Health</a></li>
                </ul>
            </nav>
        </div> <!-- navigation -->
    </header>

    <!-- Main Content -------------->
    <main id="maincontent">
        <div class="pagetitle">
            <h1>Add a Resource</h1>
        </div>

<!-- Instructions for entering information -->
        <div class="instructions">
            <div id="howtoadd">
                <p>
                    If you are a professional in the Twin Cities who works with people experiencing homelessness and/or mental health issues, please add your organization or agency to the list of resources!
                </p>
                <p>
                    To add information, fill in the form below. The Resource Name field, where you enter the organization or agency name, is required. Please add as much of the remaining information as applicable. The more information, the easier it will be to for people to get help.
                </p>
                <p>
                    Click the Submit Resource button at the bottom of the page when you are done.
                </p>
            </div>
        </div> <!-- Instructions for entering information -->

        <!-- Form (placeholder for form that links to database from database classes)-->
            <form id="form" action="index.php" method="post">
                    <ul class="flex-outer">
                        <li>
                            <label for="resource_name"><span class="formlabel">Resource Name <span id="required" class="formparenthesis">(Required)</span>:</span>
                            </label>
                            <input id="resource_name" type="text" name="resource_name" required="required">
                        </li>
                        <li>
                            <label for="street_address"><span class="formlabel">Street Address:</span></label>
                            <input id="street_address" type="text" name="street_address">
                        </li>
                        <li>
                            <label for="city"><span class="formlabel">City:</span></label>
                            <input id="city" type="text" name="city">
                        </li>
                        <li>
                            <label for="state_abbreviation"><span class="formlabel">State <span class="formparenthesis">(Two Letter Postal Code)</span>:</span>
                            </label>
                            <input id="state_abbreviation" type="text" name="state_abbreviation">
                        </li>
                        <li>
                            <label for="zip"><span class="formlabel">Zip Code:</span></label>
                            <input id="zip" type="text" name="zip">
                        </li>
                        <li>
                            <label for="phone_number"><span class="formlabel">Phone Number <span class="formparenthesis">(555-555-5555)</span>:</span></label>
                            <input id="phone_number" type="text" name="phone_number">
                        </li>
                        <li>
                            <label for="fax_number"><span class="formlabel">Fax Number <span class="formparenthesis">(555-555-5555)</span>:</span></label>
                            <input id="fax_number" type="text" name="fax_number">
                        </li>
                        <li>
                            <label for="website_url"><span class="formlabel">Website URL:</span></label>
                            <input id="website_url" type="url" name="website_url">
                        </li>
                        <li>
                            <input id="hidden"  type="radio" name="database_action" value="insert" checked>
                        </li>
                        <li>
                            <input type="submit" name="submit" value="Submit Resource">
                        </li>
            </form>

            <?php
//if radio buttons have same name, they are considered grouped. Must have different values
include_once "../php/my_functions.php";
require_once "../php/database_headhome.php";
include "../php/headhome_get_post_data.php";

$where_clause = "WHERE 1 = 1 ";

$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);

if ($conn->connect_error) die($conn->connect_error);



if($database_action == "insert")
{
	$city_id = "";

	if(!empty($city))
	{
		$find_query = "SELECT city_id FROM city WHERE city_name = '" . $city . "' ";

		$find_result = $conn->query($find_query);

		if($find_result->num_rows > 0)
		{
			$find_result->data_seek(0);
			$find_row = $find_result->fetch_array(MYSQLI_ASSOC);
			$city_id = $find_row['city_id'];
		}
		else
		{
			$insert_query = "INSERT INTO city (city_name) VALUES ('" . $city . "')";

			if($conn->query($insert_query) == TRUE)
			{
				printp("City successfully added.");
			}
			else
			{
				printp($conn->error);
			}

			$find_query = "SELECT city_id FROM city WHERE city_name = '" . $city . "' ";

			$find_result = $conn->query($find_query);
			$find_result->data_seek(0);
			$find_row = $find_result->fetch_array(MYSQLI_ASSOC);
			$city_id = $find_row['city_id'];
		}
	}

	if(!empty($zip))
	{
		$find_query = "SELECT zip_code FROM zip_code WHERE zip_code = '" . $zip . "' ";

		$find_result = $conn->query($find_query);

		if($find_result->num_rows == 0)
		{
			$insert_query = "INSERT INTO zip_code (zip_code) VALUES ('" . $zip . "')";

			if($conn->query($insert_query) == TRUE)
			{
				printp("Zip code successfully added.");
			}
			else
			{
				printp($conn->error);
			}
		}
	}

	$insert_query = "";

	if(empty($city_id))
	{
		$insert_query = "INSERT INTO location (address, zip_code, state, phone, website, fax) VALUES ('" . $street_address . "', '" . $zip . "', '" . $state_abbreviation . "', '" . $phone_number . "', '" . $website_url . "', '" . $fax_number . "')";

		$find_result = $conn->query($find_query);
		$find_result->data_seek(0);
		$find_row = $find_result->fetch_array(MYSQLI_ASSOC);
		$location_id = $find_row['location_id'];
	}
	else
	{
		$insert_query = "INSERT INTO location (address, city_id, zip_code, state, phone, website, fax) VALUES ('" . $street_address . "', " . $city_id . ", '" . $zip . "', '" . $state_abbreviation . "', '" . $phone_number . "', '" . $website_url . "', '" . $fax_number . "')";
	}

	//printp($insert_query);

	if($conn->query($insert_query) == TRUE)
	{
		//printp("Location successfully added.");
	}
	else
	{
		printp($conn->error);
	}

	$find_query = "";

	if(empty($city_id))
	{
		$find_query = "SELECT location_id FROM location WHERE 1 = 1 AND address = '" . $street_address . "' AND zip_code = '" . $zip . "' AND state = '" . $state_abbreviation . "' AND phone = '" . $phone_number . "' AND website = '" . $website_url . "' AND fax = '" . $fax_number ."' LIMIT 1";

	}
	else
	{
		$find_query = "SELECT location_id FROM location WHERE 1 = 1 AND address = '" . $street_address . "' AND zip_code = '" . $zip . "' AND state = '" . $state_abbreviation . "' AND phone = '" . $phone_number . "' AND website = '" . $website_url . "' AND fax = '" . $fax_number ."' AND city_id = " . $city_id . " LIMIT 1";
	}

	//printp($find_query);

	$find_result = $conn->query($find_query);
	$find_result->data_seek(0);
	$find_row = $find_result->fetch_array(MYSQLI_ASSOC);
	$location_id = $find_row['location_id'];

	// printp($location_id);

	$insert_query = "INSERT INTO resource (resource_name, location_id) VALUES ('" . $resource_name . "', " . $location_id . ")";

	//printp($insert_query);

	if($conn->query($insert_query) == TRUE)
	{
		printp("Resource successfully added.");
	}
	else
	{
		printp($conn->error);
	}
}

$query = <<<_QUERY
SELECT r.resource_name, s.service_type, l.address, c.city_name, z.zip_code, l.phone, l.fax, l.website
FROM resource r
	LEFT OUTER JOIN location l
	ON r.location_id = l.location_id
	LEFT OUTER JOIN zip_code z
	ON z.zip_code = l.zip_code
	LEFT OUTER JOIN  city c
	ON c.city_id = l.city_id
	LEFT OUTER JOIN service s
	ON s.service_id = r.service_id
_QUERY;

$result = $conn->query($query);
if(!$result) die($conn->error);

$num_rows = $result->num_rows;

$result->close();
$conn->close();
?>

    </main>

    <!-- Footer -->
    <footer>
        <p>
            This website was designed by Kari L. as a project for LIS 7530 (Internet Fundamentals) at St. Catherine University. Fall 2018.
        </p>
    </footer>
</body>

</html>
