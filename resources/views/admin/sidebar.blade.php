<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li class="header"><h2>Menu</h2></li>
      <!-- Optionally, you can add icons to the links -->
      <li><a href="{{route('danh-sach-phong')}}"><span>Phòng ban</span></a></li>
      <li><a href="{{route('danh-sach-nhom')}}"><span>Nhóm</span></a></li>
      <li><a href="{{route('danh-sach-nhan-vien')}}"><span>Nhân viên</span></a></li>
      {{--<li><a href="{{route('danh-sach-nhom-nhan-vien')}}"><span>Nhóm Nhân viên</span></a></li>--}}

     <!--  <li class="treeview">
        <a href="#"><span>Multilevel</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="#">User</a></li>
          <li><a href="#">Link in level 2</a></li>
        </ul>
      </li> -->
    </ul><!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>