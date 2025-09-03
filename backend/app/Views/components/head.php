<?php
/**
 * components/head.php
 * Renders a full <head> block with default CDN includes and accepts
 * dynamic page title and optional extras (strings or arrays of tags).
 *
 * Usage:
 * <?= view('components/head', ['title' => 'Page title', 'extras' => '<style>...</style>']) ?>
 */

$title = $title ?? 'Sunset Funeral Homes';
$extras = $extras ?? null; // string or array
$cdns = $cdns ?? [];
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= esc($title) ?></title>

  <!-- Default CDN includes -->
  <!-- Google Fonts: Playfair Display + Lato (global) -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Global base typography -->
  <style>
    /* Base typography */
    html, body { font-family: 'Lato', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial; }
    h1,h2,h3,h4,h5 { font-family: 'Playfair Display', Georgia, serif; }
  </style>

  <!-- Fonts are loaded above; use Tailwind utilities only (no inline CSS here) -->

  <?php
  // Extra CDN/script/link tags passed as an array of strings
  if (is_array($cdns)) {
	  foreach ($cdns as $tag) {
		  echo $tag . "\n";
	  }
  }

  // Extra head HTML (string) — styles, meta, inline script, etc.
  if (!empty($extras)) {
	  if (is_array($extras)) {
		  foreach ($extras as $e) {
			  echo $e . "\n";
		  }
	  } else {
		  echo $extras . "\n";
	  }
  }
  ?>
  <!-- No JavaScript included: all behavior removed per request -->
</head>
