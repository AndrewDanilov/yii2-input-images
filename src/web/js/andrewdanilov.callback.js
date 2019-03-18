if (typeof andrewdanilov === "undefined" || !andrewdanilov) {
    var andrewdanilov = {};
}

andrewdanilov.inputImages = {
    functions: {},
    register: function(id, func) {
        this.functions[id] = func;
    },
    callFunction: function(id, response) {
        return this.functions[id](response, id);
    }
};