import React from "react";
import ReactDOM from "react-dom/client";

import Slug from "./form/slug/Slug";
import Excerpt from "./form/Excerpt";
import Content from "./form/Content";

function Form() {
    return (
        <form action={formAction} method="POST">
            <Slug />
            <Excerpt />
            <Content />
            <button type="submit" className="btn btn-primary">
                {__("Edit")}
            </button>
        </form>
    );
}

export default Form;

var reactElement = document.getElementById("place-form");
if (reactElement) {
    ReactDOM.createRoot(reactElement).render(<Form />);
}
