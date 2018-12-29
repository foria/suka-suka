(function( $ ) {

    function loadEvents(url) {
        $('.tribe-events-loop').addClass('loading');
        $.ajax({
           url:url,
           type:'GET',
           success: function(data){
                $('#tribe-events-header').html($(data).find('#tribe-events-header').html())
                $('.tribe-events-loop').html($(data).find('.tribe-events-loop').html());
                $('.tribe-events-loop').removeClass('loading');
           }
        });
    }

    $(document).ready(function(){

        if( $('body').hasClass('page-template-events-location') || $('body').hasClass('page-template-events-search') ){
            $('#tribe-bar-date').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });
        }

        var date, location, cateogry, url;
        var urlBase = '/events-search/?'; //category=clubbing&location=Canggu&start_date=2018-12-01';

        $('#tribe-bar-form.custom-tribe-bar input[type=submit]').on('click', function(){
            if($( '#tribe-bar-date' ).val() != null && $( '#tribe-bar-date' ).val().length > 0 ) {
                url += 'start_date=' + $( '#tribe-bar-date' ).val() + '&';
            }
            if($( '#tribe-bar-location' ).val() != null) {
                url += 'location=' + $( '#tribe-bar-location' ).val() + '&';
            }
            if($( '#tribe-bar-category' ).val() != null) {
                url += 'category=' + $( '#tribe-bar-category' ).val() + '&';
            }
            console.log(url);
            window.location.href = url;
        })

        // $('#menu-categories a').click(function(event){
        //     event.stopImmediatePropagation();
        //     event.preventDefault();

        //     if($(this).hasClass('active')){
        //         $(this).removeClass('active');
        //         url = urlBase;
        //     } else {
        //         if($('#menu-categories .active').length > 0){
        //             $('#menu-categories .active').removeClass('active');
        //         }
        //         url = urlBase + 'category=' + $(event.target).text() + '&';
        //         $(event.target).addClass('active');
        //     }

        //     if($('#menu-location .active').length > 0){
        //         url += 'location=' + $('#menu-location .active').text() + '&';
        //     }
        //     loadEvents(url);
        // })

        // $('#menu-location a').click(function(event){
        //     event.stopImmediatePropagation();
        //     event.preventDefault();

        //     if($(this).hasClass('active')){
        //         $(this).removeClass('active');
        //         url = urlBase;
        //     } else {
        //         if($('#menu-location .active').length > 0){
        //             $('#menu-location .active').removeClass('active');
        //         }
        //         url = urlBase + 'location=' + $(event.target).text() + '&';
        //         $(event.target).addClass('active');
        //     }

        //     if($('#menu-categories .active').length > 0){
        //         url += 'category=' + $('#menu-categories .active').text() + '&';
        //     }
        //     loadEvents(url);
        // })

        $('#menuToggle').on('click', function(){
            $('body').toggleClass('menu-opened');
        })

        $('.mobile-menu .menu-item-has-children > a').on('click', function(){
            $(this).toggleClass('showsub');
        })

    })

})( jQuery );
