<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
      <li class="treeview dah">
        <a href="{{ url('/home') }}">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>


      <li class="treeview" >
        <a href="#">
          <i class="fa fa-archive"></i>
          <span>Manage Product</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          @if(Auth::user()->can('create_product'))
          <li><a href="{{ url('/manage-products/create') }}"><i class="fa fa-circle-o"></i> Add Product</a></li>
          @endif
          <li><a href="{{ url('/manage-products') }}"><i class="fa fa-circle-o"></i> Available Products</a></li>
          @if(Auth::user()->can('create_category'))
          <li><a href="{{ url('/product-categories/create') }}"><i class="fa fa-circle-o"></i> Add Category</a></li>
          @endif
          <li><a href="{{ url('/product-categories') }}"><i class="fa fa-circle-o"></i> Available Categories</a></li>
        </ul>
      </li>

    <li class="treeview">
        <a href="#">
          <i class="fa fa-euro"></i>
        @if(Auth::user()->can('create_price') || Auth::user()->can('edit_price'))
          <span>Manage Price</span>
        @else
          <span>Product Prices</span>
        @endif
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
        @if(Auth::user()->can('create_price'))
          <li><a href="{{ url('/manage-prices/create') }}"><i class="fa fa-circle-o"></i> Add Product Price</a></li>
        @endif
          <li><a href="{{ url('/manage-prices') }}"><i class="fa fa-circle-o"></i> View Products Prices</a></li>
        </ul>
      </li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-user"></i>
          @if(Auth::user()->can('create_user') || Auth::user()->can('edit_user'))
          <span>Manage User</span>
          @else
            <span>System User</span>
          @endif
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ url('/manage-users') }}"><i class="fa fa-circle-o"></i> View Users</a></li>
          @if(Auth::user()->can('create_user'))
          <li><a href="{{ url('/manage-users/create') }}"><i class="fa fa-circle-o"></i> Add User</a></li>
          @endif
        </ul>
      </li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-edit"></i>
          <span>Permissions and Roles</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ url('/manage-roles') }}"><i class="fa fa-circle-o"></i> User Roles</a></li>
          <li><a href="{{ url('/manage-permissions') }}"><i class="fa fa-circle-o"></i> User Permissions</a></li>
          {{-- Assign user permission --}}
          @if(Auth::user()->can('create_user') && Auth::user()->can('edit_user'))
          {{-- <li><a href="{{ url('/manage-permissions/permissions-to-entrust_role') }}"><i class="fa fa-circle-o"> </i> Assign Role Permission</a></li> --}}
          <li><a href="{{ '/manage-permissions/permissions-to-entrust_user' }}"><i class="fa fa-circle-o"> </i> Assign User Permission</a></li>
          @endif
        </ul>
      </li>

        <li class="treeview">
        <a href="#">
          <i class="fa fa-product-hunt"></i>
          <span>Manage Request</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ url('/manage-request/create') }}"><i class="fa fa-circle-o"></i> Add Request</a></li>
          <li><a href="{{ url('/manage-request') }}"><i class="fa fa-circle-o"></i> Available Requests</a></li>
          @if(Auth::user()->can('confirm_request'))
          <li><a href="{{ url('/manage-requests/confirmed-requests') }}"><i class="fa fa-circle-o"></i> Confirmed Requests</a></li>
          @endif
        </ul>
      </li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-building"></i>
          @if(Auth::user()->can('create_store'))
          <span>Manage Store</span>
          @else
            <span>Stores</span>
          @endif
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ url('/product-store') }}"><i class="fa fa-circle-o"></i> Available Stores</a></li>
          @if(Auth::user()->can('create_store'))
          <li><a href="{{ url('/product-store/create') }}"><i class="fa fa-circle-o"></i> Add Store</a></li>
          @endif
        </ul>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->

  <div class="textId">

  </div>
</aside>
