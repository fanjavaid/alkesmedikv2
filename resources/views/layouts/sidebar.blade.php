<aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          {{-- <div class="user-panel">
            <div class="pull-left image">
              <img src="{{ asset("/bower_components/admin-lte/dist/img/user2-160x160.jpg") }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>Alexander Pierce</p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div> --}}

          <!-- search form (Optional) -->
          {{-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form> --}}
          <!-- /.search form -->

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="active"><a href="#"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li class="header">CONTENT MANAGEMENT</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="treeview {{ (Request::segment(2) == 'category')? 'active' : '' }}">
              <a href="#"><i class="fa fa-clone"></i> <span>Category</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="{{ route('am-admin.category.index') }}">Categories</a></li>
                <li><a href="{{ route('am-admin.category.create') }}">Add New</a></li>
              </ul>
            </li>
            <li class="treeview {{ (Request::segment(2) == 'post')? 'active' : '' }}">
              <a href="#"><i class="fa fa-pencil-square-o"></i> <span>Post</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="{{ route('am-admin.post.index') }}">Posts</a></li>
                <li><a href="{{ route('am-admin.post.create') }}">Add New</a></li>
              </ul>
            </li>
            <li class="treeview {{ (Request::segment(2) == 'page')? 'active' : '' }}">
              <a href="#"><i class="fa fa-link"></i> <span>Page</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="{{ route('am-admin.page.index') }}">Pages</a></li>
                <li><a href="{{ route('am-admin.page.create') }}">Add New</a></li>
              </ul>
            </li>
            <li class="treeview {{ (Request::segment(2) == 'media')? 'active' : '' }}">
              <a href="#"><i class="fa fa-photo"></i> <span>Media</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="{{ route('am-admin.media.index') }}">Library</a></li>
                <li><a href="{{ route('am-admin.media.create') }}">Add New</a></li>
              </ul>
            </li>

            <li class="header">ECOMMERCE</li>
            <li class="treeview {{ (Request::segment(2) == 'product' || Request::segment(2) == 'attribute')? 'active' : '' }}">
              <a href=""><i class="fa fa-shopping-cart"></i> <span>Shop</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="{{ route('am-admin.product.index') }}">Products</a></li>
                <li><a href="{{ route('am-admin.product.create') }}">Add New</a></li>
                <li><a href="{{ route('am-admin.attribute.index') }}">Attributes</a></li>
                <li><a href="#">Categories</a></li>
                <li><a href="#" style="font-weight: bold">Orders <small class="label pull-right bg-red">3</small></a></li>
              </ul>
            </li>

            <li class="header">OTHER</li>
            <li class="treeview">
              <a href="#"><i class="fa fa-gear"></i> <span>Setting</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="#">User</a></li>
                <li><a href="#">Homepage</a></li>
              </ul>
            </li>
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>