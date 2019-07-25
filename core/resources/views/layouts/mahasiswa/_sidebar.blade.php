<aside class="sidebar">
    <div class="user-profile">
        <a href="">
            <img src="{{asset('foto/'.Auth::user()->mahasiswa->foto)}}" alt="">
        </a>
        <h3>{{Auth::user()->mahasiswa->nama}}<span>{{Auth::user()->nim}}</span></h3>
        <p>
        <a href="{{url('/mahasiswaprofile/'.Auth::user()->mahasiswa->id.'/profile')}}"><i class="fa fa-gear" aria-hidden="true"></i>Lihat Profile</a>
            <!--<a href="#"><i class="fa fa-unlock-alt" aria-hidden="true"></i>Password</a>-->
        </p>
        <a class="btn theme-btn btn-block" href="{{url('dashboard')}}">Dashboard</a>
        <a class="btn theme-btn btn-block" href="{{url('pinjamkelas')}}">Jadwal Peminjaman</a>
        <a class="btn theme-btn btn-block" href="{{url('statuspinjam')}}">Status Peminjaman</a>
        <a class="btn theme-btn btn-block" href="{{url('riwayatpinjaman')}}">Riwayat Peminjaman</a>
        <a class="btn theme-btn btn-block" href="{{url('logout')}}">Sign out</a>
    </div>
</aside>