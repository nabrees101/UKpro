<div style="display: flex; gap: 1rem; align-items: center;">
    @auth
        <li style="list-style: none;">
            <a
                href="{{ url('/dashboard') }}"
                class="m-1 rounded-md bg-blue-500 px-3 py-2 text-white ring-1 ring-transparent transition hover:bg-blue-700 focus:outline-none focus-visible:ring-[#FF2D20] dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus-visible:ring-white"
            >
                Dashboard
            </a>
        </li>
    @else
        <li style="list-style: none;">
            <a
                href="{{ route('login') }}"
                class="m-1 rounded-md bg-blue-500 px-3 py-2 text-white ring-1 ring-transparent transition hover:bg-blue-700 focus:outline-none focus-visible:ring-[#FF2D20] dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus-visible:ring-white"
            >
                Log in
            </a>
        </li>

        @if (Route::has('register'))
            <li style="list-style: none;">
                <a
                    href="{{ route('register') }}"
                    class="m-1 rounded-md bg-blue-500 px-3 py-2 text-white ring-1 ring-transparent transition hover:bg-blue-700 focus:outline-none focus-visible:ring-[#FF2D20] dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus-visible:ring-white"
                >
                    Register
                </a>
            </li>
        @endif
    @endauth
</div>
