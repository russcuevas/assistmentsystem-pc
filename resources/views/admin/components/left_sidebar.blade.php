<aside id="leftsidebar" class="sidebar">
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="active">
                <a href="{{ route('admin.dashboard.page')}}">
                    <i class="material-icons">home</i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="">
                <a href="{{ route('admin.admin.management.page') }}">
                    <i class="material-icons">admin_panel_settings</i>
                    <span>Admin Management</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">groups</i>
                    <span>Examinees Management</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="{{ route('admin.default.id.page') }}">Default ID</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.examiners.page')}}">Examinees List</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">description</i>
                    <span>Assesstment Management</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="{{ route('admin.course.page') }}">Course</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.riasec.page')}}">Riasec</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.questionnaire.page')}}">Questionnaire</a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="exam_results.html">
                    <i class="material-icons">done_all</i>
                    <span>Exam Results</span>
                </a>
            </li>
            <li class="">
                <a href="{{ route('admin.analytics.page')}}">
                    <i class="material-icons">analytics</i>
                    <span>Analytics</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    @include('admin.components.footer')
    <!-- #Footer -->
</aside>