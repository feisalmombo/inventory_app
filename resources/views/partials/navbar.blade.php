<div class="navbar-custom-menu">
  <ul class="nav navbar-nav">
    <!-- Messages: style can be found in dropdown.less-->
  @if(\Auth::user()->hasRole('administrator') || \Auth::user()->hasRole('stock_manager'))
    <!-- Notifications: style can be found in dropdown.less -->
    <li class="dropdown notifications-menu">
      <a href="#" id="requestCount" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-bell-o"></i>
        <span class="label label-danger" id="requestCountSpan"></span>
      </a>
      <ul class="dropdown-menu">
        <li class="header"><strong> Requested Products to confirm!!</strong></li>
        <li>
          <!-- inner menu: contains the actual data -->
          <ul class="menu" id ='proConf'>

          </ul>
        </li>
        <li class="footer"><a href="{{ url('/manage-request') }}">View all</a></li>
      </ul>
    </li>
    <!-- Tasks: style can be found in dropdown.less -->
    @endif


    @if(\Auth::user()->hasRole('administrator') || \Auth::user()->hasRole('finance'))
    <!-- Notifications: style can be found in dropdown.less -->
    <li class="dropdown notifications-menu">
      <a href="#" id="addPrice" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-bell-o"></i>
        <span class="label label-warning" id="addPriceSpan"></span>
      </a>
      <ul class="dropdown-menu">
        <li class="header"><strong>Products for Adding Price</strong></li>
        <li>
          <!-- inner menu: contains the actual data -->
          <ul class="menu" id ='proPrice'>

          </ul>
        </li>
        <li class="footer"><a href="{{ url('/manage-prices/create') }}">View all</a></li>
      </ul>
    </li>
    <!-- Tasks: style can be found in dropdown.less -->
    @endif

<!-- User Account: style can be found in dropdown.less -->
<li class="dropdown user user-menu">
   
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
   

    <span class="hidden-xs">{{ ucfirst(Auth::user()->first_name)." ".ucfirst(Auth::user()->last_name) }}</span>
  </a>
  <ul class="dropdown-menu">

    <!-- Menu Footer-->
    <li class="user-footer">
      <div>
        <a href="{{ url('/change-password') }}"><i class="fa fa-gear fa-fw"></i> Change Password</a>
      </div>
      <div>
        <a href="{{ route('logout') }}"
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
        <i class="fa fa-sign-out fa-fw"></i>Logout
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
      </form>

    </div>
  </li>
</ul>
</li>
</ul>
</div>
