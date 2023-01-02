import { useState } from "react";
import cx from "classnames";

/**
 * Validate Email
 */

function Email() {
    const [emailError, setEmailError] = useState(error.email);
    const handleEmailChange = (e) => {
        const value = e.target.value;
        if (value.length > 7 && !isEmail(value)) {
            setEmailError(__("Incorrect email address"));
        } else {
            setEmailError("");
        }
    };
    const isEmail = (email) =>
        /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i.test(email);
    // console.debug('!!!!Email');//mmmyyy
    return (
        <div className="row mb-3">
            <label
                htmlFor="email"
                className="col-md-4 col-form-label text-md-end"
            >
                {__("Email address")}
            </label>
            <div className="col-md-6">
                <input
                    id="email"
                    type="email"
                    className={cx("form-control", {
                        "is-invalid": emailError,
                    })}
                    name="email"
                    defaultValue={old.email}
                    required
                    autoComplete="email"
                    onChange={handleEmailChange}
                />
                <span className="invalid-feedback" role="alert">
                    <strong>{emailError}</strong>
                </span>
            </div>
        </div>
    );
}

export default Email;
