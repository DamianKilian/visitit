import cx from "classnames";

function Excerpt() {
    return (
        <div className="mb-3">
            <label htmlFor="excerpt" className="form-label">
                {__("Excerpt")}
                <span className="opacity-50"> ({__("Describe your article")})</span>
            </label>
            <textarea
                name="excerpt"
                className={cx("form-control", {
                    "is-invalid": error.excerpt,
                })}
                id="excerpt"
                rows="3"
                defaultValue={old.excerpt}
            />
            <span className="invalid-feedback" role="alert">
                <strong>{error.excerpt}</strong>
            </span>
        </div>
    );
}

export default Excerpt;
