import { Modal } from "bootstrap";
export default function () {
    const modalDelete = new Modal("#modal-delete", {
        backdrop: "static",
    });
    const modalDeleteElement = $(modalDelete._element);
    const form = $(modalDelete._element).find('form');

    $(document).on("click", ".btn-delete", function () {
        form.attr("action", $(this).data("url") || $(this).prop("href"));
        modalDeleteElement
            .find(".delete-title")
            .text($(this).data("title") || "");
        modalDeleteElement
            .find(".delete-label")
            .text($(this).data("label") || "");
        modalDelete.show();
    });

    modalDelete._element.addEventListener("hidden.bs.modal", (event) => {
        modalDeleteElement.attr("action", "#");
        modalDeleteElement.find(".delete-title").text("");
        modalDeleteElement.find(".delete-label").text("");
    });
}
