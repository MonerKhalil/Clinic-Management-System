
<header class="nk-header nk-header-fixed is-light">
    <div class="container-fluid">
        <div class="nk-header-wrap">
            <div class="nk-menu-trigger d-xl-none ms-n1">
                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em
                        class="icon ni ni-menu"></em></a>
            </div>
            <div class="nk-header-brand d-xl-none">
                <a href="#" class="logo-link">
                    <img class="logo-light logo-img" src="https://placehold.co/117x36" alt="logo">
                    <img class="logo-dark logo-img" src="https://placehold.co/117x36" alt="logo">
                </a>
            </div>
            <div class="nk-header-search ms-3 ms-xl-0">
                <em class="icon ni ni-search"></em>
                <input type="text" class="form-control border-transparent form-focus-none"
                       id="search-sidebar-dashboard"
                       placeholder="{{__("messages.Search anything")}}">
            </div>
            <div class="nk-header-tools">
                <ul class="nk-quick-nav">
                    <li class="dropdown language-dropdown d-none d-sm-block me-n1">
                        <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">
                            <div class="quick-icon border border-light">
                                @if(app()->getLocale() === "ar")
                                    <img class="icon" src="{{ asset("System/assets/images/flags/syria-sq.png") }}"
                                         alt="logo-flag">
                                @elseif(app()->getLocale() === "en")
                                    <img class="icon" src="{{ asset("System/assets/images/flags/english-sq.png") }}"
                                         alt="logo-flag">
                                @endif
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-s1">
                            <ul class="language-list">
                                @foreach(allLanguges() as $lang)
                                    @if($lang->code === "en")
                                        <li>
                                            <a href="{{ route("lang.change",$lang->code) }}" class="language-item">
                                                <img src="{{ asset("System/assets/images/flags/english.png") }}"
                                                     alt="{{ $lang->code }}" class="language-flag">
                                                <span class="language-name">{{ $lang->code }}</span>
                                            </a>
                                        </li>
                                    @elseif($lang->code === "ar")
                                        <li>
                                            <a href="{{ route("lang.change",$lang->code) }}" class="language-item">
                                                <img src="{{ asset("System/assets/images/flags/syria.png") }}"
                                                     alt="{{ $lang->code }}" class="language-flag">
                                                <span class="language-name">{{ $lang->code }}</span>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </li>
                    <li class="dropdown chats-dropdown hide-mb-xs">
                        <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">
                            <div class="icon-status icon-status-na"><em class="icon ni ni-comments"></em></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end">
                            <div class="dropdown-head">
                                <span class="sub-title nk-dropdown-title">Recent Chats</span>
                                <a href="#">Setting</a>
                            </div>
                            <div class="dropdown-body">
                                <ul class="chat-list">
                                    <li class="chat-item">
                                        <a class="chat-link" href="html/apps-chats.html">
                                            <div class="chat-media user-avatar">
                                                <span>IH</span>
                                                <span class="status dot dot-lg dot-gray"></span>
                                            </div>
                                            <div class="chat-info">
                                                <div class="chat-from">
                                                    <div class="name">Iliash Hossain</div>
                                                    <span class="time">Now</span>
                                                </div>
                                                <div class="chat-context">
                                                    <div class="text">You: Please confrim if you got my last messages.
                                                    </div>
                                                    <div class="status delivered">
                                                        <em class="icon ni ni-check-circle-fill"></em>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="chat-item is-unread">
                                        <a class="chat-link" href="html/apps-chats.html">
                                            <div class="chat-media user-avatar bg-pink">
                                                <span>AB</span>
                                                <span class="status dot dot-lg dot-success"></span>
                                            </div>
                                            <div class="chat-info">
                                                <div class="chat-from">
                                                    <div class="name">Abu Bin Ishtiyak</div>
                                                    <span class="time">4:49 AM</span>
                                                </div>
                                                <div class="chat-context">
                                                    <div class="text">Hi, I am Ishtiyak, can you help me with this
                                                        problem ?
                                                    </div>
                                                    <div class="status unread">
                                                        <em class="icon ni ni-bullet-fill"></em>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="chat-item">
                                        <a class="chat-link" href="html/apps-chats.html">
                                            <div class="chat-media user-avatar bg-pink">
                                                <span>GP</span>
                                                <span class="status dot dot-lg dot-success"></span>
                                            </div>
                                            <div class="chat-info">
                                                <div class="chat-from">
                                                    <div class="name">George Philips</div>
                                                    <span class="time">6 Apr</span>
                                                </div>
                                                <div class="chat-context">
                                                    <div class="text">Have you seens the claim from Rose?</div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="chat-item">
                                        <a class="chat-link" href="html/apps-chats.html">
                                            <div class="chat-media user-avatar bg-pink">
                                                <span>SG</span>
                                                <span class="status dot dot-lg dot-success"></span>
                                            </div>
                                            <div class="chat-info">
                                                <div class="chat-from">
                                                    <div class="name">Softnio Group</div>
                                                    <span class="time">27 Mar</span>
                                                </div>
                                                <div class="chat-context">
                                                    <div class="text">You: I just bought a new computer but i am having
                                                        some problem
                                                    </div>
                                                    <div class="status sent">
                                                        <em class="icon ni ni-check-circle"></em>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="chat-item">
                                        <a class="chat-link" href="html/apps-chats.html">
                                            <div class="chat-media user-avatar bg-pink">
                                                <span>LH</span>
                                                <span class="status dot dot-lg dot-success"></span>
                                            </div>
                                            <div class="chat-info">
                                                <div class="chat-from">
                                                    <div class="name">Larry Hughes</div>
                                                    <span class="time">3 Apr</span>
                                                </div>
                                                <div class="chat-context">
                                                    <div class="text">Hi Frank! How is you doing?</div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="chat-item">
                                        <a class="chat-link" href="html/apps-chats.html">
                                            <div class="chat-media user-avatar bg-purple">
                                                <span>TW</span>
                                            </div>
                                            <div class="chat-info">
                                                <div class="chat-from">
                                                    <div class="name">Tammy Wilson</div>
                                                    <span class="time">27 Mar</span>
                                                </div>
                                                <div class="chat-context">
                                                    <div class="text">You: I just bought a new computer but i am having
                                                        some problem
                                                    </div>
                                                    <div class="status sent">
                                                        <em class="icon ni ni-check-circle"></em>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="dropdown-foot center">
                                <a href="html/apps-chats.html">{{__("messages.View All")}}</a>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown notification-dropdown" data-unread-found="{{ ($countUnRead > 0) ? '1' : '0' }}">
                        <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">
                            <div class="icon-status">
                                <em class="icon ni ni-bell"></em>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end">
                            <div class="dropdown-head">
                                <span class="sub-title nk-dropdown-title">
                                    {{__("messages.Notifications")}}
                                </span>
                                <a href="#" class="read-all-mark">
                                    {{__("messages.Mark All as Read")}}
                                </a>
                            </div>
                            <div class="dropdown-body">
                                <div class="nk-notification">
                                    <div class="nk-notification-loading">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden"> {{__("messages.Loading...")}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-foot center">
                                <a href="{{ route("notification.with-out-audit") }}">
                                    @lang("messages.View All")
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle me-n1" data-bs-toggle="dropdown">
                            <div class="user-toggle">
                                <div class="user-avatar sm">
                                    @if(isset(Auth()->user()->image))
                                        <img alt="user-img" src="{{pathStorage(Auth()->user()->image)}}">
                                    @else
                                        <em class="icon ni ni-user-alt"></em>
                                    @endif
                                </div>
                                <div class="user-info d-none d-xl-block">
                                    <div class="user-status user-status-verified">verified</div>
                                    <div class="user-name dropdown-indicator">{{ Auth()->user()->name ?? "" }}</div>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end">
                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                <div class="user-card">
                                    <div class="user-avatar">
                                        @if(isset(Auth()->user()->image))
                                            <img alt="user-img" src="{{pathStorage(Auth()->user()->image)}}">
                                        @else
                                            <span>AB</span>
                                        @endif
                                    </div>
                                    <div class="user-info">
                                        <span class="lead-text">{{ Auth()->user()->name ?? "" }}</span>
                                        <span class="sub-text">{{ Auth()->user()->email ?? "" }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li><a href="{{ route("profile.show") }}"><em
                                                class="icon ni ni-user-alt"></em><span>{{__("messages.Profile")}}</span></a>
                                    </li>
                                    <li><a href="{{ route("account.setting.show") }}"><em
                                                class="icon ni ni-setting-alt"></em><span>{{__("messages.Security Settings")}}</span></a>
                                    </li>
                         {{--           <li><a href="{{ route("user-activity") }}"><em class="icon ni ni-activity-alt"></em><span>{{__("messages.Login Activity")}}</span></a>
                                    </li>--}}
                                    <li><a class="dark-switch" href="#"><em
                                                class="icon ni ni-moon"></em><span>{{__("messages.Dark Mode")}}</span></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="dropdown-inner">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" hidden>
                                    @csrf
                                </form>
                                <ul class="link-list">
                                    <li>
                                        <a class="AnchorSubmit" href="#"
                                           data-formID="logout-form">
                                            <em class="icon ni ni-signout"></em>
                                            <span>{{__("messages.Sign out")}}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
