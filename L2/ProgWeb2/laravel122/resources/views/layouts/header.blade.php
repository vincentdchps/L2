<div class="bg-base-100 border-base-content/20 lg:ps-75 sticky top-0 z-50 flex border-b">
    <div class="mx-auto w-full max-w-7xl">
        <nav class="navbar py-2">
            <div class="navbar-start items-center gap-2">
                <button type="button" class="btn btn-soft btn-square btn-sm lg:hidden" aria-haspopup="dialog"
                    aria-expanded="false" aria-controls="layout-sidebar" data-overlay="#layout-sidebar">
                    <span class="icon-[tabler--menu-2] size-4.5"></span>
                </button>
            </div>

            <div class="navbar-end items-end gap-6">
                <!-- Profile Dropdown -->
                <div class="dropdown relative inline-flex [--offset:21]">
                    <button id="profile-dropdown" type="button" class="dropdown-toggle avatar" aria-haspopup="menu"
                        aria-expanded="false" aria-label="Dropdown">
                        <span class="rounded-field size-9.5">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=random"
                                alt="User Avatar" />
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-open:opacity-100 max-w-75 hidden w-full space-y-0.5" role="menu"
                        aria-orientation="vertical" aria-labelledby="profile-dropdown">
                        <li class="dropdown-header pt-4.5 mb-1 gap-4 px-5 pb-3.5">
                            <div class="avatar avatar-online-top">
                                <div class="w-10 rounded-full">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=random"
                                        alt="avatar" />
                                </div>
                            </div>
                            <div>
                                <h6 class="text-base-content mb-0.5 font-semibold">{{ auth()->user()->name }}</h6>
                                <p class="text-base-content/80 font-medium">{{ auth()->user()->email }}</p>
                            </div>
                        </li>
                        <li>
                            <a class="dropdown-item px-3" href="{{ route('settings.profile.edit') }}">
                                <span class="icon-[tabler--user] size-5"></span>
                                Edit profile
                            </a>
                        </li>
                        <li class="dropdown-footer p-2 pt-1">
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit"
                                    class="btn btn-text btn-error btn-block h-11 justify-start px-3 font-normal">
                                    <span class="icon-[tabler--logout] size-5"></span>
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
