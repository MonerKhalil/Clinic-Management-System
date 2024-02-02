@extends("layouts.sidebars.layout-sidebar")

@php
    $CanReadCategory = userHasPermission("read_categories") || userHasPermission("all_categories") ;
    $CanCreateCategory = userHasPermission("create_categories") || userHasPermission("all_categories") ;

    $CanReadStaticPage = userHasPermission("read_static_pages") || userHasPermission("all_static_pages") ;
    $CanCreateStaticPage = userHasPermission("create_static_pages") || userHasPermission("all_static_pages") ;

    $CanReadUsers = userHasPermission("read_users") || userHasPermission("all_users") ;
    $CanCreateUsers = userHasPermission("create_users") || userHasPermission("all_users") ;

    $CanReadLanguage = userHasPermission("read_languages") || userHasPermission("all_languages") ;
    $CanCreateLanguage = userHasPermission("create_languages") || userHasPermission("all_languages") ;

    $CanReadCategoryTemplate = userHasPermission("read_email_template_categories") || userHasPermission("all_email_template_categories") ;
    $CanCreateCategoryTemplate = userHasPermission("create_email_template_categories") || userHasPermission("all_email_template_categories") ;
    $CanReadEmailTemplate = userHasPermission("read_email_templates") || userHasPermission("all_email_templates") ;
    $CanCreateEmailTemplate = userHasPermission("create_email_templates") || userHasPermission("all_email_templates") ;
    $CanReadSendEmail =  userHasPermission("read_send_email") || userHasPermission("all_send_email") ;
    $CanSendEmail =  userHasPermission("create_send_email") || userHasPermission("all_send_email") ;

    $CanReadStatistic = userHasPermission("read_statistic") || userHasPermission("all_statistic") ;
    $CanCreateStatistic = userHasPermission("create_statistic") || userHasPermission("all_statistic") ;

    $CanReadMediaManagers = userHasPermission("read_media_managers") || userHasPermission("all_media_managers") ;
    $CanCreateMediaManagers = userHasPermission("create_media_managers") || userHasPermission("all_media_managers") ;

    $CanReadClauses = userHasPermission("read_clauses") || userHasPermission("all_clauses") ;
    $CanCreateClauses = userHasPermission("create_clauses") || userHasPermission("all_clauses") ;

    $CanReadReport =  userHasPermission("read_reports") || userHasPermission("all_reports") ;
    $CanCreateReport =  userHasPermission("create_reports") || userHasPermission("all_reports") ;

    $CanReadSystemUpdate = userHasPermission("read_system_update") || userHasPermission("all_system_update") ;

    $CanReadRoles = userHasPermission("read_roles") || userHasPermission("all_roles") ;
    $CanCreateRole = userHasPermission("create_roles") || userHasPermission("all_roles");

    $CanDDealingGeoLocal = userHasPermission("all_geolocales") ;

    $CanReadSettingControls = userHasPermission("read_setting_controls") || userHasPermission("all_setting_controls") ;
    $CanCreateSettingControls = userHasPermission("create_setting_controls") || userHasPermission("all_setting_controls");

   $CanReadSettings = userHasPermission("read_settings") || userHasPermission("all_settings") ;
   $CanCreateSettings = userHasPermission("create_settings") || userHasPermission("all_settings");

   $CanReadFilesLang =  userHasPermission("read_files_lang") || userHasPermission("all_files_lang") ;

   $CanReadSMTPSetting = userHasPermission("read_email_configurations") || userHasPermission("all_email_configurations") ;
   $CanCreateSMTPSetting = userHasPermission("create_email_configurations") || userHasPermission("all_email_configurations") ;

   $CanReadSocialMedia = userHasPermission("read_social_email_templates") || userHasPermission("all_social_email_templates") ;
   $CanCreateSocialMedia = userHasPermission("create_social_email_templates") || userHasPermission("all_social_email_templates") ;

   $CanReadProfile = userHasPermission("read_profile") || userHasPermission("all_profile") ;
   $CanCreateProfile = userHasPermission("create_profile") || userHasPermission("all_profile") ;

   $CanReadAccountSettings = userHasPermission("read_account_settings") || userHasPermission("all_account_settings") ;
   $CanCreateAccountSettings = userHasPermission("create_account_settings") || userHasPermission("all_account_settings") ;

   $CanReadNotifications = userHasPermission("read_notifications") || userHasPermission("all_notifications") ;
   $CanCreateNotifications = userHasPermission("create_notifications") || userHasPermission("all_notifications") ;
@endphp


@section("menu-sidebar")
    <ul class="nk-menu" id="content-filter">
        <!-- start Operation -->
        @if($CanReadCategory || $CanCreateCategory ||
            $CanCreateStaticPage || $CanReadStaticPage ||
            $CanReadUsers || $CanCreateUsers ||
            $CanReadLanguage || $CanCreateLanguage ||
            $CanReadEmailTemplate || $CanCreateEmailTemplate ||
            $CanReadCategoryTemplate || $CanCreateCategoryTemplate)
            <li class="nk-menu-heading filter-sidebar-label">
                <h6 class="overline-title text-primary-alt">operation</h6>
            </li>
            @if($CanReadCategory || $CanCreateCategory)
                <li class="nk-menu-item has-sub filter-sidebar">
                    <a href="#" class="nk-menu-link nk-menu-toggle">
                        <span class="nk-menu-icon"><em class="icon ni ni-layers"></em></span>
                        <span class="nk-menu-text">Categories</span>
                    </a>
                    <ul class="nk-menu-sub">
                        @if($CanReadCategory)
                            <li class="nk-menu-item filter-sidebar">
                                <a href="{{ route("category.index") }}" class="nk-menu-link">
                                    <span class="nk-menu-text">Category List</span>
                                </a>
                            </li>
                        @endif
                        @if($CanCreateCategory)
                            <li class="nk-menu-item filter-sidebar">
                                <a href="{{ route("category.create") }}" class="nk-menu-link">
                                    <span class="nk-menu-text">Category Create</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if($CanReadStaticPage || $CanCreateStaticPage)
                <li class="nk-menu-item has-sub filter-sidebar">
                    <a href="#" class="nk-menu-link nk-menu-toggle">
                        <span class="nk-menu-icon"><em class="icon ni ni-grid-alt-fill"></em></span>
                        <span class="nk-menu-text">Static Page</span>
                    </a>
                    <ul class="nk-menu-sub">
                        @if($CanReadStaticPage)
                            <li class="nk-menu-item filter-sidebar">
                                <a href="{{ route("static-page.index") }}" class="nk-menu-link">
                                    <span class="nk-menu-text">Static Page List</span>
                                </a>
                            </li>
                        @endif
                        @if($CanCreateStaticPage)
                            <li class="nk-menu-item filter-sidebar">
                                <a href="{{ route("static-page.create") }}" class="nk-menu-link">
                                    <span class="nk-menu-text">Static Page Create</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if($CanReadUsers || $CanCreateUsers)
                <li class="nk-menu-item has-sub filter-sidebar">
                    <a href="#" class="nk-menu-link nk-menu-toggle">
                        <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>
                        <span class="nk-menu-text">Users</span>
                    </a>
                    <ul class="nk-menu-sub">
                        @if($CanReadUsers)
                            <li class="nk-menu-item filter-sidebar">
                                <a href="{{ route("user.index") }}" class="nk-menu-link">
                                    <span class="nk-menu-text">Users List</span>
                                </a>
                            </li>
                        @endif
                        @if($CanCreateUsers)
                            <li class="nk-menu-item filter-sidebar">
                                <a href="{{ route("user.create") }}" class="nk-menu-link">
                                    <span class="nk-menu-text">User Create</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if($CanReadLanguage || $CanCreateLanguage)
                <li class="nk-menu-item has-sub filter-sidebar">
                    <a href="#" class="nk-menu-link nk-menu-toggle">
                        <span class="nk-menu-icon"><em class="icon ni ni-flag-fill"></em></span>
                        <span class="nk-menu-text">Languages</span>
                    </a>
                    <ul class="nk-menu-sub">
                        @if($CanReadLanguage)
                            <li class="nk-menu-item filter-sidebar">
                                <a href="{{ route("language.index") }}" class="nk-menu-link">
                                    <span class="nk-menu-text">Languages List</span>
                                </a>
                            </li>
                        @endif
                        @if($CanCreateLanguage)
                            <li class="nk-menu-item filter-sidebar">
                                <a href="{{ route("language.create") }}" class="nk-menu-link">
                                    <span class="nk-menu-text">Language Create</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if($CanReadEmailTemplate || $CanCreateEmailTemplate)
                <li class="nk-menu-item has-sub filter-sidebar">
                    <a href="#" class="nk-menu-link nk-menu-toggle">
                        <span class="nk-menu-icon"><em class="icon ni ni-mail-fill"></em></span>
                        <span class="nk-menu-text">Email</span>
                    </a>
                    <ul class="nk-menu-sub">
                        @if($CanReadCategoryTemplate || $CanCreateCategoryTemplate)
                            <li class="nk-menu-item has-sub filter-sidebar">
                                <a href="#" class="nk-menu-link nk-menu-toggle">
                                    <span class="nk-menu-text">Category</span>
                                </a>
                                <ul class="nk-menu-sub">
                                    @if($CanReadCategoryTemplate)
                                        <li class="nk-menu-item filter-sidebar">
                                            <a href="{{ route("email-template-category.index") }}"
                                               class="nk-menu-link">
                                                <span class="nk-menu-text">Category List</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if($CanCreateCategoryTemplate)
                                        <li class="nk-menu-item filter-sidebar">
                                            <a href="{{ route("email-template-category.create") }}"
                                               class="nk-menu-link">
                                                <span class="nk-menu-text">Category Create</span>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                        @if($CanReadEmailTemplate || $CanCreateEmailTemplate)
                            <li class="nk-menu-item has-sub filter-sidebar">
                                <a href="#" class="nk-menu-link nk-menu-toggle">
                                    <span class="nk-menu-text">Templates</span>
                                </a>
                                <ul class="nk-menu-sub">
                                    @if($CanReadEmailTemplate)
                                        <li class="nk-menu-item filter-sidebar">
                                            <a href="{{ route("email_template.view_live") }}" class="nk-menu-link">
                                                <span class="nk-menu-text">Template List</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if($CanCreateEmailTemplate)
                                        <li class="nk-menu-item filter-sidebar">
                                            <a href="{{ route("email-template.create") }}" class="nk-menu-link">
                                                <span class="nk-menu-text">Template Create</span>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                        @if($CanSendEmail || $CanReadSendEmail)
                            <li class="nk-menu-item has-sub filter-sidebar">
                                <a href="#" class="nk-menu-link nk-menu-toggle">
                                    <span class="nk-menu-text">Inbox Emails</span>
                                </a>
                                <ul class="nk-menu-sub">
                                    @if($CanSendEmail)
                                        <li class="nk-menu-item filter-sidebar">
                                            <a href="{{ route("send.mails.show.page") }}" class="nk-menu-link">
                                                <span class="nk-menu-text">Send Email</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if($CanReadSendEmail)
                                        <li class="nk-menu-item filter-sidebar">
                                            <a href="{{ route("email-sent-storage.index") }}" class="nk-menu-link">
                                                <span class="nk-menu-text">List Sent</span>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
        @endif
    <!-- end Operation -->

        <!-- start Pages -->
        @if($CanReadStatistic || $CanCreateStatistic||
            $CanReadMediaManagers || $CanCreateMediaManagers)

            <li class="nk-menu-heading filter-sidebar-label">
                <h6 class="overline-title text-primary-alt">pages</h6>
            </li>
            @if($CanReadStatistic || $CanCreateStatistic)
                <li class="nk-menu-item filter-sidebar">
                    <a href="#" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-trend-up"></em></span>
                        <span class="nk-menu-text">Statistic</span>
                    </a>
                </li>
            @endif
            @if($CanReadMediaManagers|| $CanCreateMediaManagers)
                <li class="nk-menu-item filter-sidebar">
                    <a href="{{ route("media.managershow.create") }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-grid-add-fill-c"></em></span>
                        <span class="nk-menu-text">Media Manager</span>
                    </a>
                </li>
            @endif
        @endif
        <li class="nk-menu-item has-sub filter-sidebar">

            <a href="#" class="nk-menu-link nk-menu-toggle">
                <span class="nk-menu-icon"><em class="icon ni ni-file-text-fill"></em></span>
                <span class="nk-menu-text">Clauses</span>
            </a>
            <ul class="nk-menu-sub">
                <li class="nk-menu-item filter-sidebar">
                    <a href="{{ route("policy") }}" class="nk-menu-link">
                        <span class="nk-menu-text">Privacy Policy</span>
                    </a>
                </li>
                <li class="nk-menu-item filter-sidebar">
                    <a href="{{ route("term") }}" class="nk-menu-link">
                        <span class="nk-menu-text">Terms &amp; Conditions</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- end Pages -->

        <!-- start Report -->
        @if($CanReadReport || $CanCreateReport)
            <li class="nk-menu-heading">
                <h6 class="overline-title text-primary-alt">report</h6>
            </li>
            <li class="nk-menu-item has-sub">
                <a href="#" class="nk-menu-link nk-menu-toggle">
                    <span class="nk-menu-icon"><em class="icon ni ni-file-text-fill"></em></span>
                    <span class="nk-menu-text">Reports</span>
                </a>
                <ul class="nk-menu-sub">
                    @php
                        $reports = \Illuminate\Support\Facades\Cache::get(config("report.cache")??"__");
                    @endphp
                    @if(!is_null($reports))
                        @foreach($reports as $report)
                            <li class="nk-menu-item">
                                <a href="{{ route("report.". $report->name .".report") }}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-reports"></em></span>
                                    <span class="nk-menu-text">{{ucfirst($report->name)}}</span>
                                </a>
                            </li>
                        @endforeach
                    @endif
                    <li class="nk-menu-item">
                        <a href="{{ route("report.create") }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-reports"></em></span>
                            <span class="nk-menu-text">Report Create</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endif
    <!-- end Report -->

        <!-- start configurations -->
        @if($CanReadSystemUpdate ||
            $CanReadRoles || $CanCreateRole ||
            $CanDDealingGeoLocal)
            <li class="nk-menu-heading filter-sidebar-label">
                <h6 class="overline-title text-primary-alt">Configurations</h6>
            </li>
            @if($CanReadSettingControls || $CanCreateSettingControls ||
                $CanReadSettings || $CanCreateSettings ||
                $CanReadFilesLang ||
                $CanReadSMTPSetting || $CanCreateSMTPSetting ||
                $CanReadSocialMedia || $CanCreateSocialMedia)
                <li class="nk-menu-item has-sub filter-sidebar">
                    <a href="#" class="nk-menu-link nk-menu-toggle">
                        <span class="nk-menu-icon"><em class="icon ni ni-opt-dot-fill"></em></span>
                        <span class="nk-menu-text">System Update</span>
                    </a>

                    <ul class="nk-menu-sub">
                        @if($CanReadSettingControls || $CanCreateSettingControls||
                            $CanReadSettings || $CanCreateSettings)
                            <li class="nk-menu-item filter-sidebar">
                                <a href="{{ (Route::currentRouteName() == "setting.control.show") ? route("setting.control.show") : route("setting.show") }}"
                                   class="nk-menu-link">
                                    <span class="nk-menu-text">Global Setting</span>
                                </a>
                            </li>
                        @endif
                        @if($CanReadFilesLang)
                            <li class="nk-menu-item filter-sidebar">
                                <a href="{{ route("lang.file.editorshow") }}" class="nk-menu-link">
                                    <span class="nk-menu-text">Files Language</span>
                                </a>
                            </li>
                        @endif
                        @if($CanReadSMTPSetting || $CanCreateSMTPSetting)
                            <li class="nk-menu-item has-sub filter-sidebar">
                                <a href="#" class="nk-menu-link nk-menu-toggle">
                                    <span class="nk-menu-text">SMTP</span>
                                </a>
                                <ul class="nk-menu-sub">
                                    @if($CanReadSMTPSetting)
                                        <li class="nk-menu-item filter-sidebar">
                                            <a href="{{ route("email-configuration.index") }}" class="nk-menu-link">
                                                <span class="nk-menu-text">SMTP List</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if($CanCreateSMTPSetting)
                                        <li class="nk-menu-item filter-sidebar">
                                            <a href="{{ route("email-configuration.create") }}"
                                               class="nk-menu-link">
                                                <span class="nk-menu-text">SMTP Create</span>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                        @if($CanReadSocialMedia || $CanCreateSocialMedia)
                            <li class="nk-menu-item has-sub">
                                <a href="#" class="nk-menu-link nk-menu-toggle">
                                    <span class="nk-menu-text">Social Media</span>
                                </a>
                                <ul class="nk-menu-sub">
                                    @if($CanReadSocialMedia)
                                        <li class="nk-menu-item filter-sidebar">
                                            <a href="{{ route("social-media.index") }}" class="nk-menu-link">
                                                <span class="nk-menu-text">Social Media List</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if($CanCreateSocialMedia)
                                        <li class="nk-menu-item filter-sidebar">
                                            <a href="{{ route("social-media.create") }}" class="nk-menu-link">
                                                <span class="nk-menu-text">Social Media Create</span>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if($CanReadRoles || $CanCreateRole)
                <li class="nk-menu-item has-sub filter-sidebar">
                    <a href="#" class="nk-menu-link nk-menu-toggle">
                        <span class="nk-menu-icon"><em class="icon ni ni-star-round"></em></span>
                        <span class="nk-menu-text">Roles</span>
                    </a>
                    <ul class="nk-menu-sub">
                        @if($CanReadRoles)
                            <li class="nk-menu-item filter-sidebar">
                                <a href="{{ route("role.index") }}" class="nk-menu-link">
                                    <span class="nk-menu-text">Role List</span>
                                </a>
                            </li>
                        @endif
                        @if($CanCreateRole)
                            <li class="nk-menu-item filter-sidebar">
                                <a href="{{ route("role.create") }}" class="nk-menu-link">
                                    <span class="nk-menu-text">Role Create</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if($CanDDealingGeoLocal)
                <li class="nk-menu-item filter-sidebar">
                    <a href="{{ route("geo-locale.main") }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-globe"></em></span>
                        <span class="nk-menu-text">Geo Local</span>
                    </a>
                </li>
            @endif
        @endif
    <!-- end configurations -->

        <!-- start my account -->
        @if($CanReadProfile || $CanCreateProfile ||
            $CanReadAccountSettings || $CanCreateAccountSettings ||
            $CanReadNotifications || $CanCreateNotifications)
            <li class="nk-menu-heading filter-sidebar-label">
                <h6 class="overline-title text-primary-alt">My Account</h6>
            </li>
            @if($CanReadProfile || $CanCreateProfile)
                <li class="nk-menu-item filter-sidebar">
                    <a href="{{ route("profile.show") }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-user-alt"></em></span>
                        <span class="nk-menu-text">Profile</span>
                    </a>
                </li>
            @endif
            @if($CanReadAccountSettings || $CanCreateAccountSettings)
                <li class="nk-menu-item filter-sidebar">
                    <a href="{{ route("account.setting.show") }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-setting-fill"></em></span>
                        <span class="nk-menu-text">Security Settings</span>
                    </a>
                </li>
            @endif
            @if($CanReadNotifications || $CanCreateNotifications)
                <li class="nk-menu-item filter-sidebar">
                    @php
                        $NotificationRoute = "" ;
                        switch (Route::currentRouteName()) {
                            case "notification.audit.show" :
                                $NotificationRoute = "notification.audit.show" ;
                                break;
                            case "notification.print.table.show" :
                                $NotificationRoute = "notification.print.table.show" ;
                                break;
                            default :
                                $NotificationRoute = "notification.with-out-audit" ;
                                break;
                        }
                    @endphp
                    <a href="{{ route($NotificationRoute) }}"
                       class="nk-menu-link">
                   <span class="nk-menu-icon">
                       <em class="icon ni ni-bell-fill"></em>
                   </span>
                        <span class="nk-menu-text">Notifications</span>
                    </a>
                </li>
        @endif
    @endif
    <!-- end my account -->
    </ul>
@endsection
