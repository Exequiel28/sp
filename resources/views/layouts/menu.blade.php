<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="/home">
    <i class="fas fa-house-user"></i><span>Inicio</span>
    </a>
</li>

@can('admin.home')
<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="/usuarios">
        <i class="fas fa-regular fa-users"></i><span>Usuarios</span>
    </a>
</li>
<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="/roles">
        <i class=" fas fa-user-lock"></i><span>Roles</span>
    </a>
</li>
@endcan

<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="/clientes">
        <i class=" fas fa-user-tie"></i><span>Clientes</span>
        
    </a>
</li>

<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="/productos">
        <i class=" fas fa-boxes"></i><span>Productos</span>
        
    </a>
</li>

@can ('editar-pedidos')
<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="/pedidos">
    <i class="fas fa-shopping-cart"></i><span>Pedidos</span>
    </a>
</li>

@endcan

<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="/ordenes/index">
    <i class="fas fa-shopping-basket"></i><span>Ordenes</span>
    </a>
</li>

<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="/inventario">
        <i class=" fas fa-archive"></i><span>Inventario</span>
        
    </a>
</li>
<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="/inventario/uso">
    <i class="fas fa-dolly-flatbed"></i><span>Inventario en Uso</span>
        
    </a>
</li>

<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="/reportes/index">
    <i class="fas fa-clipboard-list"></i><span>Reportes</span>
        
    </a>
</li>
@can('ver-facturacion')

<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="/facturacion">
    <i class="fas fa-th-list"></i><span>Facturacion</span>
        
    </a>
</li>
@endcan

<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="">
    <i class="fas fa-info-circle"></i><span>Ayuda</span>
        
    </a>
</li>