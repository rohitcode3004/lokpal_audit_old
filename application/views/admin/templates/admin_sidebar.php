                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li class="sidebar-search">
                                <div class="input-group custom-search-form">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                </span>
                                </div>
                                <!-- /input-group -->
                            </li>
                            <li>
                                <a href="#" class="active"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                            </li>
                        
                            <li>
                                <a href="#"><i class="fa fa-sitemap fa-fw"></i> Menus<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="<?php echo site_url('admin/view_menus') ?>">View Menus</a>
                                    </li>
                                    <li>
                                        <a href="#" id="create_menu">Create Menu</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('admin/add_submenu') ?>">Create Submenu</a>
                                    </li>
                                    <!--<li>
                                        <a href="#">Third Level <span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            <li>
                                                <a href="#">Third Level Item</a>
                                            </li>
                                            <li>
                                                <a href="#">Third Level Item</a>
                                            </li>
                                            <li>
                                                <a href="#">Third Level Item</a>
                                            </li>
                                            <li>
                                                <a href="#">Third Level Item</a>
                                            </li>
                                        </ul>-->
                                        <!-- /.nav-third-level -->
                                    <!--</li>-->
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>

                            <li>
                                <a href="#"><i class="fa fa-sitemap fa-fw"></i> Roles<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="<?php echo site_url('admin/view_roles') ?>">View Roles</a>
                                    </li>
                                    <li>
                                        <a href="#" id="create_role">Add New Role</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>

                            <li>
                                <a href="#"><i class="fa fa-sitemap fa-fw"></i> Staff Users<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="<?php echo site_url('admin/view_users') ?>">View Users</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('admin/add_user') ?>" id="create_menu">Add New User</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>

                                                        <li>
                                <a href="#"><i class="fa fa-sitemap fa-fw"></i> Permissions<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="<?php echo site_url('admin/view_permissions') ?>">View Permissions</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('admin/add_perm') ?>">Add New Permission</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>

                        </ul>
                    </div>
                </div>