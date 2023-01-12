function Modal(props) {
    function cancelHandler(e) {
        if (
            e.target.closest(".close-modal") ||
            !e.target.closest(".modal-content")
        ) {
            props.onCancel();
        }
    }
    const place = props.place;
    if (place.trashed) {
        var route = place.routes.restore;
        var destroyRestoreText = props.destroyRestoreText;
        var text = "Enable Place?";
        var method = "PUT";
        var c = props.c;
    } else {
        var route = place.routes.destroy;
        var destroyRestoreText = props.destroyRestoreText;
        var text = "Disable Place?";
        var method = "DELETE";
        var c = props.c;
    }
    
    return (
        <>
            <div
                onClick={cancelHandler}
                className="modal fade show"
                tabIndex="-1"
                role="dialog"
                style={{ display: "block" }}
            >
                <div
                    className="modal-dialog modal-dialog-centered"
                    role="document"
                >
                    <div className="modal-content">
                        <div className="modal-header">
                            <h5
                                className="modal-title"
                                id="exampleModalLongTitle"
                            >
                                {__(destroyRestoreText)}
                            </h5>
                        </div>
                        <div className="modal-body">{__(text)}</div>
                        <div className="modal-footer">
                            <button
                                type="button"
                                className="btn btn-secondary close-modal"
                                data-dismiss="modal"
                            >
                                Close
                            </button>
                            <form
                                id="destroy-restore-form"
                                action={route}
                                method="POST"
                            >
                                <input
                                    type="hidden"
                                    name="_method"
                                    value={method}
                                />
                                <input
                                    type="hidden"
                                    name="_token"
                                    value={csrf}
                                />
                                <button
                                    type="submit"
                                    className={`btn btn-${c}`}
                                >
                                    {__(destroyRestoreText)}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div className="modal-backdrop fade show"></div>
        </>
    );
}

export default Modal;
