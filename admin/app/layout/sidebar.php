<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= url('') ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Lojinha <sup>v1</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?= url('') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Home</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Cadastros
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseProducts" aria-expanded="true"
           aria-controls="collapseProducts">
            <i class="fas fa-fw fa-cog"></i>
            <span>Produtos</span>
        </a>
        <div id="collapseProducts" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Cadastro:</h6>
                <a class="collapse-item" href="javascript:void(0)" data-route="products">Listar</a>
                <a class="collapse-item" href="javascript:void(0)" data-route="save-product">Cadastrar</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#users" aria-expanded="true"
           aria-controls="collapseRegister">
            <i class="fas fa-fw fa-cog"></i>
            <span>Usuários</span>
        </a>
        <div id="users" class="collapse" aria-labelledby="headingOne" data-parent="#users">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Cadastro:</h6>
                <a href="javascript:void(0)" class="collapse-item" data-route="users">Listar</a>
                <a href="javascript:void(0)" class="collapse-item" data-route="save-user">Cadastrar</a>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>