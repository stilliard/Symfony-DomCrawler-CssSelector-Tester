<?php

ini_set('display_errors', true);

define('PATH', dirname(__FILE__));

require_once PATH . '/vendor/autoload.php';

use Symfony\Component\DomCrawler\Crawler;

$error = null;
$userSelector = '';
$userHtml = '';
$crawlerHtml = '';
$tidyCrawlerHtml = '';
$resultCount = '';
$resultText = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') try {
	
	// grab the user's post'd html
	$userHtml = isset($_POST['html']) ? $_POST['html'] : null;
	if ( ! $userHtml) {
		throw new Exception('Please enter some html');
	}

	// and the user's post'd css selector
	$userSelector = isset($_POST['selector']) ? $_POST['selector'] : null;
	if ( ! $userSelector) {
		throw new Exception('Please enter a CSS selector');
	}

	$crawler = new Crawler();
	$crawler->addHtmlContent($userHtml);
	$crawlerHtml = $crawler->html(); // to use later in view

	$result = $crawler->filter($userSelector);
	$resultCount = count($result);

	if ($resultCount > 0) {
		$resultText = $result->text();
	}
	// if no results found yet, then try tidying the html
	else {

		// tidy version of it
		$tidyHtml = tidy_parse_string($userHtml);

		$tidyCrawler = new Crawler();
		$tidyCrawler->addHtmlContent($tidyHtml);
		$tidyCrawlerHtml = $tidyCrawler->html(); // to use later in view

		$result = $tidyCrawler->filter($userSelector);
		$resultCount = count($result);

		if ($resultCount > 0) {
			$resultText = $result->text();
		}

	}
} catch (Exception $e) {
	$error = $e->getMessage();
}

// view function to html escape
function escape($string) {
	return htmlspecialchars($string, ENT_QUOTES, 'utf-8');
}

$view = (object) [
	'error' => $error,
	'userSelector' => $userSelector,
	'userHtml' => $userHtml,
	'crawlerHtml' => $crawlerHtml,
	'tidyCrawlerHtml' => $tidyCrawlerHtml,
	'resultCount' => $resultCount,
	'resultText' => $resultText,
];
include PATH . '/views/index.php';
