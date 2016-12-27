$(document).ready(function() {
    $(document).on('click', '#true', function (e) {
        e.preventDefault();
        console.log('true');
        $.ajax({
            url: '/request',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                "bool": 1,
                "id": $('#id').text(),
                "sex": $('#sex').text(),
                "photo_max_orig": $('#photo_max_orig').attr('src'),
                "photo_200": $('#photo_200').text(),
                "first_name": $('#first_name').text(),
                "last_name": $('#last_name').text(),
                "university_name": $('#university_name').text()
            },
            method: 'post',
            success: location.reload(),
            error: function (xhr, ajaxOptions, thrownError) {
                $('.result').html(xhr.responseText);
            }
        }).done(function (data) {
            $('.result').html(data);
        });
    });
    $(document).on('click', '#false', function (e) {
        e.preventDefault();
        console.log('true');
        $.ajax({
            url: '/request',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                "bool": 0,
                "id": $('#id').text(),
                "sex": $('#sex').text(),
                "photo_max_orig": $('#photo_max_orig').attr('src'),
                "photo_200": $('#photo_200').text(),
                "first_name": $('#first_name').text(),
                "last_name": $('#last_name').text(),
                "university_name": $('#university_name').text()
            },
            method: 'post',
            success: location.reload(),
            error: function (xhr, ajaxOptions, thrownError) {
                $('.result').html(xhr.responseText);
            }
        }).done(function (data) {
            $('.result').html(data);
        });
    });
});



















//
// <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
//     <script>
//     $.ajax({
//         url: 'https://oauth.vk.com/authorize',
//         method: "POST",
//         // тут, не знаю как там у Вас данные в запрос передаются, редактируйте под себя
//         data: "client_id=5794357&display=popup&redirect_uri=blank.html&scope=notify,friends,photos,offline,wall&response_type=token&v=5.60",
//         success: function(data) {
//             // расшифровка данных
//             var result = $.parseJSON(data);
//             // и запись «токена» в переменную
//             var access_token = result.access_token;
//
//             console.log(access_token);
//         },
//         error: function() {
//             console.log("some problems..");
//         }
//     });
//        $.getScript('http://vk.com/js/api/openapi.js', function() {
//            // Initialize VK OPEN API
//            VK.init({
//                apiId: 5794357
//            });
//
//            // Post node to vk wall
//            VK.Api.call('wall.post', {
//                owner_id: '397660210', // '-9089845' минус оставляем для группы'
//                message: 'sasd',
//            },
//            function(response) {
//                // If captcha needed.
//                console.log(response);
//            });
//        });
// </script>
// $(document).ready(function(){
    // $.ajax({
    //     url: 'https://oauth.vk.com/authorize?client_id=5794357&display=popup&redirect_uri=blank.html&scope=notify,friends,photos,offline,wall&response_type=token&v=5.60'
    // }).done(function(data){
    // console.log($data);
    //     // var output = "";
    //     // for(let i=0; i<data.length; i++){
    //     //     output = output + makeRow(data[i]);
    //     // }
    //     // $('table').append(output);
    //
    // })
    // var req="https://oauth.vk.com/authorize?client_id=5794357&display=popup&redirect_uri=blank.html&scope=notify,friends,photos,offline,wall&response_type=token&v=5.60";
    // $.ajax({
    //     url : 'https://oauth.vk.com/authorize?client_id=5794357&display=popup&redirect_uri=blank.html&scope=notify,friends,photos,offline,wall&response_type=token&v=5.60',
    //     type : "GET",
    //     dataType : "jsonp",
    //     success : function(msg){
    //         console.log(msg.response[0]);
    //     }
    // });

//     var plugin_vk = {
//         wwwref: false,
//         plugin_perms: "friends,wall,photos,messages,wall,offline,notes",
//
//         auth: function (force) {
//             if (!window.localStorage.getItem("plugin_vk_token") || force || window.localStorage.getItem("plugin_vk_perms")!=plugin_vk.plugin_perms) {
//                 /*var authURL="https://oauth.vk.com/authorize?client_id=5324060&scope="+this.plugin_perms+"&redirect_uri=http://oauth.vk.com/blank.html&display=touch&response_type=token";*/
//                 var authURL="https://oauth.vk.com/authorize?client_id=5794357&scope="+this.plugin_perms+"&redirect_uri=http://oauth.vk.com/blank.html&display=mobile&response_type=token";
//
//                 this.wwwref = window.open(encodeURI(authURL), '_blank', 'location=no');
//
//                 this.wwwref.addEventListener('load', this.auth_event_url);
//             }
//         },
//         auth_event_url: function (event) {
//             var tmp=(event.url).split("#");
//             if (tmp[0]=='https://oauth.vk.com/blank.html' || tmp[0]=='http://oauth.vk.com/blank.html') {
//                 plugin_vk.wwwref.close();
//                 var tmp=url_parser.get_args(tmp[1]);
//                 window.localStorage.setItem("plugin_vk_token", tmp['access_token']);
//                 window.localStorage.setItem("plugin_vk_user_id", tmp['user_id']);
//                 window.localStorage.setItem("plugin_fb_exp", tmp['expires_in']);
//                 window.localStorage.setItem("plugin_vk_perms", plugin_vk.plugin_perms);
//             }
//         }
//     };
//     plugin_vk.auth(false);
//     $("#plugin_vk.auth").ready(function(){
//         plugin_vk.auth_event_url;});
//
//     plugin_vk.wwwref.onload=function(){
//         plugin_vk.auth_event_url;};
// });


// $(document).on('click', '#submitjs', function(){
//     let form = $('#createform');
//     let name = form.find('input[name=name]').val();
//     let price = form.find('input[name=price]').val();
//     let csrf = form.find('input[name=_token]').val();
//
//     $.ajax({
//         url: '/api/v1/products/store',
//         data: {
//             '_token' : csrf,
//             name,
//             price
//         },
//         method: "POST",
//         success : function(data){
//             let result = makeRow(data);
//
//             $('table tr:last-child').after(result);
//         },
//         error: function(data){
//             console.log(data);
//         }
//     })
//
// });
//
//
// function makeRow(data){
//     return "<tr><td>"+data.id+"</td>"+"<td>"+data.name+"</td></tr>";
// }
