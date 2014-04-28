;(function($, settings) {
    var app = app || {};
    var pluginStatus = settings.status || 'active';
    app.contentOverlay = {
        init: function() {
            this.cache();

            this.showOverlay();

            this.events();
        },

        cache: function() {
            this.$body = $('body');
            this.popupTemplate = $('#popupTemplate').html();
        },

        canLocalStorage: function() {
            if ( window.localStorage !== undefined )
                return true;
            else
                return false;
        },

        closePopup: function(e) {
            e.preventDefault();
            var $this = this;
            this.$curtain.fadeOut('slow', function() {
                $this.$curtain.remove();
            });
        },

        events: function() {
            $('.popup').delegate('.close-btn', 'click', $.proxy(this.closePopup, this));
        },

        persistData: function() {
            var localData = localStorage.getItem('content-overlay');
            var now = new Date();
            var diff,
                min = 1000 * 60,
                hrs = min * 60,
                day = hrs * 24,
                week = day * 7,
                month = week * 4,
                intervals = {
                    min: min,
                    hour: hrs,
                    day: day,
                    week: week,
                    month: month
                };

            var show = false;

            newData = { lastVisit: now.getTime() }
            newData = JSON.stringify(newData);

            if ( localData === undefined || localData === null ) {
                localStorage.setItem('content-overlay', newData);
                show = true;
            } else {
                diff = now.getTime() - parseInt( JSON.parse( localData ).lastVisit );
                //console.log(diff, intervals[settings.interval], settings.interval);
                if ( diff >= intervals[settings.interval] ) {
                    show = true;
                    localStorage.setItem('content-overlay', newData);
                }
            }

            return show;
        },

        showOverlay: function() {

            if ( this.canLocalStorage() ) {
                if ( ! this.persistData() )
                    return;
            }


            var curtain = $('<div></div>').addClass('curtain');
            var popup = $('<div></div>').addClass('popup-wrapper');
            var width = (settings.width <= window.innerWidth) ? settings.width : window.innerWidth;
            var height = (settings.width <= window.innerHeight) ? settings.height : ((settings.height * window.innerWidth)/settings.width);

            curtain.css('display','none');
            popup.html( this.popupTemplate.replace(/{{content}}/i, settings.content_overlay) );
            popup.css({
                'width': width,
                'height': height,
                'margin-left': (width / 2) * -1,
                'margin-top': (height / 2) * -1
            });
            curtain.append( popup );

            this.$body.append( curtain );
            this.$curtain = curtain;

            curtain.fadeIn('slow');
        }
     };

    if ( pluginStatus === 'active' ) {
        var delay = settings.delay || 1;
        setTimeout(function(){
            app.contentOverlay.init();
        }, delay  * 1000);
    }

})(jQuery, contentSettings);
