var Spinner = function (target) {

    this.text = "Yükleniyor...";
    this.spinner = $("<div id='spinner'>");
    this.inner = $("<img style='width: 200px;' src='/img/loading-gif.gif' id='spinner-inner'>");
    this.span = $("<span id='spinner-inner-text'>" + this.text + "</span>");

    this.spinner
        .css("z-index", "99999")
        .css("position", "fixed")
        .css("top", "0")
        .css("left", "0")
        .css("width", "100%")
        .css("height", "100%")
        .css("background", "rgba(255,255,255,0.9")
        .css("margin", "0 0 0 0")
        .css("padding", "0")
        .css("display", "flex")
        .css("flex-flow", "column nowrap")
        .css("align-items", "center")
        .css("align-content", "center")
        .css("justify-content", "center");

    this.inner
        .css("background-color", "transparent")
        .css("color", "#fff")
        .css("padding", "0")
        .css("margin", "0")
        .css("font-size", "144px");
    this.spinner.append(this.inner)
    this.spinner.append(this.span)

    $(target).append(this.spinner);

    this.fadeIn = function (text) {

        this.spinner.empty();
        this.spinner.append(this.inner);
        this.spinner.append(this.span);
        this.span.html(text ? text : this.text);
        this.spinner.fadeIn(100).load();

        return this;
    };

    this.fadeOut = function () {

        this.spinner.fadeOut(100);

        return this;
    };

    this.show = function (text) {

        this.spinner.empty();
        this.spinner.append(this.inner);
        this.spinner.append(this.span);
        this.span.html(text ? text : this.text);
        this.spinner.show().load();

        return this;
    };

    this.hide = function () {

        this.spinner.hide().trigger('');

        return this;
    };

    this.hide();
};