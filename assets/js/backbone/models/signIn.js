/**
 * Created by Ershadi Sayuri on 1/13/2016.
 */
// Define a model with some validation rules
var SignInModel = Backbone.Model.extend({
    urlRoot: "../user/signInUser",
    defaults: {
        username: '',
        password: '',
    },
    validation: {
        username: {
            required: true
        },
        password: {
            required: true
        }
    }
});