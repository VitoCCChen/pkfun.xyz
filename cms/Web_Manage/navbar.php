        <!-- BEGIN Theme Setting -->
        <div id="theme-setting">
            <a href="#"><i class="icon-gears icon-2x"></i></a>
            <ul>
                <li>
                    <span>Skin</span>
                    <ul class="colors" data-target="body" data-prefix="skin-">
                        <li class="active"><a class="blue" href="#"></a></li>
                        <li><a class="red" href="#"></a></li>
                        <li><a class="green" href="#"></a></li>
                        <li><a class="orange" href="#"></a></li>
                        <li><a class="yellow" href="#"></a></li>
                        <li><a class="pink" href="#"></a></li>
                        <li><a class="magenta" href="#"></a></li>
                        <li><a class="gray" href="#"></a></li>
                        <li><a class="black" href="#"></a></li>
                    </ul>
                </li>
                <li>
                    <span>Navbar</span>
                    <ul class="colors" data-target="#navbar" data-prefix="navbar-">
                        <li class="active"><a class="blue" href="#"></a></li>
                        <li><a class="red" href="#"></a></li>
                        <li><a class="green" href="#"></a></li>
                        <li><a class="orange" href="#"></a></li>
                        <li><a class="yellow" href="#"></a></li>
                        <li><a class="pink" href="#"></a></li>
                        <li><a class="magenta" href="#"></a></li>
                        <li><a class="gray" href="#"></a></li>
                        <li><a class="black" href="#"></a></li>
                    </ul>
                </li>
                <li>
                    <span>Sidebar</span>
                    <ul class="colors" data-target="#main-container" data-prefix="sidebar-">
                        <li class="active"><a class="blue" href="#"></a></li>
                        <li><a class="red" href="#"></a></li>
                        <li><a class="green" href="#"></a></li>
                        <li><a class="orange" href="#"></a></li>
                        <li><a class="yellow" href="#"></a></li>
                        <li><a class="pink" href="#"></a></li>
                        <li><a class="magenta" href="#"></a></li>
                        <li><a class="gray" href="#"></a></li>
                        <li><a class="black" href="#"></a></li>
                    </ul>
                </li>
                <li>
                    <span></span>
                    <a data-target="navbar" href="#"><i class="icon-check-empty"></i> Fixed Navbar</a>
                    <a class="pull-right hidden-xs" data-target="sidebar" href="#"><i class="icon-check-empty"></i> Fixed Sidebar</a>
                </li>
            </ul>
        </div>
        <!-- END Theme Setting -->
        <!-- BEGIN Navbar -->
        <div id="navbar" class="navbar">
            <button type="button" class="navbar-toggle navbar-btn collapsed" data-toggle="collapse" data-target="#sidebar">
                <span class="icon-reorder"></span>
            </button>
            <a class="navbar-brand" href="#">
                <small>
                    <i class="icon-desktop"></i>
                    <?php echo $webname.$webmanagename?>
                </small>
            </a>

            <!-- BEGIN Navbar Buttons -->
            <ul class="nav flaty-nav pull-right">


                <!-- BEGIN Button User -->
                <li class="user-profile">
                    <a data-toggle="dropdown" href="#" class="user-menu dropdown-toggle">
                        <img class="nav-user-photo" src="<?php echo $adminuser['pic']?>" alt="Penny's Photo" />
                        <span id="user_info">
                            <?php echo $adminuser['name']?>
                        </span>
                        <i class="icon-caret-down"></i>
                    </a>

                    <!-- BEGIN User Dropdown -->
                    <ul class="dropdown-menu dropdown-navbar" id="user_menu">
                        <li class="nav-header">
                            <i class="icon-time"></i>
                            <?php echo $langary_navbar['time']?> <?php echo $adminuser['time']?>
                        </li>


                        <li>
                            <?php
                                $all_datalink = "";
                                switch ($adminuser['type']){
                                    case '1':
                                        $all_datalink = "admin";
                                        break;
                                    case '2':
                                        $all_datalink = "admin_agent";
                                        break;
                                    case '3':
                                        $all_datalink = "agents_data";
                                        break;
                                    case '4':
                                        $all_datalink = "agents_service";
                                        break;
                                }
                            ?>
                            <a href="javascript:void(0)" onclick="openBox('../<?php echo $all_datalink;?>/manage.php?username=<?php echo $adminuser['username']?>&index_type=1')">
                                <i class="icon-user"></i>
                                <?php echo $langary_navbar['data']?>
                            </a>
                        </li>

                        <?php
                        unset($incary_lang[$user_lang]);
                        foreach ($incary_lang as $_lang_key => $_lang_val){
                        ?>
                        <li>
                            <a href="javascript:void(0)" lang="<?php echo $_lang_key; ?>" class="lang">
                                <i class="icon-globe"></i>
                                <?php echo $_lang_val; ?>
                            </a>
                        </li>
                        <?php }?>
                        <li class="divider"></li>

                        <li>
                            <a href="../loginout.php">
                                <i class="icon-off"></i>
                                <?php echo $langary_navbar['loginout']?>
                            </a>
                        </li>
                    </ul>
                    <!-- BEGIN User Dropdown -->
                </li>
                <!-- END Button User -->
            </ul>
            <!-- END Navbar Buttons -->
        </div>
        <!-- END Navbar -->