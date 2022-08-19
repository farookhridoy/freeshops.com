require('./bootstrap');

require('alpinejs');

let userId = document.head.querySelector('meta[name="current"]').content;
let role = document.head.querySelector('meta[name="role"]').content;

Echo.private('App.Models.User.'+userId).notification((notification) => {
    console.log(notification);

    if (role == "1") {
        if (!$(".notif button").hasClass('notif-drop')) {
            $(".notif button").addClass('notif-drop');
        }
        $(".notif-count").html(notification.count);
        let html = ''+
        '<a href="'+notification_url+'/'+notification.id+'" style="text-decoration: none; color:inherit;">'+
            '<li class="active">'+
                '<div class="d-flex">'+
                    '<div class="">'+
                        '<div class="notif-icon">'+
                            '<img src="'+notification.data.icon+'" class="img-fluid" alt="Notif Icon">'+
                        '</div>'+
                    '</div>'+
                    '<div class="px-1">'+
                        '<strong>'+notification.data.title+'</strong>'+
                        '<p>'+notification.data.body+'</p>'+
                        '<small class="text-muted text-end">1 second ago</small>'+
                    '</div>'+
                    '<div class="px-1 ms-auto">'+
                        '<span data-id="'+notification.id+'" class="read-status d-inline-block font-20"><i class="uil uil-envelope align-middle icons"></i></span>'+
                    '</div>'+
                '</div>'+
            '</li>'+
        '</a>';

        $(".notifications").prepend(html);
    } else {
        $(".notif-count").html(notification.count);
        $(".notif-count").show();

        let html = ''+
        '<a href="'+notification_url+'/'+notification.id+'" class="dropdown-item position-relative py-3 unread">'+
            '<span data-id="'+notification.id+'" class="read-status d-inline-block font-20"><i class="mdi mdi-email-outline noti-icon"></i></span>'+
            '<small class="float-right text-muted pl-2">1 second ago</small>'+
            '<div class="media">'+
                '<div class="avatar-md rounded-circle">'+
                    '<img src="'+notification.data.icon+'" class="img-fluid rounded-circle" alt="Notif Icon">'+
                '</div>'+
                '<div class="media-body align-self-center ml-2 text-truncate">'+
                    '<h6 class="my-0 font-weight-normal text-dark">'+notification.data.title+'</h6>'+
                    '<small class="text-muted mb-0">'+notification.data.title+'</small>'+
                '</div>'+
            '</div>'+
        '</a>';

        $(".notifications-prepend").prepend(html);
    }
});
