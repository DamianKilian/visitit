import { useState } from "react";
import Modal from "./Modal";

function DestroyRestoreButton(props) {
    const [modalIsOpen, setModalIsOpen] = useState(false);
    function openModalHandler() {
        setModalIsOpen(true);
    }
    function closeModalHandler(e) {
        if (
            e.target.closest(".close-modal") ||
            !e.target.closest(".modal-content")
        ) {
            setModalIsOpen(false);
        }
    }
    const place = placesData[props.id];
    if (place.trashed) {
        var route = place.routes.restore;
        var destroyRestoreText = "Enable";
        var text = "Enable Place?";
        var method = "PUT";
        var c = "success";
    } else {
        var route = place.routes.destroy;
        var destroyRestoreText = "Disable";
        var text = "Disable Place?";
        var method = "DELETE";
        var c = "warning";
    }
    return (
        <>
            <a className={`btn btn-${c}`} onClick={openModalHandler}>
                {__(destroyRestoreText)}
            </a>
            {modalIsOpen && (
                <Modal
                    onCancel={closeModalHandler}
                    route = {route}
                    text = {text}
                    method = {method}
                    c = {c}
                    destroyRestoreText = {destroyRestoreText}
                />
            )}
        </>
    );
}

export default DestroyRestoreButton;
