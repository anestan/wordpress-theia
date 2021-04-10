<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php
if ( false ) {
?>
<div class="relative" x-data="loadingScreen()">
    <div class="h-screen w-screen bg-cover bg-center bg-no-repeat fixed z-50"
         style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/public/imgs/admin-bg.jpg);"
         x-show="showLoadingScreen"
         x-on:load.window.debounce.300="toggleLoadingScreen()"
         x-transition:enter="transition-opacity ease-linear duration-1000"
         x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-1000"
         x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

        <svg class="animate-spin h-16 w-16 absolute top-1/2 right-1/2 -translate-y-1/2 -translate-x-1/2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="gray" stroke-width="4"></circle>
            <path class="opacity-75" fill="blue" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    </div>
</div>
<script>
  function loadingScreen () {
    return {
      showLoadingScreen: true,
      toggleLoadingScreen () {
        this.showLoadingScreen = !this.showLoadingScreen;
      }
    };
  }
</script>
<?php
}
?>
