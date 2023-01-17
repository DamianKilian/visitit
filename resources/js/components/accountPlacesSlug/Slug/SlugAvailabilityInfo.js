import cx from "classnames";

function SlugAvailabilityInfo(props) {
    const slugAvailability = props.slugAvailability;
    return (
        <span
            className={cx("input-group-text", {
                "text-success":
                    "unavailable" !== slugAvailability &&
                    "loading" !== slugAvailability,
                "text-danger": "unavailable" === slugAvailability,
                "d-none": !slugAvailability,
            })}
        >
            {"loading" === slugAvailability && (
                <span className="spinner-border spinner-border-sm">
                    <span className="visually-hidden">Loading...</span>
                </span>
            )}
            {"loading" !== slugAvailability && slugAvailability}
        </span>
    );
}

export default SlugAvailabilityInfo;
