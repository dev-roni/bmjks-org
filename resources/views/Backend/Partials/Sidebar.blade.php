<aside class="admin-sidebar">
    <div class="admin-brand">
        <img src="{{asset('Frontend-Assets/images/header/logo.png')}}" alt="বামযুকস লোগো" class="brand-logo">
        <a href="{{ route('home') }}" target="_blank" style="text-decoration:none;">
            <span class="text-white">বামযুকস</span>
        </a>
    </div>
    @superadmin
    <nav class="admin-nav">
        <a class="sidebar-link {{ Route::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"><i class="fa-solid fa-gauge"></i><span class="sidebar-text">ড্যাশবোর্ড</span></a>
        <a class="sidebar-link {{ Route::is('notice.index') ? 'active' : '' }}" href="{{ route('notice.index') }}"><i class="fa-solid fa-bullhorn"></i><span class="sidebar-text">নোটিশ</span></a>

        <div class="sidebar-dropdown {{ Route::is('active.committee.list') || Route::is('deactive.committee.list') || Route::is('branch.committee.list') || Route::is('committee.create') ? 'open' : '' }}">
            <a href="#" class="sidebar-link sidebar-dropdown-toggle">
                <i class="fa-solid fa-sitemap"></i>
                <span class="sidebar-text">কমিটি ম্যানেজমেন্ট</span>
                <i class="fa-solid fa-chevron-down ms-auto"></i>
            </a>
            <div class="sidebar-submenu">
                <a class="sidebar-sublink {{ Route::is('active.committee.list') || Route::is('deactive.committee.list') || Route::is('branch.committee.list') ? 'active' : '' }}" href="{{ route('active.committee.list') }}">
                    <i class="fa-solid fa-diagram-project"></i>
                    <span class="sidebar-text">কমিটি তালিকা</span>
                </a>
                <a class="sidebar-sublink" href="{{ route('committee.create') }}">
                    <i class="fa-solid fa-plus"></i>
                    <span class="sidebar-text">কমিটি তৈরি</span>
                </a>
            </div>
        </div>
        <div
            class="sidebar-dropdown {{ Route::is('specific.category.person','1') || Route::is('specific.category.person','2') || Route::is('person.create') || Route::is('tag') || Route::is('person.search') || Route::is('search.result') || Route::is('person.edit.view') || Route::is('lifetime.member.padding.list') || Route::is('general.member.padding.list') ? 'open' : '' }}">
            <a href="#" class="sidebar-link sidebar-dropdown-toggle">
                <i class="fa-solid fa-users"></i>
                <span class="sidebar-text">সদস্য ম্যানেজমেন্ট</span>
                <i class="fa-solid fa-chevron-down ms-auto"></i>
            </a>
            <div class="sidebar-submenu">

                <a class="sidebar-sublink {{ request()->routeIs('person.search') || request()->routeIs('search.result') ? 'active' : '' }}" 
                href="{{ route('person.search') }}">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <span class="sidebar-text">ব্যাক্তি খুজুন</span>
                </a>

                <a class="sidebar-sublink {{ request()->routeIs('specific.category.person') && request()->route('personType') == 1 ? 'active' : '' }}" 
                href="{{ route('specific.category.person', 1) }}">
                    <i class="fa-solid fa-crown"></i>
                    <span class="sidebar-text">আজীবন সদস্য তালিকা</span>
                </a>

                <a class="sidebar-sublink {{ Route::is('lifetime.member.padding.list') ? 'active' : '' }}" 
                href="{{ route('lifetime.member.padding.list') }}">
                    <i class="fa-solid fa-user-check"></i>
                    <span class="sidebar-text">আঃ সদস্য অনুমোদন</span>
                </a>

                <a class="sidebar-sublink {{ request()->routeIs('specific.category.person') && request()->route('personType') == 2 ? 'active' : '' }}" 
                href="{{ route('specific.category.person', 2) }}">
                    <i class="fa-solid fa-user"></i>
                    <span class="sidebar-text">সাধারণ সদস্য তালিকা</span>
                </a>

                <a class="sidebar-sublink {{ Route::is('general.member.padding.list') ? 'active' : '' }}" 
                href="{{ route('general.member.padding.list') }}">
                    <i class="fa-solid fa-user-check"></i>
                    <span class="sidebar-text">সাঃ সদস্য অনুমোদন</span>
                </a>

                <a class="sidebar-sublink {{ Route::is('person.create') ? 'active' : '' }}" href="{{ route('person.create') }}">
                    <i class="fa-solid fa-user-plus"></i>
                    <span class="sidebar-text">সদস্য তৈরি</span>
                </a>
                <a class="sidebar-sublink {{ Route::is('tag') ? 'active' : '' }}" href="{{ route('tag') }}">
                    <i class="fa-solid fa-user-tie"></i> 
                    <span class="sidebar-text">সদস্য ক্যাটাগরি তৈরি</span>
                </a>
            </div>
        </div>

        <a class="sidebar-link {{ Route::is('users.manage') ? 'active' : '' }}" href="{{ route('users.manage') }}"><i class="fas fa-user-circle"></i><span class="sidebar-text">অ্যাকাউন্ট ম্যানেজমেন্ট</span></a>
        <a class="sidebar-link {{ Route::is('committeeActivities.index') ? 'active' : '' }}" href="{{ route('committeeActivities.index') }}"><i class="fas fa-calendar-check"></i><span class="sidebar-text">কমিটির কার্যক্রম</span></a>

        <div class="sidebar-dropdown {{ Route::is('finance.sheet') || Route::is('monthly.contribution.view') || Route::is('monthly.contribution.list') || Route::is('chada.settings.view') ? 'open' : '' }}">
            <a href="#" class="sidebar-link sidebar-dropdown-toggle">
                <i class="fa-solid fa-sack-dollar"></i>
                <span class="sidebar-text">আর্থিক ব্যবস্থাপনা</span>
                <i class="fa-solid fa-chevron-down ms-auto"></i>
            </a>

            <div class="sidebar-submenu">
                <a class="sidebar-sublink {{ Route::is('finance.sheet') ? 'active' : '' }}" href="{{ route('finance.sheet') }}">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                    <span class="sidebar-text">বাজেট প্রকাশ</span>
                </a>
                <a class="sidebar-sublink {{ Route::is('monthly.contribution.view') || Route::is('monthly.contribution.list') ? 'active' : '' }}" href="{{ route('monthly.contribution.view') }}">
                    <i class="fa-solid fa-hand-holding-dollar"></i>
                    <span class="sidebar-text">মাসিক চাঁদা</span>
                </a>
                 <a class="sidebar-sublink {{ Route::is('chada.settings.view') ? 'active' : '' }}" href="{{ route('chada.settings.view') }}">
                    <i class="fa-solid fa-gear"></i>
                    <span class="sidebar-text">মাসিক চাঁদা সেটিংস</span>
                </a>
            </div>
        </div>

         <div
            class="sidebar-dropdown {{Route::is('donation.create') || Route::is('donator.list') || Route::is('donation.event') || Route::is('donation.event.create') || Route::is('recent.donation') ? 'open' : '' }}">
            <a href="#" class="sidebar-link sidebar-dropdown-toggle">
                <i class="fa-solid fa-hand-holding-dollar"></i>
                <span class="sidebar-text">ডোনেশন ম্যানেজমেন্ট</span>
                <i class="fa-solid fa-chevron-down ms-auto"></i>
            </a>
            <div class="sidebar-submenu">

                <a class="sidebar-sublink {{ request()->routeIs('donation.create') ? 'active' : '' }}" href="{{ route('donation.create') }}">
                    <i class="fa-solid fa-money-bill-wave"></i>
                    <span class="sidebar-text">ডোনেশন তৈরি</span>
                </a>

                <a class="sidebar-sublink {{ request()->routeIs('recent.donation') ? 'active' : '' }}" href="{{ route('recent.donation') }}">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    <span class="sidebar-text">রিসেন্ট ডোনেশন</span>
                </a>

                <a class="sidebar-sublink {{ request()->routeIs('donation.event') ? 'active' : '' }}" href="{{ route('donation.event') }}">
                    <i class="fa-solid fa-coins"></i>
                    <span class="sidebar-text">ডোনেশন ইভেন্ট</span>
                </a>

                <a class="sidebar-sublink {{ request()->routeIs('donation.event.create') ? 'active' : '' }}" href="{{ route('donation.event.create') }}">
                    <i class="fa-solid fa-calendar-plus"></i>
                    <span class="sidebar-text">ডোনেশন ইভেন্ট তৈরি</span>
                </a>

                <a class="sidebar-sublink {{ Route::is('donator.list') ? 'active' : '' }}" href="{{ route('donator.list') }}">
                    <i class="fa-solid fa-list-ul"></i>
                    <span class="sidebar-text">ডোনেটর লিস্ট</span>
                </a>
            </div>
        </div>

        <a class="sidebar-link {{ Route::is('contact.unread') || Route::is('contact.read') ? 'active' : '' }}" href="{{ route('contact.unread') }}"><i class="fas fa-comments"></i><span class="sidebar-text">যোগাযোগ তথ্য</span></a>

        <div class="sidebar-dropdown {{ Route::is('services') || Route::is('president.create') || Route::is('site.settings') ? 'open' : '' }}">
            <a href="#" class="sidebar-link sidebar-dropdown-toggle">
                <i class="fa-solid fa-screwdriver-wrench"></i>
                <span class="sidebar-text">ওয়েব সাইট সেটিংস</span>
                <i class="fa-solid fa-chevron-down ms-auto"></i>
            </a>
            <div class="sidebar-submenu">
                <a class="sidebar-sublink {{ Route::is('services') ? 'active' : '' }}" href="{{ route('services') }}">
                    <i class="fa-solid fa-hand-holding-droplet"></i>
                    <span class="sidebar-text">সেবা</span>
                </a>

                <a class="sidebar-sublink {{ Route::is('president.create') ? 'active' : '' }}" href="{{ route('president.create') }}">
                    <i class="fas fa-user-tie"></i>
                    <span class="sidebar-text">সভাপতির বার্তা</span>
                </a>
                <a class="sidebar-sublink {{ Route::is('site.settings') ? 'active' : '' }}" href="{{ route('site.settings') }}">
                    <i class="fa-solid fa-gear"></i>
                    <span class="sidebar-text">সাইট সেটিং</span>
                </a>
            </div>
        </div>
    </nav>
    @endsuperadmin
    @admin
    <nav class="admin-nav">
        <a class="sidebar-link {{ Route::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"><i class="fa-solid fa-gauge"></i><span class="sidebar-text">ড্যাশবোর্ড</span></a>


        <a class="sidebar-link {{ Route::is('active.committee.list') || Route::is('deactive.committee.list') || Route::is('branch.committee.list') ? 'active' : '' }}" href="{{ route('active.committee.list') }}" href="{{ route('active.committee.list') }}"><i class="fa-solid fa-diagram-project"></i><span class="sidebar-text">কমিটি তালিকা</span></a>

        <div
            class="sidebar-dropdown {{Route::is('specific.category.person','1') || Route::is('specific.category.person','2') || Route::is('person.create') ||Route::is('tag') ||Route::is('person.search') ||Route::is('search.result') || Route::is('person.edit.view') || Route::is('general.member.padding.list') ? 'open' : '' }}">
            <a href="#" class="sidebar-link sidebar-dropdown-toggle">
                <i class="fa-solid fa-users"></i>
                <span class="sidebar-text">সদস্য ম্যানেজমেন্ট</span>
                <i class="fa-solid fa-chevron-down ms-auto"></i>
            </a>
            <div class="sidebar-submenu">

                <a class="sidebar-sublink {{ request()->routeIs('person.search') || request()->routeIs('search.result') ? 'active' : '' }}" 
                href="{{ route('person.search') }}">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <span class="sidebar-text">ব্যাক্তি খুজুন</span>
                </a>

                <a class="sidebar-sublink {{ request()->routeIs('specific.category.person') && request()->route('personType') == 1 ? 'active' : '' }}" 
                href="{{ route('specific.category.person', 1) }}">
                    <i class="fa-solid fa-crown"></i>
                    <span class="sidebar-text">আজীবন সদস্য</span>
                </a>

                <a class="sidebar-sublink {{ request()->routeIs('specific.category.person') && request()->route('personType') == 2 ? 'active' : '' }}" 
                href="{{ route('specific.category.person', 2) }}">
                    <i class="fa-solid fa-user"></i>
                    <span class="sidebar-text">সাধারণ সদস্য</span>
                </a>

                <a class="sidebar-sublink {{ Route::is('general.member.padding.list') ? 'active' : '' }}" 
                href="{{ route('general.member.padding.list') }}">
                    <i class="fa-solid fa-user-check"></i>
                    <span class="sidebar-text">সাঃ সদস্য অনুমোদন</span>
                </a>

                <a class="sidebar-sublink {{ Route::is('person.create') ? 'active' : '' }}" href="{{ route('person.create') }}">
                    <i class="fa-solid fa-user-plus"></i>
                    <span class="sidebar-text">সদস্য তৈরি</span>
                </a>
            </div>
        </div>

        <a class="sidebar-sublink {{ Route::is('monthly.contribution.view') || Route::is('monthly.contribution.list') ? 'active' : '' }}" href="{{ route('monthly.contribution.view') }}">
            <i class="fa-solid fa-hand-holding-dollar"></i>
            <span class="sidebar-text">মাসিক চাঁদা</span>
        </a>

        <a class="sidebar-link {{ Route::is('committeeActivities.index') ? 'active' : '' }}" href="{{ route('committeeActivities.index') }}"><i class="fas fa-calendar-check"></i><span class="sidebar-text">কমিটির কার্যক্রম</span></a>
            @if(in_array(Auth::user()->branch, ['1','100']))    <a class="sidebar-link {{ Route::is('contact.unread') || Route::is('contact.read') ? 'active' : '' }}" href="{{ route('contact.unread') }}"><i class="fas fa-comments"></i><span class="sidebar-text">যোগাযোগ তথ্য</span></a>@endif
    </nav>
    @endadmin
    @cashier
    <nav class="admin-nav">
        <a class="sidebar-link {{ Route::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"><i class="fa-solid fa-gauge"></i><span class="sidebar-text">ড্যাশবোর্ড</span></a>

        <div class="sidebar-dropdown {{ Route::is('finance.sheet') || Route::is('monthly.contribution.view') || Route::is('monthly.contribution.list') || Route::is('chada.settings.view') ? 'open' : '' }}">
            <a href="#" class="sidebar-link sidebar-dropdown-toggle">
                <i class="fa-solid fa-sack-dollar"></i>
                <span class="sidebar-text">আর্থিক ব্যবস্থাপনা</span>
                <i class="fa-solid fa-chevron-down ms-auto"></i>
            </a>

            <div class="sidebar-submenu">
                <a class="sidebar-sublink {{ Route::is('finance.sheet') ? 'active' : '' }}" href="{{ route('finance.sheet') }}">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                    <span class="sidebar-text">বাজেট প্রকাশ</span>
                </a>
                <a class="sidebar-sublink {{ Route::is('monthly.contribution.view') || Route::is('monthly.contribution.list') ? 'active' : '' }}" href="{{ route('monthly.contribution.view') }}">
                    <i class="fa-solid fa-hand-holding-dollar"></i>
                    <span class="sidebar-text">মাসিক চাঁদা</span>
                </a>
                 <a class="sidebar-sublink {{ Route::is('chada.settings.view') ? 'active' : '' }}" href="{{ route('chada.settings.view') }}">
                    <i class="fa-solid fa-gear"></i>
                    <span class="sidebar-text">মাসিক চাঁদা সেটিংস</span>
                </a>
            </div>
        </div>
        
        <div
            class="sidebar-dropdown {{Route::is('donation.create') || Route::is('donator.list') || Route::is('donation.event') || Route::is('donation.event.create') || Route::is('recent.donation') ? 'open' : '' }}">
            <a href="#" class="sidebar-link sidebar-dropdown-toggle">
                <i class="fa-solid fa-hand-holding-dollar"></i>
                <span class="sidebar-text">ডোনেশন ম্যানেজমেন্ট</span>
                <i class="fa-solid fa-chevron-down ms-auto"></i>
            </a>
            <div class="sidebar-submenu">

                <a class="sidebar-sublink {{ request()->routeIs('donation.create') ? 'active' : '' }}" href="{{ route('donation.create') }}">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    <span class="sidebar-text">ডোনেশন তৈরি</span>
                </a>

                <a class="sidebar-sublink {{ request()->routeIs('recent.donation') ? 'active' : '' }}" href="{{ route('recent.donation') }}">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    <span class="sidebar-text">রিসেন্ট ডোনেশন</span>
                </a>

                <a class="sidebar-sublink {{ request()->routeIs('donation.event') ? 'active' : '' }}" href="{{ route('donation.event') }}">
                    <i class="fa-solid fa-coins"></i>
                    <span class="sidebar-text">ডোনেশন ইভেন্ট</span>
                </a>

                <a class="sidebar-sublink {{ request()->routeIs('donation.event.create') ? 'active' : '' }}" href="{{ route('donation.event.create') }}">
                    <i class="fa-solid fa-calendar-plus"></i>
                    <span class="sidebar-text">ডোনেশন ইভেন্ট তৈরি</span>
                </a>

                <a class="sidebar-sublink {{ Route::is('donator.list') ? 'active' : '' }}" href="{{ route('donator.list') }}">
                    <i class="fa-solid fa-list-ul"></i>
                    <span class="sidebar-text">ডোনেটর লিস্ট</span>
                </a>
            </div>
        </div>
        <div
            class="sidebar-dropdown {{Route::is('specific.category.person','1') || Route::is('specific.category.person','2') || Route::is('person.create') || Route::is('lifetime.member.padding.list') ||Route::is('person.search') ||Route::is('search.result') ? 'open' : '' }}">
            <a href="#" class="sidebar-link sidebar-dropdown-toggle">
                <i class="fa-solid fa-users"></i>
                <span class="sidebar-text">সদস্য ম্যানেজমেন্ট</span>
                <i class="fa-solid fa-chevron-down ms-auto"></i>
            </a>
            <div class="sidebar-submenu">

                <a class="sidebar-sublink {{ request()->routeIs('person.search') || request()->routeIs('search.result') ? 'active' : '' }}" 
                href="{{ route('person.search') }}">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <span class="sidebar-text">ব্যাক্তি খুজুন</span>
                </a>

                <a class="sidebar-sublink {{ request()->routeIs('specific.category.person') && request()->route('personType') == 1 ? 'active' : '' }}" 
                href="{{ route('specific.category.person', 1) }}">
                    <i class="fa-solid fa-crown"></i>
                    <span class="sidebar-text">আজীবন সদস্য</span>
                </a>

                <a class="sidebar-sublink {{ Route::is('lifetime.member.padding.list') ? 'active' : '' }}" 
                href="{{ route('lifetime.member.padding.list') }}">
                    <i class="fa-solid fa-user-check"></i>
                    <span class="sidebar-text">আঃ সদস্য অনুমোদন</span>
                </a>

                <a class="sidebar-sublink {{ Route::is('person.create') ? 'active' : '' }}" href="{{ route('person.create') }}">
                    <i class="fa-solid fa-user-plus"></i>
                    <span class="sidebar-text">সদস্য তৈরি</span>
                </a>
            </div>
        </div>
    </nav>
    @endcashier
</aside>
<main class="admin-content">