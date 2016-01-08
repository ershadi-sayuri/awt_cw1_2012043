/**
 * Created by Ershadi Sayuri on 1/8/2016.
 */
var SaveUserRouter = Backbone.Router.extend({
    routeParams: {},
    routes: {
        "save/user": "saveUser",
    },

    /**
     * Override navigate function
     * @param route the route hash
     * @param key to pass the parameter
     * @param options the Options for navigate functions
     */
    navigate: function (route, key, options) {
        var routeOption = {
            trigger: true
        };
        var params = (options && options.params) ? options.params : null;
        $.extend(routeOption, options);
        delete routeOption.params;

        //set the params for the route
        this.param(key, params);

        Backbone.Router.prototype.navigate(route, routeOption);
    },

    /**
     * Get or set parameters for a route fragment
     * @param fragment fragment Exact route hash
     * @param params the parameter you to set for the route
     * @returns param value for that parameter
     */
    param: function (fragment, params) {
        var matchedRoute;
        _.any(Backbone.history.handlers, function (handler) {
            if (handler.route.test(fragment)) {
                matchedRoute = handler.route;
            }
        });
        if (params !== undefined) {
            this.routeParams[fragment] = params;
        }

        return this.routeParams[fragment];
    },

    saveUser: function () {
        var username = JSON.parse(this.param("user")).username;
        var password = JSON.parse(this.param("user")).password;
        var roleId = JSON.parse(this.param("user")).roleId;

        $.ajax({
            type: "GET",
            url: '../user/addnewuser',
            data: {username: username, password: password, role_id: roleId},
            success: function (response) {
                alert("admin saved");
                //$("#signUpMessage").html("User added successfully." + response);
                //location.href = "Home.php"

            },
            error: function () {
                $("#signUpMessage").append("Failed to add new user.");
            }
        });
    }
});