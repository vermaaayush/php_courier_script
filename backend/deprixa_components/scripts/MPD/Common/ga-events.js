$(document).ready(function () {
    
    //track an event click for any element with the class "ga-trackevent"
    $(".ga-trackevent").each(function () {
        $(this).on("click", function (event) {
            var category = GetCategory($(this));
            var action = GetAction($(this), "Clicked");
            var label = GetLabelByValue($(this));
            SendEvent(category, action, label);
        });
    });

    $(".ga-fieldfocusevent").each(function () {
        var category = GetCategory($(this));
        var label = GetLabelForField($(this));
        $(this).on("focus", function () {
            var action = GetAction($(this), "FieldEnter");
            SendEvent(category, action, label);
        });
    });

    $(".ga-fieldblurevent").each(function () {
        $(this).on("blur", function () {
            var condition = GetCondition($(this));
            var category = GetCategory($(this));
            var action = "";
            var label = GetLabelForField($(this));
            var value = 0;
            var val = $(this).val();
            if (typeof val !== "undefined" && val != null && val.length > 0) {
                value = 1;
        }
        if (condition.hasCondition) {
            if (condition.value === 0) {
                action = "FieldLeaveEmpty";
            } else {
                action = "FieldLeaveCompleted";
            }
            if (value === condition.value) {
                SendEvent(category, action, label);
            }
        }
        else
        {
            if (value === 0) {
                action = "FieldLeaveEmpty";
            }
            else
            {
                action = "FieldLeaveCompleted";
            }
            SendEvent(category, action, label);
        }
        });
    });
    
});

function GetCategory($element) {
    var category = $element.data("gacat");
    if (typeof category === "undefined") {
        category = $element[0].nodeName.toLowerCase();
    }

    return category;
}

function GetAction($element, defaultAction) {
    var action = $element.data("gaact");
    if (typeof action === "undefined") {
        action = defaultAction;
    }
    return action;
}

function GetLabelByValue($element) {
    var label = $element.data("galab");
    if (typeof label === "undefined") {
        label = $element.val();
    }
    return label;
}

function GetLabelForField($element) {
    var label = $element.data("galab");
    if (typeof label === "undefined") {
        var thisLabel = $("label[for='" + $element.attr("id") + "']");
        if (typeof thisLabel !== "undefined" && thisLabel != null) {
            return thisLabel.text();
        } else {
            return "_no_label";
        }
    } else {
        return label;
    }
}

function SendEvent(category, action, label) {
    if (typeof ga !== "undefined" && ga !== null) {
        ga("send", {
            "hitType": "event",
            "eventCategory": category,
            "eventAction": action,
            "eventLabel": label
        },
        { useBeacon: true });
        ga("MPD.send", {
            "hitType": "event",
            "eventCategory": category,
            "eventAction": action,
            "eventLabel": label
        },
        { useBeacon: true });
    }
}

function GetCondition($element) {
    var condition = $element.data("gacond");
    if (typeof condition === "undefined") {
        return new Condition(false, null);
    } else {
        return new Condition(true, condition);
    }
}

function Condition(hasCondition, value) {
    this.hasCondition = hasCondition;
    this.value = value;
    return this;
}