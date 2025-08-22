 <!-- Header -->
            <header class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700 px-4 lg:px-6 py-4 transition-colors duration-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <!-- Mobile menu button -->
                        <button id="mobile-menu-button" class="lg:hidden p-2 text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                            <i data-lucide="menu" class="w-5 h-5"></i>
                        </button>
                        
                    </div>
                    <div class="flex items-center space-x-2 lg:space-x-4">
                        <!-- Theme Toggle -->
                        <button id="theme-toggle" class="p-2 text-gray-400 hover:text-gray-600 dark:text-gray-300 dark:hover:text-white rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                            <i data-lucide="sun" class="w-5 h-5 hidden dark:block"></i>
                            <i data-lucide="moon" class="w-5 h-5 block dark:hidden"></i>
                        </button>
                        
                        <div class="relative hidden sm:block">
                            <input type="text" placeholder="Buscar..." 
                                   class="w-32 lg:w-64 pl-8 lg:pl-10 pr-4 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            <i data-lucide="search" class="w-4 h-4 text-gray-400 absolute left-2 lg:left-3 top-1/2 transform -translate-y-1/2"></i>
                        </div>
                        <button class="p-2 text-gray-400 hover:text-gray-600 dark:text-gray-300 dark:hover:text-white relative">
                            <i data-lucide="bell" class="w-5 h-5"></i>
                            <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full"></span>
                        </button>
                        <!-- Mobile search button -->
                        <button class="sm:hidden p-2 text-gray-400 hover:text-gray-600 dark:text-gray-300 dark:hover:text-white">
                            <i data-lucide="search" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>
            </header>