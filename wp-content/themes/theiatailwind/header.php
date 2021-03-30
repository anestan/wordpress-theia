<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
    <script>
      var onloadCallback = () => {
        grecaptcha.render('recaptcha', {
          'sitekey': window.wp_obj.google_recaptcha_site_key
        });
      };
    </script>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="container mx-auto mb-[100px] px-[15px]">
    <p>Header</p>
</div>
