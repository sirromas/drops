$(document).ready(function () {
    console.log("ready!");

    var current_url = window.location.href;


    // Image mapper for resized images
    if (current_url == 'https://learningindrops.com' || current_url == 'https://learningindrops.com/') {
        console.log('Resizer called ....');
        $('map').imageMapResize();
    }

    $('#phone').mask("(99) 99999-9999");

    $.post('https://learningindrops.com/lms/custom/tmp/courses.json', {id: 1}, function (data) {
        $('#theme-coursesearchbox').typeahead({source: data, items: 240});
    }, 'json');


    var Base64 = {
        // private property
        _keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",
        // public method for encoding
        encode: function (input) {
            var output = "";
            var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
            var i = 0;

            input = Base64._utf8_encode(input);

            while (i < input.length) {

                chr1 = input.charCodeAt(i++);
                chr2 = input.charCodeAt(i++);
                chr3 = input.charCodeAt(i++);

                enc1 = chr1 >> 2;
                enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
                enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
                enc4 = chr3 & 63;

                if (isNaN(chr2)) {
                    enc3 = enc4 = 64;
                } else if (isNaN(chr3)) {
                    enc4 = 64;
                }

                output = output +
                    this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
                    this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);

            }

            return output;
        },
        // public method for decoding
        decode: function (input) {
            var output = "";
            var chr1, chr2, chr3;
            var enc1, enc2, enc3, enc4;
            var i = 0;

            input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

            while (i < input.length) {

                enc1 = this._keyStr.indexOf(input.charAt(i++));
                enc2 = this._keyStr.indexOf(input.charAt(i++));
                enc3 = this._keyStr.indexOf(input.charAt(i++));
                enc4 = this._keyStr.indexOf(input.charAt(i++));

                chr1 = (enc1 << 2) | (enc2 >> 4);
                chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
                chr3 = ((enc3 & 3) << 6) | enc4;

                output = output + String.fromCharCode(chr1);

                if (enc3 != 64) {
                    output = output + String.fromCharCode(chr2);
                }
                if (enc4 != 64) {
                    output = output + String.fromCharCode(chr3);
                }

            }

            output = Base64._utf8_decode(output);

            return output;

        },
        // private method for UTF-8 encoding
        _utf8_encode: function (string) {
            string = string.replace(/\r\n/g, "\n");
            var utftext = "";

            for (var n = 0; n < string.length; n++) {

                var c = string.charCodeAt(n);

                if (c < 128) {
                    utftext += String.fromCharCode(c);
                } else if ((c > 127) && (c < 2048)) {
                    utftext += String.fromCharCode((c >> 6) | 192);
                    utftext += String.fromCharCode((c & 63) | 128);
                } else {
                    utftext += String.fromCharCode((c >> 12) | 224);
                    utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                    utftext += String.fromCharCode((c & 63) | 128);
                }

            }

            return utftext;
        },
        // private method for UTF-8 decoding
        _utf8_decode: function (utftext) {
            var string = "";
            var i = 0;
            var c = c1 = c2 = 0;

            while (i < utftext.length) {

                c = utftext.charCodeAt(i);

                if (c < 128) {
                    string += String.fromCharCode(c);
                    i++;
                } else if ((c > 191) && (c < 224)) {
                    c2 = utftext.charCodeAt(i + 1);
                    string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
                    i += 2;
                } else {
                    c2 = utftext.charCodeAt(i + 1);
                    c3 = utftext.charCodeAt(i + 2);
                    string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                    i += 3;
                }
            }
            return string;
        }
    };

    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }

    function validateEmail($email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test($email);
    }

    $("body").click(function (event) {

        var element_id = event.target.id;
        var element_class = $(event.target).prop("class");

        console.log('Element ID: ' + event.target.id);
        console.log('Element Class: ' + element_class);

        /******************* Index page suggest modals *********************/

        if (element_class == 'contact_suggest') {
            var title = $(event.target).prop('title');
            console.log('Title: ' + title);
            var id = Math.round((new Date()).getTime() / 1000);
            var url = '/index.php/index/get_suggest_box';
            var item = {id: id, title: title};
            $.post(url, {id: JSON.stringify(item)}).done(function (data) {
                var modalID = '#' + id;
                $("body").append(data);
                //$("#myModal").modal('show');
                $(modalID).modal('show');
            });
        }

        if (event.target.id.indexOf("send_suggest_") >= 0) {
            var modalID = event.target.id.replace("send_suggest_", "");

            var type_elid = '#suggest_type_' + modalID;
            var type = $(type_elid).val();
            console.log('Type ID: ' + type);

            var course_elid = '#suggest_course_' + modalID;
            var courseid = $(course_elid).val();
            console.log('Course ID: ' + courseid);

            var text_elid = '#suggest_text_' + modalID;
            var text = $(text_elid).val();
            console.log('Message text: ' + text);

            var err_elid = '#suggest_err_' + modalID;
            console.log('Error container: ' + err_elid);

            if (type == 0 || courseid == 0 || text == '') {

                $(err_elid).html('Please provide mandatory fields');
                return false;
            } // end if
            else {
                $(err_elid).html('');
                var item = {type: type, courseid: courseid, text: text};
                var url = '/index.php/index/send_suggest_message';
                $.post(url, {item: JSON.stringify(item)}).done(function () {
                    $("[data-dismiss=modal]").trigger({type: "click"});
                    $(modalID).remove();
                    $('.modal-backdrop').remove();
                });
            } // end else
        }

        if (event.target.id == 'cancel_suggest') {
            var id = Math.round((new Date()).getTime() / 1000);
            var modalID = '#' + id;
            $("[data-dismiss=modal]").trigger({type: "click"});
            $(id).remove();
            $('.modal-backdrop').remove();
            $("body").scroll();
        }

        /******************* Index page contact modal *********************/

        if (element_class == 'contact_suggest2') {
            var title = $(event.target).prop('title');
            console.log('Title: ' + title);
            var id = Math.round((new Date()).getTime() / 1000);
            var url = '/index.php/index/get_suggest_box_company';
            var item = {id: id, title: title};
            $.post(url, {id: JSON.stringify(item)}).done(function (data) {
                var modalID = '#' + id;
                $("body").append(data);
                $(modalID).modal('show');
            });
        }

        if (event.target.id.indexOf("send_suggestcompany_") >= 0) {
            var modalID = event.target.id.replace("send_suggestcompany_", "");

            console.log('Send Suggest company button ID:' + modalID);

            var name_elid = '#suggest_company_name_' + modalID;
            var name = $(name_elid).val();
            console.log('Name: ' + name);

            var email_elid = '#suggest_company_email_' + modalID;
            var email = $(email_elid).val();
            console.log('Email: ' + email);

            var phone_elid = '#suggest_company_phone_' + modalID;
            var phone = $(phone_elid).val();
            console.log('{Phone: ' + phone);

            var company_elid = '#suggest_company_company_' + modalID;
            var company = $(company_elid).val();
            console.log('Company: ' + company)

            var msg_elid = '#suggest_company_text_' + modalID;
            var msg = $(msg_elid).val();
            console.log('Message Text: ' + msg);

            var err_elid = '#suggest_err_company_' + modalID;
            console.log('Error container: ' + err_elid);

            var item = {name: name, phone: phone, email: email, company: company, text: msg};
            console.log('Item: ' + JSON.stringify(item));

            if (name == '' || email == '' || phone == '' || company == '' || msg == '') {
                $(err_elid).html('Please provide all mandatory fields');
                return false;
            } // end if
            else {
                $(err_elid).html('');
                var url = '/index.php/index/send_suggest_contact';
                $.post(url, {item: JSON.stringify(item)}).done(function () {
                    $("[data-dismiss=modal]").trigger({type: "click"});
                    $(modalID).remove();
                    $('.modal-backdrop').remove();
                });


            } // end else

        }

        /******************* Register page terms & conditions *********************/

        if (event.target.id == 'terms') {
            if ($('#terms').prop('checked')) {
                var url = '/index.php/register/get_terms_box';
                $.post(url, {id: 1}).done(function (data) {
                    $("body").append(data);
                    $("#myModal").modal('show');
                    $('#reg_continue').prop('disabled', false);
                });
            }
        }

        if (event.target.id == 'course_cancel_dialog') {
            $("[data-dismiss=modal]").trigger({type: "click"});
            $("#myModal").remove();
            $('.modal-backdrop').remove();
        }

        /******************* Registration form *********************/

        if (event.target.id == 'reg_continue') {
            var courseid = $('#courses').val();
            var name = $('#name').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var address = $('#address').val();

            if (courseid == 0) {
                $('#reg_err').html('Please select program course');
                return false;
            }

            if (name == '') {
                $('#reg_err').html('Please provide name');
                return false;
            }

            if (email == '') {
                $('#reg_err').html('Please provide email');
                return false;
            }

            if (!validateEmail(email)) {
                $('#reg_err').html('Please provide valid email');
                return false;
            }

            if (phone == '') {
                $('#reg_err').html('Please provide phone');
                return false;
            }

            if (address == '') {
                $('#reg_err').html('Please provide address');
                return false;
            }

            if (!$('#terms').prop('checked')) {
                $('#reg_err').html('Please agree with terms and conditions');
                return false;
            }

            $('#reg_err').html('');

            var email_url = 'https://learningindrops.com/index.php/register/is_email_exist';
            $.post(email_url, {email: email}).done(function (data) {
                if (data > 0) {
                    $('#reg_err').html('Email is in use');
                    return false;
                } // end if
                else {
                    $('#reg_err').html('');
                    var user = {
                        courseid: courseid,
                        name: name,
                        email: email,
                        phone: phone,
                        address: address
                    };
                    var item = Base64.encode(JSON.stringify(user));
                    var next_url = 'https://learningindrops.com/index.php/register/confirm_order/' + item;
                    document.location = next_url;
                } // end else
            });
        }

        if (event.target.id == 'send_contact_request') {
            var name = $('#name').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var msg = $('#msg').val();

            if (name == '') {
                $('#contact_err').html('Please provide name');
                return false;
            }

            if (email == '') {
                $('#contact_err').html('Please provide email');
                return false;
            }

            if (!validateEmail(email)) {
                $('#contact_err').html('Please provide valid email');
                return false;
            }

            if (phone == '') {
                $('#contact_err').html('Please provide phone');
                return false;
            }

            if (msg == '') {
                $('#contact_err').html('Please provide message text');
                return false;
            }

            $('#contact_err').html('');

            var item = {name: name, email: email, phone: phone, msg: msg};

            var url = 'https://learningindrops.com/index.php/contact/send';
            $.post(url, {item: JSON.stringify(item)}).done(function (data) {
                $('#contact_form_container').html(data);
            });
        }

        /******************* Index page search feature *********************/

        if (event.target.id == 'index_search') {
            var item = $('#theme-coursesearchbox').val();
            if (item != '') {
                var clear_item = encodeURI(item);
                console.log('Search item: ' + clear_item);
                var url = '/index.php/index/search/' + Base64.encode(clear_item);
                document.location = url;
            }
        }

        /******************* Index page add subscriber feature *********************/

        if (event.target.id == 'add_subs') {
            var subs_email = $('#subs_email').val();
            var subs_name = $('#subs_name').val();
            if (subs_email != '' && subs_name != '') {
                var item = {name: subs_name, email: subs_email};
                var url = '/index.php/index/add_subscriber';
                $.post(url, {item: JSON.stringify(item)}).done(function (data) {
                    alert('Thank you!');
                });
            }
        }


    }); // end of body click

    $("body").change(function (event) {

        console.log('Change Event ID: ' + event.target.id);

        if (event.target.id == 'course_categories') {
            var id = $('#course_categories').val();
            var url = '/index.php/register/get_category_courses';
            $.post(url, {id: id}).done(function (data) {
                $('#courses_span').html(data);
            });
        }


    }); // end of change event

    $(document).keypress(function (event) {

        if (event.which == 13) {
            var item = $('#theme-coursesearchbox').val();
            if (item != '') {
                var clear_item = encodeURI(item);
                console.log('Search item: ' + clear_item);
                var url = 'https://learningindrops.com/index.php/index/search/' + Base64.encode(clear_item);
                document.location = url;
            }
        }


    }); // end of body keypress event


}); // end of document ready