import * as boostrap from "bootstrap";
import jQuery from "jquery";
window.$ = jQuery;
import "./main";

if (document.getElementById("modal-delete")) {
    import("./components/delete").then((modalDelete) => modalDelete.default());
}
