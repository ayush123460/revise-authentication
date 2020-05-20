<div class="bg-gray-800 py-4 px-4 w-64">

    @if(auth()->user()->role == 'admin')

    <a class="nav {{ request()->routeIs('dashboard.home') ? 'active' : '' }}" href="{{ route('dashboard.home') }}">
        <svg class="h-6 w-8" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
            <path fill="currentColor" d="M9.484 15.696l-.711-.696-2.552 2.607-1.539-1.452-.698.709 2.25 2.136 3.25-3.304zm0-5l-.711-.696-2.552 2.607-1.539-1.452-.698.709 2.25 2.136 3.25-3.304zm0-5l-.711-.696-2.552 2.607-1.539-1.452-.698.709 2.25 2.136 3.25-3.304zm10.516 11.304h-8v1h8v-1zm0-5h-8v1h8v-1zm0-5h-8v1h8v-1zm4-5h-24v20h24v-20zm-1 19h-22v-18h22v18z"/>
        </svg>
        <span class="ml-2">Home</span>
    </a>

    <a class="nav {{ request()->routeIs('dashboard.admin*') ? 'active' : '' }}" href="{{ route('dashboard.admin') }}">
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path fill="currentColor" d="M23 17h-22v7h22v-7zm-20 5l.863-3h1.275l-.863 3h-1.275zm2.066 0l.863-3h1.275l-.863 3h-1.275zm2.067 0l.863-3h1.275l-.864 3h-1.274zm2.066 0l.863-3h1.274l-.863 3h-1.274zm3.341 0h-1.274l.863-3h1.275l-.864 3zm7.46-.5c-.552 0-1-.448-1-1s.448-1 1-1c.553 0 1 .448 1 1s-.447 1-1 1zm1-19.5v11h-18v-11h18zm2-2h-22v15h22v-15zm-13 7.5l-2.563-2.5-.771.751 1.794 1.749-1.794 1.749.771.751 2.563-2.5zm7 1.5h-5v1h5v-1z"/>
        </svg>
        <span class="ml-2">Administrators</span>
    </a>

    <a href="{{ route('dashboard.teacher') }}" class="nav {{ request()->routeIs('dashboard.teacher*') ? 'active' : '' }}">
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
            <path fill="currentColor" d="M24 17.99l-7.731-.001 2.731 4h-1.311l-2.736-4h-1.953l-2.736 4h-1.264l2.732-4h-2.95v-1h8.218v-1h3v1h3v-14h-17v.447h-1v-1.447h19v16zm-17.241-9c.649 0 1.293-.213 1.692-.436.755-.42 2.695-1.643 3.485-2.124.215-.13.496-.082.654.114l.009.01c.164.205.145.5-.043.68l-3.371 3.214c-.521.498-.822 1.183-.853 1.902-.095 2.207-.261 6.912-.332 8.834-.016.45-.386.806-.836.806h-.001c-.444 0-.786-.348-.836-.788-.111-.982-.329-3.279-.427-4.212-.04-.384-.279-.613-.584-.614-.304-.002-.523.226-.548.608-.062.921-.266 3.249-.342 4.221-.034.441-.397.785-.84.785h-.001c-.452 0-.823-.356-.842-.809-.097-2.34-.369-8.963-.369-8.963l-1.287 2.331c-.14.254-.445.364-.715.26l-.001-.001c-.228-.088-.371-.305-.371-.54l.022-.157 1.244-4.393c.122-.43.515-.727.963-.727h4.53zm7.241 2h5v-1h-5v1zm0-2h7v-1h-7v1zm-8.626-5c1.241 0 2.25 1.008 2.25 2.25s-1.009 2.25-2.25 2.25c-1.242 0-2.25-1.008-2.25-2.25s1.008-2.25 2.25-2.25zm8.626 3h7v-1h-7v1z"/>
        </svg>
        <span class="ml-2">Teachers</span>
    </a>

    <a href="{{ route('dashboard.student') }}" class="nav {{ request()->routeIs('dashboard.student*') ? 'active' : '' }}">
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
            <path fill="currentColor" d="M24 21h-3l1-3h1l1 3zm-12.976-4.543l8.976-4.575v6.118c-1.007 2.041-5.607 3-8.5 3-3.175 0-7.389-.994-8.5-3v-6.614l8.024 5.071zm11.976.543h-1v-7.26l-10.923 5.568-11.077-7 12-5.308 11 6.231v7.769z"/>
        </svg>
        <span class="ml-2">Students</span>
    </a>

    @endif

    <a class="nav {{ request()->routeIs('dashboard.profile') ? 'active' : '' }}" href="{{ route('dashboard.profile') }}" class="nav">
        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path fill="currentColor" d="M12 2c2.757 0 5 2.243 5 5.001 0 2.756-2.243 5-5 5s-5-2.244-5-5c0-2.758 2.243-5.001 5-5.001zm0-2c-3.866 0-7 3.134-7 7.001 0 3.865 3.134 7 7 7s7-3.135 7-7c0-3.867-3.134-7.001-7-7.001zm6.369 13.353c-.497.498-1.057.931-1.658 1.302 2.872 1.874 4.378 5.083 4.972 7.346h-19.387c.572-2.29 2.058-5.503 4.973-7.358-.603-.374-1.162-.811-1.658-1.312-4.258 3.072-5.611 8.506-5.611 10.669h24c0-2.142-1.44-7.557-5.631-10.647z"/>
        </svg>
        <span class="ml-2">Your profile</span>
    </a>

    <a href="{{ route('logout') }}" class="nav">
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
            <path fill="currentColor" d="M11 21h8v-2l1-1v4h-9v2l-10-3v-18l10-3v2h9v5l-1-1v-3h-8v18zm10.053-9l-3.293-3.293.707-.707 4.5 4.5-4.5 4.5-.707-.707 3.293-3.293h-9.053v-1h9.053z"/>
        </svg>
        <span class="ml-2">Sign Out</span>
    </a>

</div>