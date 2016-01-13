/**
 * Created by Ershadi Sayuri on 1/10/2016.
 */
var NavigatorView = Backbone.View.extend({
    /**
     * navigation menu
     */
    template: _.template($('#navigte-template').html()),
    render: function () {
        this.$el.html(this.template);
        return this;
    }
});