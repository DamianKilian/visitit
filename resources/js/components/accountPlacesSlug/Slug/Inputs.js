import { useState, useReducer } from "react";
import cx from "classnames";
import urlSlug from "url-slug";
import { __ } from "../../../lang";

function Inputs(props) {
    const [slugError, setSlugError] = useState(error.slug);
    const [title, setTitle] = useState(old.title);
    const [slug, setSlug] = useState(old.slug);
    const [edited, editedDispatch] = useReducer(editedReducer, false);
    function editedReducer(state, action) {
        switch (action) {
            case "on":
                if (!edited) {
                    if (slug === urlSlug(title)) {
                        return false;
                    }
                }
                return true;
            case "off":
            default:
                return false;
        }
    }
    function handleTitleChange(e) {
        const v = e.target.value;
        setTitle(v);
        if (!edited) {
            setSlug(urlSlug(v));
        }
    }
    function handleSlugChange(e) {
        const v = e.target.value;
        setSlug(v);
    }
    function editSlug() {
        setSlug(urlSlug(slug));
        editedDispatch("on");
    }
    function resetSlug() {
        setSlug(urlSlug(title));
        editedDispatch("off");
    }
    return (
        <>
            <div className="mb-3">
                <label htmlFor="place-title" className="form-label">
                    {__("Place title")}
                </label>
                <input
                    id="place-title"
                    name="title"
                    type="text"
                    required
                    className={cx("form-control", {
                        "is-invalid": error.title,
                    })}
                    value={title}
                    onChange={handleTitleChange}
                />
                <span className="invalid-feedback" role="alert">
                    <strong>{error.title}</strong>
                </span>
            </div>
            <div className="mb-3">
                <label htmlFor="slug" className="form-label">
                    {__("Slug")}
                </label>
                <div className="input-group">
                    <input
                        id="slug"
                        type="text"
                        name="slug"
                        required
                        className={cx("form-control", {
                            "is-invalid": slugError,
                        })}
                        value={slug}
                        onChange={handleSlugChange}
                    />
                    <button
                        className={cx("btn", {
                            "btn-outline-success": !edited,
                            "btn-success": edited,
                        })}
                        type="button"
                        onClick={editSlug}
                    >
                        {__("Edit")}
                    </button>
                    <button
                        className="btn btn-outline-danger"
                        type="button"
                        onClick={resetSlug}
                    >
                        {__("Reset")}
                    </button>
                </div>

                <span className="invalid-feedback" role="alert">
                    <strong>{slugError}</strong>
                </span>
            </div>
        </>
    );
}

export default Inputs;
