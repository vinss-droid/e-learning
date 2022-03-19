<nav class="navbar navbar-expand-lg shadow fixed-top " id="mynavbar">
    <div class="container">
        <a class="navbar-brand" href="/" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tels Learning">
            <img src="{{ asset('img/MyLogo.ico') }}" alt="" width="30" height="24" class="d-inline-block align-text-top">
            Tels-Learning
        </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/#" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Halaman Utama"><i class="fas fa-home"></i> Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/#about" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tentang Tels-Learning">Tentang</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/#mapel" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Mata Pelajaran"><i class="fas fa-book"></i> Mapel</a>
          </li>
          @guest
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Login"><i class="fas fa-sign-in-alt"></i> Masuk</a>
            </li>
          @else
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="far fa-user-circle"></i> {{ ucwords(Auth::user()->name) }}
              </a>
              <ul class="dropdown-menu mt-2" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="
                  @if (Auth::user()->level == 'admin')
                    {{ route('dashboardAdmin') }}
                  @elseif(Auth::user()->level == 'guru')
                    {{ route('dashboardGuru') }}
                  @else
                    #
                  @endif
                ">Dashboard</a>
              </li>
                <li><a class="dropdown-item" href="#">Tugas Saya</a></li>
                <li>
                  <a class="dropdown-item" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                      Logout
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                  </form>
                </li>
              </ul>
            </li>
          @endguest
          {{-- <li>
              <a href="#" class="btn btn-outline-warning btn-login">Login</a>
          </li> --}}
        </ul>
      </div>
    </div>
  </nav>