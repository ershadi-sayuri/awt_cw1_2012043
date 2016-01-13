/**
 * Created by Ershadi Sayuri on 1/12/2016.
 */
var AddQuestionView = Backbone.View.extend({
    initialize: function () {
        // This hooks up the validation
        Backbone.Validation.bind(this);
    },

    events: {
        'click #saveQuestionButton': function (e) {
            e.preventDefault();
            this.saveQuestion();
        }
    },

    render: function (id) {
        var that = this;
        this.model.urlRoot = "../question/getQuestionData/" + id;
        if (id != undefined) {
            this.model.fetch({
                success: function () {
                    console.log(that.model.attributes);
                    var template = _.template($('#new-question-template').html());
                    var renderedContent = template({question: that.model});
                    that.$el.html(renderedContent);
                },
                error: function (e) {
                   console.log(e);
                }
            });

        } else {
            var template = _.template($('#new-question-template').html());
            var renderedContent = template(this.model.attributes);
            this.$el.html(renderedContent);
        }

        return this;
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

    saveQuestion: function () {
        var data = $("#addQuestionForm").serializeObject();

        this.model.set(data);
        if (this.model.get("question_id") != null) {
            this.model.urlRoot = "../question/updateQuestionData/" + this.model.get("question_id");
        } else {
            this.model.urlRoot = "../question/saveQuestion";
        }

        // Check if the model is valid before saving
        if (this.model.isValid(true)) {
            this.model.save(data, {
                success: function (response) {
                    $("#questionSaveMessage").text("Question saved successfully.");
                    $("#questionSaveMessage").addClass("text-warning");
                },
                error: function (error) {
                    $("#questionSaveMessage").text("Failed to save the question.");
                    $("#questionSaveMessage").addClass("text-warning");
                }
            });
            $(".form-control").val("");
        }
    },

    remove: function () {
        // Remove the validation binding
        Backbone.Validation.unbind(this);
        return Backbone.View.prototype.remove.apply(this, arguments);
    }

});