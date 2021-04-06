<!-- Tabs -->
<div class="container px-[15px] mb-[100px] mx-auto" x-data="{ tab: '1' }">
    <div class="grid grid-cols-12">
        <div class="col-span-3 xl:col-span-1 bg-red-500 p-[15px] cursor-pointer" x-on:click="tab = '1'">Tab #1</div>
        <div class="col-span-3 xl:col-span-1 bg-green-500 p-[15px] cursor-pointer" x-on:click="tab = '2'">Tab #2</div>
        <div class="col-span-3 xl:col-span-1 bg-blue-500 p-[15px] cursor-pointer" x-on:click="tab = '3'">Tab #3</div>
        <div class="col-span-3 xl:col-span-1 bg-purple-500 p-[15px] cursor-pointer" x-on:click="tab = '4'">Tab #4</div>
    </div>
    <div class="relative h-[300px]">
        <div class="h-full w-full p-[15px] bg-red-400 opacity-0 transition-all duration-300 absolute inset-0"
             x-bind:class="{'opacity-100' : tab == 1}">
            Content #1
        </div>
        <div class="h-full w-full p-[15px] bg-green-400 opacity-0 transition-all duration-300 absolute inset-0"
             x-bind:class="{'opacity-100' : tab == 2}">
            Content #2
        </div>
        <div class="h-full w-full p-[15px] bg-blue-400 opacity-0 transition-all duration-300 absolute inset-0"
             x-bind:class="{'opacity-100' : tab == 3}">
            Content #3
        </div>
        <div class="h-full w-full p-[15px] bg-purple-400 opacity-0 transition-all duration-300 absolute inset-0"
             x-bind:class="{'opacity-100' : tab == 4}">
            Content #4
        </div>
    </div>
</div>
<!-- Accordion-->
<div class="container px-[15px] mb-[100px] mx-auto">
    <ul x-data="{ tab : null }">
        <li class="bg-red-500">
            <div class="p-[15px] cursor-pointer" x-on:click="tab !== 1 ? tab = 1 : tab = null">Tab #1</div>
            <div class="relative overflow-hidden bg-red-400 transition-all duration-300" x-ref="tab1" x-bind:style="tab == 1 ? 'max-height: ' + $refs.tab1.scrollHeight + 'px' : 'max-height: 0px'">
                <div class="p-[15px]">Content #1</div>
            </div>
        </li>
        <li class="bg-green-500">
            <div class="p-[15px] cursor-pointer" x-on:click="tab !== 2 ? tab = 2 : tab = null">Tab #2</div>
            <div class="relative overflow-hidden bg-green-400 transition-all duration-300" x-ref="tab2" x-bind:style="tab == 2 ? 'max-height: ' + $refs.tab2.scrollHeight + 'px' : 'max-height: 0px'">
                <div class="p-[15px]">Content #2</div>
            </div>
        </li>
        <li class="bg-blue-500">
            <div class="p-[15px] cursor-pointer" x-on:click="tab !== 3 ? tab = 3 : tab = null">Tab #3</div>
            <div class="relative overflow-hidden bg-blue-400 transition-all duration-300" x-ref="tab3" x-bind:style="tab == 3 ? 'max-height: ' + $refs.tab3.scrollHeight + 'px' : 'max-height: 0px'">
                <div class="p-[15px]">Content #3</div>
            </div>
        </li>
        <li class="bg-purple-500">
            <div class="p-[15px] cursor-pointer" x-on:click="tab !== 4 ? tab = 4 : tab = null">Tab #4</div>
            <div class="relative overflow-hidden bg-purple-400 transition-all duration-300" x-ref="tab4" x-bind:style="tab == 4 ? 'max-height: ' + $refs.tab3.scrollHeight + 'px' : 'max-height: 0px'">
                <div class="p-[15px]">Content #3</div>
            </div>
        </li>
    </ul>
</div>
<!-- Header on Border -->
<div class="container p-[50px] border-[5px] border-gray-500 mb-[100px] mx-auto">
    <div class="block w-[200px] text-[50px] text-blue-500 text-center bg-white mt-[-90px]">Lorem</div>
    <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</div>
</div>
