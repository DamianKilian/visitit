import { useState } from "react";
import Modal from "./Modal";

function ForceDelete(props) {
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
    return (
        <>
            <a className="btn btn-danger" onClick={openModalHandler}>
                {__("Remove")}
            </a>
            {modalIsOpen && (
                <Modal
                    onCancel={closeModalHandler}
                    route = {place.routes.forceDelete}
                    text = "Delete permanently place?"
                    method = "DELETE"
                    c = "danger"
                    destroyRestoreText = "Delete permanently"
                />
            )}
        </>
    );
}

export default ForceDelete;
