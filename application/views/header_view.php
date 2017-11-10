<!DOCTYPE html>
<html dir="ltr" lang="en" xml:lang="en">
<head>
    <title>Learning Drops</title>
    <link rel="shortcut icon"
          href="http://<? echo $_SERVER['SERVER_NAME']; ?>/clientes/drops/lms/theme/image.php/mb2nl/theme/1510318957/favicon"/>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script type="text/javascript" src="http://<? echo $_SERVER['SERVER_NAME']; ?>/clientes/drops/lms/theme/jquery.php/core/jquery-3.1.0.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        //<![CDATA[
        var M = {};
        M.yui = {};
        M.pageloadstarttime = new Date();
        M.cfg = {
            "wwwroot": "http:\/\/<? echo $_SERVER['SERVER_NAME']; ?>\/clientes\/drops\/lms",
            "sesskey": "hOAJvSA9jM",
            "themerev": "1510318957",
            "slasharguments": 1,
            "theme": "mb2nl",
            "iconsystemmodule": "core\/icon_system_standard",
            "jsrev": "1510318528",
            "admin": "admin",
            "svgicons": true,
            "usertimezone": "America\/Chicago",
            "contextid": 5
        };
        var yui1ConfigFn = function (me) {
            if (/-skin|reset|fonts|grids|base/.test(me.name)) {
                me.type = 'css';
                me.path = me.path.replace(/\.js/, '.css');
                me.path = me.path.replace(/\/yui2-skin/, '/assets/skins/sam/yui2-skin')
            }
        };
        var yui2ConfigFn = function (me) {
            var parts = me.name.replace(/^moodle-/, '').split('-'), component = parts.shift(), module = parts[0],
                min = '-min';
            if (/-(skin|core)$/.test(me.name)) {
                parts.pop();
                me.type = 'css';
                min = ''
            }
            if (module) {
                var filename = parts.join('-');
                me.path = component + '/' + module + '/' + filename + min + '.' + me.type
            } else {
                me.path = component + '/' + component + '.' + me.type
            }
        };
        YUI_config = {
            "debug": false,
            "base": "http:\/\/<? echo $_SERVER['SERVER_NAME'];  ?>\/clientes\/drops\/lms\/lib\/yuilib\/3.17.2\/",
            "comboBase": "http:\/\/<?  echo $_SERVER['SERVER_NAME'];  ?>\/clientes\/drops\/lms\/theme\/yui_combo.php?",
            "combine": true,
            "filter": null,
            "insertBefore": "firstthemesheet",
            "groups": {
                "yui2": {
                    "base": "http:\/\/<?  echo $_SERVER['SERVER_NAME'];  ?>\/clientes\/drops\/lms\/lib\/yuilib\/2in3\/2.9.0\/build\/",
                    "comboBase": "http:\/\/<? echo $_SERVER['SERVER_NAME'];  ?>\/clientes\/drops\/lms\/theme\/yui_combo.php?",
                    "combine": true,
                    "ext": false,
                    "root": "2in3\/2.9.0\/build\/",
                    "patterns": {"yui2-": {"group": "yui2", "configFn": yui1ConfigFn}}
                },
                "moodle": {
                    "name": "moodle",
                    "base": "http:\/\/<? echo $_SERVER['SERVER_NAME'];  ?>\/clientes\/drops\/lms\/theme\/yui_combo.php?m\/1510318528\/",
                    "combine": true,
                    "comboBase": "http:\/\/ <? echo $_SERVER['SERVER_NAME'];  ?>\/clientes\/drops\/lms\/theme\/yui_combo.php?",
                    "ext": false,
                    "root": "m\/1510318528\/",
                    "patterns": {"moodle-": {"group": "moodle", "configFn": yui2ConfigFn}},
                    "filter": null,
                    "modules": {
                        "moodle-core-blocks": {"requires": ["base", "node", "io", "dom", "dd", "dd-scroll", "moodle-core-dragdrop", "moodle-core-notification"]},
                        "moodle-core-dragdrop": {"requires": ["base", "node", "io", "dom", "dd", "event-key", "event-focus", "moodle-core-notification"]},
                        "moodle-core-tooltip": {"requires": ["base", "node", "io-base", "moodle-core-notification-dialogue", "json-parse", "widget-position", "widget-position-align", "event-outside", "cache-base"]},
                        "moodle-core-checknet": {"requires": ["base-base", "moodle-core-notification-alert", "io-base"]},
                        "moodle-core-popuphelp": {"requires": ["moodle-core-tooltip"]},
                        "moodle-core-dock": {"requires": ["base", "node", "event-custom", "event-mouseenter", "event-resize", "escape", "moodle-core-dock-loader", "moodle-core-event"]},
                        "moodle-core-dock-loader": {"requires": ["escape"]},
                        "moodle-core-maintenancemodetimer": {"requires": ["base", "node"]},
                        "moodle-core-event": {"requires": ["event-custom"]},
                        "moodle-core-notification": {"requires": ["moodle-core-notification-dialogue", "moodle-core-notification-alert", "moodle-core-notification-confirm", "moodle-core-notification-exception", "moodle-core-notification-ajaxexception"]},
                        "moodle-core-notification-dialogue": {"requires": ["base", "node", "panel", "escape", "event-key", "dd-plugin", "moodle-core-widget-focusafterclose", "moodle-core-lockscroll"]},
                        "moodle-core-notification-alert": {"requires": ["moodle-core-notification-dialogue"]},
                        "moodle-core-notification-confirm": {"requires": ["moodle-core-notification-dialogue"]},
                        "moodle-core-notification-exception": {"requires": ["moodle-core-notification-dialogue"]},
                        "moodle-core-notification-ajaxexception": {"requires": ["moodle-core-notification-dialogue"]},
                        "moodle-core-handlebars": {"condition": {"trigger": "handlebars", "when": "after"}},
                        "moodle-core-actionmenu": {"requires": ["base", "event", "node-event-simulate"]},
                        "moodle-core-chooserdialogue": {"requires": ["base", "panel", "moodle-core-notification"]},
                        "moodle-core-languninstallconfirm": {"requires": ["base", "node", "moodle-core-notification-confirm", "moodle-core-notification-alert"]},
                        "moodle-core-lockscroll": {"requires": ["plugin", "base-build"]},
                        "moodle-core-formchangechecker": {"requires": ["base", "event-focus", "moodle-core-event"]},
                        "moodle-core_availability-form": {"requires": ["base", "node", "event", "event-delegate", "panel", "moodle-core-notification-dialogue", "json"]},
                        "moodle-backup-confirmcancel": {"requires": ["node", "node-event-simulate", "moodle-core-notification-confirm"]},
                        "moodle-backup-backupselectall": {"requires": ["node", "event", "node-event-simulate", "anim"]},
                        "moodle-course-categoryexpander": {"requires": ["node", "event-key"]},
                        "moodle-course-dragdrop": {"requires": ["base", "node", "io", "dom", "dd", "dd-scroll", "moodle-core-dragdrop", "moodle-core-notification", "moodle-course-coursebase", "moodle-course-util"]},
                        "moodle-course-util": {
                            "requires": ["node"],
                            "use": ["moodle-course-util-base"],
                            "submodules": {
                                "moodle-course-util-base": {},
                                "moodle-course-util-section": {"requires": ["node", "moodle-course-util-base"]},
                                "moodle-course-util-cm": {"requires": ["node", "moodle-course-util-base"]}
                            }
                        },
                        "moodle-course-modchooser": {"requires": ["moodle-core-chooserdialogue", "moodle-course-coursebase"]},
                        "moodle-course-management": {"requires": ["base", "node", "io-base", "moodle-core-notification-exception", "json-parse", "dd-constrain", "dd-proxy", "dd-drop", "dd-delegate", "node-event-delegate"]},
                        "moodle-course-formatchooser": {"requires": ["base", "node", "node-event-simulate"]},
                        "moodle-form-showadvanced": {"requires": ["node", "base", "selector-css3"]},
                        "moodle-form-shortforms": {"requires": ["node", "base", "selector-css3", "moodle-core-event"]},
                        "moodle-form-passwordunmask": {"requires": []},
                        "moodle-form-dateselector": {"requires": ["base", "node", "overlay", "calendar"]},
                        "moodle-question-searchform": {"requires": ["base", "node"]},
                        "moodle-question-chooser": {"requires": ["moodle-core-chooserdialogue"]},
                        "moodle-question-qbankmanager": {"requires": ["node", "selector-css3"]},
                        "moodle-question-preview": {"requires": ["base", "dom", "event-delegate", "event-key", "core_question_engine"]},
                        "moodle-availability_completion-form": {"requires": ["base", "node", "event", "moodle-core_availability-form"]},
                        "moodle-availability_date-form": {"requires": ["base", "node", "event", "io", "moodle-core_availability-form"]},
                        "moodle-availability_grade-form": {"requires": ["base", "node", "event", "moodle-core_availability-form"]},
                        "moodle-availability_group-form": {"requires": ["base", "node", "event", "moodle-core_availability-form"]},
                        "moodle-availability_grouping-form": {"requires": ["base", "node", "event", "moodle-core_availability-form"]},
                        "moodle-availability_profile-form": {"requires": ["base", "node", "event", "moodle-core_availability-form"]},
                        "moodle-qtype_ddimageortext-form": {"requires": ["moodle-qtype_ddimageortext-dd", "form_filepicker"]},
                        "moodle-qtype_ddimageortext-dd": {"requires": ["node", "dd", "dd-drop", "dd-constrain"]},
                        "moodle-qtype_ddmarker-form": {"requires": ["moodle-qtype_ddmarker-dd", "form_filepicker", "graphics", "escape"]},
                        "moodle-qtype_ddmarker-dd": {"requires": ["node", "event-resize", "dd", "dd-drop", "dd-constrain", "graphics"]},
                        "moodle-qtype_ddwtos-dd": {"requires": ["node", "dd", "dd-drop", "dd-constrain"]},
                        "moodle-mod_assign-history": {"requires": ["node", "transition"]},
                        "moodle-mod_forum-subscriptiontoggle": {"requires": ["base-base", "io-base"]},
                        "moodle-mod_quiz-quizquestionbank": {"requires": ["base", "event", "node", "io", "io-form", "yui-later", "moodle-question-qbankmanager", "moodle-core-notification-dialogue"]},
                        "moodle-mod_quiz-repaginate": {"requires": ["base", "event", "node", "io", "moodle-core-notification-dialogue"]},
                        "moodle-mod_quiz-dragdrop": {"requires": ["base", "node", "io", "dom", "dd", "dd-scroll", "moodle-core-dragdrop", "moodle-core-notification", "moodle-mod_quiz-quizbase", "moodle-mod_quiz-util-base", "moodle-mod_quiz-util-page", "moodle-mod_quiz-util-slot", "moodle-course-util"]},
                        "moodle-mod_quiz-modform": {"requires": ["base", "node", "event"]},
                        "moodle-mod_quiz-util": {
                            "requires": ["node", "moodle-core-actionmenu"],
                            "use": ["moodle-mod_quiz-util-base"],
                            "submodules": {
                                "moodle-mod_quiz-util-base": {},
                                "moodle-mod_quiz-util-slot": {"requires": ["node", "moodle-mod_quiz-util-base"]},
                                "moodle-mod_quiz-util-page": {"requires": ["node", "moodle-mod_quiz-util-base"]}
                            }
                        },
                        "moodle-mod_quiz-randomquestion": {"requires": ["base", "event", "node", "io", "moodle-core-notification-dialogue"]},
                        "moodle-mod_quiz-autosave": {"requires": ["base", "node", "event", "event-valuechange", "node-event-delegate", "io-form"]},
                        "moodle-mod_quiz-quizbase": {"requires": ["base", "node"]},
                        "moodle-mod_quiz-questionchooser": {"requires": ["moodle-core-chooserdialogue", "moodle-mod_quiz-util", "querystring-parse"]},
                        "moodle-mod_quiz-toolboxes": {"requires": ["base", "node", "event", "event-key", "io", "moodle-mod_quiz-quizbase", "moodle-mod_quiz-util-slot", "moodle-core-notification-ajaxexception"]},
                        "moodle-message_airnotifier-toolboxes": {"requires": ["base", "node", "io"]},
                        "moodle-filter_glossary-autolinker": {"requires": ["base", "node", "io-base", "json-parse", "event-delegate", "overlay", "moodle-core-event", "moodle-core-notification-alert", "moodle-core-notification-exception", "moodle-core-notification-ajaxexception"]},
                        "moodle-filter_mathjaxloader-loader": {"requires": ["moodle-core-event"]},
                        "moodle-editor_atto-editor": {"requires": ["node", "transition", "io", "overlay", "escape", "event", "event-simulate", "event-custom", "node-event-html5", "node-event-simulate", "yui-throttle", "moodle-core-notification-dialogue", "moodle-core-notification-confirm", "moodle-editor_atto-rangy", "handlebars", "timers", "querystring-stringify"]},
                        "moodle-editor_atto-plugin": {"requires": ["node", "base", "escape", "event", "event-outside", "handlebars", "event-custom", "timers", "moodle-editor_atto-menu"]},
                        "moodle-editor_atto-menu": {"requires": ["moodle-core-notification-dialogue", "node", "event", "event-custom"]},
                        "moodle-editor_atto-rangy": {"requires": []},
                        "moodle-report_eventlist-eventfilter": {"requires": ["base", "event", "node", "node-event-delegate", "datatable", "autocomplete", "autocomplete-filters"]},
                        "moodle-report_loglive-fetchlogs": {"requires": ["base", "event", "node", "io", "node-event-delegate"]},
                        "moodle-gradereport_grader-gradereporttable": {"requires": ["base", "node", "event", "handlebars", "overlay", "event-hover"]},
                        "moodle-gradereport_history-userselector": {"requires": ["escape", "event-delegate", "event-key", "handlebars", "io-base", "json-parse", "moodle-core-notification-dialogue"]},
                        "moodle-tool_capability-search": {"requires": ["base", "node"]},
                        "moodle-tool_lp-dragdrop-reorder": {"requires": ["moodle-core-dragdrop"]},
                        "moodle-tool_monitor-dropdown": {"requires": ["base", "event", "node"]},
                        "moodle-assignfeedback_editpdf-editor": {"requires": ["base", "event", "node", "io", "graphics", "json", "event-move", "event-resize", "transition", "querystring-stringify-simple", "moodle-core-notification-dialog", "moodle-core-notification-alert", "moodle-core-notification-exception", "moodle-core-notification-ajaxexception"]},
                        "moodle-atto_accessibilitychecker-button": {"requires": ["color-base", "moodle-editor_atto-plugin"]},
                        "moodle-atto_accessibilityhelper-button": {"requires": ["moodle-editor_atto-plugin"]},
                        "moodle-atto_align-button": {"requires": ["moodle-editor_atto-plugin"]},
                        "moodle-atto_bold-button": {"requires": ["moodle-editor_atto-plugin"]},
                        "moodle-atto_charmap-button": {"requires": ["moodle-editor_atto-plugin"]},
                        "moodle-atto_clear-button": {"requires": ["moodle-editor_atto-plugin"]},
                        "moodle-atto_collapse-button": {"requires": ["moodle-editor_atto-plugin"]},
                        "moodle-atto_emoticon-button": {"requires": ["moodle-editor_atto-plugin"]},
                        "moodle-atto_equation-button": {"requires": ["moodle-editor_atto-plugin", "moodle-core-event", "io", "event-valuechange", "tabview", "array-extras"]},
                        "moodle-atto_html-button": {"requires": ["moodle-editor_atto-plugin", "event-valuechange"]},
                        "moodle-atto_image-button": {"requires": ["moodle-editor_atto-plugin"]},
                        "moodle-atto_indent-button": {"requires": ["moodle-editor_atto-plugin"]},
                        "moodle-atto_italic-button": {"requires": ["moodle-editor_atto-plugin"]},
                        "moodle-atto_link-button": {"requires": ["moodle-editor_atto-plugin"]},
                        "moodle-atto_managefiles-button": {"requires": ["moodle-editor_atto-plugin"]},
                        "moodle-atto_managefiles-usedfiles": {"requires": ["node", "escape"]},
                        "moodle-atto_media-button": {"requires": ["moodle-editor_atto-plugin"]},
                        "moodle-atto_noautolink-button": {"requires": ["moodle-editor_atto-plugin"]},
                        "moodle-atto_orderedlist-button": {"requires": ["moodle-editor_atto-plugin"]},
                        "moodle-atto_rtl-button": {"requires": ["moodle-editor_atto-plugin"]},
                        "moodle-atto_strike-button": {"requires": ["moodle-editor_atto-plugin"]},
                        "moodle-atto_subscript-button": {"requires": ["moodle-editor_atto-plugin"]},
                        "moodle-atto_superscript-button": {"requires": ["moodle-editor_atto-plugin"]},
                        "moodle-atto_table-button": {"requires": ["moodle-editor_atto-plugin", "moodle-editor_atto-menu", "event", "event-valuechange"]},
                        "moodle-atto_title-button": {"requires": ["moodle-editor_atto-plugin"]},
                        "moodle-atto_underline-button": {"requires": ["moodle-editor_atto-plugin"]},
                        "moodle-atto_undo-button": {"requires": ["moodle-editor_atto-plugin"]},
                        "moodle-atto_unorderedlist-button": {"requires": ["moodle-editor_atto-plugin"]}
                    }
                },
                "gallery": {
                    "name": "gallery",
                    "base": "http:\/\/ <? echo $_SERVER['SERVER_NAME']; ?>\/clientes\/drops\/lms\/lib\/yuilib\/gallery\/",
                    "combine": true,
                    "comboBase": "http:\/\/<?  echo $_SERVER['SERVER_NAME'];  ?>\/clientes\/drops\/lms\/theme\/yui_combo.php?",
                    "ext": false,
                    "root": "gallery\/1510318528\/",
                    "patterns": {"gallery-": {"group": "gallery"}}
                }
            },
            "modules": {
                "core_filepicker": {
                    "name": "core_filepicker",
                    "fullpath": "http:\/\/<?  echo $_SERVER['SERVER_NAME'];  ?>\/clientes\/drops\/lms\/lib\/javascript.php\/1510318528\/repository\/filepicker.js",
                    "requires": ["base", "node", "node-event-simulate", "json", "async-queue", "io-base", "io-upload-iframe", "io-form", "yui2-treeview", "panel", "cookie", "datatable", "datatable-sort", "resize-plugin", "dd-plugin", "escape", "moodle-core_filepicker", "moodle-core-notification-dialogue"]
                },
                "core_comment": {
                    "name": "core_comment",
                    "fullpath": "http:\/\/<?  echo $_SERVER['SERVER_NAME'];  ?>\/clientes\/drops\/lms\/lib\/javascript.php\/1510318528\/comment\/comment.js",
                    "requires": ["base", "io-base", "node", "json", "yui2-animation", "overlay", "escape"]
                },
                "mathjax": {
                    "name": "mathjax",
                    "fullpath": "https:\/\/cdnjs.cloudflare.com\/ajax\/libs\/mathjax\/2.7.1\/MathJax.js?delayStartupUntil=configured"
                }
            }
        };
        M.yui.loader = {modules: {}};

        //]]>
    </script>

    <link href="//fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="moodle, Dashboard"/>
    <link rel="stylesheet" type="text/css"
          href="http://<? echo $_SERVER['SERVER_NAME']; ?>/clientes/drops/lms/theme/yui_combo.php?rollup/3.17.2/yui-moodlesimple-min.css"/>
    <script id="firstthemesheet"
            type="text/css">/** Required in order to fix style inclusion problems in IE with YUI **/</script>

    <link rel="stylesheet" type="text/css"
          href="http://<? echo $_SERVER['SERVER_NAME']; ?>/clientes/drops/lms/theme/styles.php/mb2nl/1510318957/all"/>
    <link rel="stylesheet" type="text/css"
          href="http://<? echo $_SERVER['SERVER_NAME']; ?>/clientes/drops/lms/theme/mb2nl/assets/font-awesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css"
          href="http://<? echo $_SERVER['SERVER_NAME']; ?>/clientes/drops/lms/theme/mb2nl/assets/pe-icon-7-stroke/css/pe-icon-7-stroke.min.css"/>
    <link rel="stylesheet" type="text/css"
          href="http://<? echo $_SERVER['SERVER_NAME']; ?>/clientes/drops/lms/theme/mb2nl/assets/bootstrap/css/glyphicons.min.css"/>
    <link rel="stylesheet" type="text/css"
          href="http://<? echo $_SERVER['SERVER_NAME']; ?>/clientes/drops/lms/theme/mb2nl/assets/OwlCarousel/assets/owl.carousel.min.css"/>
    <link rel="stylesheet" type="text/css"
          href="http://<? echo $_SERVER['SERVER_NAME']; ?>/clientes/drops/lms/theme/mb2nl/assets/Nivo-Lightbox/nivo-lightbox.min.css"/>
    <link rel="stylesheet" type="text/css"
          href="http://<? echo $_SERVER['SERVER_NAME']; ?>/clientes/drops/lms/theme/mb2nl/assets/spectrum/spectrum.min.css"/>

    <script type="text/javascript"
            src="http://<? echo $_SERVER['SERVER_NAME']; ?>/clientes/drops/lms/theme/yui_combo.php?rollup/3.17.2/yui-moodlesimple-min.js"></script>

    <script type="text/javascript"
            src="http://<? echo $_SERVER['SERVER_NAME']; ?>/clientes/drops/lms/lib/javascript.php/1510318528/lib/javascript-static.js"></script>


</head>

<div id="page">
    <div id="page-a">
        <div id="main-header">
            <div class="container-fluid" id="yui_3_17_2_2_1510321856752_178">
                <div class="row" id="yui_3_17_2_2_1510321856752_177">
                    <div class="col-sm-12" id="yui_3_17_2_2_1510321856752_176">
                        <div class="main-logo" style="width:180px;margin:20px 0 20px 0;margin-left:40%;"
                             id="yui_3_17_2_2_1510321856752_244">
                            <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/clientes/drops/" title="Learning Drops"
                               id="yui_3_17_2_2_1510321856752_243">
                                <img src="//marbol2.com/themes/new-learning/pluginfile.php/1/theme_mb2nl/logo/1508612606/logo_20170917.png"
                                     alt="New Learning" id="yui_3_17_2_2_1510321856752_242">
                            </a>
                        </div>
                        <!--
                        <ul class="social-list" style="margin:47px 0 0 12px;">
                            <li class="li-facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li class="li-twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li class="li-instagram"><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li class="li-youtube-play"><a href="#"><i class="fa fa-youtube-play"></i></a></li>
                            <li class="li-linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                        -->
                    </div>
                </div>
            </div>
        </div>
        <div class="sticky-nav-element-offset" style="height: 0px;"></div>

        <div id="main-navigation" class="">
            <div class="main-navigation-inner" id="">
                <div class="container-fluid" id="">
                    <div class="row" id="">
                        <div class="col-sm-12" id="">
                            <div class="menu-bar"><a class="mobile-home" href="http://marbol2.com/themes/new-learning"
                                                     title="New Learning"><i class="fa fa-home"></i></a><a
                                        class="show-menu" href="#"><i class="fa fa-bars"></i></a></div>
                            <ul class="main-menu theme-ddmenu sf-js-enabled desk-menu" data-animtype="2"
                                data-animspeed="450" style="touch-action: pan-y;" id="">
                                <li class="home-item"><a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/clientes/drops/"
                                                         title="New Learning"><i class="fa fa-home"></i></a></li>
                                <li class="" id=""><a title="Courses" class=""
                                                                                    href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/clientes/drops/index.php/navigation/courses"

                                                                                    id="">Courses</a>
                                </li>
                                <li class="" id=""><a title="Register" class=""
                                                                                    href="#"

                                                                                    id="">Register</a>
                                </li>
                                <li class="" id=""><a title="FAQ" class=""
                                                                                    href="#"

                                                                                    id="">Help</a>
                                </li>

                                <!--
                                <li class="dropdown" id="yui_3_17_2_2_1510321856752_180"><a href="#" class="sf-with-ul"
                                                                                            data-toggle=""
                                                                                            title="Elements"
                                                                                            id="yui_3_17_2_2_1510321856752_179">Elements<span
                                                class="mobile-arrow"></span></a>
                                    <ul class="dropdown-list" style="display: none;"
                                        id="yui_3_17_2_2_1510321856752_185">
                                        <li class="dropdown" id="yui_3_17_2_2_1510321856752_184"><a href="#"
                                                                                                    class="sf-with-ul"
                                                                                                    data-toggle=""
                                                                                                    title=" Elements #1"
                                                                                                    id="yui_3_17_2_2_1510321856752_183">
                                                Elements #1<span class="mobile-arrow"></span></a>
                                            <ul class="dropdown-list" style="display: none;"
                                                id="yui_3_17_2_2_1510321856752_188">
                                                <li class="" id="yui_3_17_2_2_1510321856752_187"><a title=" Accordions"
                                                                                                    class=""
                                                                                                    href="http://marbol2.com/themes/new-learning/mod/page/view.php?id=2"
                                                                                                    id="yui_3_17_2_2_1510321856752_186">
                                                        Accordions</a></li>
                                                <li class=""><a title=" Buttons" class=""
                                                                href="http://marbol2.com/themes/new-learning/mod/page/view.php?id=4">
                                                        Buttons</a></li>
                                                <li class=""><a title=" Highlights" class=""
                                                                href="http://marbol2.com/themes/new-learning/mod/page/view.php?id=5">
                                                        Highlights</a></li>
                                                <li class=""><a title=" Icon Boxes" class=""
                                                                href="http://marbol2.com/themes/new-learning/mod/page/view.php?id=6">
                                                        Icon Boxes</a></li>
                                                <li class=""><a title=" Image Boxes" class=""
                                                                href="http://marbol2.com/themes/new-learning/mod/page/view.php?id=7">
                                                        Image Boxes</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown"><a href="#" class="sf-with-ul" data-toggle=""
                                                                title=" Elements #2"> Elements #2<span
                                                        class="mobile-arrow"></span></a>
                                            <ul class="dropdown-list" style="display: none;">
                                                <li class=""><a title=" Headers" class=""
                                                                href="http://marbol2.com/themes/new-learning/mod/page/view.php?id=8">
                                                        Headers</a></li>
                                                <li class=""><a title=" Slider" class=""
                                                                href="http://marbol2.com/themes/new-learning/mod/page/view.php?id=9">
                                                        Slider</a></li>
                                                <li class=""><a title=" Tabs" class=""
                                                                href="http://marbol2.com/themes/new-learning/mod/page/view.php?id=3">
                                                        Tabs</a></li>
                                                <li class=""><a title=" Video" class=""
                                                                href="http://marbol2.com/themes/new-learning/mod/page/view.php?id=10">
                                                        Video</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                -->

                                <li class="" id=""><a title="About" class=""
                                                                                    href="#"

                                                                                    id="">About</a>
                                </li>

                                <li class="" id=""><a title="Contact" class=""
                                                                                    href=""
                                                                                    target=""
                                                                                    id="">Contact</a>
                                </li>

                                <li class="" id=""><a title="Login" class=""
                                                                                    href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/clientes/drops/index.php/navigation/login"
                                                                                    id="">Login</a>
                                </li>

                                <li class="nav navbar-nav navbar-right"><div class="theme-searchform" style="display:block;margin-top:3px;" id="yui_3_17_2_2_1510339076392_144"><form id="theme-search" action="http://marbol2.com/themes/new-learning/course/search.php" method="GET"><input id="theme-coursesearchbox" type="text" value="" placeholder="Search courses" name="search"><button type="submit" id="yui_3_17_2_2_1510339076392_145"><i class="fa fa-search"></i></button></form></div></li>



                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- //end #page-a -->

