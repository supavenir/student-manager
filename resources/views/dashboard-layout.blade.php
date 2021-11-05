<x-app-layout>
    <body class="h-screen overflow-hidden flex items-center justify-center" style="background: #edf2f7;">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Dashboard</title>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
              rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
              rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
              rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    </head>
    <body >
    <div class="flex h-screen w-full bg-gray-800 " x-data="{openMenu:1}">
        <!--Start SideBar-->
        <aside class="w-20 relative z-20 flex-shrink-0  px-2 overflow-y-auto bg-indigo-600 sm:block">
            <div class="mb-6">
                <!--Start logo -->
                <div class="flex justify-center">
                    <div class="w-14 h-14 rounded-full bg-gray-300 border-2 border-white mt-2">
                        <img
                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQVxhAxJ4D7MOeTTj6kR9PBeZonW5HM7giKjTbEmR-HMBwf3G1VqGnlwpO1kWrdyIZu8_U&usqp=CAU"
                            class="rounded-full w-auto"
                        />
                    </div>
                </div>
                <!--End logo -->
                <!--Start NavItem -->
                <div>
                    <ul class="mt-6 leading-10 px-4">
                        <li class="mb-3 p-2 rounded-md flex items-center justify-center bg-blue-400 cursor-pointer"
                            @click="openMenu !== 1 ? openMenu = 1 : openMenu = null"
                        >
                            <i class="fas fa-align-left fa-sm text-white"></i>
                        </li>
                        {{-- <li class="mb-3 p-2 rounded-md flex items-center justify-center bg-pink-400 cursor-pointer">
                            <i class="fas fa-question-circle fa-sm text-white"></i>
                        </li>
                        <li class="mb-3 p-2 rounded-md flex items-center justify-center bg-yellow-400 cursor-pointer">
                            <i class="fas fa-headphones fa-sm text-white"></i>
                        </li> --}}
                        <li class="absolute bottom-0 mb-3 p-2 rounded-full flex items-center mx-auto bg-white cursor-pointer" 
                        onclick="document.getElementById('logout-form').submit()">
                            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                @csrf
                                <button class="fas fa-power-off fa-sm text-indigo-600" type="submit">
                            </form>
                        </li>
                    </ul>
                </div>
                <!--End NavItem -->
            </div>
        </aside>
        <!-- Start Open Menu -->
        <aside class="animate__animated animate__fadeInLeft w-52 relative z-0 flex-shrink-0 hidden px-4 overflow-y-auto bg-gray-100 sm:block "
               x-show="openMenu ==  1"
               @click.away="openMenu = null"
               style="display: none;">
            <div class="mb-6">
                <!--Start Sidebar for open menu -->
                <div class="grid grid-cols-1 gap-4 grid-cols-1 mt-6">
                    <!-- Start Navitem -->
                    <a href="{{route('dashboard')}}" class="">
                        <div class="p-2 flex flex-col items-center bg-white rounded-md justify-center shadow-xl cursor-pointer">
                            <div class="rounded-full p-2 bg-indigo-200 flex flex-col items-center">
                                <i class="fas fa-home fa-sm text-indigo-600"></i>
                            </div>
                            <p class="text-xs mt-1 text-center font-semibold">Accueil</p>
                        </div>
                    </a>
                    <!-- End Navitem -->
                    <!-- Start Navitem -->
                    <a href="{{route('etudiants')}}">
                        <div class="p-2 flex flex-col items-center bg-white rounded-md justify-center shadow-xl cursor-pointer">
                            <div class="rounded-full p-2 bg-indigo-200 flex flex-col items-center">
                                <i class="fas fa-users fa-sm text-indigo-600"></i>
                            </div>
                            <p class="text-xs mt-1 text-center font-semibold">Etudiants</p>
                        </div>
                    </a>
                    <a href="{{route('chatify')}}">
                        <div class="p-2 flex flex-col items-center bg-white rounded-md justify-center shadow-xl cursor-pointer">
                            <div class="rounded-full p-2 bg-indigo-200 flex flex-col items-center">
                                <i class="fas fa-comments fa-sm text-indigo-600"></i>
                            </div>
                            <p class="text-xs mt-1 text-center font-semibold">Messagerie</p>
                        </div>
                    </a>
                    <!-- End Navitem -->
                    <!-- Start Navitem -->
                    {{-- <div class="p-2 flex flex-col items-center bg-white rounded-md justify-center shadow-xl cursor-pointer">
                        <div class="rounded-full p-2 bg-indigo-200 flex flex-col items-center">
                            <i class="fas fa-wallet fa-sm text-indigo-600"></i>
                        </div>
                        <p class="text-xs mt-1 text-center font-semibold">Wallet</p>
                    </div>
                    <!-- End Navitem -->
                    <!-- Start Navitem -->
                    <div class="p-2 flex flex-col items-center bg-white rounded-md justify-center shadow-xl cursor-pointer">
                        <div class="rounded-full p-2 bg-indigo-200 flex flex-col items-center">
                            <i class="fas fa-archive fa-sm text-indigo-600"></i>
                        </div>
                        <p class="text-xs mt-1 text-center font-semibold">Saving</p>
                    </div>
                    <!-- End Navitem -->
                    <!-- Start Navitem -->
                    <div class="p-2 flex flex-col items-center bg-white rounded-md justify-center shadow-xl cursor-pointer">
                        <div class="rounded-full p-2 bg-indigo-200 flex flex-col items-center">
                            <i class="fas fa-money-bill-wave-alt fa-sm text-indigo-600"></i>
                        </div>
                        <p class="text-xs mt-1 text-center font-semibold">Currencies</p>
                    </div>
                    <!-- End Navitem -->
                    <!-- Start Navitem -->
                    <div class="p-2 flex flex-col items-center bg-white rounded-md justify-center shadow-xl cursor-pointer">
                        <div class="rounded-full p-2 bg-indigo-200 flex flex-col items-center">
                            <i class="fas fa-shopping-basket fa-sm text-indigo-600"></i>
                        </div>
                        <p class="text-xs mt-1 text-center font-semibold">Expenses</p>
                    </div> --}}
                    <!-- End Navitem -->
                </div>
                <!--End Sidebar for open menu -->
            </div>
        </aside>
        <!-- End Open Menu -->

        <!-- End Sidebar -->
        <div class="flex flex-col flex-1 w-full overflow-y-auto">
            <!--Start Topbar -->
            <!--End Topbar -->
            <main class="relative z-0 flex-1 pb-8 px-6 bg-white">
                @yield('content')
            </main>
        </div>
    </div>
    </body>
    </body>

</x-app-layout>
