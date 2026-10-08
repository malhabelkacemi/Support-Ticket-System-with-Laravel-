            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item nav-category">Menu</li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route("dashboard") }}">
                            <span class="icon-bg">
                                <i class="mdi mdi-cube menu-icon"></i>
                            </span>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>

                   {{--                     <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                            <span class="icon-bg">
                                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                            </span>
                            <span class="menu-title">Tickets</span>
                            <i class="menu-arrow"></i>
                        </a>

                        <div class="collapse" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="pages/ui-features/dropdowns.html">Dropdowns</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="pages/ui-features/typography.html">Typography</a>
                                </li>
                            </ul>
                        </div>
                    </li>
 --}}

                    <li class="nav-item">
                        <a class="nav-link" href="{{route("tickets.index") }}">
                            <span class="icon-bg">
                                <i class="mdi mdi-contacts menu-icon"></i>
                            </span>
                            <span class="menu-title">Tickets</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route("users.index") }}">
                            <span class="icon-bg">
                                <i class="mdi mdi-contacts menu-icon"></i>
                            </span>
                            <span class="menu-title">Users</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logs.index') }}">
                            <span class="icon-bg">
                                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                            </span>
                            <span class="menu-title">Ticket logs</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('categories.index') }}">
                            <span class="icon-bg">
                                <i class="mdi mdi-chart-bar menu-icon"></i>
                            </span>
                            <span class="menu-title">Categories</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('labels.index') }}">
                            <span class="icon-bg">
                                <i class="mdi mdi-table-large menu-icon"></i>
                            </span>
                            <span class="menu-title">Labels</span>
                        </a>
                    </li>

                    <li class="nav-item documentation-link">
                        <a class="nav-link" href="http://www.bootstrapdash.com/demo/connect-plus-free/jquery/documentation/documentation.html" target="_blank">
                            <span class="icon-bg">
                                <i class="mdi mdi-file-document-box menu-icon"></i>
                            </span>
                            <span class="menu-title">Support</span>
                        </a>
                    </li>

                </ul>
            </nav>
