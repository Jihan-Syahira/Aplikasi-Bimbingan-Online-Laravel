<nav class="sidebar sidebar-offcanvas dynamic-active-class-disabled" id="sidebar">
  <ul class="nav">
    @if(Auth::user()->level == 'Admin')
    <li class="nav-item {{ (request()->is('admin/dashboard')) ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('admin.dashboard')}}">
        <i class="menu-icon mdi mdi-television"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item {{ (request()->is('admin/data/*')) ? 'active' : '' }}">
      <a class="nav-link" data-toggle="collapse" href="#data"  aria-controls="data">
        <i class="menu-icon mdi mdi-clipboard-text"></i>
        <span class="menu-title">Data Bimbingan</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ (request()->is('admin/data/*')) ? 'show' : '' }}" id="data">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item {{ (request()->is('admin/data/bimbingan/kerja_praktik')) ? 'active' : '' }}{{ (request()->is('admin/data/bimbingan/kerja_praktik/*')) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.bimbingan.kp') }}">Kerja Praktik</a>
          </li>
          <li class="nav-item {{ (request()->is('admin/data/bimbingan/pengajuan_judul')) ? 'active' : '' }}{{ (request()->is('admin/data/bimbingan/pengajuan_judul/*')) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.bimbingan.pengajuan') }}">Pengajuan Tugas Akhir</a>
          </li>
          <li class="nav-item {{ (request()->is('admin/data/bimbingan/tugas_akhir')) ? 'active' : '' }}{{ (request()->is('admin/data/bimbingan/tugas_akhir/*')) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.bimbingan.ta') }}">Tugas Akhir</a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item {{ (request()->is('admin/user/*')) ? 'active' : '' }}">
      <a class="nav-link" data-toggle="collapse" href="#user"  aria-controls="user">
        <i class="menu-icon mdi mdi-account-group"></i>
        <span class="menu-title">User</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ (request()->is('admin/user/*')) ? 'show' : '' }}" id="user">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item {{ (request()->is('admin/user/dosen')) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.user.dosen') }}">Dosen</a>
          </li>
          <li class="nav-item {{ (request()->is('admin/user/mahasiswa')) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.user.mahasiswa') }}">Mahasiswa</a>
          </li>
          <li class="nav-item {{ (request()->is('admin/user/other')) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.user.other') }}">Other</a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item {{ (request()->is('admin/jadwal')) ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('admin.jadwal')}}">
        <i class="menu-icon mdi mdi-calendar"></i>
        <span class="menu-title">Jadwal Bimbingan</span>
      </a>
    </li>
    @elseif(Auth::user()->level == 'Dosen')
    <li class="nav-item {{ (request()->is('dosen/dashboard')) ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('dosen.dashboard')}}">
        <i class="menu-icon mdi mdi-television"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item {{ (request()->is('dosen/data/*')) ? 'active' : '' }}">
      <a class="nav-link" data-toggle="collapse" href="#data"  aria-controls="data">
        <i class="menu-icon mdi mdi-clipboard-text"></i>
        <span class="menu-title">Data Bimbingan</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ (request()->is('dosen/data/*')) ? 'show' : '' }}" id="data">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item {{ (request()->is('dosen/data/bimbingan/kerja_praktik')) ? 'active' : '' }}{{ (request()->is('dosen/data/bimbingan/kerja_praktik/*')) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dosen.bimbingan.kp') }}">Kerja Praktik</a>
          </li>
          <li class="nav-item {{ (request()->is('dosen/data/bimbingan/pengajuan_judul')) ? 'active' : '' }}{{ (request()->is('dosen/data/bimbingan/pengajuan_judul/*')) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dosen.bimbingan.pengajuan') }}">Pengajuan Tugas Akhir</a>
          </li>
          <li class="nav-item {{ (request()->is('dosen/data/bimbingan/tugas_akhir')) ? 'active' : '' }}{{ (request()->is('dosen/data/bimbingan/tugas_akhir/*')) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dosen.bimbingan.ta') }}">Tugas Akhir</a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item {{ (request()->is('dosen/mahasiswa')) ? 'active' : '' }}{{ (request()->is('dosen/mahasiswa/*')) ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('dosen.mahasiswa')}}">
        <i class="menu-icon mdi mdi-account-group"></i>
        <span class="menu-title">Mahasiswa Bimbingan</span>
      </a>
    </li>
    <li class="nav-item {{ (request()->is('dosen/jadwal')) ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('dosen.jadwal')}}">
        <i class="menu-icon mdi mdi-calendar"></i>
        <span class="menu-title">Atur Jadwal Bimbingan</span>
      </a>
    </li>
    <li class="nav-item {{ (request()->is('dosen/profile')) ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('dosen.profile')}}">
        <i class="menu-icon mdi mdi-account"></i>
        <span class="menu-title">Profile</span>
      </a>
    </li>
    @else
    <li class="nav-item {{ (request()->is('mahasiswa/dashboard')) ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('mahasiswa.dashboard')}}">
        <i class="menu-icon mdi mdi-television"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item {{ (request()->is('mahasiswa/data/*')) ? 'active' : '' }}">
      <a class="nav-link" data-toggle="collapse" href="#data"  aria-controls="data">
        <i class="menu-icon mdi mdi-clipboard-text"></i>
        <span class="menu-title">Data Bimbingan</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ (request()->is('mahasiswa/data/*')) ? 'show' : '' }}" id="data">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item {{ (request()->is('mahasiswa/data/bimbingan/kerja_praktik')) ? 'active' : '' }}{{ (request()->is('mahasiswa/data/bimbingan/kerja_praktik/*')) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('mahasiswa.bimbingan.kp') }}">Kerja Praktik</a>
          </li>
          <li class="nav-item {{ (request()->is('mahasiswa/data/bimbingan/pengajuan_judul')) ? 'active' : '' }}{{ (request()->is('mahasiswa/data/bimbingan/pengajuan_judul/*')) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('mahasiswa.bimbingan.pengajuan') }}">Pengajuan Tugas Akhir</a>
          </li>
          <li class="nav-item {{ (request()->is('mahasiswa/data/bimbingan/tugas_akhir')) ? 'active' : '' }}{{ (request()->is('mahasiswa/data/bimbingan/tugas_akhir/*')) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('mahasiswa.bimbingan.ta') }}">Tugas Akhir</a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item {{ (request()->is('mahasiswa/history')) ? 'active' : '' }}{{ (request()->is('mahasiswa/jadwal/*')) ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('mahasiswa.history')}}">
        <i class="menu-icon mdi mdi-calendar"></i>
        <span class="menu-title">History Bimbingan</span>
      </a>
    </li>
    <li class="nav-item {{ (request()->is('mahasiswa/jadwal')) ? 'active' : '' }}{{ (request()->is('mahasiswa/jadwal/*')) ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('mahasiswa.jadwal')}}">
        <i class="menu-icon mdi mdi-calendar"></i>
        <span class="menu-title">Jadwal Bimbingan</span>
      </a>
    </li>
    <li class="nav-item {{ (request()->is('mahasiswa/profile')) ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('mahasiswa.profile')}}">
        <i class="menu-icon mdi mdi-account"></i>
        <span class="menu-title">Profile</span>
      </a>
    </li>
    @endif
  </ul>
</nav>