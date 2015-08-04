<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Symfony DomCrawler CssSelector Component Testing</title>
	<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
	<link rel="stylesheet" href="/css/app.css">
</head>
<body>
		
	<header>
		<h1>Testing the Symfony DomCrawler CssSelector Component</h1>
		<p>With HTML Tidy fallback</p>
	</header>

	<?php /* show error */ if ($view->error) { ?>
	<div class="error">
		<?php echo $view->error; ?>
	</div>
	<?php } ?>

	<?php /* show results */ if ($view->crawlerHtml) { ?>
	<h2>Results - Count: <?php echo $view->resultCount; ?></h2>
	<form class="pure-g pure-form">

		<div class="pure-u-1-3">
			<p>Matched Text:<br>
				<textarea class="pure-input-1" disabled rows="10"><?php echo escape($view->resultText); ?></textarea></li>
			</p>
		</div>

		<div class="pure-u-1-3">
			<p>Crawler's HTML:<br>
				<textarea class="pure-input-1" disabled rows="10"><?php echo escape($view->crawlerHtml); ?></textarea>
			</p>
		</div>
		
		<?php /* if the tidy html was used, show it */ if ($view->tidyCrawlerHtml) { ?>
		<div class="pure-u-1-3">
			<p>Tidy Craler's HTML:<br>
				<textarea class="pure-input-1" disabled rows="10"><?php echo escape($view->tidyCrawlerHtml); ?></textarea>
			</p>
		</div>
		<?php } ?>

	</form>

	<h2>Re-run?</h2>
	<?php } ?>

	<form method="POST" class="pure-form pure-form-stacked">
		
		<fieldset>
			
			<!-- css selector -->
			<label for="selector">CSS selector path to filter</label>
			<input class="pure-input-1" type="text" name="selector" id="selector" placeholder=".something > span" value="<?php echo escape($view->userSelector); ?>">
			
			<!-- html to run against -->
			<label for="selector">HTML</label>
			<textarea class="pure-input-1" rows="6" name="html" id="html" placeholder="&lt;!DOCTYPE html&gt;
&lt;html&gt;..."><?php echo escape($view->userHtml); ?></textarea>

			<button type="submit" class="pure-button pure-button-primary">Submit</button>

		</fieldset>
	</form>

	<footer>
		<small>&copy; <?php echo date('Y'); ?></small>
	</footer>

</body>
</html>