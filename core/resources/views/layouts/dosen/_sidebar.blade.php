<ul class="nav">                       
          <li class="active">
            <a class="nav-link" href="{{route('dosendashboard')}}">
              <i class="fa fa-th-large"></i>&nbsp;&nbsp;&nbsp;<span>Dashboard</span><span class="sr-only"></span>
            </a>
          </li>
          @if(Auth::user()->role == 'dosen')
          <li class="">
            <a class="nav-link" href="{{route('dosendata')}}">
              <i class="fa fa-check-square-o"></i>
              </i>&nbsp;&nbsp;&nbsp;<span>Data Dosen</span><span class="sr-only"></span>
            </a>
          </li>
          <li class="">
            <a class="nav-link" href="{{route('dosenabsendetail')}}">
              <i class="fa fa-check-square-o"></i>
              </i>&nbsp;&nbsp;&nbsp;<span>Daftar Hadir Dosen</span><span class="sr-only"></span>
            </a>
          </li>
          <li class="">
            <a class="nav-link" href="{{url('/dosenmatkul')}}">
              <i class="fa fa-check-square-o"></i>
              </i>&nbsp;&nbsp;&nbsp;<span>Data Matkul</span><span class="sr-only"></span>
            </a>
          </li>
          <li class="">
            <a class="nav-link" href="{{url('/dosenabsen')}}">
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
          @endif
</ul>