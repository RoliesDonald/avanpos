<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('AdminLTE-2/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-right info">
                <p><b>{{ auth()->user()->name }}</b></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li>
                <a href=" {{ route('dashboard') }} "><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cubes"></i>
                    <span>Master Data</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href=" {{ route('kategori.index') }}"><i class="fa fa-circle-o"></i> Kategori</a>
                    </li>
                    <li>
                        <a href="{{ route('produk.index') }}"><i class="fa fa-circle-o"></i> Produk</a>
                    </li>
                    <li>
                        <a href="{{ route('member.index') }}"><i class="fa fa-circle-o"></i> Karyawan</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-circle-o"></i> Suplier</a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-arrows-h"></i>
                    <span>Transaksi</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="#"><i class="fa fa-circle-o"></i> Transaksi
                            Pembelian</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-circle-o"></i> Daftar Pembelian</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-circle-o"></i> Transaksi
                            Pembelian</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-circle-o"></i> Daftar Penjualan</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-circle-o"></i> Transaksi
                            Penjualan</a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-paperclip"></i>
                    <span>Laporan</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="#"><i class="fa fa-circle-o"></i> Laporan Gudang</a>
                    </li>
                </ul>
            </li>
            <li class="header">MISC</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cog"></i>
                    <span>Pengaturan</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="#"><i class="fa fa-circle-o"></i> User</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-circle-o"></i> Setting</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-circle-o"></i> Profile</a>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
