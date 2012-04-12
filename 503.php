<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">

  <title><?php bloginfo('name'); ?></title>

  <!-- Mobile viewport optimized: h5bp.com/viewport -->
  <meta name="viewport" content="width=device-width">
  <link href='http://fonts.googleapis.com/css?family=Lato:300,700' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Crete+Round' rel='stylesheet'> 
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
</head>
<body>
  <header role="banner">
      <h1><a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/ph2logo.png" title="<?php bloginfo('name'); ?>" /></a></h1>

  </header>
  <div role="main">
    <?php 
      // Echo Maintenance Mode plugin content.
      echo $this->mamo_template_tag_message(); ?>		
  </div>
</body>
</html>
