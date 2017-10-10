<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <img src="<?php echo url($user->image); ?>" width="48" height="48" alt="User" />
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo ucfirst($user->first_name . ' ' .$user->last_name); ?></div>
                <div class="email"><?php echo $user->email; ?></div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="<?php echo $profileLink; ?>"><i class="material-icons">person</i>Profile</a></li>
                        <li><a href="<?php echo $settingsLink; ?>"><i class="material-icons">settings</i>Settings</a></li>
                        <li role="seperator" class="divider"></li>
                        <li><a href="<?php echo $logoutLink; ?>"><i class="material-icons">input</i>Sign Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list" id="sidebar-menu">
                <li class="header">MAIN NAVIGATION</li>
                <?php if ($linksMenu) : ?>
                    <?php foreach ($linksMenu AS $link) : ?>
                        <?php  $x = 1 ; ?>
                        <li class="<?php echo ($x == 1) ? 'active' : null; ?>">
                            <a href="<?php echo $link['url']; ?>">
                                <i class="material-icons"><?php echo $link['icon']; ?></i>
                                <span><?php echo $link['name']; ?></span>
                            </a>
                        </li>
                        <?php $x++; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
            </div>
            <div class="version">
                <b>Version: </b> 1.0.5
            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->