import React from "react";
import ReactDOM from "react-dom/client";

import Slug from "./form/slug/Slug";
import Excerpt from "./form/Excerpt";
import Content from "./form/content/Content";

function Form() {
    return (
        <form action={formAction} method="POST">
            <div className="col-md-8">
                <input type="hidden" name="_token" defaultValue={csrfToken} />
                {"edit" === formType && (
                    <input type="hidden" name="_method" value="PUT"></input>
                )}
                <Slug />
                <Excerpt />
            </div>
            <Content />
            <button type="submit" className="btn btn-primary">
                {"edit" === formType ? __("Edit") : __("Create")}
            </button>
        </form>
    );
}

export default Form;

var reactElement = document.getElementById("place-form");
if (reactElement) {
    ReactDOM.createRoot(reactElement).render(<Form />);
}
