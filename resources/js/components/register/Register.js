import React from "react";
import ReactDOM from "react-dom";
import Email from "./Email";

function Register() {
// console.debug('!!!!Register');//mmmyyy
    return (
        <Email />
    );
}

export default Register;

if (document.getElementById("react-inputs")) {
    ReactDOM.render(<Register />, document.getElementById("react-inputs"));
    document.getElementById('formWrapper').style.display = '';
}
