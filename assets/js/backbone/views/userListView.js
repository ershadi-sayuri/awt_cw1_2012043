/**
 * Created by Ershadi Sayuri on 1/12/2016.
 */
var UserListView = Backbone.View.extend({
    /**
     * get user list view
     * @returns {UserListView}
     */
    render: function () {
        var that = this;
        var users = new Users();
        var template = _.template($('#user-list-template').html());

        users.fetch({
            success: function (users) {
                var renderedContent = template({users1: users.models});
                that.$el.html(renderedContent);
                console.log(users);
            },
            error: function (e) {
                console.log(e);
            }
        })
        return this;
    }
});