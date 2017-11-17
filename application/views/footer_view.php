<div id="bottom" class="dark1">
    <div class="container-fluid" id="yui_3_17_2_2_1510781966338_212">
        <div class="row" id="yui_3_17_2_2_1510781966338_211">
            <div class="col-sm-12" id="yui_3_17_2_2_1510781966338_210">
                <aside id="block-region-bottom" class="bottom style-bottom block-region" data-blockregion="bottom"
                       data-droptarget="1">
                    <div id="inst26" class="block_html  block" role="complementary" data-block="html"
                         data-instanceid="26" aria-label="HTML">
                        <div class="content" id="yui_3_17_2_2_1510781966338_214">
                            <div class="block_action notitle"></div>
                            <div class="no-overflow" id="yui_3_17_2_2_1510781966338_213">
                                <div class="row theme-cols" id="yui_3_17_2_2_1510781966338_215">
                                    <div class="col-sm-4 align-right" id="yui_3_17_2_2_1510781966338_217">
                                        <h4 style="margin:15px 0 0 0;" id="yui_3_17_2_2_1510781966338_218">
                                            SUBSCRIBE TO OUR NEWSLETTER</h4></div>
                                    <div class="col-sm-4" style="margin-top: 8px;"><input type="text" id="subs_email" style="width:100%;"></div>
                                    <div class="col-sm-4 align-left">
                                        <a href="#" target="" class="btn btn-success btn-lg btn-icon-before">
                                            <span class="btn-text">Sign Up</span></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>
<footer id="footer" class="dark1">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="footer-content clearfix">
                    <p class="footer-text">Copyright © Learning Drops 2017. All rights reserved.</p>
                    <ul class="social-list">
                        <!--
                        <li class="li-facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li class="li-twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li class="li-instagram"><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li class="li-youtube-play"><a href="#"><i class="fa fa-youtube-play"></i></a></li>
                        <li class="li-linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        -->
                        <div class="sharethis-inline-share-buttons"></div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
</div><!-- //end #page-b -->
</div><!-- //end #page -->
</div><!-- //end #page-outer -->
<script type="text/javascript"
        src="http://<? echo $_SERVER['SERVER_NAME']; ?>/clientes/drops/lms/theme/jquery.php/core/jquery-3.1.0.min.js"></script>
<script type="text/javascript">
    //<![CDATA[
    var require = {
        baseUrl: 'http://<? echo $_SERVER['SERVER_NAME']; ?>/clientes/drops/lms/lib/requirejs.php/1510318528/',
        // We only support AMD modules with an explicit define() statement.
        enforceDefine: true,
        skipDataMain: true,
        waitSeconds: 0,

        paths: {
            jquery: 'http://<? echo $_SERVER['SERVER_NAME']; ?>/clientes/drops/lms/lib/javascript.php/1510318528/lib/jquery/jquery-3.1.0.min',
            jqueryui: 'http://<? echo $_SERVER['SERVER_NAME']; ?>/clientes/drops/lms/lib/javascript.php/1510318528/lib/jquery/ui-1.12.1/jquery-ui.min',
            jqueryprivate: 'http://<? echo $_SERVER['SERVER_NAME']; ?>/clientes/drops/lms/lib/javascript.php/1510318528/lib/requirejs/jquery-private'
        },

        // Custom jquery config map.
        map: {
            // '*' means all modules will get 'jqueryprivate'
            // for their 'jquery' dependency.
            '*': {jquery: 'jqueryprivate'},

            // 'jquery-private' wants the real jQuery module
            // though. If this line was not here, there would
            // be an unresolvable cyclic dependency.
            jqueryprivate: {jquery: 'jquery'}
        }
    };

    //]]>

</script>
<script type="text/javascript"
        src="http://<? echo $_SERVER['SERVER_NAME']; ?>/clientes/drops/lms/lib/javascript.php/1510318528/lib/requirejs/require.min.js"></script>
<script type="text/javascript">
    //<![CDATA[
    require(['core/first'], function () {
        ;
        require(["media_videojs/loader"], function (loader) {
            loader.setUp(function (videojs) {
                videojs.options.flash.swf = "http://<? echo $_SERVER['SERVER_NAME']; ?>/clientes/drops/lms/media/player/videojs/videojs/video-js.swf";
                videojs.addLanguage("en", {
                    "Play": "Play",
                    "Pause": "Pause",
                    "Current Time": "Current Time",
                    "Duration Time": "Duration Time",
                    "Remaining Time": "Remaining Time",
                    "Stream Type": "Stream Type",
                    "LIVE": "LIVE",
                    "Loaded": "Loaded",
                    "Progress": "Progress",
                    "Fullscreen": "Fullscreen",
                    "Non-Fullscreen": "Non-Fullscreen",
                    "Mute": "Mute",
                    "Unmute": "Unmute",
                    "Playback Rate": "Playback Rate",
                    "Subtitles": "Subtitles",
                    "subtitles off": "subtitles off",
                    "Captions": "Captions",
                    "captions off": "captions off",
                    "Chapters": "Chapters",
                    "Close Modal Dialog": "Close Modal Dialog",
                    "Descriptions": "Descriptions",
                    "descriptions off": "descriptions off",
                    "Audio Track": "Audio Track",
                    "You aborted the media playback": "You aborted the media playback",
                    "A network error caused the media download to fail part-way.": "A network error caused the media download to fail part-way.",
                    "The media could not be loaded, either because the server or network failed or because the format is not supported.": "The media could not be loaded, either because the server or network failed or because the format is not supported.",
                    "The media playback was aborted due to a corruption problem or because the media used features your browser did not support.": "The media playback was aborted due to a corruption problem or because the media used features your browser did not support.",
                    "No compatible source was found for this media.": "No compatible source was found for this media.",
                    "The media is encrypted and we do not have the keys to decrypt it.": "The media is encrypted and we do not have the keys to decrypt it.",
                    "Play Video": "Play Video",
                    "Close": "Close",
                    "Modal Window": "Modal Window",
                    "This is a modal window": "This is a modal window",
                    "This modal can be closed by pressing the Escape key or activating the close button.": "This modal can be closed by pressing the Escape key or activating the close button.",
                    ", opens captions settings dialog": ", opens captions settings dialog",
                    ", opens subtitles settings dialog": ", opens subtitles settings dialog",
                    ", opens descriptions settings dialog": ", opens descriptions settings dialog",
                    ", selected": ", selected"
                });

            });
        });
        ;
        require(["block_navigation/navblock"], function (amd) {
            amd.init("16");
        });
        ;
        require(["block_settings/settingsblock"], function (amd) {
            amd.init("17", "expandable_branch_71_siteadministration");
        });
        ;

        require(['jquery', 'block_myoverview/event_list'], function ($, EventList) {
            var root = $("#event-list-container-");
            EventList.registerEventListeners(root);
        });
        ;

        require(['jquery', 'block_myoverview/event_list'], function ($, EventList) {
            var root = $("#timeline-view-dates-5a05a9895a9a65a05a9878be1b10").find('[data-region="event-list-container"]');
            EventList.load(root);
        });
        ;

        require(['jquery', 'core/custom_interaction_events', 'block_myoverview/event_list_by_course'],
            function ($, CustomEvents, EventListByCourse) {

                var root = $("#sort-by-courses-view-5a05a9895a9a65a05a9878be1b10");
                // This flag is used so that we can delay the loading of the events until the tab
                // is toggled by the user.
                var seen = false;

                CustomEvents.define(root, [CustomEvents.events.activate]);
                // Show more courses and load their events when the user clicks the "more courses"
                // button.
                root.on(CustomEvents.events.activate, '[data-action="more-courses"]', function (e, data) {
                    var button = $(e.target);
                    var blocks = root.find('[data-region="course-block"].hidden');

                    if (blocks && blocks.length) {
                        var block = blocks.first();
                        EventListByCourse.init(block);
                        block.removeClass('hidden');
                    }

                    // If there was only one hidden block then we have no more to show now
                    // so we can disable the button.
                    if (blocks && blocks.length == 1) {
                        button.prop('disabled', true);
                    }

                    if (data) {
                        data.originalEvent.preventDefault();
                        data.originalEvent.stopPropagation();
                    }
                    e.stopPropagation();
                });

                // Listen for when the user changes tab so that we can show the first set of courses
                // and load their events when they request the sort by courses view for the first time.
                root.closest('[data-region="timeline-view"]').on('shown shown.bs.tab', function (e) {
                    if (seen) {
                        return;
                    }

                    var tab = $(e.target);
                    var tabTarget = $(tab.attr('href'));

                    if (!tabTarget || !tabTarget.length) {
                        return;
                    }

                    var viewCourses = tabTarget.find('#sort-by-courses-view-5a05a9895a9a65a05a9878be1b10');

                    if (viewCourses && viewCourses.length && !seen) {
                        seen = true;
                        viewCourses.find('[data-action="more-courses"]').trigger(CustomEvents.events.activate);
                    }
                });
            });
        ;

        require(['jquery', 'core/custom_interaction_events'], function ($, customEvents) {
            var root = $('#timeline-view-5a05a9895a9a65a05a9878be1b10');
            customEvents.define(root, [customEvents.events.activate]);
            root.on(customEvents.events.activate, '[data-toggle="btns"] > .btn', function () {
                root.find('.btn.active').removeClass('active');
            });
        });
        ;

        require(['jquery', 'core/custom_interaction_events'], function ($, customEvents) {
            var root = $('#courses-view-5a05a9895a9a65a05a9878be1b10');
            customEvents.define(root, [customEvents.events.activate]);
            root.on(customEvents.events.activate, '[data-toggle="btns"] > .btn', function () {
                root.find('.btn.active').removeClass('active');
            });
        });
        ;

        require(['jquery', 'block_myoverview/tab_preferences'], function ($, TabPreferences) {
            var root = $('#block-myoverview-view-choices-5a05a9895a9a65a05a9878be1b10');
            TabPreferences.registerEventListeners(root);
        });
        ;

        require(['core/yui'], function (Y) {
            M.util.init_skiplink(Y);
        });
        ;

        require(['core/yui'], function (Y) {
            Y.use('moodle-core-actionmenu', function () {
                M.core.actionmenu.init();
            });
        });
        ;
        require(["core/notification"], function (amd) {
            amd.init(5, []);
        });
        ;
        require(["core/log"], function (amd) {
            amd.setConfig({"level": "warn"});
        });
    });
    //]]>
</script>
<script type="text/javascript"
        src="http://<? echo $_SERVER['SERVER_NAME']; ?>/clientes/drops/lms/lib/javascript.php/1510318528/theme/mb2nl/assets/superfish/superfish.custom.min.js"></script>
<script type="text/javascript"
        src="http://<? echo $_SERVER['SERVER_NAME']; ?>/clientes/drops/lms/lib/javascript.php/1510318528/theme/mb2nl/assets/OwlCarousel/owl.carousel.min.js"></script>
<script type="text/javascript"
        src="http://<? echo $_SERVER['SERVER_NAME']; ?>/clientes/drops/lms/lib/javascript.php/1510318528/theme/mb2nl/assets/Nivo-Lightbox/nivo-lightbox.min.js"></script>
<script type="text/javascript"
        src="http://<? echo $_SERVER['SERVER_NAME']; ?>/clientes/drops/lms/lib/javascript.php/1510318528/theme/mb2nl/assets/spectrum/spectrum.min.js"></script>
<script type="text/javascript"
        src="http://<? echo $_SERVER['SERVER_NAME']; ?>/clientes/drops/lms/lib/javascript.php/1510318528/theme/mb2nl/javascript/theme-amd.js"></script>
<script type="text/javascript"
        src="http://<? echo $_SERVER['SERVER_NAME']; ?>/clientes/drops/lms/lib/javascript.php/1510318528/theme/mb2nl/javascript/theme.js"></script>
<script type="text/javascript"
        src="http://<? echo $_SERVER['SERVER_NAME']; ?>/clientes/drops/lms/lib/javascript.php/1510318528/theme/mb2nl/assets/youtube/player_api.js"></script>
<script type="text/javascript">
    //<![CDATA[
    M.str = {
        "moodle": {
            "lastmodified": "Last modified",
            "name": "Name",
            "error": "Error",
            "info": "Information",
            "yes": "Yes",
            "no": "No",
            "viewallcourses": "View all courses",
            "cancel": "Cancel",
            "morehelp": "More help",
            "loadinghelp": "Loading...",
            "confirm": "Confirm",
            "areyousure": "Are you sure?",
            "closebuttontitle": "Close",
            "unknownerror": "Unknown error"
        },
        "repository": {
            "type": "Type",
            "size": "Size",
            "invalidjson": "Invalid JSON string",
            "nofilesattached": "No files attached",
            "filepicker": "File picker",
            "logout": "Logout",
            "nofilesavailable": "No files available",
            "norepositoriesavailable": "Sorry, none of your current repositories can return files in the required format.",
            "fileexistsdialogheader": "File exists",
            "fileexistsdialog_editor": "A file with that name has already been attached to the text you are editing.",
            "fileexistsdialog_filemanager": "A file with that name has already been attached",
            "renameto": "Rename to \"{$a}\"",
            "referencesexist": "There are {$a} alias\/shortcut files that use this file as their source",
            "select": "Select"
        },
        "admin": {
            "confirmdeletecomments": "You are about to delete comments, are you sure?",
            "confirmation": "Confirmation"
        }
    };
    //]]>
</script>
<script type="text/javascript">
    //<![CDATA[
    (function () {
        Y.use("moodle-filter_mathjaxloader-loader", function () {
            M.filter_mathjaxloader.configure({
                "mathjaxconfig": "\nMathJax.Hub.Config({\n    config: [\"Accessible.js\", \"Safe.js\"],\n    errorSettings: { message: [\"!\"] },\n    skipStartupTypeset: true,\n    messageStyle: \"none\"\n});\n",
                "lang": "en"
            });
        });
        M.util.help_popups.setup(Y);
        Y.use("moodle-core-popuphelp", function () {
            M.core.init_popuphelp();
        });
        M.util.init_block_hider(Y, {
            "id": "inst16",
            "title": "Navigation",
            "preference": "block16hidden",
            "tooltipVisible": "Hide Navigation block",
            "tooltipHidden": "Show Navigation block"
        });
        M.util.init_block_hider(Y, {
            "id": "inst17",
            "title": "Administration",
            "preference": "block17hidden",
            "tooltipVisible": "Hide Administration block",
            "tooltipHidden": "Show Administration block"
        });
        M.util.init_block_hider(Y, {
            "id": "inst9",
            "title": "Private files",
            "preference": "block9hidden",
            "tooltipVisible": "Hide Private files block",
            "tooltipHidden": "Show Private files block"
        });
        M.util.init_block_hider(Y, {
            "id": "inst10",
            "title": "Online users",
            "preference": "block10hidden",
            "tooltipVisible": "Hide Online users block",
            "tooltipHidden": "Show Online users block"
        });
        M.util.init_block_hider(Y, {
            "id": "inst11",
            "title": "Latest badges",
            "preference": "block11hidden",
            "tooltipVisible": "Hide Latest badges block",
            "tooltipHidden": "Show Latest badges block"
        });
        M.util.init_block_hider(Y, {
            "id": "inst12",
            "title": "Calendar",
            "preference": "block12hidden",
            "tooltipVisible": "Hide Calendar block",
            "tooltipHidden": "Show Calendar block"
        });
        M.util.init_block_hider(Y, {
            "id": "inst13",
            "title": "Upcoming events",
            "preference": "block13hidden",
            "tooltipVisible": "Hide Upcoming events block",
            "tooltipHidden": "Show Upcoming events block"
        });
        M.util.init_block_hider(Y, {
            "id": "inst15",
            "title": "Course overview",
            "preference": "block15hidden",
            "tooltipVisible": "Hide Course overview block",
            "tooltipHidden": "Show Course overview block"
        });
        M.util.js_pending('random5a05a9878be1b29');
        Y.on('domready', function () {
            M.util.js_complete("init");
            M.util.js_complete('random5a05a9878be1b29');
        });
    })();
    //]]>
</script>
</body>
</html>