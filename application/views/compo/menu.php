<div class="site-sidebar">
    <div class="custom-scroll custom-scroll-light">
        <ul class="sidebar-menu">
            <li class="menu-title">Main</li>
            <li>
                <a href="<?php echo base_url('dashboard');?>" class="waves-effect waves-light">
                    <span class="s-icon"><i class="ti-microsoft"></i></span>
                    <span class="s-text">Dashboard</span>
                </a>
            </li>
            <li class="with-sub">
                <a href="javascript:void(0)" class="waves-effect  waves-light">
                    <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                    <span class="s-icon"><i class="ti-face-smile"></i></span>
                    <span class="s-text">Stuffs</span>
                </a>
                <ul>
                    <li><a href="<?php echo base_url('engineers');?>">Engineers</a></li>
                    <li><a href="<?php echo base_url('managers');?>">Managers</a></li>
                    <li><a href="<?php echo base_url('employees');?>">Employees</a></li>
                </ul>
            </li>
            <li class="with-sub">
                <a href="javascript:void(0)" class="waves-effect  waves-light">
                    <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                    <span class="s-icon"><i class="ti-paint-roller"></i></span>
                    <span class="s-text">Sites</span>
                </a>
                <ul>
                    <li><a href="<?php echo base_url('sites/constructions_site');?>">Constructions</a></li>
                    <li><a href="<?php echo base_url('sites/supply_site');?>">Supply</a></li>
                </ul>
            </li>
            <li>
                <a href="<?php echo base_url('admins');?>" class="waves-effect  waves-light">
                    <span class="s-icon"><i class="ti-user"></i></span>
                    <span class="s-text">Admins</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('suppliers');?>" class="waves-effect  waves-light">
                    <span class="s-icon"><i class="ti-truck"></i></span>
                    <span class="s-text">Suppliers</span>
                </a>
            </li>
            <li class="with-sub">
                <a href="javascript:void(0)" class="waves-effect  waves-light">
                    <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                    <span class="s-icon"><i class="ti-settings"></i></span>
                    <span class="s-text">Setting</span>
                </a>
                <ul>
                    <li><a href="<?php echo base_url('items');?>">Items</a></li>
                    <li><a href="<?php echo base_url('employee_types');?>">Employee Types</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>