<?php if(!defined('ABSPATH')) exit; ?>
<?php $dssm_content = get_option('dssm-content'); ?>
<?php $dssm_design = get_option('dssm-design'); ?>
<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <!-- DS Site message prevents WP from loading beyond action 'init'. Manual Stylesheet linking required. -->
        <link rel="icon" type="image/png" href="<?php echo (isset($dssm_content['text']['favicon']) && $dssm_content['text']['favicon'] ? $dssm_content['text']['favicon'] : DSSM_ASSETS . 'images/icon-xs.png'); ?>" />
        <link type="text/css" href="<?php echo DSSM_ASSETS . 'css/style.css?v=' . DSSM_VERSION; ?>" rel="stylesheet" />
        <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <style type="text/css">
            body{
                <?php echo (isset($dssm_design['background']['color']) && $dssm_design['background']['color'] ? 'background-color: ' . $dssm_design['background']['color'] . ';' : ''); ?>
                <?php echo (isset($dssm_design['background']['image']) && $dssm_design['background']['image'] ? 'background-image: url(' . $dssm_design['background']['image']['url'] . ');' : ''); ?>
            }
            
            a,
            body{
                <?php echo (isset($dssm_design['font']['color']) && $dssm_design['font']['color'] ? 'color: ' . $dssm_design['font']['color'] . ';' : ''); ?>
            }
            
            #main-container{
                <?php echo (isset($dssm_design['font']['panel']) ? 'background-color: ' . (isset($dssm_design['font']['panelcolor']) && $dssm_design['font']['panelcolor'] ? $dssm_design['font']['panelcolor'] : '#00000080') . ';' : ''); ?>
            }
            
            @media(min-width: 992px){
                #main-container{
                    <?php echo (isset($dssm_design['font']['pos']) ? $dssm_design['font']['pos'] . ';' : ''); ?>
                }
            }
            
            <?php echo (isset($dssm_design['css']['custom']) ? $dssm_design['css']['custom'] : ''); ?>
        </style>
    </head>
    <body>
        <?php if(isset($dssm_content['insert'])){
            foreach($dssm_content['insert'] as $insert){
                echo $insert;
            }
        } ?>
        <div id="main-container">
            <div id="message" class="<?php echo (isset($dssm_design['font']['align']) ? $dssm_design['font']['align'] : ''); ?>">
                <div id="message-heading">
                    <?php if(isset($dssm_content['text']['logo']) && $dssm_content['text']['logo']){ ?><div id="logo"><img src="<?php echo $dssm_content['text']['logo']; ?>" /></div><?php } ?>
                    <?php if(isset($dssm_content['text']['heading']) && $dssm_content['text']['heading']){ ?><h1><?php echo $dssm_content['text']['heading']; ?></h1><?php } ?>
                </div>
                <?php if(isset($dssm_content['text']['body'])){ ?><div id="message-text"><p id="message-text" class="mb-0"><?php echo wpautop($dssm_content['text']['body']); ?></p></div><?php } ?>
                <div id="message-socials">
                    <?php if(isset($dssm_content['social'])){ ?>
                        <?php foreach($dssm_content['social'] as $social => $data){ ?>
                            <?php if(isset($data['url']) && $data['url']){ ?><a class="social-icon<?php echo ' ' . $social; ?> textcenter" href="<?php echo $data['url']; ?>" target="_blank"><i class="<?php echo $data['icon']; ?>"></i></a><?php } ?>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </body>
</html>