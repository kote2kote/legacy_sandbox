<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="format-detection" content="email=no,telephone=no,address=no" />
  <!-- <title>starter</title> -->
  <meta name="description" content="" />

  <!-- ogp -->
  <meta property="og:image" content="表示される画像URL(https://〜)" />
  <meta property="og:site_name" content="site name" />
  <meta property="fb:app_id" content="xxxxxxxxxxxxxx" />
  <meta property="twitter:card" content="表示される画像URL(https://〜)" />
  <meta property="twitter:site" content="@xxxxx" />
  <meta property="og:image:secure_url" content="表示される画像URL(https://〜)" />
  <meta property="og:image:width" content="1024" />
  <meta property="og:image:height" content="764" />

  <!-- windows -->
  <meta name="msapplication-square70x70logo" content="/assets/icons/favicon-70x70.png" />
  <meta name="msapplication-square150x150logo" content="/assets/icons/favicon-150x150.png" />
  <meta name="msapplication-wide310x150logo" content="/assets/icons/favicon-310x150.png" />
  <meta name="msapplication-square310x310logo" content="/assets/icons/favicon-310x310.png" />
  <meta name="msapplication-TileColor" content="#000" />

  <!-- safari -->
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="apple-mobile-web-app-status-bar-style" content="#000" />
  <meta name="apple-mobile-web-app-title" content="site name" />

  <!-- Chrome, Firefox OS and Opera for Android -->
  <meta name="theme-color" content="#008CBA" />

  <!-- others -->
  <link rel="icon" href="favicon.ico" />
  <link rel="apple-touch-icon" type="image/png" href="/assets/icons/favicon-180x180.png">
  <link rel="icon" type="image/png" href="/assets/icons/favicon-192x192.png">

  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-xxxxxxxx-x"></script>
  <script>
  window.dataLayer = window.dataLayer || [];

  function gtag() {
    dataLayer.push(arguments);
  }
  gtag('js', new Date());

  gtag('config', 'UA-xxxxxxxx-x');
  </script>

  <!-- GTA (there is one more tag. check first body tag) -->
  <script>
  (function(w, d, s, l, i) {
    w[l] = w[l] || [];
    w[l].push({
      'gtm.start': new Date().getTime(),
      event: 'gtm.js'
    });
    var f = d.getElementsByTagName(s)[0],
      j = d.createElement(s),
      dl = l != 'dataLayer' ? '&l=' + l : '';
    j.async = true;
    j.src =
      'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
    f.parentNode.insertBefore(j, f);
  })(window, document, 'script', 'dataLayer', 'GTM-xxxxxx');
  </script>

  <link rel="manifest" href="/manifest.json" />
  <link rel="stylesheet" href="/assets/css/style.css" />