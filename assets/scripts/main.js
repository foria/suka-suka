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

    function getToday() {
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();
        var month = today.toLocaleString('en-us', { month: 'long' });

        if(dd<10) {
            dd = '0'+dd
        }

        if(mm<10) {
            mm = '0'+mm
        }

        today = [yyyy,  mm, dd, month];

        return today;
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
            url = urlBase;
            if($( '#tribe-bar-date' ).val() != null && $( '#tribe-bar-date' ).val().length > 0 ) {
                url += 'start_date=' + $( '#tribe-bar-date' ).val() + '&';
            }
            if($( '#tribe-bar-location' ).val() != null) {
                url += 'location=' + $( '#tribe-bar-location' ).val() + '&';
            }
            if($( '#tribe-bar-category' ).val() != null) {
                url += 'category=' + $( '#tribe-bar-category' ).val() + '&';
            }
            //console.log(url);
            loadEvents(url);
        })

        $('#menu-categories a').click(function(event){
            event.stopImmediatePropagation();
            event.preventDefault();

            if($(this).hasClass('active')){
                $(this).removeClass('active');
                url = urlBase;
            } else {
                if($('#menu-categories .active').length > 0){
                    $('#menu-categories .active').removeClass('active');
                }
                url = urlBase + 'category=' + $(event.target).text() + '&';
                $(event.target).addClass('active');
            }

            if($('#menu-location .active').length > 0){
                url += 'location=' + $('#menu-location .active').text() + '&';
            }
            loadEvents(url);
        })

        $('#menu-location a').click(function(event){
            event.stopImmediatePropagation();
            event.preventDefault();

            if($(this).hasClass('active')){
                $(this).removeClass('active');
                url = urlBase;
            } else {
                if($('#menu-location .active').length > 0){
                    $('#menu-location .active').removeClass('active');
                }
                url = urlBase + 'location=' + $(event.target).text() + '&';
                $(event.target).addClass('active');
            }

            if($('#menu-categories .active').length > 0){
                url += 'category=' + $('#menu-categories .active').text() + '&';
            }
            loadEvents(url);
        })

        $('#menuToggle').on('click', function(){
            $('body').toggleClass('menu-opened');
        })

        $('.mobile-menu .menu-item-has-children a').on('click', function(){
            $(this).toggleClass('showsub');
        })

        if(window.innerWidth < 1025){
            var selectsHTML = '<select name="day"> <option value="1">1</option> <option value="2">2</option> <option value="3">3</option> <option value="4">4</option> <option value="5">5</option> <option value="6">6</option> <option value="7">7</option> <option value="8">8</option> <option value="9">9</option> <option value="10">10</option> <option value="11">11</option> <option value="12">12</option> <option value="13">13</option> <option value="14">14</option> <option value="15">15</option> <option value="16">16</option> <option value="17">17</option> <option value="18">18</option> <option value="19">19</option> <option value="20">20</option> <option value="21">21</option> <option value="22">22</option> <option value="23">23</option> <option value="24">24</option> <option value="25">25</option> <option value="26">26</option> <option value="27">27</option> <option value="28">28</option> <option value="29">29</option> <option value="30">30</option> <option value="31">31</option> </select><select name="month"> <option value="January">January</option> <option value="February">February</option> <option value="March">March</option> <option value="April">April</option> <option value="May">May</option> <option value="June">June</option> <option value="July">July</option> <option value="August">August</option> <option value="September">September</option> <option value="October">October</option> <option value="November">November</option> <option value="December">December</option> </select>';
            $(selectsHTML).insertAfter('.mobile-menu #tribe-bar-date');

            var date = getToday();
            $('select[name="day"]').val(date[2]);
            $('select[name="month"]').val(date[3]);
        }


    })

})( jQuery );
