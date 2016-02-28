<!-- Navigation -->
<nav class="top1 navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="../redireccion/phpredireccion.php">
            <?php
            $usuario = $sesion->getUser();
            $admin = $usuario->getAdministrador();
            $personal = $usuario->getPersonal();

            if ($admin == 1) {
                echo 'ADMIN';
            } else {
                if ($personal == 1) {
                    echo 'PERSONAL';
                } else {
                    echo 'USER';
                }
            }
            ?>
        </a>
    </div>
    <!-- /.navbar-header -->
    <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i></a>
            <ul class="dropdown-menu">
                <li class="dropdown-menu-header text-center">
                    <strong><?= $sesion->getUser()->getEmail() ?></strong>
                </li>
                <li class="m_2"><a href="../artista/index.php?action=edit&do=view"><i class="fa fa-user"></i>Editar perfil</a></li>
                
                <li class="m_2"><a href="../artista/index.php?action=logout&do=set"><i class="fa fa-lock"></i>Desconectarse</a></li>	
            </ul>
        </li>
    </ul>
    <form class="navbar-form navbar-right">
        <input type="text" class="form-control" value="Search..." onfocus="this.value = '';" onblur="if (this.value == '') {
                    this.value = 'Search...';
                }">
    </form>
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="../redireccion/phpredireccion.php"><i class="fa fa-dashboard fa-fw nav_icon"></i>Escritorio</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-laptop nav_icon"></i>Ver usuarios<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="grids.html">Administradores</a>
                        </li>
                        <li>
                            <a href="grids.html">Personal</a>
                        </li>
                        <li>
                            <a href="grids.html">Usuarios</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
<?php if ($admin == 1 || $personal == 1) { ?>
                    <li>
                        <a href="#"><i class="fa fa-indent nav_icon"></i>Operaciones<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="alta.php">Alta de usuarios</a>
<?php } else { ?>
                                <a href="#"></a>
                            <?php } ?>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
            </ul>
            <!-- /.nav-second-level -->
            </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>
