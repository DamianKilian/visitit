import { useState, useRef } from "react";
import cx from "classnames";

/**
 * Validate Pass
 */

function Pass() {
    const passRef = useRef();
    const passConfirmRef = useRef();

    const [passError, setPassError] = useState(error.pass);
    const handlePassChange = () => {
        const passVal = passRef.current.value;
        const passConfirmVal = passConfirmRef.current.value;
        if (passVal.length < 8) {
            setPassError(__("Password must have at least 8 characters"));
        } else if (passVal !== passConfirmVal) {
            setPassError(__("Password confirmation doesn't match"));
        } else {
            setPassError("");
        }
    };

    // console.debug('!!!!Pass');//mmmyyy
    return (
        <>
            <div className="row mb-3">
                <label
                    htmlFor="password"
                    className="col-md-4 col-form-label text-md-end"
                >
                    {__("Password")}
                </label>
                <div className="col-md-6">
                    <input
                        ref={passRef}
                        id="password"
                        type="password"
                        className={cx("form-control", {
                            "is-invalid": passError,
                        })}
                        name="password"
                        required
                        autoComplete="new-password"
                        onChange={handlePassChange}
                    />
                    <span className="invalid-feedback" role="alert">
                        <strong>{passError}</strong>
                    </span>
                </div>
            </div>
            <div className="row mb-3">
                <label
                    htmlFor="password-confirm"
                    className="col-md-4 col-form-label text-md-end"
                >
                    {__("Confirm password")}
                </label>
                <div className="col-md-6">
                    <input
                        ref={passConfirmRef}
                        id="password-confirm"
                        type="password"
                        className="form-control"
                        name="password_confirmation"
                        required
                        autoComplete="new-password"
                        onChange={handlePassChange}
                    />
                </div>
            </div>
        </>
    );
}

export default Pass;
