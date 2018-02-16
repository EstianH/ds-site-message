<?php if(!defined('ABSPATH')) exit; ?>
<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <!-- DS Site message prevents WP from loading beyond action 'init'. Manual Stylesheet linking required. -->
        <link type="text/css" href="<?php echo DSSM_ASSETS . 'css/style.css?v=' . DSSM_VERSION; ?>" rel="stylesheet" />
        <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <?php $dssm_settings = get_option('dssm-settings'); ?>
        <style type="text/css">
            body{
                <?php echo (isset($dssm_settings['background']['color']) && $dssm_settings['background']['color'] ? 'background-color: ' . $dssm_settings['background']['color'] . ';' : ''); ?>
                <?php echo (isset($dssm_settings['background']['image']) && $dssm_settings['background']['image'] ? 'background-image: url(' . $dssm_settings['background']['image']['url'] . ');' : ''); ?>
            }
            
            a,
            body{
                <?php echo (isset($dssm_settings['font']['color']) && $dssm_settings['font']['color'] ? 'color: ' . $dssm_settings['font']['color'] . ';' : ''); ?>
            }
            
            #main-container{
                <?php echo (isset($dssm_settings['font']['panel']) ? 'background-color: ' . (isset($dssm_settings['font']['panelcolor']) && $dssm_settings['font']['panelcolor'] ? $dssm_settings['font']['panelcolor'] : '#00000080') . ';' : ''); ?>
            }
            
            @media(min-width: 992px){
                #main-container{
                    <?php echo (isset($dssm_settings['font']['pos']) ? $dssm_settings['font']['pos'] . ';' : ''); ?>
                }
            }
            
            <?php echo (isset($dssm_settings['css']['custom']) ? $dssm_settings['css']['custom'] : ''); ?>
        </style>
    </head>
    <body>
        <div id="main-container">
            <div id="message" class="<?php echo (isset($dssm_settings['font']['align']) ? $dssm_settings['font']['align'] : ''); ?>">
                <div id="message-heading">
                    <?php if(isset($dssm_settings['text']['logo']) && $dssm_settings['text']['logo']){ ?><div id="logo"><img src="<?php echo $dssm_settings['text']['logo']; ?>" /></div><?php } ?>
                    <?php if(isset($dssm_settings['text']['heading']) && $dssm_settings['text']['heading']){ ?><h1><?php echo $dssm_settings['text']['heading']; ?></h1><?php } ?>
                </div>
                <?php if(isset($dssm_settings['text']['body'])){ ?><div id="message-text"><p id="message-text" class="mb-0"><?php echo wpautop($dssm_settings['text']['body']); ?></p></div><?php } ?>
                <div id="message-socials">
                    <?php if(isset($dssm_settings['social'])){ ?>
                        <?php foreach($dssm_settings['social'] as $social => $data){ ?>
                            <?php if(isset($data['url']) && $data['url']){ ?><a class="social-icon<?php echo ' ' . $social; ?> textcenter" href="<?php echo $data['url']; ?>" target="_blank"><i class="<?php echo $data['icon']; ?>"></i></a><?php } ?>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </body>
</html>