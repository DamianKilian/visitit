import { useState } from "react";
import Modal from "./Modal";

function DestroyRestoreButton(props) {
    const [modalIsOpen, setModalIsOpen] = useState(false);
    function openModalHandler() {
        setModalIsOpen(true);
    }
    function closeModalHandler() {
        setModalIsOpen(false);
    }
    const place = placesData[props.id];
    if (place.trashed) {
        var c = "success";
        var destroyRestoreText = "Enable";
    } else {
        var c = "warning";
        var destroyRestoreText = "Disable";
    }
    return (
        <>
            <a className={`btn btn-${c}`} onClick={openModalHandler}>
                {__(destroyRestoreText)}
            </a>
            {modalIsOpen && (
                <Modal
                    onCancel={closeModalHandler}
                    place={place}
                    c = {c}
                    destroyRestoreText = {destroyRestoreText}
                />
            )}
        </>
    );
}

export default DestroyRestoreButton;
