<!-- Header on Border -->
<div class="h-32"></div>
<div class="container px-4 mx-auto">
    <div class="p-8 mb-20 mx-auto ring-4 ring-blue-700">
        <div class="block w-[200px] text-6xl text-gray-700 text-center bg-white mt-[-75px]">Lorem</div>
        <div class="p-8">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor, quia?</div>
    </div>
</div>
<!-- Tabs -->
<div class="container px-4 mb-20 mx-auto" x-data="{ tab: '1' }">
    <div class="grid grid-cols-12">
        <div class="col-span-3 xl:col-span-1 font-bold text-xl text-white bg-red-700 p-8 cursor-pointer" x-on:click="tab = '1'">
            Lorem
        </div>
        <div class="col-span-3 xl:col-span-1 font-bold text-xl text-white bg-green-700 p-8 cursor-pointer" x-on:click="tab = '2'">
            Ipsum
        </div>
        <div class="col-span-3 xl:col-span-1 font-bold text-xl text-white bg-blue-700 p-8 cursor-pointer" x-on:click="tab = '3'">
            Dolor
        </div>
        <div class="col-span-3 xl:col-span-1 font-bold text-xl text-white bg-purple-700 p-8 cursor-pointer" x-on:click="tab = '4'">
            Sit
        </div>
    </div>
    <div class="relative h-[200px]">
        <div class="h-full w-full p-8 bg-red-700 opacity-0 transition-all duration-300 absolute inset-0" x-bind:class="{'opacity-100' : tab == 1}">
            <div class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor, tenetur.</div>
        </div>
        <div class="h-full w-full p-8 bg-green-700 opacity-0 transition-all duration-300 absolute inset-0" x-bind:class="{'opacity-100' : tab == 2}">
            <div class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum, iure.</div>
        </div>
        <div class="h-full w-full p-8 bg-blue-700 opacity-0 transition-all duration-300 absolute inset-0" x-bind:class="{'opacity-100' : tab == 3}">
            <div class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, voluptate.</div>
        </div>
        <div class="h-full w-full p-8 bg-purple-700 opacity-0 transition-all duration-300 absolute inset-0" x-bind:class="{'opacity-100' : tab == 4}">
            <div class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, atque.</div>
        </div>
    </div>
</div>
<!-- Accordion-->
<div class="container px-4 mb-20 mx-auto">
    <ul x-data="{ tab : null }">
        <li>
            <div class="font-bold text-xl text-white bg-red-700 p-8 cursor-pointer" x-on:click="tab !== 1 ? tab = 1 : tab = null">
                Lorem
            </div>
            <div class="relative overflow-hidden bg-red-500 transition-all duration-300" x-ref="tab1" x-bind:style="tab == 1 ? 'max-height: ' + $refs.tab1.scrollHeight + 'px' : 'max-height: 0px'">
                <div class="p-8 text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem, unde!</div>
            </div>
        </li>
        <li>
            <div class="font-bold text-xl text-white bg-green-700 p-8 cursor-pointer" x-on:click="tab !== 2 ? tab = 2 : tab = null">
                Ipsum
            </div>
            <div class="relative overflow-hidden bg-green-500 transition-all duration-300" x-ref="tab2" x-bind:style="tab == 2 ? 'max-height: ' + $refs.tab2.scrollHeight + 'px' : 'max-height: 0px'">
                <div class="p-8 text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis, natus?
                </div>
            </div>
        </li>
        <li>
            <div class="font-bold text-xl text-white bg-blue-700 p-8 cursor-pointer" x-on:click="tab !== 3 ? tab = 3 : tab = null">
                Dolor
            </div>
            <div class="relative overflow-hidden bg-blue-500 transition-all duration-300" x-ref="tab3" x-bind:style="tab == 3 ? 'max-height: ' + $refs.tab3.scrollHeight + 'px' : 'max-height: 0px'">
                <div class="p-8 text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus,
                    provident.
                </div>
            </div>
        </li>
        <li>
            <div class="font-bold text-xl text-white bg-purple-700 p-8 cursor-pointer" x-on:click="tab !== 4 ? tab = 4 : tab = null">
                Sit
            </div>
            <div class="relative overflow-hidden bg-purple-500 transition-all duration-300" x-ref="tab4" x-bind:style="tab == 4 ? 'max-height: ' + $refs.tab3.scrollHeight + 'px' : 'max-height: 0px'">
                <div class="p-8 text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus,
                    nemo!
                </div>
            </div>
        </li>
    </ul>
</div>
<div class="container px-4 mb-20 mx-auto">
    <div class="relative" x-data="{ tooltip_coffee: false, tooltip_keyboard: false }">
        <img loading="lazy" src="<?php echo get_stylesheet_directory_uri(); ?>/public/imgs/admin-bg.jpg" alt="">
        <div class="h-[50px] w-[150px] text-center bg-white py-2 px-4 border-2 border-black rounded-lg absolute top-[50%] left-[20%] transform -translate-y-full translate-x-8"
             x-show="tooltip_coffee"
             x-transition:enter="transition-all ease-linear duration-300"
             x-transition:enter-start="scale-y-0"
             x-transition:enter-end="scale-y-100"
             x-transition:leave="transition-all ease-linear duration-300"
             x-transition:leave-start="scale-y-100"
             x-transition:leave-end="scale-y-0">
            C for coffee.
        </div>
        <div class="flex items-center justify-center h-4 w-4 text-white bg-red-700 p-4 border-2 border-black rounded-full cursor-pointer absolute top-[50%] left-[20%] transition-all duration-300 transform hover:rotate-45"
             x-on:mouseover="tooltip_coffee = true"
             x-on:mouseleave="tooltip_coffee = false">
            C
        </div>
        <div class="h-[50px] w-[150px] text-center bg-white py-2 px-4 border-2 border-black rounded-lg absolute top-[70%] left-[65%] transform -translate-y-full translate-x-[calc(-100%)]"
             x-show="tooltip_keyboard"
             x-transition:enter="transition-all ease-linear duration-300"
             x-transition:enter-start="scale-y-0"
             x-transition:enter-end="scale-y-100"
             x-transition:leave="transition-all ease-linear duration-300"
             x-transition:leave-start="scale-y-100"
             x-transition:leave-end="scale-y-0">
            K for keyboard.
        </div>
        <div class="flex items-center justify-center h-4 w-4 text-white bg-red-700 border-2 border-black p-4 rounded-full cursor-pointer absolute top-[70%] left-[65%] transition-all duration-300 transform hover:rotate-45"
             x-on:mouseover="tooltip_keyboard = true"
             x-on:mouseleave="tooltip_keyboard = false">
            K
        </div>
    </div>
</div>
<div class="container px-4 mb-20 mx-auto">
    <div class="h-[580px] w-[350px] shadow-xl relative z-0">
        <img class="object-cover object-center h-full w-full" loading="lazy" src="https://picsum.photos/1920/1080" alt="">
        <div class="h-[90px] w-full border-t-[1px] border-black flex items-start justify-end absolute z-10 top-[15%] right-[-70%]">
            <div class="w-[50%] bg-white p-4 mt-[-30px]">
                <div class="font-bold">Lorem ipsum dolor.</div>
                <small>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque, vitae!</small>
            </div>
        </div>
        <div class="h-[90px] w-full border-t-[1px] border-black flex items-start justify-end absolute z-10 top-[50%] right-[-70%]">
            <div class="w-[50%] bg-white p-4 mt-[-30px]">
                <div class="font-bold">Lorem ipsum dolor.</div>
                <small>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque, vitae!</small>
            </div>
        </div>
        <div class="h-[90px] w-full border-t-[1px] border-black flex items-start justify-end absolute z-10 top-[85%] right-[-70%]">
            <div class="w-[50%] bg-white p-4 mt-[-30px]">
                <div class="font-bold">Lorem ipsum dolor.</div>
                <small>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque, vitae!</small>
            </div>
        </div>
    </div>
</div>
<div class="container h-[300px] bg-gray-700 bg-opacity-5 px-4 mb-20 mx-auto relative">
    <div class="inline-block border-t-[1px] border-black absolute top-0 left-0 transform translate-x-[-100%] origin-top-right -rotate-90">
        <div class="bg-white px-[15px] mt-[-12px] ml-[100px]">Lorem ipsum dolor</div>
    </div>
    <div class="inline-block border-t-[1px] border-black absolute top-0 right-0 transform translate-x-[100%] origin-top-left rotate-90">
        <div class="bg-white px-[15px] mt-[-12px] ml-[100px]">Lorem ipsum dolor</div>
    </div>
</div>
<div class="relative mb-20">
    <div class="container px-4 mx-auto">
        <img class="object-cover object-center w-full h-[300px]" src="https://picsum.photos/1920/1080" alt="" loading="lazy">
        <div class="absolute bg-gray-500 w-[600px] p-8 mt-16 top-0 left-0">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus aperiam architecto culpa error esse et eveniet excepturi nihil soluta sunt?</p>
        </div>
    </div>
</div>
<div class="container px-4 mb-20 mx-auto">
    <div class="relative py-[100px]">
        <img class="object-cover object-center w-[800px] h-full absolute z-[-1] top-0 right-0" src="https://picsum.photos/1920/1080" alt="">
        <div class="bg-gray-500 w-[800px] p-8">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus aperiam architecto culpa error esse et eveniet excepturi nihil soluta sunt?</p>
        </div>
    </div>
</div>
<div class="container px-4 mb-20 mx-auto">
    <div class="relative py-[100px] mt-[-25px]">
        <img class="object-cover object-center shadow-xl w-[960px] h-full absolute z-[-1] top-0 bottom-0 right-0" loading="lazy" src="https://picsum.photos/1920/1080">
        <div class="bg-gray-500 shadow-xl w-[600px] p-8 mr-auto">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus aperiam architecto culpa error esse et eveniet excepturi nihil soluta sunt?</p>
        </div>
    </div>
    <div class="relative py-[100px] mt-[-25px]">
        <img class="object-cover object-center shadow-xl w-[960px] h-full absolute z-[-1] top-0 bottom-0 left-0" loading="lazy" src="https://picsum.photos/1920/1080">
        <div class="bg-gray-500 shadow-xl w-[600px] p-8 ml-auto">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus aperiam architecto culpa error esse et eveniet excepturi nihil soluta sunt?</p>
        </div>
    </div>
</div>
<div class="bg-black pb-[100px]">
    <div class="container px-4 mx-auto">
        <div class="flex justify-center shadow-xl py-[100px] relative top-[-25px]">
            <img class="object-cover object-center w-full h-full absolute inset-0" loading="lazy" src="https://picsum.photos/1920/1080">
            <div class="inline-flex flex-col items-center justify-center mx-[30px] bg-gray-500 p-[30px] p-[50px] relative">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus aperiam architecto culpa error esse et eveniet excepturi nihil soluta sunt?</p>
            </div>
        </div>
    </div>
</div>
