/**
 * Created by Ershadi Sayuri on 1/7/2016.
 */
var Users = Backbone.Collection.extend({
    url: '../user/loadAllUsers'
});

var UserListView = Backbone.View.extend({
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

var AddAdminView = Backbone.View.extend({
    events: {
        'click #saveAdminButton': function (e) {
            e.preventDefault();
            this.saveAdmin();
        }
    },

    render: function () {
        var template = _.template($('#new-admin-template').html());
        var renderedContent = template({});
        this.$el.html(renderedContent);
        return this;
    },

    saveAdmin: function () {
        var adminDetails = this.$el.serializeObject();
        console.log(adminDetails);
    },

    //render: function () {
    //    this.$el.html(this.template(this.model.attributes));
    //}
});

/**
 * converts form elements to a valid JSON object
 */
$.fn.serializeObject = function () {
    "use strict";
    var a = {}, b = function (b, c) {
        var d = a[c.name];
        "undefined" != typeof d && d !== null ? $.isArray(d) ? d.push(c.value) : a[c.name] = [d, c.value] : a[c.name] = c.value
    };
    return $.each(this.serializeArray(), b), a
};