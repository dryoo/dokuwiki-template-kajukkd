<?php

/**
 * 
 * Dokuwiki template Kajukk Dark 
 *  
 * @link     https://dokuwiki.org/template:kajukkd
 * @author   S.C. Yoo <dryoo@live.com>
 * 
 * Based on DokuWiki Starter Template
 *
 * @link     http://dokuwiki.org/template:starter
 * @author   Anika Henke <anika@selfthinker.org>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * 
 * Does not support IE9 
 * 
 * Open source
 * 
 *  Material Design Off Canvas Menu (the MIT license)
 *    https://github.com/callmenick/Material-Menu
 * 
 *  Minimal Hamburger Overlay Navigation Drawer In CSS
 *    https://www.cssscript.com/hamburger-overlay-navigation-drawer/
 * 
 *  GeShi Dark mode CSS from 
 *    https://cyberasylum.eu/how-to-change-geshi-stylesheet
 */

if (!defined('DOKU_INC')) die(); /* must be run from within DokuWiki */
@require_once(dirname(__FILE__) . '/tpl_functions.php'); /* include hook for template functions */
$showTools = true;
// $showTools = !tpl_getConf('hideTools') || (tpl_getConf('hideTools') && !empty($_SERVER['REMOTE_USER']));
$showSidebar = page_findnearest($conf['sidebar']) && ($ACT == 'show');
//$sidebarElement = tpl_getConf('sidebarIsNav') ? 'nav' : 'aside';
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $conf['lang'] ?>" lang="<?php echo $conf['lang'] ?>" dir="<?php echo $lang['direction'] ?>" class="no-js" style="background-image: url('<?php if (!$INFO['ismobile']) echo _tpl_background(true); ?>');">

<head>
    <meta charset="UTF-8" />
    <title>
        <?php echo (p_get_first_heading($ID)) ? p_get_first_heading($ID) : strrchr(':' . $INFO['id'], ":"); ?>
        <?php if (strrchr(':' . $INFO['id'], ":") != ":" . $conf['start']) {
            echo ' - ' . p_get_first_heading(':' . $INFO['namespace'] . ':' . $conf['start']) .
                ' - ' . strip_tags($conf['title']);
        } else {
            echo ' - ' . strip_tags($conf['tagline']);
        } ?>
    </title>
    <script>
        (function(H) {
            H.className = H.className.replace(/\bno-js\b/, 'js')
        })(document.documentElement)
    </script>
    <?php tpl_metaheaders() ?>
    <?php
    /* 
     * support for https://www.dokuwiki.org/plugin:adultcontent
     */
    if (($ACT == "show") || ($ACT == "showtag")) $noadsense = false;
    else $noadsense = true;
    if (p_get_metadata($ID, "adult")) $noadsense = true;
    /* 
     *  support for https://github.com/tatewake/dokuwiki-plugin-googleads/
     */
    if (($ACT != "edit") && (!$noadsense)) :
        if (file_exists(DOKU_PLUGIN . 'googleads/code.php')) include_once(DOKU_PLUGIN . 'googleads/code.php');
        if (function_exists('gads_code')) gads_code();
    endif;
    ?>
    <!-- <link rel="preload" as="font" crossorigin="crossorigin" type="font/woff2" href="myfont.woff2"> -->
    <!-- <link rel="stylesheet" href="lib/tpl/kajukkd/fonts/style.css"> -->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <?php echo tpl_favicon(array('favicon', 'mobile')) ?>
    <?php tpl_includeFile('meta.html') ?>

</head>

<body>
    <?php /* the "dokuwiki__top" id is needed somewhere at the top, because that's where the "back to top" button/link links to */ ?>
    <?php /* tpl_classes() provides useful CSS classes; if you choose not to use it, the 'dokuwiki' class at least
             should always be in one of the surrounding elements (e.g. plugins and templates depend on it) */ ?>
    <div id="dokuwiki__site">
        <div id="dokuwiki__top" class=" site <?php echo tpl_classes(); ?> 
        <?php
        // echo ($showSidebar) ? 'hasSidebar' : ''; 
        ?>">
            <!-- ********** HEADER ********** -->
            <header id="dokuwiki__header">
                <!-- <div class="pa d"> -->
                <?php tpl_includeFile('header.html') ?>
                <div class="headings">
                    <h1>
                        <?php // tpl_link(wl(), '<img src="' . _tpl_logo(). '" alt="' . $conf['title'] . '" />', 'id="dokuwiki__top" accesskey="h" title="[H]"')  
                        ?>
                        <?php _tpl_icon() ?>
                        <div class="clearer"></div>
                </div>
                <?php tpl_searchform() ?>
                <div id="smartbtn" class="tools">
                    <?php //if ($INFO['userinfo'] != "") : /* If logged-in */

                    ?>
                    <?php _tpl_smartbtn(); ?>


                    <?php  /* if (!empty($_SERVER['REMOTE_USER'])) {
                        echo '<div class="user">';

                        tpl_actionlink('edit', '', '', ' &#xe90f;');
                        //echo  "title='". _tpl_userinfo(true)."'>";

                        echo '</div>';
                    } else {
                        echo '<div class="login">';
                        tpl_actionlink('login', '', '', ' &#xe90f;');
                        echo '</div>';
                    } */
                    ?>
                    <!--- usertools were here -->
                </div>
                <!--   <div class="clearer"></div>



                <div class="clearer"></div>
                <hr class="a11y" /> -->
                <!-- </div> -->
            </header><!-- /header -->
            <ul class="a11y skip">
                <li><a href="#dokuwiki__content"><?php echo $lang['skip_to_content'] ?></a></li>
            </ul>
            <div class="wrapper">

                <?php html_msgarea() /* occasional error and info messages on top of the page */ ?>
                <!-- ********** CONTENT ********** -->

                <main id="dokuwiki__content">
                    <div class="pad">
                        <?php tpl_flush() /* flush the output buffer */ ?>
                        <!-- BREADCRUMBS -->
                        <?php if ($conf['breadcrumbs']) { ?>
                            <div class="breadcrumbs"><?php tpl_breadcrumbs() ?></div>
                        <?php } ?>
                        <?php if ($conf['youarehere']) { ?>
                            <div class="breadcrumbs"><?php tpl_youarehere() ?></div>
                        <?php } ?>
                        <?php tpl_includeFile('pageheader.html') ?>


                        <div class="page">
                            <!-- wikipage start -->
                            <?php tpl_content() /* the main content */ ?>
                            <!-- wikipage stop -->
                            <div class="clearer"></div>
                        </div>



                        <?php tpl_flush() ?>
                        <?php tpl_includeFile('pagefooter.html') ?>

                        <?php /*Backlinks 참조문서 출력*/
                        if ((ft_backlinks($ID) != null) &&
                            (strrchr(':' . $INFO['id'], ":") != ":" . $conf['start'])
                            && (($ACT == 'edit') or ($ACT == 'preview') or ($ACT == "show"))
                        ) print '<h2>' . $lang['btn_backlink'] . '</h2>' .
                            p_render('xhtml', p_get_instructions('{{backlinks>.}}'), $info);
                        ?>

                        <?php /* disqus */
                        global $ACT;
                        if ($ACT == 'show') {
                            $disqus = &plugin_load('syntax', 'disqus');
                            if ($disqus) echo $disqus->_disqus($shortname);
                        }
                        ?>
                    </div>
                </main><!-- /content -->

                <div class="clearer"></div>
                <hr class="a11y" />

                <!-- PAGE ACTIONS -->
                <?php if ($showTools) : ?>


                    <!---------https://www.cssscript.com/hamburger-overlay-navigation-drawer/ ------------>
                    <nav id="dokuwiki__pagetools" class="mh-menu-wrap " aria-labelledby="dokuwiki__pagetools_heading">

                        <input type="checkbox" class="toggler " />
                        <div class="hamburger">
                            <div></div>
                        </div>
                        <div class="mh-menu ">
                            <div class="">

                                <h3 class="a11y" id="dokuwiki__pagetools_heading"><?php echo $lang['page_tools'] ?></h3>
                                <ul>
                                    <?php if (file_exists(DOKU_INC . 'inc/Menu/PageMenu.php')) {
                                        echo (new \dokuwiki\Menu\PageMenu())->getListItems('action ', false);
                                    } else {
                                        _tpl_pagetools();
                                    } ?>
                                </ul>

                            </div>
                        </div>
                    </nav>

                <?php endif; ?>
            </div><!-- /wrapper -->

            <!-- ********** FOOTER ********** -->
            <footer id="dokuwiki__footer">
                <div class="pad">
                    <div class="doc"><?php tpl_pageinfo() /* 'Last modified' etc */ ?></div>
                    <?php tpl_license('button') /* content license, parameters: img=*badge|button|0, imgonly=*0|1, return=*0|1 */ ?>

                    <?php tpl_includeFile('footer.html') ?>
                </div>
            </footer><!-- /footer -->


        </div>
    </div><!-- /site -->
    <!--- 메뉴~~    --->
    <div class="mm-menu-bg"></div>
    <button id="mm-menu-toggle" class="mm-menu-toggle">Toggle Menu</button>

    <nav id="mm-menu" class="mm-menu">

        <!-- ********** ASIDE ********** -->
        <? php // if ($showSidebar) : 
        ?>
        <nav id="dokuwiki__aside" aria-label="<?php echo $lang['sidebar'] ?>">
            <div class="mm-menu__header text-center">
                <?php _tpl_logo(); ?>
                <?php _tpl_title(); ?>
                <!---- Tag Line ---->
                <?php if ($conf['tagline']) : ?>
                    <p class="claim"><?php echo $conf['tagline'] ?></p>
                <?php endif ?>
            </div>


            <!-- SITE TOOLS -->
            <nav id="dokuwiki__sitetools" aria-labelledby="dokuwiki__sitetools_heading">
                <h3 class="a11y" id="dokuwiki__sitetools_heading"><?php echo $lang['site_tools'] ?></h3>

                <?php
                // mobile menu (combines all menus in one dropdown)
                // if (file_exists(DOKU_INC . 'inc/Menu/MobileMenu.php')) {
                //     echo (new \dokuwiki\Menu\MobileMenu())->getDropdown($lang['tools']);
                // } else {
                //   tpl_actiondropdown($lang['tools']);
                // }
                ?>
                <ul>
                    <?php if (file_exists(DOKU_INC . 'inc/Menu/SiteMenu.php')) {
                        echo (new \dokuwiki\Menu\SiteMenu())->getListItems('action ', false);
                    } else {
                        _tpl_sitetools();
                    } ?>
                </ul>
            </nav>
            <!-- USER TOOLS -->
            <?php if ($conf['useacl']) : //&& $showTools 
            ?>
                <nav id="dokuwiki__usertools" aria-labelledby="dokuwiki__usertools_heading">
                    <h3 class="a11y" id="dokuwiki__usertools_heading"><?php echo $lang['user_tools'] ?></h3>
                    <ul>
                        <?php if (file_exists(DOKU_INC . 'inc/Menu/UserMenu.php')) {
                            /* the first parameter is for an additional class, the second for if SVGs should be added */
                            echo (new \dokuwiki\Menu\UserMenu())->getListItems('action ', false);
                        } else {
                            /* tool menu before Greebo */
                            _tpl_usertools();
                        } ?>


                    </ul>
                </nav>
            <?php endif ?>
            <div class="pad aside include group">
                <?php tpl_includeFile('sidebarheader.html') ?>
                <?php tpl_include_page($conf['sidebar'], 1, 1) /* includes the nearest sidebar page */ ?>
                <?php tpl_includeFile('sidebarfooter.html') ?>
                <div class="clearer"></div>
            </div>
        </nav><!-- /aside -->
        <?php // endif; 
        ?>
        <!---- mm-menu
        <ul class="mm-menu__items">
            <li class="mm-menu__item">
                <a class="mm-menu__link" href="./?=main">
                    <span class="mm-menu__link-text"><i class="fas fa-clinic-medical"></i> 병원소개</span>
                </a>
            </li>
            <li class="mm-menu__item">
                <a class="mm-menu__link" href="./?p=staffs">
                    <span class="mm-menu__link-text"><i class="fas fa-hospital"></i> 의료진</span>
                </a>
            </li>
            <li class="mm-menu__item">
                <a class="mm-menu__link" href="./?p=info">
                    <span class="mm-menu__link-text"><i class="fas fa-clock"></i> 진료안내</span>
                </a>
            </li>
            <li class="mm-menu__item">
                <a class="mm-menu__link" href="./?p=duty">
                    <span class="mm-menu__link-text"><i class="fas fa-calendar-alt"></i> 당직표</span>
                </a>
            </li>
            <li class="mm-menu__item">
                <a class="mm-menu__link" href="./?p=loc">
                    <span class="mm-menu__link-text"><i class="fas fa-map-marker"></i> 오시는 길</span>
                </a>
            </li>
        </ul> -->
    </nav><!-- /nav -->
    <div class="no"><?php tpl_indexerWebBug() /* provide DokuWiki housekeeping, required in all templates */ ?></div>
    <div id="screen__mode" class="no"></div><?php /* helper to detect CSS media query in script.js */ ?>
</body>

</html>