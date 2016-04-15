<?php
header("Access-Control-Allow-Origin: *");
include('../libs/simple_html_dom.php');

// Load MeL search page

//book_title = $_POST['t'];
$book_title = 'obfuscation%3A%20a%20user%27s%20guide';

//$url = 'http://elibrary.mel.org/search/a?searchtype=t&searcharg=' . $book_title . '&SORT=D&submit.x=0&submit.y=0';

$url = 'http://elibrary.mel.org/search~S15/?searchtype=t&searcharg=kasjhdkajshdaks&searchscope=15&sortdropdown=-&SORT=D&extended=0&SUBMIT=Search&searchlimits=&searchorigarg=tobfuscation%3A+a+user%27s+guide';

$html = file_get_html($url);

// Determine if a title is available:

$html->find('.bibScreeen');

if(count($html->find('.bibScreen')) > 0) { // Takes you to a record

	// Count number of owning libraries
	$copies = $html->find('#owningLibs td');

	echo '<p>' . count($copies) . ' other Michigan libraries may have this book. You can get it faster by requesting it directly.<br /><a class="btn btn-default" target="_blank" href="' . $url . '">Request from another Michigan Library</a></p>';
	
}

if(count($html->find('.browseScreen')) > 0) { // List of results

	// Is this a no results screen?
	if(count($html->find('tr.yourEntryWouldBeHere')) > 0) {

		echo '<!-- Not available in MeLCat-->';

	} else { // Possible results

		echo '<p>Other Michigan libraries may have this book. You can get it faster by requesting it directly.<br /><a class="btn btn-default" target="_blank" href="' . $url . '">Request from another Michigan Library</a></p>';

	}

}