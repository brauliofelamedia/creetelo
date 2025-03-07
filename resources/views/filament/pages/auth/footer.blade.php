<div class="mt-4">
    <div class="relative">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-300 dark:border-gray-700"></div>
        </div>
        <div class="relative flex justify-center text-sm">
            <span class="bg-white dark:bg-gray-900 px-2 text-gray-500 dark:text-gray-400">
                {{ __('O accede con') }}
            </span>
        </div>
    </div>

    <div class="mt-6 grid grid-cols-2 gap-3">
        <a href="{{ route('auth.google') }}" class="flex w-full items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">
            <svg class="h-5 w-5 mr-2" viewBox="0 0 24 24" fill="none">
                <path d="M23.766 12.2764C23.766 11.4607 23.6999 10.6406 23.5588 9.83807H12.24V14.4591H18.7217C18.4528 15.9494 17.5885 17.2678 16.323 18.1056V21.1039H20.19C22.4608 19.0139 23.766 15.9274 23.766 12.2764Z" fill="#4285F4"/>
                <path d="M12.2401 24.0008C15.4766 24.0008 18.2059 22.9382 20.1945 21.1039L16.3276 18.1055C15.2517 18.8375 13.8627 19.252 12.2445 19.252C9.11388 19.252 6.45946 17.1399 5.50705 14.3003H1.5166V17.3912C3.55371 21.4434 7.7029 24.0008 12.2401 24.0008Z" fill="#34A853"/>
                <path d="M5.50253 14.3002C4.99987 12.81 4.99987 11.1975 5.50253 9.70727V6.61621H1.51649C-0.18551 10.0047 -0.18551 14.0028 1.51649 17.3912L5.50253 14.3002Z" fill="#FBBC04"/>
                <path d="M12.2401 4.74966C13.9509 4.7232 15.6044 5.36697 16.8434 6.54867L20.2695 3.12262C18.1001 1.0855 15.2208 -0.034466 12.2401 0.000808666C7.7029 0.000808666 3.55371 2.55822 1.5166 6.61621L5.50264 9.70727C6.45064 6.86775 9.10947 4.74966 12.2401 4.74966Z" fill="#EA4335"/>
            </svg>
            Google
        </a>

        <a href="{{ route('filament.admin.auth.magic-link-request') }}" class="flex w-full items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">
            <svg class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
            </svg>
            Magic Link
        </a>
    </div>
</div>