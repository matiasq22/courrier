<ul class="sidebar-menu" data-widget="tree">
        <li class="header">Navegacion</li>
        <!-- Optionally, you can add icons to the links -->
        <li {{ request()->is('admin') ? 'class=active' : '' }}><a href="{{route('admin.home')}}"><i class="fa fa-home"></i> <span>Inicio</span></a></li>
        <li class="treeview {{ request()->is('admin/posts*') ? 'active' : '' }}">
          <a href="#" ><i class="fa fa-link"></i> <span>Blog</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li {{ request()->is('admin/posts') ? 'class=active' : '' }}><a href="{{route('admin.posts.index')}}"><i class="fa fa-eye"></i>Ver Todos los Posts</a></li>
            <li><a href="#" id="create_post" data-toggle="modal"
                   data-target="#create_post"><i class="fa fa-pencil " ></i>Crear un post</a></li>
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->