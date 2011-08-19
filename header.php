<?php global $theme;  $theme->doctype();  ?>

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="<?php $theme->profile_uri(); ?>">

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php $theme->meta_title(); ?></title>
<?php $theme->hook('meta'); ?>

<?php wp_head(); ?>
<?php $theme->hook('head'); ?>

</head>

<body <?php body_class(); ?>>
<?php $theme->hook('html_before'); ?>

<div id="wrapper">
<?php $theme->hook('wrapper_before'); ?>
    
    <div id="wrap-header">
    <?php $theme->hook('header_before'); ?>
        
        <div id="header">
        <?php $theme->hook('header'); ?>

            <div id="branding">
            <?php if ($theme->display('logo')) { ?> 
                <a href="<?php bloginfo('url'); ?>"><img class="logo" src="<?php $theme->option('logo'); ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" /></a>
            <?php } else { ?> 
                <h1 class="site-title"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
                <h2 class="site-description"><?php bloginfo('description'); ?></h2>
            <?php } ?> 
            </div><!-- #branding -->

            <div id="header-banner">

                <?php $theme->option('header_banner'); ?> 

            </div><!-- #header-banner -->

        </div><!-- #header -->
        <?php $theme->hook('header_after'); ?>

    </div><!-- #wrap-header -->