<!-- Header Menu -->
<div id="header" class="w-full py-2 fixed z-20 transition-all duration-300" x-data="{ sidebarOpen: false }" @keydown.window.escape="sidebarOpen = false">
    <div class="flex items-center justify-between container px-4 mx-auto">
        <a class="text-white" href="/">Home</a>
        <div class="flex items-center gap-x-8">
            <a class="text-white" href="/how-to">How To</a>
            <a class="text-white" href="/mansory">Mansory</a>
            <a class="text-white" href="/carousels">Carousels</a>
            <a class="text-white" href="/contact">Contact</a>
            <div class="cursor-pointer"
                 @click.stop="sidebarOpen = true">
                <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </div>
        </div>
    </div>
    <div x-show="sidebarOpen" style="display: none;">
        <div class="flex fixed inset-0">
            <div class="fixed inset-0" @click="sidebarOpen = false"
                 x-show="sidebarOpen"
                 x-transition:enter="transition-opacity ease-linear duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-linear duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0">
                <div class="bg-gray-700 opacity-50 absolute inset-0"></div>
            </div>
            <div class="flex flex-col w-full max-w-xs bg-blue-700 relative"
                 x-show="sidebarOpen"
                 x-transition:enter="transition ease-in-out duration-300 transform"
                 x-transition:enter-start="-translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transition ease-in-out duration-300 transform"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="-translate-x-full">
                <div class="absolute top-4 right-4">
                    <div class="cursor-pointer"
                         @click.stop="sidebarOpen = false">
                        <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </div>
                </div>
                <div class="flex flex-col gap-y-8 overflow-y-auto h-full p-16">
                    <a class="text-2xl text-white" href="/">Home</a>
                    <a class="text-2xl text-white" href="/how-to">How To</a>
                    <a class="text-2xl text-white" href="/mansory">Mansory</a>
                    <a class="text-2xl text-white" href="/carousels">Carousels</a>
                    <a class="text-2xl text-white" href="/contact">Contact</a>
                    <a class="text-2xl text-white" href="/parallax-scrolltrigger">Parallax Scrolltrigger</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="h-[48px]"></div>
