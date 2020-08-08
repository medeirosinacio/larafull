toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "600",
    "hideDuration": "1200",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

class Notifier {
    constructor(opt) {
        this.dflt = {
            info: {},
            success: {},
            warning: {},
            error: {}
        }
        this.cfg = _.defaults(opt, this.dflt);
    }

    info(msg, title, options) {
        this.notify('info', msg, title, options);
    }

    success(msg, title, options) {
        this.notify('success', msg, title, options);
    }

    warning(msg, title, options) {
        this.notify('warning', msg, title, options);
    }

    error(msg, title, options) {
        this.notify('error', msg, title, options);
    }

    notify(lvl, msg, title, options) {
        let cfg = this.cfg[lvl];
        if (options) {
            cfg = _.defaults(options, cfg);
        }
        toastr[lvl](msg, title, cfg);
    }
}

const notifier = new Notifier();
