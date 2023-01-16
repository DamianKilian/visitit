import React from "react";
import ReactDOM from "react-dom/client";
import Inputs from "./Slug/Inputs";

function Slug() {
    return (
        <>
            <Inputs />
        </>
    );
}

export default Slug;

var reactElement = document.getElementById("react-slug");
if (reactElement) {
    ReactDOM.createRoot(reactElement).render(<Slug />);
    document.getElementById("place-form").style.display = "";
}
