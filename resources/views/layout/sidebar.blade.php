<div class="mdk-drawer js-mdk-drawer layout-compact__drawer" id="default-drawer">
    <div class="mdk-drawer__content js-sidebar-mini" data-responsive-width="992px" data-layout="compact">

        <div class="sidebar sidebar-mini sidebar-left ps ps--active-y sidebar-dark-dodger-blue" data-perfect-scrollbar>

            <!-- Navbar toggler -->
            <a href="analytics.html"
               class="navbar-toggler navbar-toggler-custom w-auto d-flex align-items-center justify-content-center"
               data-toggle="tooltip" data-title="Switch to Vertical App Layout" data-placement="right"
               data-boundary="window">
                <span class="material-icons">sync_alt</span>
            </a>

            <ul class="nav flex-column sidebar-menu sm-item-bordered" id="sidebar-mini-tabs" role="tablist">
                <li class="sidebar-account mx-16pt mb-16pt">
                    <a href="#sm_account_1" class="p-4pt d-flex align-items-center justify-content-center"
                       data-toggle="tab" role="tab" aria-controls="sm_account_1" aria-selected="true">
                        <img width="32" height="32" class="rounded-circle mr-8pt"
                             src="{{ Auth::user()->img_url ? Auth::user()->img_url : asset('theme/images/guy-3.jpg') }}"
                             alt="account"/>
                        <i class="material-icons text-black-20 icon-16pt">keyboard_arrow_down</i>
                    </a>
                </li>
                <li class="sidebar-menu-item active" data-title="Dashboards" data-placement="right"
                    data-boundary="window">
                    <a class="sidebar-menu-button" href="#sm_dashboards" data-toggle="tab" role="tab"
                       aria-controls="sm_dashboards" aria-selected="true">
                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dashboard</i>
                        <span class="sidebar-menu-text">Главная</span>
                    </a>
                </li>
                <li class="sidebar-menu-item" data-title="Enterprise" data-placement="right" data-container="body"
                    data-boundary="window">
                    <a class="sidebar-menu-button" href="#sm_enterprise" data-toggle="tab" role="tab"
                       aria-controls="sm_enterprise" aria-selected="false">
                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">donut_large</i>
                        <span class="sidebar-menu-text">Пользователь</span>
                    </a>
                </li>
                <li class="sidebar-menu-item " data-title="Account" data-placement="right" data-container="body"
                    data-boundary="window">
                    <a class="sidebar-menu-button" href="#sm_account" data-toggle="tab" role="tab"
                       aria-controls="sm_account">
                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">account_box</i>
                        <span class="sidebar-menu-text">Мой профиль</span>
                    </a>
                </li>
                @isAllowed('viewing_project')
                    <li class="sidebar-menu-item " data-title="Projects" data-placement="right" data-container="body"
                        data-boundary="window">
                        <a class="sidebar-menu-button" href="#sm_projects" data-toggle="tab" role="tab"
                           aria-controls="sm_account">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">shopping_cart</i>
                            <span class="sidebar-menu-text">Проекты</span>
                        </a>
                    </li>
                @endisAllowed
            </ul>
        </div>

        <div class="sidebar sidebar-left flex sidebar-secondary sidebar-p-t ps sidebar-dark-dodger-blue"
             data-perfect-scrollbar>
            <div class="tab-content">

                <div class="tab-pane" id="sm_account_1">
                    <div class="sidebar-heading">Аккаунт</div>
                    <ul class="sidebar-menu">
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="compact-edit-account.html">
                                <span class="sidebar-menu-text">Редактировать аккаунт</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="compact-billing.html">Billing</a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="compact-billing-history.html">Реквизиты</a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Выйти') }}
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="tab-pane fade active show" id="sm_dashboards">
                    <div class="sidebar-heading">Главная</div>
                    <ul class="sidebar-menu">
                        <li class="sidebar-menu-item active open">
                            <a class="sidebar-menu-button" data-toggle="collapse" href="#dashboards_menu">
                                    <span
                                        class="material-icons sidebar-menu-icon sidebar-menu-icon--left">Главная</span>
                                Главная
                                <span class="ml-auto sidebar-menu-toggle-icon"></span>
                            </a>
                            <ul class="sidebar-submenu collapse show sm-indent" id="dashboards_menu">
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="compact-index.html">
                                        <span class="sidebar-menu-text">Analytics Dashboard</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item active">
                                    <a class="sidebar-menu-button" href="compact-analytics.html">
                                        <span class="sidebar-menu-text">Analytics 2 Dashboard</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="compact-projects.html">
                                        <span class="sidebar-menu-text">Projects Dashboard</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="compact-tasks-board.html">
                                        <span class="sidebar-menu-text">Tasks Dashboard</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="compact-staff.html">
                                        <span class="sidebar-menu-text">Staff Dashboard</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="compact-ecommerce.html">
                                        <span class="sidebar-menu-text">Shop Dashboard</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="compact-erp-dashboard.html">
                                        <span class="sidebar-menu-text">ERP Dashboard</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="compact-crm-dashboard.html">
                                        <span class="sidebar-menu-text">CRM Dashboard</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="compact-hr-dashboard.html">
                                        <span class="sidebar-menu-text">HR Dashboard</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="compact-cms-dashboard.html">
                                        <span class="sidebar-menu-text">CMS Dashboard</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button disabled" href="compact-ui-card-metrics.html">
                                        <span class="sidebar-menu-text">Card Metrics</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                @isAllowed('viewing_users')
                <div class="tab-pane" id="sm_enterprise">
                    <ul class="sidebar-menu">
                        <li class="sidebar-menu-item open">
                            <a class="sidebar-menu-button js-sidebar-collapse" data-toggle="collapse"
                               href="#enterprise_menu">
                                    <span
                                        class="material-icons sidebar-menu-icon sidebar-menu-icon--left">donut_large</span>
                                Пользователи
                                <span class="ml-auto sidebar-menu-toggle-icon"></span>
                            </a>
                            <ul class="sidebar-submenu collapse sm-indent" id="enterprise_menu">
                                @isAllowed('user_create')
                                    <li class="sidebar-menu-item">
                                        <a class="sidebar-menu-button" href="{{route('createUser')}}">
                                            <span class="sidebar-menu-text">Создать пользователя</span>
                                        </a>
                                    </li>
                                @endisAllowed
                                    <li class="sidebar-menu-item">
                                        <a class="sidebar-menu-button" href="{{route('manageUser')}}">
                                            <span class="sidebar-menu-text">Пользователи</span>
                                        </a>
                                    </li>

                            </ul>

                        </li>
                    </ul>
                </div>
                @endisAllowed
                <div class="tab-pane " id="sm_account">
                    <div class="sidebar-heading">Аккаунт</div>
                    <ul class="sidebar-menu">
                        <li class="sidebar-menu-item open">
                            <a class="sidebar-menu-button" data-toggle="collapse" href="#account_menu">
                                    <span
                                        class="material-icons sidebar-menu-icon sidebar-menu-icon--left">account_box</span>
                                Account
                                <span class="ml-auto sidebar-menu-toggle-icon"></span>
                            </a>
                            <ul class="sidebar-submenu collapse sm-indent" id="account_menu">
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="{{route('profile')}}">
                                        <span class="sidebar-menu-text">Profile</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="{{route('paymentInfo')}}">
                                        <span class="sidebar-menu-text">Payment</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                @isAllowed('viewing_project')
                <div class="tab-pane " id="sm_projects">
                    <div class="sidebar-heading">Проекты</div>
                    <ul class="sidebar-menu">
                        <li class="sidebar-menu-item open">
                            <a class="sidebar-menu-button" data-toggle="collapse" href="#account_menu">
                                <span
                                    class="material-icons sidebar-menu-icon sidebar-menu-icon--left">shopping_cart</span>
                                Проекты
                                <span class="ml-auto sidebar-menu-toggle-icon"></span>
                            </a>
                            <ul class="sidebar-submenu collapse sm-indent" id="account_menu">
                                <li class="sidebar-menu-item">
                                    @isAllowed('project_create')
                                    <a class="sidebar-menu-button" href="{{route('createProject')}}">
                                        <span class="sidebar-menu-text">Создать проект</span>
                                    </a>
                                    @endisAllowed
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="{{route('projectManage')}}">
                                        <span class="sidebar-menu-text">Проекты</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                @endisAllowed
            </div>

{{--            <div class="sidebar-heading mt-3"><strong>Select company</strong></div>--}}
{{--            <a href="" class="dropdown-item active d-flex align-items-center">--}}

{{--                <div class="avatar avatar-sm mr-8pt">--}}

{{--                    <span class="avatar-title rounded bg-primary">FM</span>--}}

{{--                </div>--}}

{{--                <small class="ml-4pt flex">--}}
{{--                            <span class="d-flex flex-column">--}}
{{--                                <strong class="text-100">Какой то пункт, еоторый есть везде</strong>--}}
{{--                                <span class="text-50">Administrator</span>--}}
{{--                            </span>--}}
{{--                </small>--}}
{{--            </a>--}}
{{--            <a href="" class="dropdown-item d-flex align-items-center mb-3">--}}

{{--                <div class="avatar avatar-sm mr-8pt">--}}

{{--                    <span class="avatar-title rounded bg-accent">HH</span>--}}

{{--                </div>--}}

{{--                <small class="ml-4pt flex">--}}
{{--                            <span class="d-flex flex-column">--}}
{{--                                <strong class="text-100">HumaHuma Inc.</strong>--}}
{{--                                <span class="text-50">Publisher</span>--}}
{{--                            </span>--}}
{{--                </small>--}}
{{--            </a>--}}
        </div>

    </div>
</div>
