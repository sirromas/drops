<div id="bottom" class="dark1">
    <div class="container-fluid" >
        <div class="row" >
            <div class="col-sm-12" >
                <aside id="block-region-bottom" class="bottom style-bottom block-region" data-blockregion="bottom"
                       data-droptarget="1">
                    <div id="inst26" class="block_html  block" role="complementary" data-block="html"
                         data-instanceid="26" aria-label="HTML">
                        <div class="content" >
                            <div class="block_action notitle"></div>
                            <div class="no-overflow" >
                                <div class="rows">
                                    <div class="col-sm-12" style="margin-top: 5px;text-align: center;">
                                        <span style="font-size: 20px;margin-right: 15px;color:white;">SUBSCRIBE TO OUR NEWSLETTER</span>
                                        <input type="text" id="subs_name" style="" placeholder="Your Name">
                                        <input type="text" style="margin-right: 15px;" id="subs_email" style="idth: 15%;" placeholder="Your Email">
                                        <a href="#" onclick="return false;" class="btn btn-success btn-lg btn-icon-before">
                                        <span class="btn-text"  style="" id="add_subs">Sign Up</span></a>
                                    </div>
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