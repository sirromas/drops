$(document).ready(function () {

    console.log("ready!");

    function get_student_subscriptions_list() {
        var url = '/lms/custom/courses/get_student_subscriptions.php';
        $.post(url, {id: 1}).done(function (data) {
            $('#page-content').html(data);
            $('#subscriptions_table').dataTable();
        });
    }

    $("body").click(function (event) {

        console.log('Event ID: ' + event.target.id);

        /************ Sliders section ************/

        if (event.target.id.indexOf("slide_upload_") >= 0) {
            var id = event.target.id.replace("slide_upload_", "");
            var url = '/lms/custom/slider/dialog.php';
            $.post(url, {id: id}).done(function (data) {
                $("body").append(data);
                $("#myModal").modal('show');
                document.body.style.overflow = 'auto';
            });
        }

        function get_slides_page() {
            var url = '/lms/custom/slider/list.php';
            $.post(url, {id: 1}).done(function (data) {
                $('#page-content').html(data);
                $('#banners_table').DataTable();
            }); // end of post
        }


        if (event.target.id == 'slider_cancel_dialog') {
            $("[data-dismiss=modal]").trigger({type: "click"});
            $("#myModal").remove();
            $('.modal-backdrop').remove();
        }

        if (event.target.id == 'upload_slide_done') {
            var id = $('#slide_id').val();
            var url = '/lms/custom/slider/upload.php';
            var raw_file_data = $('#files')[0].files.length;
            var file_data = $('#files').prop('files');
            console.log('File data: ' + raw_file_data);
            if (raw_file_data == 0) {
                $('#slide_err').html('Please select file to upload');
                return false;
            } // end if
            else {
                $('#slide_err').html('');
                var form_data = new FormData();
                $.each(file_data, function (key, value) {
                    form_data.append(key, value);
                });
                form_data.append('id', id);
                $('#loader').show();
                $.ajax({
                    url: url,
                    data: form_data,
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    success: function () {
                        $('#loader').hide();
                        get_slides_page();
                    } // end of success
                }); // end of $.ajax
            } // end else

            $("[data-dismiss=modal]").trigger({type: "click"});
            $("#myModal").remove();
            $('.modal-backdrop').remove();
            get_slides_page();
        }


        /*********** Site pages section ************/

        if (event.target.id.indexOf("page_") >= 0) {
            var url;
            var pageid = event.target.id.replace("page_", "");
            if ($.isNumeric(pageid)) {
                get_site_edit_page(pageid);
            } // end if
            else {
                switch (pageid) {
                    case 'contact':
                        url = '/lms/custom/contact/edit.php';
                        $.post(url, {id: 1}).done(function (data) {
                            $('#page-content').html(data);
                        }); // end of post
                        break;
                    case 'news':
                        url = '/lms/custom/news/list.php';
                        $.post(url, {id: 1}).done(function (data) {
                            $('#page-content').html(data);
                            $('#news_table').DataTable();
                        }); // end of post
                        break;
                    case 'slider':
                        url = '/lms/custom/slider/list.php';
                        $.post(url, {id: 1}).done(function (data) {
                            $('#page-content').html(data);
                            $('#banners_table').DataTable();
                        }); // end of post
                        break;
                } // end of switch
            } // end else
        }

        if (event.target.id == 'update_site_page') {
            var pageid = $('#pageid').val();
            update_site_page(pageid);
        }

        if (event.target.id == 'update_company_info') {
            var name = $('#name').val();
            var addr = CKEDITOR.instances["addr"].getData();
            var email = $('#email').val();
            var phone = $('#phone').val();
            if (name == '' || addr == '' || email == '' || phone == '') {
                $('#contact_err').html('All fields are required');
            } // end if
            else {
                $('#contact_err').html('');
                var item = {name: name, addr: addr, email: email, phone: phone};
                var url = '/lms/custom/contact/update.php';
                $.post(url, {item: JSON.stringify(item)}).done(function (data) {
                    $('#page-content').html(data);
                });
            } // end else
        }

        function get_site_edit_page(id) {
            var url = '/lms/custom/pages/edit.php';
            $.post(url, {id: id}).done(function (data) {
                $('#page-content').html(data);
            });
        }

        function update_site_page(pageid) {
            var title = $('#page_title').val();
            var content = CKEDITOR.instances["editor1"].getData();
            var limit = $('#climit').val();
            if (title != '' && content != '' && limit > 0) {
                $('#page_err').html('');
                var item = {pageid: pageid, title: title, content: content, limit: limit};
                var url = '/lms/custom/pages/update.php';
                $.post(url, {item: JSON.stringify(item)}).done(function (data) {
                    $('#page-content').html(data);
                });
            } // end if
            else {
                $('#page_err').html('Please provide page title, content and limit');
            }
        }


        /*********** News section ************/

        if (event.target.id.indexOf("news_edit_") >= 0) {
            var id = event.target.id.replace("news_edit_", "");
            var url = '/lms/custom/news/edit_dialog.php';
            $.post(url, {id: id}).done(function (data) {
                $("body").append(data);
                $("#myModal").modal('show');
                document.body.style.overflow = 'auto';
            });
        }

        if (event.target.id == "news_update_done") {
            var id = $('#news_id').val();
            //var title = CKEDITOR.instances["news_title"].getData();
            var title = $('#news_title').val();
            var content = CKEDITOR.instances["news_content"].getData();
            var limit = $('#climit').val();
            var status;
            if ($('#active').prop('checked')) {
                status = 1;
            } // end if
            else {
                status = 0;
            } // end else
            if (title == '' || content == '' || limit == 0) {
                $('#news_err').html('Please provide news title , content and limit');
            } // end if
            else {
                $('#news_err').html('');
                var url = '/lms/custom/news/update.php';
                var file_data = $('#files').prop('files');
                var form_data = new FormData();
                $.each(file_data, function (key, value) {
                    form_data.append(key, value);
                });
                form_data.append('id', id);
                form_data.append('title', title);
                form_data.append('content', content);
                form_data.append('status', status);
                form_data.append('limit', limit);
                $.ajax({
                    url: url,
                    data: form_data,
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    success: function () {
                        $("[data-dismiss=modal]").trigger({type: "click"});
                        $("#myModal").remove();
                        $('.modal-backdrop').remove();
                        get_news_page();
                    } // end of success
                }); // end of $.ajax
            }
        }

        if (event.target.id.indexOf("news_del_") >= 0) {
            var id = event.target.id.replace("news_del_", "");
            if (confirm('Delete current item?')) {
                var url = '/lms/custom/news/del.php';
                $.post(url, {id: id}).done(function (data) {
                    get_news_page();
                });
            }
        }

        if (event.target.id == 'add_news') {
            var url = '/lms/custom/news/add_dialog.php';
            $.post(url, {item: 1}).done(function (data) {
                $("body").append(data);
                $("#myModal").modal('show');
                document.body.style.overflow = 'auto';
            });
        }

        if (event.target.id == 'add_news_done') {
            var title = $('#news_title').val();
            var content = CKEDITOR.instances["news_content"].getData();
            var limit = $('#climit').val();
            var status;
            if ($('#active').prop('checked')) {
                status = 1;
            } // end if
            else {
                status = 0;
            } // end else
            var raw_file_data = $('#files')[0].files.length;
            if (title == '' || content == '' || raw_file_data == 0 || limit == 0) {
                $('#news_err').html('Please provide news title, picture, content and limit');
            } // end if
            else {
                $('#news_err').html('');
                var url = '/lms/custom/news/add.php';
                var file_data = $('#files').prop('files');
                var form_data = new FormData();
                $.each(file_data, function (key, value) {
                    form_data.append(key, value);
                });
                form_data.append('title', title);
                form_data.append('content', content);
                form_data.append('status', status);
                form_data.append('limit', limit);
                $.ajax({
                    url: url,
                    data: form_data,
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    success: function () {
                        $("[data-dismiss=modal]").trigger({type: "click"});
                        $("#myModal").remove();
                        $('.modal-backdrop').remove();
                        get_news_page();
                    } // end of success
                }); // end of $.ajax
            } // end else
        }

        if (event.target.id == 'news_cancel_dialog') {
            CKEDITOR.instances['news_content'].destroy(true);
            $("[data-dismiss=modal]").trigger({type: "click"});
            $("#myModal").remove();
            $('.modal-backdrop').remove();
        }


        function get_news_page() {
            var url = '/lms/custom/news/list.php';
            $.post(url, {id: 1}).done(function (data) {
                $('#page-content').html(data);
                $('#news_table').DataTable();
            }); // end of post
        }

        /*********** Courses section ************/

        if (event.target.id == 'courses') {
            var url = '/lms/custom/courses/list.php';
            $.post(url, {id: 1}).done(function (data) {
                $('#page-content').html(data);
                $('#courses_table').dataTable({
                    "pageLength": 3
                });
            }); // end of post
        }

        if (event.target.id == 'course_update_done') {
            var id = $('#courseid').val();
            var cost = $('#cost').val();
            var top;
            if ($('#top_status').prop('checked')) {
                top = 1;
            } // end if
            else {
                top = 0;
            } // end else
            if (cost == '') {
                $('#course_err').html('Please provide course cost');
            } // end if
            else {
                $('#course_err').html('');
                var url = '/lms/custom/courses/update.php';
                var file_data = $('#files').prop('files');
                var form_data = new FormData();
                $.each(file_data, function (key, value) {
                    form_data.append(key, value);
                });
                form_data.append('id', id);
                form_data.append('cost', cost);
                form_data.append('top', top);
                $.ajax({
                    url: url,
                    data: form_data,
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    success: function () {
                        get_courses_page();
                    } // end of success
                }); // end of $.ajax
                $("[data-dismiss=modal]").trigger({type: "click"});
                $("#myModal").remove();
                $('.modal-backdrop').remove();
                get_courses_page();
            } // end else
        }

        if (event.target.id.indexOf("course_edit_") >= 0) {
            var id = event.target.id.replace("course_edit_", "");
            var url = '/lms/custom/courses/dialog.php';
            $.post(url, {id: id}).done(function (data) {
                $("body").append(data);
                $("#myModal").modal('show');
                document.body.style.overflow = 'auto';
            });
        }

        if (event.target.id == 'course_cancel_dialog') {
            $("[data-dismiss=modal]").trigger({type: "click"});
            $("#myModal").remove();
            $('.modal-backdrop').remove();
        }

        function get_courses_page() {
            var url = '/lms/custom/courses/list.php';
            $.post(url, {id: 1}).done(function (data) {
                $('#page-content').html(data);
                $('#courses_table').dataTable({
                    "pageLength": 3
                });
            }); // end of post
        }

        /*********** Feedback section ************/

        if (event.target.id == 'contacts') {
            var url = '/lms/custom/feedback/list.php';
            $.post(url, {id: 1}).done(function (data) {
                $('#page-content').html(data);
                $('#feedback_table').dataTable();
            }); // end of post
        }

        function get_feedback_page() {
            var url = '/lms/custom/feedback/list.php';
            $.post(url, {id: 1}).done(function (data) {
                $('#page-content').html(data);
                $('#feedback_table').dataTable();
            }); // end of post
        }

        /*********** Subscribers section ************/

        if (event.target.id == 'subscribers') {
            var url = '/lms/custom/subscribers/list.php';
            $.post(url, {id: 1}).done(function (data) {
                $('#page-content').html(data);
                $('#subs_table').dataTable();
            }); // end of post
        }

        function get_subsribers_page() {
            var url = '/lms/custom/subscribers/list.php';
            $.post(url, {id: 1}).done(function (data) {
                $('#page-content').html(data);
                $('#subs_table').dataTable();
            }); // end of post
        }

        if (event.target.id.indexOf("subs_edit_") >= 0) {
            var id = event.target.id.replace("subs_edit_", "");
            var url = '/lms/custom/subscribers/dialog.php';
            $.post(url, {id: id}).done(function (data) {
                $("body").append(data);
                $("#myModal").modal('show');
                document.body.style.overflow = 'auto';
            });
        }

        if (event.target.id == 'subs_update_done') {
            var id = $('#subs_id').val();
            var vals = $('.status:radio:checked').map(function () {
                return this.value;
            }).get();
            var status = vals.join(",");
            var item = {id: id, status: status};
            var url = '/lms/custom/subscribers/update.php';
            $.post(url, {item: JSON.stringify(item)}).done(function () {
                $("[data-dismiss=modal]").trigger({type: "click"});
                $("#myModal").remove();
                $('.modal-backdrop').remove();
                get_subsribers_page();
            }); // end of post
        }

        /*********** Subscribers section ************/

        if (event.target.id == 'managers') {
            var roleid = 9;
            var url = '/lms/custom/users/list.php';
            $.post(url, {roleid: roleid}).done(function (data) {
                $('#page-content').html(data);
                $('#users_table').dataTable();
            }); // end of post
        }

        if (event.target.id == 'partners') {
            var roleid = 10;
            var url = '/lms/custom/users/list.php';
            $.post(url, {roleid: roleid}).done(function (data) {
                $('#page-content').html(data);
                $('#users_table').dataTable();
            }); // end of post
        }

        if (event.target.id == 'teachers') {
            var roleid = 4;
            var url = '/lms/custom/users/list.php';
            $.post(url, {roleid: roleid}).done(function (data) {
                $('#page-content').html(data);
                $('#users_table').dataTable();
            }); // end of post
        }

        if (event.target.id == 'students') {
            var roleid = 5;
            var url = '/lms/custom/users/list.php';
            $.post(url, {roleid: roleid}).done(function (data) {
                $('#page-content').html(data);
                $('#users_table').dataTable();
            }); // end of post
        }

        if (event.target.id == 'revenue_rep') {
            var url = '/lms/custom/reports/revenue.php';
            $.post(url, {id: 1}).done(function (data) {
                $('#page-content').html(data);
                $('#reports_table').dataTable();
            }); // end of post
        }

        /*********** Students courses section ************/

        if (event.target.id == 'st_courses') {
            var url = '/lms/custom/courses/course_enroll_dialog.php';
            $.post(url, {id: id}).done(function (data) {
                $('#page-content').html(data);
            });
        }

        if (event.target.id == 'enroll_to_course') {
            var courseid = $('#available_courses').val();
            var userid = $('#userid').val();
            if (courseid > 0) {
                $('#course_err').html('');
                var item = {courseid: courseid, userid: userid};
                if (confirm('Enroll into current course?')) {
                    var url = '/lms/custom/courses/enroll_into_course.php';
                    $.post(url, {item: JSON.stringify(item)}).done(function (data) {
                        /*
                        $("[data-dismiss=modal]").trigger({type: "click"});
                        $("#myModal").remove();
                        $('.modal-backdrop').remove();
                        */
                        console.log('Server response: ' + data);
                        alert('Please re-login to see new courses');
                        document.location.reload();
                    }); // end of post;
                } // end if
            } // end if courseid>0
            else {
                $('#course_err').html('Please select course to enroll');
            }
        }

        if (event.target.id == 'st_subscription') {
            get_student_subscriptions_list();
        }

        if (event.target.id.indexOf("subscription_status_") >= 0) {
            var trans_id = event.target.id.replace("subscription_status_", "");
            if (confirm('Change subscription status?')) {
                var url = '/lms/custom/courses/update_student_subscription_status.php';
                $.post(url, {trans_id: trans_id}).done(function (data) {
                    get_student_subscriptions_list();
                });
            }
        }

        if (event.target.id == 'st_feedback') {
            var url = '/lms/custom/feedback/get_feedback_dialog.php';
            $.post(url, {id: id}).done(function (data) {
                $('#page-content').html(data);
            });
        }

        if (event.target.id == 'send_student_feedback') {
            var userid = $('#userid').val();
            var text = $('#feedback_text').val();
            if (text == '') {
                $('#feedback_err').html('Please provide feedback text');
            } // end if
            else {
                $('#feedback_err').html('');
                var item = {userid: userid, text: text};
                var url = '/lms/custom/feedback/add_student_feedback.php';
                $.post(url, {item: JSON.stringify(item)}).done(function (data) {
                    document.location.reload();
                });
            }
        }

        if (event.target.id == 'st_content') {
            var type = 1;
            var url = '/lms/custom/feedback/get_suggest_dialog.php';
            $.post(url, {type: type}).done(function (data) {
                $('#page-content').html(data);
            });

        }

        if (event.target.id == 'st_teacher') {
            var type = 2;
            var url = '/lms/custom/feedback/get_suggest_dialog.php';
            $.post(url, {type: type}).done(function (data) {
                $('#page-content').html(data);
            });
        }

        if (event.target.id == 'st_proposals') {
            var type = 3;
            var url = '/lms/custom/feedback/get_suggest_dialog.php';
            $.post(url, {type: type}).done(function (data) {
                $('#page-content').html(data);
            });
        }

        if (event.target.id == 'send_student_suggest') {
            var userid = $('#userid').val();
            var type = $('#type').val();
            var courseid = $('#user_courses').val();
            var msg = $('#suggest_text').val();
            if (courseid == 0 || msg == '') {
                $('#suggest_err').html('Please select course and provide message text');
            } // end if
            else {
                $('#suggest_err').html('');
                var item = {courseid: courseid, msg: msg, type: type, userid: userid};
                var url = '/lms/custom/feedback/add_student_suggest.php';
                $.post(url, {item: JSON.stringify(item)}).done(function (data) {
                    $("[data-dismiss=modal]").trigger({type: "click"});
                    $("#myModal").remove();
                    $('.modal-backdrop').remove();
                    document.location.reload();
                });
            } // end else
        }

        if (event.target.id == 'st_resume') {
            var url = '/lms/custom/feedback/get_resume_page.php';
            $.post(url, {id: 1}).done(function (data) {
                $('#page-content').html(data);
            });
        }

        if (event.target.id == 'attach_resume') {
            var userid = $('#userid').val();
            var raw_file_data = $('#resume_file')[0].files.length;
            var file_data = $('#resume_file').prop('files');
            console.log('File data: ' + raw_file_data);
            if (raw_file_data == 0) {
                $('#resume_err').html('Please select file to upload');
                return false;
            } // end if
            else {
                $('#resume_err').html('');
                var url = '/lms/custom/feedback/attach_resume.php';
                var form_data = new FormData();
                $.each(file_data, function (key, value) {
                    form_data.append(key, value);
                });
                form_data.append('userid', userid);
                $('#loader').show();
                $.ajax({
                    url: url,
                    data: form_data,
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    success: function (data) {
                        document.location.reload();
                    } // end of success
                }); // end of $.ajax
            }
        }


    }); // end of body click event


    $("body").change(function (event) {

        console.log('Change Event ID: ' + event.target.id);

        if (event.target.id == 'categories') {
            var id = $('#categories').val();
            var url = '/lms/custom/courses/get_courses_by_category.php';
            $.post(url, {id: id}).done(function (data) {
                $('#courses_container').html(data);
            });
        }


    }); // end of change event


}); // end of document ready
