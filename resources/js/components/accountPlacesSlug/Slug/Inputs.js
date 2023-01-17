import { useState, useReducer, useEffect, useCallback } from "react";
import cx from "classnames";
import urlSlug from "url-slug";
import { __ } from "../../../lang";

import SlugAvailabilityInfo from "./SlugAvailabilityInfo";

function Inputs(props) {
    const [slugError, setSlugError] = useState(error.slug);
    const [slugAvailability, setSlugAvailability] = useState("");
    const [title, setTitle] = useState(old.title);
    const [slug, setSlug] = useState(old.slug);
    const [edited, editedDispatch] = useReducer(editedReducer, false);
    function editedReducer(state, action) {
        switch (action) {
            case "on":
                if (!state) {
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
    const isSlugAvailableDebounce = useCallback(
        _.debounce(isSlugAvailable, 1500),
        []
    );
    function isSlugAvailable(slug) {
        axios
            .get(slugUniqueUrl, {
                params: {
                    slug: slug,
                },
            })
            .then(function (response) {
                setSlugAvailability(response.data.slug_availability);
            })
            .catch(function (error) {
                console.log(error);
            });
    }
    useEffect(() => {
        if (old.slug === slug) {
            setSlugAvailability("");
        } else if ("" !== slug) {
            setSlugAvailability("loading");
            isSlugAvailableDebounce(slug);
        }
    }, [slug]);
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
                    <SlugAvailabilityInfo slugAvailability={slugAvailability} />
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
