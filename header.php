<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">

  <title><?php bloginfo('site_title'); ?></title>

  <!-- Mobile viewport optimized: h5bp.com/viewport -->
  <meta name="viewport" content="width=device-width">
  <link href='http://fonts.googleapis.com/css?family=Lato:300,700|Crete+Round' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
    <!-- Modernizr and Friends -->
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/javascripts/modernizr.min.js"></script>
    <script>
      Modernizr.load([
        {
          test: Modernizr.mq(),
          nope: ['<?php echo get_stylesheet_directory_uri(); ?>/javascripts/respond.min.js',
          '<?php echo get_stylesheet_directory_uri(); ?>/javascripts/selectivizr.min.js']
        }
      ]);
    </script>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->
  <header role="banner">
      <h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('site_title'); ?></a></h1>
<?php wp_nav_menu( array( 'theme_location' => 'footer_additional', 'depth' => 1, 'container_class' => 'additional', 'menu_class' => 'additional'  ) ); ?>
  </header>
  <div role="main">
