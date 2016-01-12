/**
 * Created by Ershadi Sayuri on 1/12/2016.
 */
// Define a model with some validation rules
var UserModel = Backbone.Model.extend({
    urlRoot: "../user/addNewUser",
    defaults: {
        username: '',
        password: '',
        repeatPassword: '',
        roleId: ''
    },
    validation: {
        username: {
            required: true
        },
        password: {
            minLength: 8
        },
        repeatPassword: {
            equalTo: 'password',
            msg: 'The passwords does not match'
        }
    }
});