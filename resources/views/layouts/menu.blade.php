<!-- 메뉴 리스트 -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                로고
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">샵캐스트</span>
        </a>


        {{--        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">--}}
        {{--            <i class="bx bx-chevron-left bx-sm align-middle"></i>--}}
        {{--        </a>--}}
    </div>
    <div class="app-brand demo">
        <a
            class="github-button"
            href="{{route('index')}}"
            data-icon="octicon-star"
            data-size="large"
            data-show-count="true"
            aria-label="Star themeselection/sneat-html-admin-template-free on GitHub"
        >홈</a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        {{--        <li class="menu-item active">--}}
        {{--            <a href="index.html" class="menu-link">--}}
        {{--                <i class="menu-icon tf-icons bx bx-home-circle"></i>--}}
        {{--                <div data-i18n="Analytics">Dashboard</div>--}}
        {{--            </a>--}}
        {{--        </li>--}}

        {{--        href="{{route("excelImport")}}"--}}
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">정산관리</span>
        </li>
        <li class="menu-item active">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">이용료 청구</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item ">
                    <a href="{{route('chargeMemberRegist')}}" class="menu-link">
                        <div data-i18n="Account">청구 대상 등록</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{route('chargeNonMemberRegist')}}" class="menu-link">
                        <div data-i18n="Notifications">비회원 청구 대상 등록</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="pages-account-settings-connections.html" class="menu-link">
                        <div data-i18n="Connections">청구 대상 조회</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item ">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">계산서</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item active">
                    <a href="{{route('billIssue')}}" class="menu-link ">
                        <div data-i18n="Account">계산서 발행 조회</div>
                    </a>
                    <a href="{{route('billForm')}}" class="menu-link">
                        <div data-i18n="Account">계산서 양식 출력</div>
                    </a>
                    <a href="{{route('printBillForm')}}" class="menu-link">
                        <div data-i18n="Account">계산서 양식 출력 내역 View(임시)</div>
                    </a>
                    <a href="#" class="menu-link">
                        <div data-i18n="Account">통합 징수 출력</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                <div data-i18n="Authentications">입금내역</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{route('depositHistory')}}" class="menu-link" target="_blank">
                        <div data-i18n="Basic">입금내역 등록 히스토리</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{route('depositSearch')}}" class="menu-link" target="_blank">
                        <div data-i18n="Basic">입금내역 등록, 조회</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{route('depositMatch')}}" class="menu-link" target="_blank">
                        <div data-i18n="Basic">입금내역 매칭</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                <div data-i18n="Misc">미수금</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="pages-misc-error.html" class="menu-link">
                        <div data-i18n="Error">미수금 조회</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="pages-misc-error.html" class="menu-link">
                        <div data-i18n="Error">이용료 납부 안내</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">기능샘플</span>
        </li>
        <li class="menu-item">
            <a href="{{route('oracleConnection')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-table"></i>
                <div data-i18n="Tables">오라클</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                <div data-i18n="Misc">Ui 관련</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{route('dataTables')}}" class="menu-link">
                        <div data-i18n="Error">데이터테이블</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="pages-misc-under-maintenance.html" class="menu-link">
                        <div data-i18n="Under Maintenance">Under Maintenance</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="{{route("excelImport")}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-table"></i>
                <div data-i18n="Tables">엑셀 등록</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route("excelExportProcess")}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-table"></i>
                <div data-i18n="Tables">엑셀 다운로드</div>
            </a>
        </li>
    </ul>
</aside>
<!-- / Menu -->

<!-- User 정보 -->
<div class="layout-page">
    <!-- Navbar -->
    <nav
        class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
        id="layout-navbar">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>

        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Search -->
            <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                    <i class="bx bx-search fs-4 lh-0"></i>
                    <input
                        type="text"
                        class="form-control border-0 shadow-none"
                        placeholder="Search..."
                        aria-label="Search..."
                    />
                </div>
            </div>
            <!-- /Search -->
            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->
                <li class="nav-item lh-1 me-3">
                    <a
                        class="github-button"
                        href="https://github.com/themeselection/sneat-html-admin-template-free"
                        data-icon="octicon-star"
                        data-size="large"
                        data-show-count="true"
                        aria-label="Star themeselection/sneat-html-admin-template-free on GitHub"
                    >Star</a
                    >
                </li>

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <div class="avatar avatar-online">
                            <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar avatar-online">
                                            <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="fw-semibold d-block">John Doe</span>
                                        <small class="text-muted">Admin</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bx bx-user me-2"></i>
                                <span class="align-middle">My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bx bx-cog me-2"></i>
                                <span class="align-middle">Settings</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                        <span class="d-flex align-items-center align-middle">
                          <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                          <span class="flex-grow-1 align-middle">Billing</span>
                          <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                        </span>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{route('logout')}}" >
                                <i class="bx bx-power-off me-2"></i>
                                <span class="align-middle">Log Out</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--/ User -->
            </ul>
        </div>
    </nav>

    <!-- / Navbar -->
    <div class="content-wrapper">
