<!-- BEGIN: SideNav-->
<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-dark gradient-45deg-deep-purple-blue sidenav-gradient sidenav-active-rounded">
    <div class="brand-sidebar">
        <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="{{ route('home') }}">
                @if($setting->logo && $setting->site_name)
                <img class="hide-on-med-and-down " src="{{ asset($setting->logo) }}" alt="Site logo" />
                <img class="show-on-medium-and-down hide-on-med-and-up" src="{{ asset($setting->logo)}}" alt="site logo')}}" />
                <span style="font-size: 16px" class="logo-text hide-on-med-and-down">{{ $setting->site_name }}</span></a>
                @else
                <img class="hide-on-med-and-down " src="{{ asset('default/logo.png') }}" alt="Site logo" />
                <img class="show-on-medium-and-down hide-on-med-and-up" src="{{ asset('admin/app-assets/images/logo/materialize-logo-color.png" alt="materialize logo')}}" />
                <span style="font-size: 16px" class="logo-text hide-on-med-and-down">Medbill</span>

                @endif
{{--            <a class="navbar-toggler" href="#">--}}
{{--                <i class="material-icons">radio_button_checked</i>--}}
{{--            </a>--}}
        </h1>
    </div>
    <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
        <li class="{{ Request::is('/') ? 'active' : '' }} bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i class="material-icons">settings_input_svideo</i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li class="{{ Request::is('/') ? 'active' : '' }}"><a class="{{ Request::is('/') ? 'active' : '' }}" href=" {{ route('home') }}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Modern">Dashboard</span></a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="navigation-header"><a class="navigation-header-text">Pages </a><i class="navigation-header-icon material-icons">more_horiz</i>
        </li>
        <li class="{{ Request::is('category') || Request::is('category/*') ? 'active' : '' }} bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i class="material-icons">content_paste</i><span class="menu-title" data-i18n="Pages">Category</span></a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li class="{{ Request::is('category/list') ? 'active' : '' }}"><a class="{{ Request::is('category/list') ? 'active' : '' }}" href="{{ route('category.index') }}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Page Blank">List</span></a>
                    </li>
                    <li class="{{ Request::is('category/create') ? 'active' : '' }}"><a class="{{ Request::is('category/create') ? 'active' : '' }}" href="{{ route('category.create') }}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Page Blank">Add</span></a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="{{ Request::is('sub-category') || Request::is('sub-category/*') ? 'active' : '' }} bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i class="material-icons">content_paste</i><span class="menu-title" data-i18n="Pages">Sub Category</span></a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li class="{{ Request::is('sub-category/list') ? 'active' : '' }}"><a class="{{ Request::is('sub-category/list') ? 'active' : '' }}" href="{{ route('subcategory.index') }}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Page Blank">List</span></a>
                    </li>
                    <li class="{{ Request::is('sub-category/create') ? 'active' : '' }}"><a class="{{ Request::is('sub-category/create') ? 'active' : '' }}" href="{{ route('subcategory.create') }}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Page Blank">Add</span></a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="{{ Request::is('tag') || Request::is('tag/*') ? 'active' : '' }} bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i class="material-icons">content_paste</i><span class="menu-title" data-i18n="Pages">Tag</span></a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li class="{{ Request::is('tag/list') ? 'active' : '' }}"><a class="{{ Request::is('tag/list') ? 'active' : '' }}" href="{{ route('tag.index') }}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Page Blank">List</span></a>
                    </li>
                    <li class="{{ Request::is('tag/create') ? 'active' : '' }}"><a class="{{ Request::is('tag/create') ? 'active' : '' }}" href="{{ route('tag.create') }}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Page Blank">Add</span></a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="{{ Request::is('news') || Request::is('news/*') ? 'active' : '' }} bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i class="material-icons">content_paste</i><span class="menu-title" data-i18n="Pages">News</span></a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li class="{{ Request::is('news/list') ? 'active' : '' }}"><a class="{{ Request::is('news/list') ? 'active' : '' }}" href="{{ route('news.index') }}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Page Blank">List</span></a>
                    </li>
                    <li class="{{ Request::is('news/create') ? 'active' : '' }}"><a class="{{ Request::is('news/create') ? 'active' : '' }}" href="{{ route('news.create') }}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Page Blank">Add</span></a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="{{ Request::is('comment') || Request::is('comment/*') ? 'active' : '' }} bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i class="material-icons">content_paste</i><span class="menu-title" data-i18n="Pages">Comment</span></a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li class="{{ Request::is('comment/approve/list') ? 'active' : '' }}"><a class="{{ Request::is('comment/approve/list') ? 'active' : '' }}" href="{{ route('comment.approve.list') }}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Page Blank">Approve List</span></a>
                    </li>
                    <li class="{{ Request::is('comment/pending/list') ? 'active' : '' }}"><a class="{{ Request::is('comment/pending/list') ? 'active' : '' }}" href="{{ route('comment.pending.list') }}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Page Blank">Pending List</span></a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="{{ Request::is('user') || Request::is('user/*') ? 'active' : '' }} bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i class="material-icons">content_paste</i><span class="menu-title" data-i18n="Pages">Users</span></a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li class="{{ Request::is('user/list') ? 'active' : '' }}"><a class="{{ Request::is('user/list') ? 'active' : '' }}" href="{{ route('user.index') }}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Page Blank">List</span></a>
                    </li>
                    <li class="{{ Request::is('user/create') ? 'active' : '' }}"><a class="{{ Request::is('user/create') ? 'active' : '' }}" href="{{ route('user.create') }}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Page Blank">Add</span></a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="{{ Request::is('filter') || Request::is('filter/*') ? 'active' : '' }} bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i class="material-icons">content_paste</i><span class="menu-title" data-i18n="Pages">Filter</span></a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li class="{{ Request::is('filter/list') ? 'active' : '' }}"><a class="{{ Request::is('filter/list') ? 'active' : '' }}" href="{{ route('filter.view') }}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Page Blank">List</span></a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="bold {{ Request::is('setting') || Request::is('setting/*') ? 'active' : '' }}"><a class="waves-effect waves-cyan {{ Request::is('setting/list') ? 'active' : '' }}" href="{{ route('setting.index') }}"><i class="material-icons">settings_ethernet</i><span class="menu-title" data-i18n="Form Wizard">Settings</span></a>
        </li>
    </ul>

    <div class="navigation-background"></div><a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
</aside>
<!-- END: SideNav-->
