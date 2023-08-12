<?php

/**
 * Template Functions
 *
 * This file provides template specific custom functions that are
 * not provided by the DokuWiki core.
 * It is common practice to start each function with an underscore
 * to make sure it won't interfere with future core functions.
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();

function _tpl_usertools()
{
    /* the optional second parameter of tpl_action() switches between a link and a button,
     e.g. a button inside a <li> would be: tpl_action('edit', 0, 'li') */
    tpl_toolsevent('usertools', array(

        'profile'   => tpl_action('profile', 1, 'li', 1),
        'register'  => tpl_action('register', 1, 'li', 1),
        'login'     => tpl_action('login', 1, 'li', 1),
    ));
}

function _tpl_sitetools()
{
    tpl_toolsevent('sitetools', array(
        'recent'    => tpl_action('recent', 1, 'li', 1),
        'media'     => tpl_action('media', 1, 'li', 1),
        'index'     => tpl_action('index', 1, 'li', 1),
        'admin'     => tpl_action('admin', 1, 'li', 1),
    ));
}

function _tpl_pagetools()
{
    tpl_toolsevent('pagetools', array(
        'edit'      => tpl_action('edit', 1, 'li', 1),
        'revisions' => tpl_action('revisions', 1, 'li', 1),
        'backlink'  => tpl_action('backlink', 1, 'li', 1),
        'subscribe' => tpl_action('subscribe', 1, 'li', 1),
        'revert'    => tpl_action('revert', 1, 'li', 1),
        'top'       => tpl_action('top', 1, 'li', 1),
    ));
}

function _tpl_detailtools()
{
    echo tpl_action('mediaManager', 1, 'li', 1);
    echo tpl_action('img_backto', 1, 'li', 1);
}

function _tpl_logo($return = false)
{
    global $INFO;
    global $conf;

    $logoSize = array();
    $logo = tpl_getMediaFile(array(':' . $INFO['namespace'] . ':logo.jpg', ':' . $INFO['namespace'] . ':logo.png',  ':logo.png', ':wiki:dokuwiki-128.png', ':wiki:logo.png', 'images/logo.png'), false, $logoSize);
    $out = '<div><img class="logo" src="' . $logo . '" alt="' . $conf['title'] . '" id="dokuwiki__top" accesskey="h" title="[H]" ></div>';
	$_nstartpage = $INFO['namespace'] . ':' . $conf['start'];
	if (page_exists($_nstartpage)) {	
		$out = tpl_link(wl($_nstartpage),  $out, '', 1);
	} 		else {
		$out = tpl_link(wl(),  $out, '', 1);
	}
    if ($return) return $out;
    echo $out;
    return true;
}


function _tpl_icon($return = false)
{
    global $INFO;
    global $conf;

    $logoSize = array();
    $logo = tpl_getMediaFile(array(':' . $INFO['namespace'] . ':icon.png',':' . $INFO['namespace'] . ':logo.jpg', ':' . $INFO['namespace'] . ':logo.png',  ':logo.png', ':wiki:dokuwiki-128.png', ':wiki:logo.png', 'images/logo.png'), false, $logoSize);
    $out = '<div><img class="logo" src="' . $logo . '" alt="' . $conf['title'] . '" id="dokuwiki__top" accesskey="h" title="[H]" ></div>';
	// if namespace_start_page exist then go there or go to home
	$_nstartpage = $INFO['namespace'] . ':' . $conf['start'];
	if (page_exists($_nstartpage)) {	
		$out = tpl_link(wl($_nstartpage),  $out, '', 1);
	} 		else {
		$out = tpl_link(wl(),  $out, '', 1);
	}
    if ($return) return $out;
    echo $out;
    return true;
}



function _tpl_background($return = false)
{
    global $INFO;
    $bg = ('background.jpg');
    $logoSize = array();
    $img = tpl_getMediaFile(array(
        ':' . $INFO['namespace'] . ':' . $bg,        ':' . $bg, 'images/background.png'
        //,         'images/background.png'
    ), true);
    $out = $img;
    if ($return) return $out;
    echo $out;
    return true;
}

function _tpl_title($return = false)
{
    global $INFO;
    global $conf;
    //strip_tags($conf['title'])
    $out = '<div class="text-center" >' . tpl_link(wl($INFO['namespace'] . ':' . $conf['start']), p_get_first_heading(':' . $INFO['namespace'] . ':' . $conf['start']), 'accesskey="h" title="[H]"', 1) . '</div>';
    if ($return) return $out;
    echo $out;
    return true;
}

function _tpl_userinfo($return = false)
{
    global $lang;
    /** @var Input $INPUT */
    global $INPUT;
    if ($INPUT->server->str('REMOTE_USER')) {
        // print $lang['loggedinas'].' '.userlink();
        if ($return) {
            return  userlink();
        } else {
            print userlink();
            return true;
        }
    }
    return false;
}

function  _tpl_smartbtn()
{
    global $INFO;
    global $conf;
    global $ACT;

    //echo $ACT;

    switch ($ACT) {
        case 'edit':

            tpl_actionlink('edit', '', '', ' &#xe909;'); // show

            break;
        case 'show':
            if ($INFO['editable'])
                tpl_actionlink('edit', '', '', ' &#xe907;'); //edit
            else
                tpl_actionlink('login', '', '', ' &#xe90f;'); //login
            break;
        default:
            tpl_actionlink('edit', '', '', ' &#xe909;'); // show
    }

    return false;
}
