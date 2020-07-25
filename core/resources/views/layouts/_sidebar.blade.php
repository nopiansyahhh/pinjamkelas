<ul class="nav">                       
          <li class="active">
            <a class="" href="{{url('/admindashboard')}}">
              <i class="fa fa-th-large"></i>&nbsp;&nbsp;&nbsp;<span>Dashboard</span><span class="sr-only"></span>
            </a>
          </li>
          @if(Auth::user()->role == 'administrator')
          <li class="">
            <a class="" href="{{url('/adminlist')}}">
              <i class="fa fa-user-md"></i>
              </i>&nbsp;&nbsp;&nbsp;<span>Data Admin</span><span class="sr-only"></span>
            </a>
          </li>
          
          <li class="">
            <a class="" href="{{url('/datamahasiswa')}}">
              <i class="fa fa-users"></i>
              </i>&nbsp;&nbsp;&nbsp;<span>Data Mahasiswa</span><span class="sr-only"></span>
            </a>
          </li>
          @endif
          <li class="">
            <a class="" href="{{url('datagedung')}}">
              <i class="fa fa-building-o"></i>
              </i>&nbsp;&nbsp;&nbsp;<span>Data Gedung</span><span class="sr-only"></span>
            </a>
          </li>
          <li class="">
            <a class="nav-link" href="{{url('dataruangan')}}">
              <i class="fa fa-cube"></i>
              </i>&nbsp;&nbsp;&nbsp;<span>Data Ruangan</span><span class="sr-only"></span>
            </a>
          </li>
          <li class="">
            <a class="nav-link" href="{{url('pinjamkelas')}}">
              <i class="fa fa-list"></i>
              </i>&nbsp;&nbsp;&nbsp;<span>Jadwal Peminjaman</span><span class="sr-only"></span>
            </a>
          </li>
          <li class="">
            <a class="nav-link" href="{{url('statuspinjam')}}">
              <i class="fa fa-check-square-o"></i>
              </i>&nbsp;&nbsp;&nbsp;<span>Status Peminjaman</span><span class="sr-only"></span>
            </a>
          </li>
          <li class="">
            <a class="nav-link" href="{{route('dosendata')}}">
              <i class="fa fa-check-square-o"></i>
              </i>&nbsp;&nbsp;&nbsp;<span>Data Dosen</span><span class="sr-only"></span>
            </a>
          </li>
          <li class="">
            <a class="nav-link" href="{{url('datamatkul')}}">
              <i class="fa fa-check-square-o"></i>
              </i>&nbsp;&nbsp;&nbsp;<span>Data Matkul</span><span class="sr-only"></span>
            </a>
          </li>
          <li class="">
            <a class="nav-link" href="{{url('dataabsen')}}">
              <i class="fa fa-check-square-o"></i>
              </i>&nbsp;&nbsp;&nbsp;<span>Data Absensi</span><span class="sr-only"></span>
            </a>
          </li>
           <li class="">
            <a class="nav-link" href="{{url('logout')}}">
              <i class="fa fa-sign-out"></i>
             </i>&nbsp;&nbsp;&nbsp;<span>Sign Out</span><span class="sr-only"></span>
            </a>
          </li>
</ul>