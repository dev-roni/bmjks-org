<div class="admin-header">
    <div class="d-flex align-items-center gap-2">
        <button class="btn sidebar-toggle" data-toggle="sidebar"><i class="fa-solid fa-bars"></i></button>
    </div>
    <div class="d-flex align-items-center gap-3">
        <!-- Search Button (Only on Members Page) -->
        @if (request()->routeIs('specific.category.person'))
            <button class="btn search-toggle" data-toggle="search-sidebar" title="উন্নত অনুসন্ধান">
                <i class="fa-solid fa-search"></i>
            </button>
        @endif
        
        <!-- User Profile Dropdown -->
        <div class="user-profile-dropdown">
            <div class="user-profile-toggle" data-toggle="user-dropdown">
                <div class="user-avatar">
                    <img src="{{ asset('Frontend-Assets/images/profile_img.png') }}" alt="User Avatar" class="user-avatar-img">
                </div>
                <div class="user-info">
                    <span class="user-name">{{Auth::user()->name}}</span>
                </div>
                <i class="fa-solid fa-chevron-down dropdown-arrow"></i>
            </div>
            <div class="user-dropdown-menu">
                <div class="dropdown-divider"></div>
                <a href="{{ route('change.password') }}" class="dropdown-item">
                    <i class="fa-solid fa-lock me-1"></i> পাসওয়ার্ড পরিবর্তন
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout.submit') }}" class="dropdown-item text-danger">
                    <i class="fa-solid fa-right-from-bracket me-2"></i>লগআউট
                </a>
            </div>
        </div>
    </div>
</div>