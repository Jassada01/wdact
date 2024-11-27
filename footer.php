<footer class="main-footer">
	<!-- To the right -->
	<div class="pull-right hidden-xs">
		<a href="https://www.facebook.com/groups/Watchdog.TAC1/" target="_blank"><i class="fa fa-facebook-square"> ศูนย์ปฎิบัติการหมาเฝ้าบ้าน</i> </a>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="https://www.facebook.com/Watchdog.ACT/" target="_blank"><i class="fa fa-facebook-square"> เพจปฎิบัติการหมาเฝ้าบ้าน</i> </a>
	</div>
	<!-- Default to the left -->
	<strong>Copyright &copy; <?php echo date("Y"); ?></strong> All rights reserved.
</footer>
  <!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
	<!-- Create the tabs -->
	<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
		<li  class="active"><a href="#sidebar_search_tab_case" data-toggle="tab"><i class="fa fa-gg"></i>  CASE</a></li>
		<li <?php echo $l2;?>><a href="#sidebar_search_tab" data-toggle="tab"><i class="fa fa-users"></i>  WD</a></li>
		
	</ul>
	
	<!-- Tab panes -->
	<div class="tab-content">
	<!-- Home tab content -->
		<div class="tab-pane" id="sidebar_search_tab" <?php echo $l2;?>>
			<form>
			<div class="input-group_2">
			  <input type="text" id="sidebar_search_text" style="color:#95abb7;background-color:#374850; border-color: transparent;border-radius: 6px;" class="form-control" placeholder="ค้นหา" autocomplete="off" />
			   <input type="text" style="display: none;">
			</div>
		  </form>
		  <h3 class="control-sidebar-heading">สมาชิกหมาเฝ้าบ้าน</h3>
		  <div id="sidebar_search_wd_result">
			
			</div>
			<!-- /.control-sidebar-menu -->
		  
		</div>
		
		<div class="tab-pane active" id="sidebar_search_tab_case" >
			<form>
			<div class="input-group">
			  <input type="text" id="sidebar_search_text_case" style="color:#95abb7;background-color:#374850; border-color: transparent;border-radius: 6px;"  class="form-control" placeholder="ค้นหา" autocomplete="off" />
			  <input type="text" style="display: none;">
			</div>
		  </form>
		  <h3 class="control-sidebar-heading">เคสการตรวจสอบทุจริต</h3>
		  <div id="sidebar_search_case_result">
			
			</div>
		</div>
	</div>

		

</aside>
<!-- Add the sidebar's background. This div must be placed
immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>