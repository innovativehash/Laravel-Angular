/* ============================================================
 * Directive: pgNavigate
 * Pre-made view ports to be used for HTML5 mobile hybrid apps
 * ============================================================ */

function pgNavigate() {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {

            $(element).click(function() {
                var el = $(this).attr('data-view-port');
                if ($(this).attr('data-toggle-view') != null) {
                    $(el).children().last().children('.view').hide();
                    $($(this).attr('data-toggle-view')).show();
                }
                $(el).toggleClass($(this).attr('data-view-animation'));
                $(this).parent().trigger('click');
                return false;
            });


        }
    }
};

export const PgNavigate = pgNavigate
