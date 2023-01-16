import React from "react";
import ReactDOM from "react-dom/client";
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

var reactElement = document.getElementById("react-inputs");
if (reactElement) {
    ReactDOM.createRoot(reactElement).render(<Register />);
    document.getElementById("formWrapper").style.display = "";
}
