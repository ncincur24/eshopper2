<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark">
        <a href="{{route("admin.home")}}" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Admin</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="{{asset("img/1168742.png")}}" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{session()->get("user")->full_name}}</h6>
                <span>Admin</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            @foreach($adminNav as $a)
            <a href="{{route($a->route)}}" class="nav-item nav-link"><i class="fa fa-{{$a->icon}} me-2"></i>{{$a->title}}</a>
            @endforeach
            <a href="{{route("home")}}" class="nav-item nav-link"><i class="fas fa-home me-2"></i>Website</a>
                <input type="hidden" id="current" value="{{url()->current()}}" />
        </div>
    </nav>
</div>
<!-- Sidebar End -->
