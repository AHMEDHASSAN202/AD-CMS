<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2><?php echo $header; ?></h2>
        </div>
    </div>
    <div class="row m-r-0 m-l-0">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        <?php echo $headerCard; ?>
                        <small><?php echo $smallHeader; ?></small>
                    </h2>
                    <!--<div class="col-sm-6 col-xs-12">
                        <div class="pull-right">
                            <div class="input-group header-search">
                                <span class="input-group-addon" id="sizing-addon2">
                                    <i class="material-icons">search</i>
                                </span>
                                <input type="search" class="form-control search-aj" data-target="<?php echo $searchLink; ?>" placeholder="Search a User.." aria-describedby="sizing-addon2">
                                <div class="box-result">
                                    <div class="loader" id="loader">
                                        <img src="<?php //echo assets('admin/images/loader.gif'); ?>" alt="loading..">
                                    </div>
                                    <div class="results"></div>
                                </div>
                            </div>
                        </div>
                    </div>-->
                    <div class="clearfix"></div>
                </div>
                <div class="body">
                    <div class="clearfix">
                        <!-- nav tabs -->
                        <ul class="nav nav-tabs" role="tablist" id="nav-tabs">
                            <?php if ($navLinks): ?>
                                <?php $i = 1; foreach ($navLinks AS $name => $url): ?>
                                    <li role="presentation" class="<?php echo $i === 1 ? 'active' : null; ?>">
                                        <a href="<?php echo $url; ?>">
                                            <?php echo $name; ?>
                                        </a>
                                    </li>
                                    <?php $i = 0; endforeach; ?>
                            <?php endif; ?>
                        </ul>
                        <!-- #END# tabs -->
                        <!-- tab content -->
                        <div class="tab-content" id="tab-content">
                            <div class="loader">
                                <img src="<?php echo assets('admin/images/loader.gif'); ?>" alt="loading...">
                            </div>
                            <div class="content"></div>
                        </div>
                        <!-- #END# content tab -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>