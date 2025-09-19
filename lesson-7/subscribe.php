<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Subscribe | COMP1002 HTML, CSS, and JS Fundamentals</title>
		<meta name="author" content="The name of the document’s author to go here" />
		<meta name="description" content="A concise and accurate summary of the document content is to appear here">
		<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon" />
		<link rel="stylesheet" href="css/styles.css" />
	</head>
	<body>
		<!-- Page-level header -->
		<header>
			<img src="images/html-logo.svg" height="75" width="75" alt="HTML" />
			<h1>HTML, CSS, and JS Fundamentals</h1>
			<h2>Building Blocks for Web Developers</h2>
			<!-- Global site navigation -->
			<nav>
				<ul>
					<li><a href="index.php" title="Go to the Home page">Home</a></li>
					<li><a href="red.php" title="Learn about red blocks">Red Blocks</a></li>
					<li><a href="blue.php" title="Learn about blue blocks">Blue Blocks</a></li>
					<li><a href="yellow.php" title="Learn about yellow blocks">Yellow Blocks</a></li>
					<li><a href="about.php" title="Learn more about us">About</a></li>
				</ul>
			</nav>
		</header>
		<!-- Page-level main content -->
		<main>
			<section>
				<h3>Thank You for Subscribing</h3>
<?php
// Capture the value of the emailAddress INPUT from the index.php page by defining a PHP variable called '$emailAddress' and setting the value to the email address as entered by the user in the FORM on index.php
	$emailAddress = $_GET['emailAddress'];
// Use the PHP function, echo() to create an HTML paragraph element that confirms the user's email address -->
	echo('<p>Your email address, '.$emailAddress.' has been added to our list of subscribers.</p>');
?>
			</section>
		</main>
		<!-- Page-level footer -->
		<footer>
			<!-- Fine print navigation -->
			<nav>
				<a href="about/privacy-policy.php" title="Read our Privacy Policy">Privacy Policy</a> | <a href="about/privacy-policy.php#personal-information" title="Learn about how we treat your personal information">Use of Personal Information</a> | <a href="about/terms-of-use.php" title="Understand our Terms of Use">Terms of Use</a> | <a href="about/terms-of-use.php#limitation-liability" title="Our Limitation of Liability explained">Limitation of Liability</a>
			</nav>
			<p><small>© HTML, CSS, and JS Blocks Inc.</small></p>
		</footer>
	</body>
</html>
