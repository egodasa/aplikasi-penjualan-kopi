<div class="navbar-header">
                <a class="navbar-brand home" href="{{ base_url() }}" data-animate-hover="bounce">
                    <img src="{{ base_url() }}assets/img/logo.png" alt="Solok Radja logo" class="hidden-xs">
                    <img src="{{ base_url() }}assets/img/logo-small.png" alt="Solok Radja logo" class="visible-xs"><span class="sr-only">Solok Radja - go to homepage</span>
                </a>
                <div class="navbar-buttons">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <i class="fa fa-align-justify"></i>
                    </button>
                    <a class="btn btn-default navbar-toggle" href="{{ site_url('keranjang') }}">
                        <i class="fa fa-shopping-cart"></i>  <span class="hidden-xs">3 items in cart</span>
                    </a>
                </div>
            </div>
            <!--/.navbar-header -->

            <div class="navbar-collapse collapse" id="navigation">

                <ul class="nav navbar-nav navbar-left">
                    <li><a href="{{ base_url() }}">Beranda</a></li>
                    
                    @if(isset($_SESSION['username']))
                      <li class="nav-item dropdown"><a href="javascript: void(0)" data-toggle="dropdown" class="dropdown-toggle" aria-expanded="false">Menu <b class="caret"></b></a>
                      <ul class="dropdown-menu">
                        @if($_SESSION['akses_level'] == "Admin")
                          <li class="dropdown-item"><a href="{{ site_url('kategori') }}" class="nav-link"><i class="fa fa-list"></i> Data Kategori</a></li>
                          <li class="dropdown-item"><a href="{{ site_url('kopi') }}" class="nav-link"><i class="fa fa-list"></i> Data Kopi</a></li>
                          <li class="dropdown-item"><a href="{{ site_url('user') }}" class="nav-link"><i class="fa fa-list"></i> Data User</a></li>
                          <li class="dropdown-item"><a href="{{ site_url('pemesanan') }}" class="nav-link"><i class="fa fa-list"></i> Data Pemesanan</a></li>
                          <li class="dropdown-item"><a href="{{ site_url('laporan-kopi') }}" class="nav-link"><i class="fa fa-list"></i> Laporan Kopi</a></li>
                          <li class="dropdown-item"><a href="{{ site_url('laporan-pemesanan') }}" class="nav-link"><i class="fa fa-list"></i> Laporan Penjualan</a></li>
                        @else
                          <li class="dropdown-item"><a href="{{ site_url('pemesanan') }}" class="nav-link"><i class="fa fa-list"></i> Data Pemesanan</a></li>
                        @endif
                        <li class="dropdown-item"><a href="{{ site_url('logout') }}" class="nav-link"><i class="fa fa-sign-out"></i> Logout</a></li>
                      </ul>
                    @else
                      <li><a href="#" onclick="showModal('#modal-login')">Login</a></li>
                      <li><a href="#" onclick="showModal('#modal-registrasi')">Registrasi</a></li>
                    @endif
                </ul>
            </div>
            <!--/.nav-collapse -->
            <div class="navbar-buttons">
              @if(isset($_SESSION['username']))
                @if($_SESSION['akses_level'] == "Member")
                  <div class="navbar-collapse collapse right" id="basket-overview">
                    <a href="{{ site_url('keranjang') }}" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i><span class="hidden-sm">Keranjang Belanja</span></a>
                  </div>
                @endif
              @endif
            </div>
