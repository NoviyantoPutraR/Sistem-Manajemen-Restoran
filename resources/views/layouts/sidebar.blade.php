<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-profile">
        <a href="#" class="nav-link">
          <div class="nav-profile-image">
            <img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="profile">
            <span class="login-status online"></span>
            <!--change to offline or busy as needed-->
          </div>
          <div class="nav-profile-text d-flex flex-column">
            <span class="font-weight-bold mb-2">{{ Str::upper(Auth::user()->name) }}</span>
            <span class="text-secondary text-small">{{ Str::upper(Auth::user()->role) }}</span>
          </div>
          <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('dashboard')}}">
          <span class="menu-title">Dashboard</span>
          <i class="mdi mdi-home menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <span class="menu-title">Pengeluaran</span>
          <i class="menu-arrow"></i>
          <i class="mdi mdi-currency-usd menu-icon"></i>
      </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{route('daftarPembelian')}}">Pembelian Bahan Baku</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Pengeluaran Resto</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pages/icons/mdi.html">
          <span class="menu-title">Icons</span>
          <i class="mdi mdi-contacts menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pages/forms/basic_elements.html">
          <span class="menu-title">Forms</span>
          <i class="mdi mdi-format-list-bulleted menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pages/charts/chartjs.html">
          <span class="menu-title">Charts</span>
          <i class="mdi mdi-chart-bar menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pages/tables/basic-table.html">
          <span class="menu-title">Tables</span>
          <i class="mdi mdi-table-large menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
          <span class="menu-title">Data Master</span>
          <i class="menu-arrow"></i>
          <i class="mdi mdi-food-fork-drink menu-icon"></i>
        </a>
        <div class="collapse" id="general-pages">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{route('daftarMenu')}}"> Menu </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Pelanggan </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> Metode Pembayaran </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Bahan Baku </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> Meja </a></li>
            
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui" aria-expanded="false" aria-controls="ui">
          <span class="menu-title">Settings Resto</span>
          <i class="menu-arrow"></i>
          <i class="mdi mdi-format-list-bulleted menu-icon"></i>
        </a>
        <div class="collapse" id="ui">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{route('daftarUser')}}">Manajemen User</a></li>           
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <form id="logout-form" action="{{route('logout')}}" method="post">
            @csrf
        </form>
        <a href="#"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            role="button" class="nav-link">
            <span class="menu-title">Logout</span>

                <i class="nav-icon fa fa-sign-out menu-icon"></i>
            </a>
        </li>
    </ul>
</nav>
