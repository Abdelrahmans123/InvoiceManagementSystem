<div class="sidebar">
    <div class="logo-details">
        <i class="fa-solid fa-file-invoice"></i>
        <span class="logo_name">{{ trans('sidebar.InvoiceProgram') }}</span>
    </div>
    <ul class="nav-links">
        <li>
            <a href="{{ url('/' . $page='home') }}" class="link">
                <i class="fa-solid fa-house nav_icon"></i>
                <span class="link_name">{{ trans('sidebar.Dashboard') }}</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="{{ url('/' . $page='home') }}">{{ trans('sidebar.Dashboard') }}</a></li>
            </ul>
        </li>
        @can('الفواتير')
        <li>
            <div class="iocn-link">
                <a href="#">
                    <i class="fa-solid fa-file-invoice-dollar nav_icon"></i>
                    <span class="link_name">{{ trans('sidebar.Invoice') }}</span>
                </a>
                <i class="fa-solid fa-chevron-down nav_icon arrow"></i>
            </div>
            <ul class="sub-menu">
                <li><a href="#" class="link_name"> {{ trans('sidebar.Invoice') }}</a></li>
                @can('قائمة الفواتير')
                <li><a href="{{ url('/' . $page='invoices') }}" class="link">{{ trans('sidebar.InvoiceList') }}</a></li>
                @endcan
                @can('الفواتير المدفوعة')
                <li ><a href="{{ url('/' . $page='invoicePaid') }}" class="link">{{ trans('sidebar.PaidInvoice') }}</a></li>
                @endcan
                @can('الفواتير الغير مدفوعة')
                <li><a href="{{ url('/' . $page='invoiceUnpaid') }}" class="link">{{ trans('sidebar.UnpaidInvoice') }}</a></li>
                @endcan
                @can('الفواتير المدفوعة جزئيا')
                <li ><a href="{{ url('/' . $page='invoicePartialPaid') }}" class="link">{{ trans('sidebar.PaidpartialInvoice') }}</a></li>
                @endcan
                @can('ارشيف الفواتير')
                <li ><a href="{{ url('/' . $page='archiveInvoice') }}" class="link" >{{ trans('sidebar.ArchiveInvoice') }}</a></li>
                @endcan
            </ul>
        </li>
        @endcan
        <li>
            <div class="iocn-link">
                <a href="#">
                    <i class="fa-solid fa-clipboard nav_icon"></i>
                    <span class="link_name">{{ trans('sidebar.Reports') }}</span>
                </a>
                <i class="fa-solid fa-chevron-down nav_icon arrow"></i>
            </div>
            <ul class="sub-menu">
                <li class="link"><a href="#" class="link_name" > {{ trans('sidebar.Reports') }}</a></li>
                <li class="link"><a href="#" >{{ trans('sidebar.InvoiceReport') }}</a></li>
                <li class="link"><a href="#" > {{ trans('sidebar.CustomerReport') }}</a></li>
            </ul>
        </li>
        <li>
            <div class="iocn-link">
                <a href="#">
                    <i class="fa-sharp fa-solid fa-users nav_icon"></i>
                    <span class="link_name">{{ trans('sidebar.Users') }}</span>
                </a>
                <i class="fa-solid fa-chevron-down nav_icon arrow"></i>
            </div>
            <ul class="sub-menu">
                <li  class="link"><a href="#" class="link_name" > {{ trans('sidebar.Users') }}</a></li>
                <li class="link"><a href="#" > {{ trans('sidebar.UsersList') }}</a></li>
                <li class="link"><a href="#" > {{ trans('sidebar.UsersRole') }}</a></li>
            </ul>
        </li>
        <li class="link">
            <a href="#">
                <i class="fa-solid fa-sitemap nav_icon"></i>
                <span class="link_name">{{ trans('sidebar.Departments') }}</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="#" class="link">{{ trans('sidebar.Departments') }}</a></li>
            </ul>
        </li>
        <li class="link">
            <a href="#">
                <i class="fa-solid fa-bucket nav_icon"></i>
                <span class="link_name">{{ trans('sidebar.Products') }}</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="#" class="link">{{ trans('sidebar.Products') }}</a></li>
            </ul>
        </li>
        <li>
            <div class="profile-details">
                <div class="profile-content">
                    <!--<img src="image/profile.jpg" alt="profileImg">-->
                </div>
                <div class="name-job">
                    <div class="profile_name">{{ auth()->user()->name }}</div>
                    <div class="job">{{ auth()->user()->email }}</div>
                </div>
                <i class='bx bx-log-out nav_icon'></i>
                <ul class="dropdown bottom">
                    <li><a class="link_name" href="#">{{ trans('sidebar.Logout') }}</a></li>
                </ul>
        </li>
    </ul>
</div>

</div>

