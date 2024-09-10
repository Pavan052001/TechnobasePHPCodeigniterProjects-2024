<?php $uri = $this->uri->segment(1);?>
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link " href="<?php echo site_url('LoginController/index')?>">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

     <?php if ($_SESSION["role"] == 'Admin') { ?>
    <li class="nav-item">
        <a>
          <a class="nav-link" href="<?php echo site_url('UserController/userList') ?>">
          <i class="bi bi-menu-button-wide"></i><span>Manage Users</span>
     </a>
       
    </li>

    <li>

    <a class="nav-link "   href="<?php echo site_url("GuestController/getguest")?>"><i class="bi bi-menu-button-wide"></i><span>Manage Guest</span>
    </a>
    </li>
    <?php }else{ ?>

  <li>
        <a class="nav-link "  href="<?php echo site_url("GuestController/getlist")?>">
       

          <i class="bi bi-journal-text"></i><span> Manage Guests </span>
        </a>
      </li>
      <?php }?>



      <?php if($_SESSION["role"]=='Admin'){?>
      <li class="nav-item">
        <a class="nav-link<?php if($uri== "HobbieController"){
          echo "active";
        }else{
           echo " ";
        }
        ?> "  href="<?php echo site_url("HobbieController/hobbylist")?>">
          <i class="bi bi-journal-text"></i><span> Manage Hobbies </span>
        </a>
       
      </li>

      <li class="nav-item">
        <a class="nav-link<?php if($uri=="CountryController"){
          echo "active";
        }else{
           echo " ";
        }
        ?>"   href="<?php echo site_url("CountryController/countrylist")?>">
          <i class="bi bi-layout-text-window-reverse"></i><span>Manage countries</span>
        </a>
       
      </li>
      <li class="nav-item">
        <a class="nav-link<?php if($uri=="StateController"){
          echo "active";
        }else{
           echo " ";
        }
        ?>"  href="<?php echo site_url("StateController/managelist")?>">
          <i class="bi bi-layout-text-window-reverse"></i><span>Manage states</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php if($uri=="CityController"){
          echo "active";
        }else{
           echo " ";
        }
        ?>"  href="<?php echo site_url("CityController/managelist")?>">
          <i class="bi bi-layout-text-window-reverse"></i><span>Manage cities</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php if($uri=="ProductCategoryController"){
          echo "active";
        }else{
           echo " ";
        }
        ?>"  href="<?php echo site_url("ProductCategoryController/getproductlist")?>">
          <i class="bi bi-layout-text-window-reverse"></i><span>Manage Product Categories</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php if($uri=="ProductSubController"){
          echo "active";
        }else{
           echo " ";
        }
        ?>"  href="<?php echo site_url("ProductSubController/getlist")?>">
          <i class="bi bi-layout-text-window-reverse"></i><span>Manage Product SubCategories</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link<?php if($uri=="ProductController"){
          echo "active";
        }else{
           echo " ";
        }
        ?>"  href="<?php echo site_url("ProductController/manageproducts")?>">
          <i class="bi bi-layout-text-window-reverse"></i><span>Manage Products</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php if($uri=="LeadStageController"){
          echo "active";
        }else{
           echo " ";
        }
        ?>"  href="<?php echo site_url("LeadStageController/manageLeads")?>">
          <i class="bi bi-layout-text-window-reverse"></i><span>Manage Lead Stages</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php if($uri=="LeadSourceController"){
          echo "active";
        }else{
           echo " ";
        }
        ?>"  href="<?php echo site_url("LeadSourceController/managelist")?>">
          <i class="bi bi-layout-text-window-reverse"></i><span>Manage Lead Sources</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php if($uri=="LeadController"){
          echo "active";
        }else{
           echo " ";
        }
        ?>"  href="<?php echo site_url("LeadController/getAlleads")?>">
          <i class="bi bi-layout-text-window-reverse"></i><span>Manage Leads</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link<?php if($uri=="BlogCategoryController"){
          echo "active";
        }else{
           echo " ";
        }
        ?>"  href="<?php echo site_url("BlogCategoryController/getAllbogcat")?>">
          <i class="bi bi-layout-text-window-reverse"></i><span>Manage Blog categories</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php if($uri=="BlogsController"){
          echo "active";
        }else{
           echo " ";
        }
        ?>"  href="<?php echo site_url("BlogsController/getalldata")?>">
          <i class="bi bi-layout-text-window-reverse"></i><span>Manage Blogs</span>
        </a>
      </li>
      <?php }?>
     
      <li class="nav-item">
        <a class="nav-link" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Icons</span>
        </a>
       
      </li>


    </ul>

  </aside>