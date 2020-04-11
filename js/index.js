function myFunction(x) {
    x.classList.toggle("fa-thumbs-up");
    console.log(x.id);
    var name = x.id.split("_");
    console.log(name);
    var request = { 'updateId': name[0], 'postIndex': name[1]};
    $.post("./ajax/likePost.php", request, function (response) {
        if (response != 'Updated') {
            alert('like not posted');
        }
    });

}

function searchUser() {
    var userEmail = $('#search-box').val();
    
}

$(document).ready(function () {
    append_prefix = '<li><a href="#">';
    append_suffix = '</a></li>';

    $.post("./ajax/getMyInfo.php", {}, function (response) {
        jsondata = JSON.parse(response);
        if (jsondata["status"] != 'Error') {
            var name = jsondata['name'];
            var email = jsondata['email'];
            var gender = jsondata['gender'];
            var birthday = jsondata['birthday'];

            var append_string = '<p><b>Name : ' + name + "</b><p>"
                + '<p>Email : ' + email + '</p>'
                + '<p>Gender : ' + gender + '</p>'
                + '<p>Birthday : ' + toNormalTime(birthday).toDateString() + '</p>';

            $("#append_info_div").append(append_string);
            $("#append_name").append(name);
        } else {
            alert("There is a problem with your login");
        }
    });

    $.post("./ajax/getNotification.php", {}, function (response) {
        jsondata = JSON.parse(response);
        if (jsondata["status"] == 'Success') {
            var notes = jsondata['data'][0]['notification'];
            var n = Object.keys(notes).length;
            for (var i = 0; i < n; i++) {
                var append_string = append_prefix + notes[i]['notify_txt'] + append_suffix;
                $("#notify_append").append(append_string);
            }
        } else {
            alert(jsondata["data"]);
        }
    });
});

var me = {};

var you = {};

function formatAMPM(date) {
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0' + minutes : minutes;
    var strTime = hours + ':' + minutes + ' ' + ampm;
    return strTime;
}

//-- No use time. It is a javaScript effect.
function insertChat(who, text, speaker, time = 0) {
    var control = "";
    var date = formatAMPM(new Date());

    if (who == "me") {

        control = '<li style="width:100%" tabindex="1">' +
            '<div class="msj macro">' +
            '<div class="text text-l">' +
            '<p><b>' + speaker + '</b><br>' + text + '</p>' +
            '<p><small>' + date + '</small></p>' +
            '</div>' +
            '</div>' +
            '</li>';


    } else {
        control = '<li style="width:100%;" tabindex="1">' +
            '<div class="msj-rta macro">' +
            '<div class="text text-r">' +
            '<p><b>' + speaker + '</b><br>' + text + '</p>' +
            '<p><small>' + date + '</small></p>' +
            '</div>' +
            '<div class="avatar" style="padding:0px 0px 0px 10px !important"></div>' +
            '</li>';

        //$('#chat_scroll').scrollTop($('#chat_scroll')[0].scrollHeight);
    }
    setTimeout(
        function () {
            $("#chat_scroll").append(control);
            $('#chat_scroll').scrollTop($('#chat_scroll')[0].scrollHeight);
        }, time);

}

function resetChat() {
    $("#chat_scroll").empty();
}

function logout() {
    //alert("logout clicked");
    $.post("./ajax/logout.php", {}, function (response) {
        console.log(response);
        jsondata = JSON.parse(response);
        if (jsondata["status"] == 'Success') {
            window.location = './index.php';
        } else {
            alert(jsondata["data"]);
        }
    });
}

$(".mytext").on("keyup", function (e) {
    if (e.which == 13) {
        var text = $(this).val();
        if (text !== "") {
            insertChat("me", text);
            $(this).val('');
        }
    }
});

//-- Clear Chat
resetChat();

//-- Print Messages
insertChat("me", "Hello Tom...", "Spaceman", 0);
insertChat("you", "Hi, Pablo", "Spaceman", 1500);
insertChat("me", "What would you like to talk about today?", "Spaceman", 3500);
insertChat("you", "Tell me a joke", "Spaceman", 7000);
insertChat("me", "Spaceman: Computer! Computer! Do we bring battery?!", "Spaceman", 9500);
insertChat("you", "LOL", "Spaceman", 12000);
insertChat("you", "LOL", "Spaceman", 12000);
insertChat("you", "LOL", "Spaceman", 12000);
insertChat("you", "LOL", "Spaceman", 12000);

function toNormalTime(epoch) {
    var utcSeconds = epoch;
    var d = new Date(0); // The 0 there is the key, which sets the date to the epoch
    d.setUTCSeconds(utcSeconds);
    return d;
}

function insertPost() {
    $.post("./ajax/getFrndsPost.php", {}, function (response) {
        // console.log(response);
        jsondata = JSON.parse(response);
        if (jsondata.length != 0) {
            var data_length = jsondata.length;
            var flag = 0;

            var ultimate = '';

            for (var i = 0; i < data_length; i++) {
                var subdata = jsondata[i]['user_post'];
                if (subdata.length != 0) {
                    //console.log(jsondata[i]['user_post']);
                    var s1 = '<div class="panel panel-default"><div class="panel-body">';
                    var s1_2 = '<div class="media"';
                    var s2 = jsondata[i]['_id']['$oid'];

                    //console.log(s1, s2, s3, s4, s5);
                    var s6 = '"><div class="media-left"><img src="';

                    var s8 = '" class="media-object" style="width:45px"></div><div class="media-body"><h4 class="media-heading">';
                    var s9 = jsondata[i]['name'];
                    var s10 = '<small><i>Posted on ';

                    var s12 = "</small></h4><p>";

                    var s14 = '</p>';
                    var like = '<i onclick="myFunction(this)" class="fa fa-thumbs-o-up btn btn-primary" id=';
                    var like1 = '> Like</i>';
                    var comment_post = '<div class="form-group"><label for="comment">Comment:</label><textarea class="form-control" rows="4" id="comment_';
                    var comment_1_1 = '"></textarea><br><button type="button" onclick="comment_post(this);" class="btn btn-primary" id="';
                    var comment_1 = '">Post</button></div>';
                    var s15 = '</div></div></div></div>';
                    for (var j = 0; j < subdata.length; j++) {
                        var s3 = j.toString();
                        var s7 = './images/skeleton_logo.png';
                        var s11 = toNormalTime(subdata[j]['post_time']);
                        var s13 = subdata[j]['post_txt'];

                        ultimate += (s1 + s1_2 + s6 + s7 + s8 + s9 + ' ' +
                            s10 + s11 + s12 + s13 + s14 + like + s2 + '_' + s3 + like1);

                        //console.log('Post ' + subdata[j]['post_txt']);
                        if (subdata[j]['comments'].length != 0) {
                            for (var k = 0; k < subdata[j]['comments'].length; k++) {
                                //console.log('comment ' + subdata[j]['comments'][k]['comment_txt']);
                                var s4 = subdata[j]['comments'][k]['commenter'];
                                var s11 = toNormalTime(subdata[j]['comments'][k]['time']);
                                var s5 = k.toString();

                                ultimate += (s1_2 + s2 + '_' + s3 + '_' + s5 + s6 + s7 + s8 + s9 + ' ' +
                                    s10 + s11 + s12 + subdata[j]['comments'][k]['comment_txt'] + s14 + '</div></div>');

                            }
                        }

                        ultimate += (comment_post + s2 + '_' + s3 + '_comment' + comment_1_1 + s2 + '_' + s3 + '_comment' + comment_1 + s15);
                    }
                    $("#append_post_div").append(ultimate);

                }
            }
        } else {
            alert(jsondata["data"]);
        }
    });
}

insertPost();


//-- NOTE: No use time on insertChat.
