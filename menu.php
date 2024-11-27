<!-- Main Header -->

<header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>WD</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Watch_Dog</b></span>
    </a>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" id="toggle_sb_bt" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <?php
		$l1 = "";
		$l2 = "";
		$phpjume = "";
		switch ($user_level)
			{
				case 1 :
				{
					$l1 = ' style="display: none;"';
					break;
				}
				case 2 :
				{
					$l2 = ' style="display: none;"';
					$allow_page = array("10_case-add.php", "12_case-search.php","12_case-search_2.php",  "14_case_data.php", "34_profile_setup.php", "15_case_msg.php", "51_group_post.php", "61_page_post.php", "16_case_analysis.php");
					if (!(in_array($fn, $allow_page)))
					  {
						 $phpjume =  "<script>window.location.replace('12_case-search.php');</script>";
					  }
					break;
				}
			}
			

			
			include "connectionDb.php";
			//$sql = "Select a.case_id, b.topic From case_operator a INNER Join wd_case b ON a.case_id = b.case_id Where a.stf_kid = '$staff_key_id' AND b.status <=3";
			$sql = "Select * From (Select 'case' as type, a.case_id, b.topic, b.finished_date From case_operator a INNER Join wd_case b ON a.case_id = b.case_id Where a.stf_kid = $staff_key_id AND b.status not in (4, 5) UNION ALL Select type, task_id, title, end_dt From task_mng_h where kid = $staff_key_id and status = 0) a Order By a.finished_date";
			$res = $conn->query(trim($sql));
			$print_remain_case = "";
            mysqli_close($conn);
			$remain_case_cnt = 0;
			while ($row = $res->fetch_assoc()){
				if ($row['type'] == "case")
				{
					$print_remain_case .= '<li><a href="14_case_data.php?case_id='.$row['case_id'].'"><i class="fa fa-gg text-blue"></i> '.$row['topic'].'</a></li>';
				}
				else
				{
					$print_remain_case .= '<li><a><i class="fa fa-tasks text-red"></i> '.$row['topic'].'</a></li>';
				}
				
				$remain_case_cnt +=1 ;
			}
		?>
        <?php
		echo  $phpjume;
		?>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Notifications Menu -->
                <li class="messages-menu">
                    <a href="15_case_msg.php">
                        <i class="fa fa-envelope-o"></i>
                    </a>
                </li>
                <li class="dropdown notifications-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-danger"><?php echo $remain_case_cnt ;?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">คุณมี <?php echo $remain_case_cnt ;?> งานค้างอยู่</li>
                        <li>
                            <!-- Inner Menu: contains the notifications -->
                            <ul class="menu">
                                <?php echo $print_remain_case ;?>
                                <!-- end notification -->
                            </ul>
                        </li>
                        <li class="footer"><a href="12_case-search.php">View all</a></li>
                    </ul>
                </li>
                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="<?php echo $user_image;?>" class="user-image" alt="User Image">
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs"><?php  echo $user_name; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <img src="<?php echo $user_image;?>" class="img-circle" alt="User Image">
                            <p>
                                <?php  echo $user_name." - ". $Position; ?>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="34_profile_setup.php" class="btn btn-default btn-flat">โปรไฟล์</a>
                            </div>
                            <div class="pull-right">
                                <a href="login.php" class="btn btn-default btn-flat">ออกจากระบบ</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-search"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo $user_image;?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php  echo $user_name; ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> <?php  echo $Position; ?></a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <!-- Optionally, you can add icons to the links -->
            <li <?php  if ($fn=='index.php') {echo 'class = "active"';} ?> <?php echo $l2;?>><a href="index.php"
                    <?php echo $l2;?>><i class="fa fa-television"></i> <span>หน้า Dashboard</span></a></li>

            <li class="header"> <i class="fa fa-gg"></i> การตรวจสอบทุจริต</li>
            <li <?php  if ($fn=='10_case-add.php') {echo 'class = "active"';} ?>><a href="10_case-add.php"><i
                        class="fa fa-gg text-red"></i> <span>เคสใหม่</span></a></li>
            <li <?php  if ($fn=='12_case-search.php') {echo 'class = "active"';} ?>><a href="12_case-search.php"><i
                        class="fa fa-gg text-green"></i> <span>ค้นหา และ แก้ไข เคส</span></a></li>
			<li <?php  if ($fn=='51_group_post.php') {echo 'class = "active"';} ?>><a href="51_group_post.php"><i
                        class="fa fa-gg text-yellow"></i> <span>โพสในศูนย์</span></a></li>
            <li <?php  if ($fn=='61_page_post.php') {echo 'class = "active"';} ?>><a href="61_page_post.php"><i
                        class="fa fa-gg text-purple"></i> <span>โพสในเพจ</span></a></li>

            <li class="header" <?php echo $l2.$l1;?>> <i class="fa fa-users" <?php echo $l2;?>></i> อาสาสมัครหมา</li>
            <li <?php  if ($fn=='20_member-add.php') {echo 'class = "active"';} ?> <?php echo $l2.$l1;?>><a
                    href="20_member-add.php"><i class="fa fa-users text-red"></i> <span>เพิ่มอาสาสมัคร</span></a></li>
            <li <?php  if ($fn=='21_member-search.php') {echo 'class = "active"';} ?> <?php echo $l2.$l1;?>><a
                    href="21_member-search.php"><i class="fa fa-users text-green"></i> <span>ข้อมูลอาสาสมัคร</span></a>
            </li>


            <li class="header" <?php echo $l2;?>> <i class="fa fa-bar-chart"></i> ข้อมูลสถิติ</li>
            <li <?php  if ($fn=='40_page_static.php') {echo 'class = "active"';} ?> <?php echo $l2;?>><a
                    href="40_page_static.php"><i class="fa fa-bar-chart text-red"></i> <span>เพจ/Line</span></a></li>
            <li <?php  if ($fn=='41_post_static.php') {echo 'class = "active"';} ?> <?php echo $l2;?>><a
                    href="41_post_static.php"><i class="fa fa-bar-chart text-green"></i> <span>โพส</span></a></li>
            <li <?php  if ($fn=='43_case_static.php') {echo 'class = "active"';} ?> <?php echo $l2;?>><a
                    href="43_case_static.php"><i class="fa fa-bar-chart text-yellow"></i> <span>เคส</span></a></li>
            <li <?php  if ($fn=='42_member_static.php') {echo 'class = "active"';} ?> <?php echo $l2;?>><a
                    href="42_member_static.php"><i class="fa fa-bar-chart text-aqua"></i> <span>สมาชิก</span></a></li>
                    <li <?php  if ($fn=='45_Report.php') {echo 'class = "active"';} ?> <?php echo $l2;?>><a
                    href="45_Report.php"><i class="fa fa-file text-purple"></i> <span>Monthly Report</span></a></li>


            <li class="header" <?php echo $l2.$l1;?>> <i class="fa fa-link"></i> จัดการระบบ</li>
            <li <?php  if ($fn=='30_staff.php') {echo 'class = "active"';} ?> <?php echo $l2.$l1;?>><a
                    href="30_staff.php"><i class="fa fa-link text-red"></i> <span>ผู้ใช้งานระบบ</span></a></li>
            <li <?php  if ($fn=='31_team_manage.php') {echo 'class = "active"';} ?> <?php echo $l2.$l1;?>><a
                    href="31_team_manage.php"><i class="fa fa-link text-green"></i> <span>จัดการทีมหมา</span></a></li>
            <li <?php  if ($fn=='32_training_manage.php') {echo 'class = "active"';} ?> <?php echo $l2.$l1;?>><a
                    href="32_training_manage.php"><i class="fa fa-link text-yellow"></i> <span>จัดการการอบรม</span></a>
            </li>
            <li <?php  if ($fn=='33_yr_target.php') {echo 'class = "active"';} ?> <?php echo $l2.$l1;?>><a
                    href="33_yr_target.php"><i class="fa fa-link text-purple"></i> <span>เป้าหมายรายปี</span></a></li>
            <li <?php  if ($fn=='35_consent_management.php') {echo 'class = "active"';} ?> <?php echo $l2.$l1;?>><a
                    href="35_consent_management.php"><i class="fa fa-link text-aqua"></i> <span>PDPA</span></a></li>





        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>