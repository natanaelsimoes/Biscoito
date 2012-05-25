<style type="text/css">
    /* Essentials */
    
    html, div, map, dt, isindex, form, header, aside, section, section, article, footer {  
        display: block;  
    } 

    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        font-family: "Trebuchet MS", "Helvetica Neue", Helvetica, Arial, Verdana, sans-serif;
        background: #F8F8F8;
        font-size: 12px;
        overflow-x: hidden 
    }

    .clear {
        clear: both;
    }

    .spacer {
        height: 20px;
    }

    a:link, a:visited {
        color: #77BACE;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }


    /* Header */

    header#header {
        height: 55px;
        width: 100%;
        background: #222222 url(<?php echo $GLOBALS['_Biscoito']->getSite() ?>cms/images/header_bg.png) repeat-x;
    }

    header#header h1.site_title, header#header h2.section_title {
        float: left;
        margin: 0;
        font-size: 22px;
        display: block;
        width: 23%;
        height: 55px;
        font-weight: normal;
        text-align: left;
        text-indent: 1.8%;
        line-height: 55px;
        color: #fff;
        text-shadow: 0 -1px 0 #000;
    }

    header#header h1.site_title a {
        color: #fff;
        text-decoration: none;
    }
    
    header#header h1.site_title a span {
        font-size: 16px;
        font-style: italic;
    }

    header#header h2.section_title {
        text-align: center;
        text-indent: 4.5%;
        width: 68%;
        background: url(<?php echo $GLOBALS['_Biscoito']->getSite() ?>cms/images/header_shadow.png) no-repeat left top;
    }

    .btn_view_site {
        float: left;
        width: 9%;
    }

    .btn_view_site a {
        display: block;
        margin-top: 12px;
        width: 91px;
        height: 27px;
        background: url(<?php echo $GLOBALS['_Biscoito']->getSite() ?>cms/images/btn_view_site.png) no-repeat;
        text-align: center;
        line-height: 29px;
        color: #fff;
        text-decoration: none;
        text-shadow: 0 -1px 0 #000;}

    .btn_view_site a:hover {
        background-position: 0 -27px;
    }

    /* Secondary Header Bar */

    section#secondary_bar {
        height: 38px;
        width: 100%;
        background: #F1F1F4 url(<?php echo $GLOBALS['_Biscoito']->getSite() ?>cms/images/secondary_bar.png) repeat-x;
    }

    section#secondary_bar .user {
        float: left;
        width: 23%;
        height: 38px;
    }

    .user p {
        margin: 0;
        padding: 0;
        color: #666666;
        font-weight: bold;
        display: block;
        float: left;
        width: 85%;
        height: 35px;
        line-height: 35px;
        text-indent: 25px;
        text-shadow: 0 1px 0 #fff;
        background: url(<?php echo $GLOBALS['_Biscoito']->getSite() ?>cms/images/icn_user.png) no-repeat center left;
        margin-left: 6%;
    }

    .user a {
        text-decoration: none;
        color: #666666}

    .user a:hover {
        color: #77BACE;
    }

    .user a.logout_user {
        float: left;
        display: block;
        width: 16px;
        height: 35px;
        text-indent: -5000px;
        background: url(<?php echo $GLOBALS['_Biscoito']->getSite() ?>cms/images/icn_logout.png) center no-repeat;
    }

    /* Breadcrumbs */

    section#secondary_bar .breadcrumbs_container {
        float: left;
        width: 77%;
        background: url(<?php echo $GLOBALS['_Biscoito']->getSite() ?>cms/images/secondary_bar_shadow.png) no-repeat left top;
        height: 38px;
    }

    article.breadcrumbs {
        float: left;
        padding: 0 10px;
        border: 1px solid #ccc;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 0 #fff;
        -moz-box-shadow: 0 1px 0 #fff;
        box-shadow: 0 1px 0 #fff;
        height: 23px;
        margin: 4px 3%;
    }

    .breadcrumbs a {
        display: inline-block;
        float: left;
        height: 24px;
        line-height: 23px;
    }

    .breadcrumbs a.current, .breadcrumbs a.current:hover {
        color: #9E9E9E;
        font-weight: bold;
        text-shadow: 0 1px 0 #fff;
        text-decoration: none;
    }

    .breadcrumbs a:link, .breadcrumbs a:visited {
        color: #44474F;
        text-decoration: none;
        text-shadow: 0 1px 0 #fff;
        font-weight: bold;}

    .breadcrumbs a:hover {
        color: #222222;
    }

    .breadcrumb_divider {
        display: inline-block;
        width: 12px;
        height: 24px;
        background: url(<?php echo $GLOBALS['_Biscoito']->getSite() ?>cms/images/breadcrumb_divider.png) no-repeat;
        float: left;
        margin: 0 5px;
    }

    /* Sidebar */

    aside#sidebar {
        width: 23%;
        background: #E0E0E3 url(<?php echo $GLOBALS['_Biscoito']->getSite() ?>cms/images/sidebar.png) repeat;
        float: left;
        min-height: 500px;
        margin-top: -4px;
    }

    #sidebar hr {
        border: none;
        outline: none;
        background: url(<?php echo $GLOBALS['_Biscoito']->getSite() ?>cms/images/sidebar_divider.png) repeat-x;
        display: block;
        width: 100%;
        height: 2px;}


    /* Search */

    .quick_search {
        text-align: center;
        padding: 14px 0 10px 0;
    }

    .quick_search input[type=text] {
        -webkit-border-radius: 20px;
        -moz-border-radius: 20px;
        border-radius: 20px;
        border: 1px solid #bbb;
        height: 26px;
        width: 90%;
        color: #ccc;
        -webkit-box-shadow: inset 0 2px 2px #ccc, 0 1px 0 #fff;
        -moz-box-shadow: inset 0 2px 2px #ccc, 0 1px 0 #fff;
        box-shadow: inset 0 2px 2px #ccc, 0 1px 0 #fff;
        text-indent: 30px;
        background: #fff url(<?php echo $GLOBALS['_Biscoito']->getSite() ?>cms/images/icn_search.png) no-repeat;
        background-position: 10px 6px;
    }

    .quick_search input[type=text]:focus {
        outline: none;
        color: #666666;
        border: 1px solid #77BACE;
        -webkit-box-shadow: inset 0 2px 2px #ccc, 0 0 10px #ADDCE6;
        -moz-box-shadow: inset 0 2px 2px #ccc, 0 0 10px #ADDCE6;
        box-shadow: inset 0 2px 2px #ccc, 0 0 10px #ADDCE6;
    }

    /* Sidebar Menu */

    #sidebar h3 {
        color: #1F1F20;
        text-transform: uppercase;
        text-shadow: 0 1px 0 #fff;
        font-size: 13px;
        margin: 10px 0 10px 6%;
        display: block;
        float: left;
        width: 90%;
    }

    .toggleLink {
        color: #999999;
        font-size: 10px;
        text-decoration: none;
        display: block;
        float: right;
        margin-right: 2%
    }

    #sidebar .toggleLink:hover {
        color: #77BACE;
        text-decoration: none;
    }

    #sidebar ul {
        clear: both;
        margin: 0; padding: 0;
    }

    #sidebar li {
        list-style: none;
        margin: 0 0 0 12%; padding: 0;
    }

    #sidebar li a {
        color: #666666;
        padding-left: 25px;
        text-decoration: none;
        display: inline-block;
        height: 17px;
        line-height: 17px;
        text-shadow: 0 1px 0 #fff;
        margin: 2px 0;
    }

    #sidebar li a:hover {
        color: #444444;
    }

    /* Sidebar Icons */

    #sidebar li.icn_new_article a {
        background: url(<?php echo $GLOBALS['_Biscoito']->getSite() ?>cms/images/icn_new_article.png) no-repeat center left;
    }
    #sidebar li.icn_edit_article a {
        background: url(<?php echo $GLOBALS['_Biscoito']->getSite() ?>cms/images/icn_edit_article.png) no-repeat center left;
    }
    #sidebar li.icn_categories a {
        background: url(<?php echo $GLOBALS['_Biscoito']->getSite() ?>cms/images/icn_categories.png) no-repeat center left;
    }
    #sidebar li.icn_tags a {
        background: url(<?php echo $GLOBALS['_Biscoito']->getSite() ?>cms/images/icn_tags.png) no-repeat center left;
    }
    #sidebar li.icn_add_user a {
        background: url(<?php echo $GLOBALS['_Biscoito']->getSite() ?>cms/images/icn_add_user.png) no-repeat center left;
    }
    #sidebar li.icn_view_users a {
        background: url(<?php echo $GLOBALS['_Biscoito']->getSite() ?>cms/images/icn_view_users.png) no-repeat center left;
    }
    #sidebar li.icn_profile a {
        background: url(<?php echo $GLOBALS['_Biscoito']->getSite() ?>cms/images/icn_profile.png) no-repeat center left;
    }
    #sidebar li.icn_folder a {
        background: url(<?php echo $GLOBALS['_Biscoito']->getSite() ?>cms/images/icn_folder.png) no-repeat center left;
    }
    .icn_photo a {
        background: url(<?php echo $GLOBALS['_Biscoito']->getSite() ?>cms/images/icn_photo.png) no-repeat center left;
    }
    .icn_trash a {
        background: url(<?php echo $GLOBALS['_Biscoito']->getSite() ?>cms/images/icn_trash.png) no-repeat center left;
    }
    #sidebar li.icn_audio a {
        background: url(<?php echo $GLOBALS['_Biscoito']->getSite() ?>cms/images/icn_audio.png) no-repeat center left;
    }
    #sidebar li.icn_video a {
        background: url(<?php echo $GLOBALS['_Biscoito']->getSite() ?>cms/images/icn_video.png) no-repeat center left;
    }
    #sidebar li.icn_settings a {
        background: url(<?php echo $GLOBALS['_Biscoito']->getSite() ?>cms/images/icn_settings.png) no-repeat center left;
    }
    #sidebar li.icn_security a {
        background: url(<?php echo $GLOBALS['_Biscoito']->getSite() ?>cms/images/icn_security.png) no-repeat center left;
    }
    #sidebar li.icn_jump_back a {
        background: url(<?php echo $GLOBALS['_Biscoito']->getSite() ?>cms/images/icn_jump_back.png) no-repeat center left;
    }

    #sidebar p {
        color: #666666;
        padding-left: 6%;
        text-shadow: 0 1px 0 #fff;
        margin: 10px 0 0 0;}

    #sidebar a {
        color: #666666;
        text-decoration: none;
    }

    #sidebar a:hover {
        text-decoration: underline;
    }

    #sidebar footer {
        margin-top: 20%;
    }


    /* Main Content */


    section#main {
        width: 77%;
        min-height: 500px;
        background: url(<?php echo $GLOBALS['_Biscoito']->getSite() ?>cms/images/sidebar_shadow.png) repeat-y left top;
        float: left;
        margin-top: -2px;
    }

    #main h3 {
        color: #1F1F20;
        text-transform: uppercase;
        text-shadow: 0 1px 0 #fff;
        font-size: 13px;
        margin: 8px 20px;
    }

    /* Modules */

    .module {
        border: 1px solid #9BA0AF;
        width: 100%;
        margin: 20px 3% 0 3%;
        margin-top: 20px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        background: #ffffff;
    }

    #main .module header h3 {
        display: block;
        width: 90%;
        float: left;
    }

    .module header {
        height: 38px;
        width: 100%;
        background: #F1F1F4 url(<?php echo $GLOBALS['_Biscoito']->getSite() ?>cms/images/secondary_bar.png) repeat-x;
        -webkit-border-top-left-radius: 5px; -webkit-border-top-right-radius: 5px;
        -moz-border-radius-topleft: 5px; -moz-border-radius-topright: 5px;
        border-top-left-radius: 5px; border-top-right-radius: 5px;
    }

    .module footer {
        height: 32px;
        width: 100%;
        border-top: 1px solid #9CA1B0;
        background: #F1F1F4 url(<?php echo $GLOBALS['_Biscoito']->getSite() ?>cms/images/module_footer_bg.png) repeat-x;
        -webkit-border-bottom-left-radius: 5px; -webkit-border-bottom-right-radius: 5px;
        -moz-border-radius-bottomleft: 5px; -moz-border-radius-bottomright: 5px;
        -webkit-border-bottom-left-radius: 5px; -webkit-border-bottom-right-radius: 5px;
    }

    .module_content {
        margin: 10px 20px;
        color: #666;}

    /* Module Widths */

    .width_full {
        width: 95%;
    }

    .width_half {
        width: 46%;
        margin-right: 0;
        float: left;
    }

    .width_quarter {
        width: 26%;
        margin-right: 0;
        float: left;
    }

    .width_3_quarter {
        width: 66%;
        margin-right: 0;
        float: left;
    }

    /* Stats Module */

    .stats_graph {
        width: 64%;
        float: left;
    }

    .stats_overview {
        background: #F6F6F6;
        border: 1px solid #ccc;
        float: right;
        width: 26%;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
    }

    .overview_today, .overview_previous {
        width: 50%;
        float: left;}

    .stats_overview p {
        margin: 0; padding: 0;
        text-align: center;
        text-transform: uppercase;
        text-shadow: 0 1px 0 #fff;
    }

    .stats_overview p.overview_day {
        font-size: 12px;
        font-weight: bold;
        margin: 6px 0;
    }

    .stats_overview p.overview_count {
        font-size: 26px;
        font-weight: bold;
        color: #333333;}

    .stats_overview p.overview_type {
        font-size: 10px;
        color: #999999;
        margin-bottom: 8px}

    /* Content Manager */

    .tablesorter {
        width: 100%;
        margin: -5px 0 0 0;
    }

    .tablesorter td{
        margin: 0;
        padding: 0;
        border-bottom: 1px dotted #ccc;
    }

    .tablesorter thead tr {
        height: 34px;
        background: url(<?php echo $GLOBALS['_Biscoito']->getSite() ?>cms/images/table_sorter_header.png) repeat-x;
        text-align: left;
        text-indent: 10px;
        cursor: pointer;
    }

    .tablesorter td {
        padding: 15px 10px;
    }

    .tablesorter input[type=<?php echo $GLOBALS['_Biscoito']->getSite() ?>cms/image] {
        margin-right: 10px;}

    ul.tabs {
        margin: 3px 10px 0 0;
        padding: 0;
        float: right;
        list-style: none;
        height: 24px; /*--Set height of tabs--*/
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 0 #fff;
        -moz-box-shadow: 0 1px 0 #fff;
        box-shadow: 0 1px 0 #fff;
        border: 1px solid #ccc;
        font-weight: bold;
        text-shadow: 0 1px 0 #fff;
    }
    ul.tabs li {
        float: left;
        margin: 0;
        padding: 0;
        line-height: 24px;
    }
    ul.tabs li a {
        text-decoration: none;
        color: #999;
        display: block;
        padding: 0 10px;
        height: 24px;
    }

    ul.tabs li a:hover {
        color: #44474F;
    }

    html ul.tabs li.active a  {
        color: #44474F;
    }

    html ul.tabs li.active, html ul.tabs li.active a:hover  {
        background: #F1F2F4;
        -webkit-box-shadow: inset 0 2px 3px #818181;
        -moz-box-shadow: inset 0 2px 3px #818181;
        box-shadow: inset 0 2px 3px #818181;
    }

    html ul.tabs li:first-child, html ul.tabs li:first-child a  {
        -webkit-border-top-left-radius: 5px; -webkit-border-bottom-left-radius: 5px;
        -moz-border-radius-topleft: 5px; -moz-border-radius-bottomleft: 5px;
        border-top-left-radius: 5px; border-bottom-left-radius: 5px;
    }

    html ul.tabs li:last-child, html ul.tabs li:last-child a  {
        -webkit-border-top-right-radius: 5px; -webkit-border-bottom-right-radius: 5px;
        -moz-border-radius-topright: 5px; -moz-border-radius-bottomright: 5px;
        border-top-right-radius: 5px; border-bottom-right-radius: 5px;
    }

    #main .module header h3.tabs_involved {
        display: block;
        width: 60%;
        float: left;
    }

    /* Messages */

    .message {
        border-bottom: 1px dotted #cccccc;
    }

    button,input[type=submit] {
        background: #D0D1D4 url(<?php echo $GLOBALS['_Biscoito']->getSite() ?>cms/images/btn_submit.png) repeat-x;
        border: 1px solid #A8A9A8;
        -webkit-box-shadow: 0 1px 0 #fff;
        -moz-box-shadow: 0 1px 0 #fff;
        box-shadow: 0 1px 0 #fff;
        font-weight: bold;
        height: 22px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        padding: 0 10px;
        color: #666;
        text-shadow: 0 1px 0 #fff;
        cursor: pointer;
    }

    button:hover,input[type=submit]:hover {
        color: #333333;
    }

    button.alt_btn,input[type=submit].alt_btn {
        background: #D0D1D4 url(<?php echo $GLOBALS['_Biscoito']->getSite() ?>cms/images/btn_submit_2.png) repeat-x;
        border: 1px solid#30B0C8;
        -webkit-box-shadow: 0 1px 0 #fff;
        -moz-box-shadow: 0 1px 0 #fff;
        box-shadow: 0 1px 0 #fff;
        font-weight: bold;
        height: 22px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        padding: 0 10px;
        color: #003E49;
        text-shadow: 0 1px 0 #6CDCF9;
        cursor: pointer;
    }

    button.alt_btn:hover,input[type=submit].alt_btn:hover {
        color: #001217;
    }

    input[type=submit].btn_post_message {
        background: #D0D1D4 url(<?php echo $GLOBALS['_Biscoito']->getSite() ?>cms/images/post_message.png) no-repeat;
        display: block;
        width: 37px;
        border: none;
        height: 24px;
        cursor: pointer;
        text-indent: -5000px;
    }

    input[type=submit].btn_post_message:hover {
        background-position: 0 -24px;
    }

    .post_message {
        text-align: left;
        padding: 5px 0;
    }

    .post_message input[type=text] {
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        border: 1px solid #bbb;
        height: 20px;
        width: 70%;
        color: #ccc;
        -webkit-box-shadow: inset 0 2px 2px #ccc, 0 1px 0 #fff;
        -moz-box-shadow: inset 0 2px 2px #ccc, 0 1px 0 #fff;
        box-shadow: inset 0 2px 2px #ccc, 0 1px 0 #fff;
        text-indent: 10px;
        background-position: 10px 6px;
        float: left;
        margin: 0 3.5%;
    }

    .post_message input[type=text]:focus {
        outline: none;
        border: 1px solid #77BACE;
        -webkit-box-shadow: inset 0 2px 2px #ccc, 0 0 10px #ADDCE6;
        -moz-box-shadow: inset 0 2px 2px #ccc, 0 0 10px #ADDCE6;
        box-shadow: inset 0 2px 2px #ccc, 0 0 10px #ADDCE6;
        color: #666666;
    }

    .post_message input[type=<?php echo $GLOBALS['_Biscoito']->getSite() ?>cms/image] {
        float: left;
    }

    .message_list {
        height: 250px;
        overflow-x:hidden;
        overflow-y: scroll;
    }

    /* New/Edit Article Module */

    fieldset {
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        background: #F6F6F6;
        border: 1px solid #ccc;
        padding: 1% 0%;
        margin: 10px 0;
    }

    fieldset label {
        display: block;
        float: left;
        width: 200px;
        height: 25px;
        line-height: 25px;
        text-shadow: 0 1px 0 #fff;
        font-weight: bold;
        padding-left: 10px;
        margin: -5px 0 5px 0;
        text-transform: uppercase;
    }

    fieldset input[type=text] {
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        border: 1px solid #BBBBBB;
        height: 20px;
        color: #666666;
        -webkit-box-shadow: inset 0 2px 2px #ccc, 0 1px 0 #fff;
        -moz-box-shadow: inset 0 2px 2px #ccc, 0 1px 0 #fff;
        box-shadow: inset 0 2px 2px #ccc, 0 1px 0 #fff;
        padding-left: 10px;
        background-position: 10px 6px;
        margin: 0;
        display: block;
        float: left;
        width: 96%;
        margin: 0 10px;
    }

    fieldset input[type=text]:focus {
        outline: none;
        border: 1px solid #77BACE;
        -webkit-box-shadow: inset 0 2px 2px #ccc, 0 0 10px #ADDCE6;
        -moz-box-shadow: inset 0 2px 2px #ccc, 0 0 10px #ADDCE6;
        box-shadow: inset 0 2px 2px #ccc, 0 0 10px #ADDCE6;
    }

    fieldset select {
        width: 96%;
        margin: 0 10px;
        border: 1px solid #bbb;
        height: 20px;
        color: #666666;
    }

    fieldset textarea {
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        border: 1px solid #BBBBBB;
        color: #666666;
        -webkit-box-shadow: inset 0 2px 2px #ccc, 0 1px 0 #fff;
        -moz-box-shadow: inset 0 2px 2px #ccc, 0 1px 0 #fff;
        box-shadow: inset 0 2px 2px #ccc, 0 1px 0 #fff;
        padding-left: 10px;
        background-position: 10px 6px;
        margin: 0 0.5%;
        display: block;
        float: left;
        width: 96%;
        margin: 0 10px;
    }

    fieldset textarea:focus {
        outline: none;
        border: 1px solid #77BACE;
        -webkit-box-shadow: inset 0 2px 2px #ccc, 0 0 10px #ADDCE6;
        -moz-box-shadow: inset 0 2px 2px #ccc, 0 0 10px #ADDCE6;
        box-shadow: inset 0 2px 2px #ccc, 0 0 10px #ADDCE6;
    }

    .submit_link {
        float: right;
        margin-right: 3%;
        padding: 5px 0;
    }

    .submit_link select {
        width: 150px;
        border: 1px solid #bbb;
        height: 20px;
        color: #666666;
    }

    #main .module_content h1 {
        color: #333333;
        text-transform: none;
        text-shadow: 0 1px 0 #fff;
        font-size: 22px;
        margin: 8px 0px;
    }

    #main .module_content h2 {
        color: #444444;
        text-transform: none;
        text-shadow: 0 1px 0 #fff;
        font-size: 18px;
        margin: 8px 0px;
    }

    #main .module_content h3 {
        color: #666666;
        text-transform: uppercase;
        text-shadow: 0 1px 0 #fff;
        font-size: 13px;
        margin: 8px 0px;
    }

    #main .module_content h4 {
        color: #666666;
        text-transform: none;
        text-shadow: 0 1px 0 #fff;
        font-size: 13px;
        margin: 8px 0px;
    }

    #main .module_content li {
        line-height: 150%;
    }

    /* Alerts */

    #main h4.alert_info {
        display: block;
        width: 95%;
        margin: 20px 3% 0 3%;
        margin-top: 20px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        background: #B5E5EF url(<?php echo $GLOBALS['_Biscoito']->getSite() ?>cms/images/icn_alert_info.png) no-repeat;
        background-position: 10px 10px;
        border: 1px solid #77BACE;
        color: #082B33;
        padding: 10px 0;
        text-indent: 40px;
        font-size: 14px;}

    #main h4.alert_warning {
        display: block;
        width: 95%;
        margin: 20px 3% 0 3%;
        margin-top: 20px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        background: #F5F3BA url(<?php echo $GLOBALS['_Biscoito']->getSite() ?>cms/images/icn_alert_warning.png) no-repeat;
        background-position: 10px 10px;
        border: 1px solid #C7A20D;
        color: #796616;
        padding: 10px 0;
        text-indent: 40px;
        font-size: 14px;}

    #main h4.alert_error {
        display: block;
        width: 95%;
        margin: 20px 3% 0 3%;
        margin-top: 20px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        background: #F3D9D9 url(<?php echo $GLOBALS['_Biscoito']->getSite() ?>cms/images/icn_alert_error.png) no-repeat;
        background-position: 10px 10px;
        border: 1px solid #D20009;
        color: #7B040F;
        padding: 10px 0;
        text-indent: 40px;
        font-size: 14px;}

    #main h4.alert_success {
        display: block;
        width: 95%;
        margin: 20px 3% 0 3%;
        margin-top: 20px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        background: #E2F6C5 url(<?php echo $GLOBALS['_Biscoito']->getSite() ?>cms/images/icn_alert_success.png) no-repeat;
        background-position: 10px 10px;
        border: 1px solid #79C20D;
        color: #32510F;
        padding: 10px 0;
        text-indent: 40px;
        font-size: 14px;
    }

    .ui-dialog h1 {
        padding: 0;
        margin: 0; 
        font-size: 40px;
        font-weight: normal;
    }
    
    .ui-dialog .divisor {
        clear: both;
        border-bottom: 1px solid #aaa;
        margin-bottom: 10px;
    }
    
    .ui-dialog button {
        float: right;
    }
</style>