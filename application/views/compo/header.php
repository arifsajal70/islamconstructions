<?php defined('BASEPATH') or exit('No DIrect script access allowed');?>
<div class="site-header">
    <nav class="navbar navbar-light">
        <div class="navbar-left">
            <a class="navbar-brand" href="<?php echo base_url();?>">
                <div class="logo"></div>
            </a>
            <div class="toggle-button dark sidebar-toggle-first float-xs-left hidden-md-up">
                <span class="hamburger"></span>
            </div>
            <div class="toggle-button dark float-xs-right hidden-md-up" data-toggle="collapse" data-target="#collapse-1">
                <span class="more"></span>
            </div>
        </div>
        <div class="navbar-right navbar-toggleable-sm collapse" id="collapse-1">
            <div class="toggle-button light sidebar-toggle-second float-xs-left hidden-sm-down">
                <span class="hamburger"></span>
            </div>
            <ul class="nav navbar-nav float-md-right">
                <li class="nav-item dropdown hidden-md-up">
                    <a class="nav-link" href="<?php echo base_url('profile');?>">
                        <i class="ti-power-off"></i>
                        <span class="hidden-md-up">Profile</span>
                        <span class="tag tag-success top">Profile</span>
                    </a>
                </li>
                <li class="nav-item dropdown hidden-md-up">
                    <a class="nav-link" href="<?php echo base_url('login/logout');?>">
                        <i class="ti-user"></i>
                        <span class="hidden-md-up">Logout</span>
                        <span class="tag tag-success top">Logout</span>
                    </a>
                </li>
                <li class="nav-item dropdown hidden-sm-down">
                    <a href="#" data-toggle="dropdown" aria-expanded="false">
						<span class="avatar box-32">
							<img src="<?php echo file_exists('./uploads/'.$this->session->userdata('photo')) ? base_url('uploads/'.$this->session->userdata('photo')) : base_url('uploads/system/default-user.jpg')?>" alt="">
						</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right animated fadeInUp">
                        <a class="dropdown-item" href="<?php echo base_url('profile');?>">
                            <i class="ti-user mr-0-5"></i> Profile
                        </a>
                        <a class="dropdown-item" href="<?php echo base_url('login/logout');?>">
                            <i class="ti-power-off mr-0-5"></i> Log out
                        </a>
                    </div>
                </li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="nav-item hidden-sm-down">
                    <a class="nav-link toggle-fullscreen" href="#">
                        <i class="ti-fullscreen"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</div>
