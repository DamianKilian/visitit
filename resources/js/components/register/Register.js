import React from "react";
import ReactDOM from "react-dom";
import Email from "./Email";
import Pass from "./Pass";

function Register() {
// console.debug('!!!!Register');//mmmyyy
    return (
        <>
            <Email />
            <Pass />
        </>
    );
}

export default Register;

if (document.getElementById("react-inputs")) {
    ReactDOM.render(<Register />, document.getElementById("react-inputs"));
    document.getElementById("formWrapper").style.display = "";
}
