<!-- Sidebar Menu -->
    <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
      
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="far fa-building nav-icon"></i>
          <p>
            PRIMER NIVEL
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
         

              <li class="nav-item">
                <a href=" " class="nav-link">
                  <i class="far fa-address-card nav-icon"></i>
                  <p>SUBNIVEL 1</p>
                </a>
              </li>
          
         
              <li class="nav-item">
                <a href="{{route('Color.Listar')}}" class="nav-link">
                  <i class="far fa-address-card nav-icon"></i>
                  <p>Colores</p>
                </a>
              </li>
          

              <li class="nav-item">
                <a href="{{route('Edicion.Listar')}}" class="nav-link">
                  <i class="far fa-address-card nav-icon"></i>
                  <p>Ediciones</p>
                </a>
              </li>

            
              <li class="nav-item">
                <a href="{{route('Link.ListarLinks')}}" class="nav-link">
                  <i class="far fa-address-card nav-icon"></i>
                  <p>Links QR</p>
                </a>
              </li>
           
              
            

        </ul>

      </li>


      <li class="nav-item">
        <a href="{{route('Partida.listarPartidasEnEspera')}}" class="nav-link">
          <i class="far fa-address-card nav-icon"></i>
          <p>Partidas</p>
        </a>
      </li>

 
      


      



      

 