

    <!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top" id="mainNavbar">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav  align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link service {{ Route::is('home') ? 'active' : '' }}" href="{{route('home')}}">হোম</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('about') ? 'active' : '' }}" href="{{route('about')}}">আমাদের সম্পর্কে</a>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ Route::is('commitee') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown">
                        কমিটি
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">

                        @foreach($committeeNames as $committee)
                            <li>
                                <a class="dropdown-item" href="{{ route('committee', $committee->committee_slug ) }}">
                                    {{ $committee->committee_name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('frontend.notice') ? 'active' : '' }}" href="{{route('frontend.notice')}}">নোটিশ</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('frontend.service') ? 'active' : '' }}" href="{{route('frontend.service')}}">সেবা</a>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ Route::is('lifetime.member') || Route::is('general.member') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown">
                        ই-সেবা
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                        <li><a class="dropdown-item" href="{{route('lifetime.member')}}">আজীবন সদস্য আবেদন</a></li>
                        <li><a class="dropdown-item" href="{{route('general.member')}}">সাধারণ সদস্য আবেদন</a></li>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="#news">সাম্প্রতিক কার্যক্রম</a>
                </li>
        
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('techteam') ? 'active' : '' }}" href="{{route('techteam')}}">টেক টিম</a>
                </li>
				
				<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ Route::is('budget') || Route::is('committee.activities') || Route::is('contact') || Route::is('bmjks.database.view') || Route::is('donetor.frontend') || Route::is('lifetime.member.view') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown">
                        অন্যান্য
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                        <li><a class="dropdown-item" href="{{route('budget')}}">বাজেট</a></li>
						<li><a class="dropdown-item" href="{{route('committee.activities')}}">কার্যক্রম</a></li>
                        <li><a class="dropdown-item" href="{{route('lifetime.member.view', 1)}}">আজীবন সদস্য</a></li>
                        <li><a class="dropdown-item" href="{{ route('top.donetor.frontend') }}">টপ ডোনেটর</a></li>
                        <li><a class="dropdown-item" href="{{ route('donetor.frontend') }}">সাম্প্রতিক ডোনেশন</a></li>
                        <li><a class="dropdown-item" href="{{route('bmjks.database.info')}}">বামযুকস ডাটাবেস</a></li>
                        <li><a class="dropdown-item" href="{{route('bmjks.database.view')}}">বামযুকস ডাটাবেস সার্চ</a></li>
                        <li><a class="dropdown-item" href="{{route('contact')}}">যোগাযোগ</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
  
 