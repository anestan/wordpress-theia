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
<!-- Header -->
<div id="header" class="w-full py-[15px] fixed z-10 transition-all duration-300"
     x-data="{ sidebarOpen: false }"
     @keydown.window.escape="sidebarOpen = false">
    <div class="flex items-center justify-between container px-[15px] mx-auto">
        <a class="text-[20px] text-white" href="#">Home</a>
        <div class="flex items-center gap-x-[30px]">
            <a class="text-[20px] text-white" href="#">Services</a>
            <a class="text-[20px] text-white" href="#">About</a>
            <a class="text-[20px] text-white" href="#">Contact</a>
            <div class="cursor-pointer"
                 @click.stop="sidebarOpen = true">
                <svg class="h-[40px] w-[40px] text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </div>
        </div>
    </div>
    <div x-show="sidebarOpen"
         style="display: none;">
        <div class="flex fixed inset-0">
            <div class="fixed inset-0" @click="sidebarOpen = false"
                 x-show="sidebarOpen"
                 x-transition:enter="transition-opacity ease-linear duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-linear duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0">
                <div class="bg-gray-500 opacity-75 absolute inset-0"></div>
            </div>
            <div class="flex flex-col w-full max-w-xs bg-blue-500 relative"
                 x-show="sidebarOpen"
                 x-transition:enter="transition ease-in-out duration-300 transform"
                 x-transition:enter-start="-translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transition ease-in-out duration-300 transform"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="-translate-x-full">
                <div class="absolute top-[15px] right-[15px]">
                    <div class="cursor-pointer"
                         @click.stop="sidebarOpen = false">
                        <svg class="h-[40px] w-[40px] text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </div>
                </div>
                <div class="flex flex-col gap-y-[30px] overflow-y-auto h-full p-[50px]">
                    <a class="text-[20px] text-white" href="#">Home</a>
                    <a class="text-[20px] text-white" href="#">Services</a>
                    <a class="text-[20px] text-white" href="#">About</a>
                    <a class="text-[20px] text-white" href="#">Contact</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="h-[70px]"></div>
