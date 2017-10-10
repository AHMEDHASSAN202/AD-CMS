if (typeof jQuery == 'undefined') {
    throw new Error('jQuery is not loaded');
}


$(function() {

    //active links left sidebar
    activeSidebar();

    //searching
    //ajaxSearch();

    //load contents tab
    changeContent();

    //register user
    formAj();

    //edit user
    action();


});

//function for search
function ajaxSearch() {

    var search = $('.search-aj');
    var boxResults = $('.box-result');
    var resultsHtml = $('.results');
    var loader = $('#loader.loader');

    search.keyup(function () {

        if (search.val().length >= 1) {

            $.ajax({
                url: search.data('target'),
                data: {value: search.val()},
                dataType: 'html',
                type: 'POST',
                beforeSend: function () {
                    boxResults.css('display' , 'block');
                    loader.css('display' , 'block');
                },
                success: function (results) {
                    loader.css('display' , 'none');
                    resultsHtml.html(results);
                }
            });

        }else {

            boxResults.css('display' , 'none');
        }

    });
}

//active links left sidebar
function activeSidebar()
{
    var links = '#sidebar-menu li a';

    $(links).each(function () {
        if ($(this).attr('href') == window.location.href) {
            $(this).parent().addClass('active').siblings().removeClass('active');
        }
    });

}


//change tab content
function changeContent()
{
    var loader = $('.tab-content .loader');
    var defaultLink = $('#nav-tabs li.active a');
    var links = '#nav-tabs li a';
    var content = $('#tab-content .content');

    //get default view
    $.ajax({
        url: defaultLink.attr('href'),
        type: 'post',
        dataType: 'html',
        beforeSend: function () {
            loader.css('display' , 'block');
        },
        success: function (html) {
            loader.css('display' , 'none');
            content.html(html);
        }
    });

    //change the view
    $(links).on('click' , function () {

        $.ajax({
            url: $(this).attr('href'),
            type: 'post',
            dataType: 'html',
            beforeSend: function () {
                loader.css('display' , 'block');
            },
            success: function (html) {
                loader.css('display', 'none');
                content.html(html);
            }
        });

        $(this).parent().addClass('active').siblings().removeClass('active');

        return false;
    });
}

/*Register Form =========*/
function formAj()
{
    var form = ('.formAj'),
        loading = ('#loading-form');

    $(document).on('submit', form ,function () {

        var data = new FormData($(form)[0]);

        $.ajax({
            url: $(form).attr('action'),
            data: data,
            type: $(form).attr('method'),
            dataType: 'json',
            beforeSend: function() {
                $(loading).css('display' , 'block');
            },
            success: function (result) {
                $(loading).css('display' , 'none');
                if (result.errors) {
                    //exists errors
                    swal({
                        title: 'Error!',
                        html: result.errors,
                        type: 'error',
                        showConfirmButton: false,
                        showCancelButton: true,
                        cancelButtonText: 'Cancel',
                        cancelButtonClass: 'btn btn-danger',
                        focusCancel: true,
                    })
                }else {
                    //success register
                    swal({
                        title: 'Good job!',
                        text: result.success,
                        type: 'success',
                        timer: 2000,
                        showConfirmButton: false,
                    }).then(
                        function () {},
                        // handling the promise rejection
                        function (dismiss) {
                            if (dismiss === 'timer') {
                                changeContent();
                            }
                        }
                    )
                }
            },
            cache: false,
            processData: false,
            contentType: false
        });

        return false;
    });
}


/*Action ============*/
function action()
{
    var deleteButton = '.deleteButton';
    var activateUser = '.activate-user';
    var editUser = '.editButton';
    var saveEdit = '.saveEdit';
    var modalButton = '.modal-button';


    //delete user
    $('#tab-content .content').on('click' , deleteButton , function () {

        url = $(this).data('target');

        swal({
            title: 'Are you sure ?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: true,
            width: '400px',

        }).then(function () {

            //start ajax for deleted
            $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                beforeSend: function () {},
                success: function (status) {

                    if (status == true) {

                        swal({
                            title: 'Successfully removed',
                            text: 'Done has been removed!',
                            timer: 2000,
                            type: 'success',
                            width: '400px',
                            showConfirmButton: false,
                        })

                        changeContent();

                    }else {

                        swal({
                            title: 'Oops! ',
                            text: 'Error in Remove it',
                            timer: 2000,
                            type: 'error',
                            width: '400px',
                            showConfirmButton: false,
                        })

                        return false;
                    }
                },
            });

        }, function (dismiss) {
            // dismiss can be 'cancel', 'overlay',
            // 'close', and 'timer'
            if (dismiss === 'cancel') {
                return false;
            }
        })

    });


    //activate user
    $('#tab-content .content').on('click' , activateUser , function () {

        $.ajax({
            url: $(this).data('target'),
            type: 'post',
            dataType: 'json',
            success: function (status) {
                if (status == true) {
                    swal({
                        title: 'Success',
                        text: 'Successfully activated',
                        type: 'success',
                        showConfirmButton: false,
                        timer: 2000,
                        width: '400px'
                    });

                    changeContent();


                }else {
                    swal({
                        title: 'Error!',
                        text: 'Something Error',
                        type: 'error',
                        showConfirmButton: false,
                        timer: 2000,
                        width: '400px'
                    });
                }
            }
        });
    });


    //edit user
    $('#tab-content .content').on('click' , editUser , function () {

        url = $(this).data('target');

        $.ajax({
            url: url,
            type: 'post',
            dataType: 'html',
            success: function (html) {
                if (html) {

                    if ($('#edit-user').length) {
                        $('#edit-user').remove();
                    }

                    $('body').append(html);
                    $('#edit-user').modal('show');

                }else {
                    swal({
                        title: 'Error!',
                        text: 'Something Error',
                        type: 'error',
                        showConfirmButton: false,
                        timer: 2000,
                        width: '400px'
                    });
                }
            }
        });

    });

    //save edit data
    $(document).on('click', saveEdit, function () {

        var form = document.getElementsByClassName($(this).data('target'));
        method = $(form).attr('method');
        url = $(form).attr('action');
        data = new FormData($(form)[0]);

        $.ajax({
            url: url,
            type: method,
            dataType: 'json',
            data: data,
            success: function (result) {
                if (result.error) {
                    swal({
                        title: 'Error!',
                        html: result.error,
                        type: 'error',
                        showConfirmButton: false,
                        timer: 2000,
                        width: '400px'
                    });
                }else {
                    changeContent();
                    swal({
                        title: result.success,
                        timer: 2000,
                        type: 'success',
                        width: '400px',
                        showConfirmButton: false,
                    }).then(
                        function () {},
                        // handling the promise rejection
                        function (dismiss) {
                            if (dismiss === 'timer') {
                                $('#edit-user').modal('hide');
                            }
                        }
                    );
                }
            },
            cache: false,
            contentType: false,
            processData: false,
        });

        return false;
    });


    //append modal view to body
    $(document).on('click', modalButton, function () {

        var content = $('#tab-content .content');

        $.ajax({

            url: $(this).data('target'),
            type: 'post',
            dataType: 'html',
            success: function(html) {
                if (html) {

                    if ($('#modal-section').length) {
                        $('#modal-section').remove();
                    }

                    $('body').append(html);
                    $('#modal-section').modal('show');

                }else {
                    swal({
                        title: 'Oops! ',
                        text: 'Error in Remove it',
                        timer: 2000,
                        type: 'error',
                        width: '400px',
                        showConfirmButton: false,
                    })

                    return false;
                }
            }
        });

    })

}

